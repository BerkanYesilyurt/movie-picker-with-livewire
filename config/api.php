<?php

return [
    'tmdb' => [
        'base_url' => 'https://api.themoviedb.org/3/',
        'poster_url' => 'https://image.tmdb.org/t/p/original/',
        'api_key' => env('the_movie_db_api_key'),
        'timeout' => 5,
        'paths' => [
            'authentication' => 'authentication',
            'movie_genres' => 'genre/movie/list',
            'tv_series_genres' => 'genre/tv/list',
            'movie_top_rated' => 'movie/top_rated',
            'tv_series_top_rated' => 'tv/top_rated',
            'movie_discover' => 'discover/movie',
            'tv_series_discover' => 'discover/tv',
        ]
    ]
];
