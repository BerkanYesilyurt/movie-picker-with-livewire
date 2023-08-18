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
                'movie_genres' => $this->tmdbService->getData('movie_genres', 'genres', ['id', 'name']),
                'tv_series_genres' => $this->tmdbService->getData('tv_series_genres', 'genres', ['id', 'name'])
            ]);
        }
    }
}
