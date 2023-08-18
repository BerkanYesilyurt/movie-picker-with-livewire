<?php

namespace App\Services\TMDB;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Arr;
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
            ->timeout($this->timeout)
            ->withoutVerifying()
            ->withHeaders([
                'Accept' => 'application/json'
            ]);
    }

    private function getTheUrlPathFromList(string $key): ?string
    {
        return $this->paths->{$key};
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

    public function getData(string $path, string $responseKey, $params = NULL)
    {
        $response = $this->request->get(
            url: $this->generateTheUrl($this->getTheUrlPathFromList($path))
        );

        return $params
            ? $response->collect($responseKey)->transform(function ($item) use ($params){
                return Arr::only($item, $params);
            })->all()
            : $response->collect($responseKey)->toArray();
    }
}
