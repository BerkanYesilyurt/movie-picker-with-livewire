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
            return view('pages.homepage', $this->prepareStaticData());
        }
    }

    private function prepareStaticData(): array
    {
        return [
            'movie_genres' => cache()->get('movie_genres') ?? remember('movie_genres', 600, data: $this->tmdbService->getData(
                path: 'movie_genres',
                responseKey: 'genres',
                params: ['id', 'name'])),
            'tv_series_genres' => cache()->get('tv_series_genres') ?? remember('tv_series_genres', 600, data: $this->tmdbService->getData(
                path: 'tv_series_genres',
                responseKey: 'genres',
                params:['id', 'name'])),
            'movie_top_rated' => cache()->get('movie_top_rated') ?? remember('movie_top_rated', 600, data: $this->tmdbService->getData(
                path: 'movie_top_rated',
                responseKey: 'results',
                params: ['id', 'genre_ids', 'poster_path', 'title', 'vote_average'])),
            'tv_series_top_rated' => cache()->get('tv_series_top_rated') ?? remember('tv_series_top_rated', 600, data: $this->tmdbService->getData(
                path: 'tv_series_top_rated',
                responseKey: 'results',
                params: ['id', 'genre_ids', 'poster_path', 'name', 'vote_average'],
                queryParams: ['language' => 'en-US', 'page' => 1]))
        ];
    }
}
