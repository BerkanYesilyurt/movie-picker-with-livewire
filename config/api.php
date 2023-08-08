<?php

return [
    'tmdb' => [
        'base_url' => 'https://api.themoviedb.org/3/',
        'api_key' => env('the_movie_db_api_key'),
        'timeout' => 5,
        'paths' => [
            'authentication' => 'authentication',
            'movie_genres' => 'genre/movie/list',
            'tv_series_genres' => 'genre/tv/list'
        ]
    ]
];
