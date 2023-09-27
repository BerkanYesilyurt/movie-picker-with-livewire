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

    public function add()
    {
        if($this->checkAuth() && !$this->isFavorited)
            $this->isFavorited = $this->suggestion->favorite()->create(['user_id' => auth()->user()->id]);
    }

    public function discard()
    {
        if($this->checkAuth() && $this->isFavorited){
            $this->suggestion->favorite()->delete();
            $this->isFavorited = null;
        }
    }

    private function checkAuth(): bool
    {
        return auth()->check();
    }

    public function render()
    {
        return view('livewire.user-favorite');
    }

}
