<livewire:scripts />
<livewire:content-suggestion />
<br><br>

@if(checkKeysFrom($movie_top_rated, ['id', 'genre_ids', 'poster_path', 'title', 'vote_average']))
    @foreach($movie_top_rated as $movie)
        <br><br>
        <livewire:top-rated-content :content="$movie" :genre="$movie_genres" />
    @endforeach
@endif

@if(checkKeysFrom($tv_series_top_rated, ['id', 'genre_ids', 'poster_path', 'name', 'vote_average']))
    @foreach($tv_series_top_rated as $tv_series)
        <br><br>
        <livewire:top-rated-content :content="$tv_series" :genre="$tv_series_genres" />
    @endforeach
@endif
