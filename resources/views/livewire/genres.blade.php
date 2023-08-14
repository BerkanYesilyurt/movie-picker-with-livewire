<select name="genre" id="genre">
    @foreach($genres as $genre)
        <option value="{{$genre['id']}}">{{$genre['name']}}</option>
    @endforeach
</select>
