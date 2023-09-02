<?php

namespace App\Livewire;

use Livewire\Component;

class ContentSuggestion extends Component
{
    public $type, $adult, $vote_average, $vote_count;
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
    }

    public function render()
    {
        return view('livewire.content-suggestion');
    }

}
