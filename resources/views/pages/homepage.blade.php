<livewire:genres :genres="$movie_genres" />
<livewire:genres :genres="$tv_series_genres" />

@foreach($movie_top_rated as $movie)
    <br><br>
    <livewire:top-rated-content :content="$movie" :genre="$movie_genres" />
@endforeach

@foreach($tv_series_top_rated as $tv_series)
    <br><br>
    <livewire:top-rated-content :content="$tv_series" :genre="$tv_series_genres" />
@endforeach
