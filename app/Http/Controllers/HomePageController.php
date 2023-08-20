<?php

namespace App\Http\Controllers;

use App\Services\TMDB\Service;

class HomePageController extends Controller
{
    public function __construct()
    {
        $this->tmdbService = resolve(Service::class);
    }

    public function index()
    {
        if($this->tmdbService->checkAuth()){
            return view('pages.homepage', [
                'movie_genres' => $this->tmdbService->getData(
                    path: 'movie_genres',
                    responseKey: 'genres',
                    params: ['id', 'name']),
                'tv_series_genres' => $this->tmdbService->getData(
                    path: 'tv_series_genres',
                    responseKey: 'genres',
                    params:['id', 'name']),
                'movie_top_rated' => $this->tmdbService->getData(
                    path: 'movie_top_rated',
                    responseKey: 'results',
                    params: ['id', 'genre_ids', 'poster_path', 'title', 'vote_average']),
                'tv_series_top_rated' => $this->tmdbService->getData(
                    path: 'tv_series_top_rated',
                    responseKey: 'results',
                    params: ['id', 'genre_ids', 'poster_path', 'name', 'vote_average'],
                    queryParams: ['language' => 'en-US', 'page' => 1])
            ]);
        }
    }
}
