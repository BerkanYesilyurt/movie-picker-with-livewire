<?php

namespace App\Livewire;

use Livewire\Component;

class ContentSuggestion extends Component
{
    public $type;
    protected $rules = [
        'type' => 'required|in:tv,movie',
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
