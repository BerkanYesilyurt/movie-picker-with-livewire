<?php

namespace App\Livewire;

use App\Models\Suggestion;
use Livewire\Component;

class UserFavorite extends Component
{
    public $suggestion, $isFavorited;

    public function mount($suggestion, $isFavorited = false)
    {
        $this->suggestion = Suggestion::with('favorite')->whereId($suggestion)->first();
        $this->isFavorited = $this->suggestion?->favorite;
    }

    public function render()
    {
        return view('livewire.user-favorite');
    }

}
