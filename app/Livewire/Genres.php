<?php

namespace App\Livewire;

use Livewire\Component;

class Genres extends Component
{
    public $genres, $genre;

    public function mount($genres = NULL)
    {
        $this->genres = $genres;
    }

    public function setSelectedGenre(){
        $this->dispatch('setSelectedGenre', $this->genre);
    }

    public function render()
    {
        return view('livewire.genres');
    }
}
