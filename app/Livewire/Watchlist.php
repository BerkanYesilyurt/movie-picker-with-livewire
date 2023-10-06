<?php

namespace App\Livewire;

use App\Models\Suggestion;
use App\Models\Watchlist as WatchlistModel;
use Livewire\Component;

class Watchlist extends Component
{
    public $suggestion, $watchlist;

    public function mount($suggestion)
    {
        $this->suggestion = Suggestion::whereId($suggestion)->first();
        $this->watchlist = auth()->check() ? WatchlistModel::where('user_id', auth()->user()->id)->first() : NULL;
    }

    public function add()
    {
        if($this->checkAuth() && !$this->checkExistsInList($this->suggestion->id)){
            $list = $this->watchlist->list ?? [];
            $list[] = $this->suggestion->id;
            auth()->user()->watchlist()->updateOrCreate([
                'user_id' => auth()->user()->id
            ],[
                'list' => $list
            ]);
            $this->watchlist = WatchlistModel::where('user_id', auth()->user()->id)->first();
        }
    }
    private function checkExistsInList($id): bool
    {
        return isset($this->watchlist) && in_array($id, $this->watchlist->list);
    }

    private function checkAuth(): bool
    {
        return auth()->check();
    }

    public function render()
    {
        return view('livewire.watchlist');
    }

}
