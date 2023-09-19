<?php

namespace App\Livewire;

use Livewire\Component;

class UserFavorite extends Component
{
    public $content;

    protected array $rules = [
        'content' => 'required'
    ];

    public function render()
    {
        return view('livewire.user-favorite');
    }

}
