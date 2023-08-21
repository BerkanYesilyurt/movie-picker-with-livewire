<div>
    <img src="https://image.tmdb.org/t/p/original/{{$content['poster_path']}}" height="100" width="50" /><br>
    Id: {{$content['id']}}<br>
    Genres: {{$genre->whereIn('id', $content['genre_ids'])->implode('name', ', ')}}<br>
    Title: {{$content['title'] ?? $content['name']}}<br>
    Vote: {{$content['vote_average']}}
</div>
