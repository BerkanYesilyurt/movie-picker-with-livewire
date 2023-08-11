<?php

namespace App\Services\TMDB;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Fluent;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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

    private function prepareTheRequest(): PendingRequest
    {
        return Http::withToken($this->apiKey)
            ->withoutVerifying()->withHeaders([
                'Accept' => 'application/json'
            ])->timeout($this->timeout);
    }

    private function generateTheUrl($path): string|bool
    {
        return isset($path)
            ? $this->baseUrl . $path
            : false;
    }

    public function checkAuth(): bool
    {
        $response = $this->request->get(
            url: $this->generateTheUrl($this->paths->authentication)
        );

        return !$response->failed()
            && $response->status() == ResponseAlias::HTTP_OK
            && $response->json('success') == true;
    }

    public function getGenres(string $type)
    {
        $response = $this->request->get(
            url: $this->generateTheUrl($this->paths->{$type . '_genres'})
        );

        return $response->json();
    }
}
