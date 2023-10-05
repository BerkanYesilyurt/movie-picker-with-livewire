<div>
    @if(auth()->check() && $watchlist && in_array($suggestion->id, $watchlist->list))
        <button wire:click="discard">Discard from Watchlist</button>
    @elseif(auth()->check())
        <button wire:click="add">Add to Watchlist</button>
    @else
        //NOT LOGGED IN
    @endif
</div>
