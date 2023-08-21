<?php

namespace App\Livewire;

use Livewire\Component;

class TopRatedContent extends Component
{
    public $content, $genre;

    public function mount($content, $genre)
    {
        $this->content = $content;
        $this->genre = collect($genre);
    }

    public function render()
    {
        return view('livewire.top-rated-content');
    }
}
