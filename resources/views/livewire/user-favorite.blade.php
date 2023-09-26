<div>
    @if($isFavorited && auth()->check())
        //FAVORITED
    @elseif($suggestion && auth()->check())
        //SUGGESTION EXISTS BUT NOT FAVORITED
    @else
        //NOT LOGGED IN
    @endif
</div>
