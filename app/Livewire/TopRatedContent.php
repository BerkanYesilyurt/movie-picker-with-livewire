<?php

namespace App\Livewire;

use Livewire\Component;

class TopRatedContent extends Component
{
    public $content;

    public function mount($content = NULL)
    {
        $this->content = $content;
    }

    public function render()
    {
        return view('livewire.top-rated-content');
    }
}
