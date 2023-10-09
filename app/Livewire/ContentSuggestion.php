<?php

namespace App\Livewire;

use App\Enums\ContentTypeEnum;
use App\Models\Suggestion;
use App\Services\TMDB\Service;
use Illuminate\Support\Arr;
use Livewire\Component;

class ContentSuggestion extends Component
{
    public $type, $adult, $vote_average, $vote_count, $suggestion, $suggestionId, $params, $translatedParams, $genres, $genre;
    public $refreshComponent = false;
    public $refreshButtons = false;
    protected $listeners = ['setSelectedGenre'];

    protected array $rules = [
        'type' => 'required|in:tv,movie',
        'adult' => 'required|boolean',
        'vote_average' => 'required|in:5,6,7,8,9',
        'vote_count' => 'required|integer|min:1|max:100000000',
        'genre' => 'nullable|numeric'
    ];

    private function prepareAndGetFilters($page = NULL)
    {
        $filters = [
            'include_adult' => $this->adult,
            'vote_average.gte' => $this->vote_average,
            'vote_count.gte' => $this->vote_count,
            'with_genres' => $this->genre
        ];

        return $page
            ? array_merge($filters, ['page' => $page])
            : $filters;
    }

    public function generateContent()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->refreshButtons = !$this->refreshButtons;
        $this->validate();
        $this->generateSuggestion();
        $this->createSuggestionRecord();
    }

    public function setSelectedGenre($genreId)
    {
        $this->genre = $genreId;
    }

    public function setGenres()
    {
        $this->refreshComponent = !$this->refreshComponent;
        $this->genres = match ($this->type){
            'tv' => cache()->get('tv_series_genres'),
            'movie' => cache()->get('movie_genres'),
            default => null
        };
    }

    private function generateSuggestion()
    {
        $details = match ($this->type){
            'tv' => [
                'path' => 'tv_series_discover',
                'params' => ['id', 'genre_ids', 'name', 'overview', 'poster_path', 'vote_average', 'vote_count', 'first_air_date']
            ],
            'movie' => [
                'path' => 'movie_discover',
                'params' => ['id', 'genre_ids', 'title', 'overview', 'poster_path', 'vote_average', 'vote_count', 'release_date']
            ]
        };

        $details['responseKey'] = 'total_pages';
        $pageCount = $this->getSource(Arr::except($details, ['params']));
        $details['page'] = rand(1, (isset($pageCount[0]) ? ($pageCount[0] > 500 ? 250 : $pageCount[0]) : 1));
        $details['responseKey'] = 'results';
        $this->suggestion = collect($this->getSource($details))->random(1)->toArray();
        $this->params = $details['params'];
        $this->translatedParams = $this->translatedColumns();
    }

    private function createSuggestionRecord()
    {
        if(auth()->check() && $this->suggestion[0])
        {
            $this->suggestionId = Suggestion::create([
                'user_id' => auth()->user()->id,
                'type' => ContentTypeEnum::getValueOf($this->type),
                'content' => $this->suggestion[0]
            ])->id;
        }
    }

    private function getSource($details)
    {
        $tmdbService = new Service(
            config('api.tmdb.base_url'),
            config('api.tmdb.paths'),
            config('api.tmdb.api_key'),
            config('api.tmdb.timeout')
        );

        return $tmdbService->getData(
            path: $details['path'],
            responseKey: $details['responseKey'],
            params: $details['params'] ?? NULL,
            queryParams: $this->prepareAndGetFilters($details['page'] ?? NULL));
    }

    private function translatedColumns(): array
    {
        return [
            'id' => 'ID',
            'genre_ids' => 'Genres',
            'name' => 'Name',
            'title' => 'Title',
            'overview' => 'Summary',
            'poster_path' => 'Poster',
            'vote_average' => 'Vote Average',
            'vote_count' => 'Total Vote Count',
            'first_air_date' => 'First Air Date',
            'release_date' => 'Release Date'
        ];
    }

    public function render()
    {
        return view('livewire.content-suggestion');
    }

}
