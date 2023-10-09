<select wire:model="genre" wire:change="setSelectedGenre()" >
    <option>Select A Genre</option>
    @foreach($genres as $genre)
        <option value="{{$genre['id']}}">{{$genre['name']}}</option>
    @endforeach
</select>
