<?php

namespace App\Services\TMDB;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Fluent;

class Service
{
    private PendingRequest $request;

    public function __construct(
        private string $baseUrl,
        private $paths,
        private string $apiKey,
        private int $timeout
    ) {
        $this->paths = new Fluent($this->paths);
        $this->request = $this->prepareTheRequest();
    }

}
