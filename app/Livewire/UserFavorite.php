<?php

namespace App\Livewire;

use App\Models\Suggestion;
use Livewire\Component;

class UserFavorite extends Component
{
    public $suggestion, $content;

    public function mount($suggestion, $content)
    {
        $this->content = $content;
        $this->suggestion = Suggestion::find($suggestion);
    }

    public function render()
    {
        return view('livewire.user-favorite');
    }

}
