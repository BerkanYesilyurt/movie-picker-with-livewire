<?php

namespace App\Livewire;

use Livewire\Component;

class Genres extends Component
{
    public $genres;

    public function mount($genres = NULL)
    {
        $this->genres = $genres;
    }

    public function render()
    {
        return view('livewire.genres');
    }
}
