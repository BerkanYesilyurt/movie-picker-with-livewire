<?php

namespace App\Livewire;

use App\Services\TMDB\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ContentSuggestion extends Component
{
    public $tmdbService, $type, $adult, $vote_average, $vote_count, $suggestion;
    protected array $rules = [
        'type' => 'required|in:tv,movie',
        'adult' => 'required|boolean',
        'vote_average' => 'required|in:5,6,7,8,9',
        'vote_count' => 'required|integer|min:1|max:100000000'
    ];

    public function generateContent()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->validate();
        $this->generateSuggestion();
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
                'params' => ['id', 'genre_ids', 'title', 'overview', 'poster_path', 'vote_average', 'vote_count', 'title', 'release_date']
            ]
        };

        //TODO: add all fields
        $details['responseKey'] = 'total_pages';
        $pageCount = $this->getSource(Arr::except($details, ['params']));
        $details['page'] = rand(1, (isset($pageCount[0]) ? ($pageCount[0] > 500 ? 250 : $pageCount[0]) : 1));
        $details['responseKey'] = 'results';
        $this->suggestion = collect($this->getSource($details))->random(1);
    }

    private function getSource($details)
    {
        $tmdbService = App::make(Service::class);
        return $tmdbService->getData(
            path: $details['path'],
            responseKey: $details['responseKey'],
            params: $details['params'] ?? NULL,
            queryParams: ['page' => $details['page'] ?? 1]);
    }

    public function render()
    {
        return view('livewire.content-suggestion');
    }

}
