<?php

namespace App\Http\Controllers;

use App\Services\TMDB\Service;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $tmdbService = resolve(Service::class);
        if($tmdbService->checkAuth()){
            return view('pages.homepage', [
                'movie_genres' => $tmdbService->getData('movie_genres', 'genres', ['id', 'name']),
                'tv_series_genres' => $tmdbService->getData('tv_series_genres', 'genres', ['id', 'name'])
            ]);
        }
    }
}
