<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WikipediaService
{
    protected $baseUrl = 'https://en.wikipedia.org/w/api.php';

    public function searchWikipedia($query)
    {
        $response = Http::get($this->baseUrl, [
            'action' => 'query',
            'list' => 'search',
            'srsearch' => $query,
            'format' => 'json',
            'utf8' => true,
        ]);

        return $response->json()['query']['search'] ?? [];
    }
}
