<div>
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    @endif

    @if(isset($suggestion[0]) && checkKeysFrom($suggestion, $params))
            <img src="{{config('api.tmdb.poster_url') . $suggestion[0]['poster_path']}}" height="100" width="50" /><br>
            Id: {{$suggestion[0]['id']}}<br>
            @if($genres) Genres: {{collect($genres)->whereIn('id', $suggestion[0]['genre_ids'])->implode('name', ', ')}}<br> @endif
            Title: {{$suggestion[0]['title'] ?? $suggestion[0]['name']}}<br>
            Vote: {{$suggestion[0]['vote_average']}}

            <livewire:user-favorite :suggestion="$suggestionId" :key="'favorite' . $refreshButtons" />
            <livewire:watchlist :suggestion="$suggestionId" :key="'watchlist' . $refreshButtons" />
    @endif

    <form wire:submit.prevent="generateContent">
        <select wire:model="type" wire:change="setGenres" required>
            <option value="">Content Type</option>
            <option value="movie">Movie</option>
            <option value="tv">TV Series</option>
        </select>

        @if(isset($genres) && checkKeysFrom($genres, ['id', 'name']))
            <livewire:genres :genres="$genres" :key="$refreshComponent" />
        @endif

        <select wire:model="adult" required>
            <option value="">Include Adult</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <select wire:model="vote_average" required>
            <option value="">Vote Average</option>
            <option value="9">> 9</option>
            <option value="8">> 8</option>
            <option value="7">> 7</option>
            <option value="6">> 6</option>
            <option value="5">> 5</option>
        </select>
        <input wire:model="vote_count" type="text" required placeholder="Total Vote Count"/>
        <button type="submit">OK</button>
    </form>
</div>
