<div>
    @if($isFavorited && auth()->check())
        <button wire:click="discard">Discard from Favorites</button>
    @elseif($suggestion && auth()->check())
        <button wire:click="add">Add to Favorites</button>
    @else
        //NOT LOGGED IN
    @endif
</div>
