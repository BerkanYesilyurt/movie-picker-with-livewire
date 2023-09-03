<?php

namespace App\Livewire;

use App\Services\TMDB\Service;
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
        $tmdbService = App::make(Service::class);
        $type = match ($this->type){
            'tv' => 'tv_series_discover',
            'movie' => 'movie_discover'
        };

        //TODO: add all fields

        if($tmdbService->checkAuth()){
            $this->suggestion = $tmdbService->getData(
                path: $type,
                responseKey: 'results',
                params: ['id', 'genre_ids', 'poster_path', 'name', 'vote_average'],
                queryParams: ['language' => 'en-US', 'page' => 1]
            );
        }
    }

    public function render()
    {
        return view('livewire.content-suggestion');
    }

}
