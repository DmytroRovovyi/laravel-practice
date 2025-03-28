<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YouTubeService
{
    protected $apiKey;
    protected $baseUrl = 'https://www.googleapis.com/youtube/v3/';

    public function __construct()
    {
        $this->apiKey = env('YOUTUBE_API_KEY');
    }

    /**
     * Get method channel list youtube.
     *
     * @param $playlistId
     * @param $maxResults
     * @return array|mixed
     */
    public function getPlaylistVideos($playlistId, $maxResults = 4)
    {
        $response = Http::get("{$this->baseUrl}playlistItems", [
            'part' => 'snippet',
            'maxResults' => $maxResults,
            'playlistId' => $playlistId,
            'key' => $this->apiKey,
        ]);

        return $response->json();
    }

    /**
     * Get method search youtube.
     *
     * @param $query
     * @param $maxResults
     * @return array|mixed
     */
    public function searchVideos($query, $maxResults = 5)
    {
        $response = Http::get("{$this->baseUrl}search", [
            'part' => 'snippet',
            'q' => $query,
            'maxResults' => $maxResults,
            'type' => 'video',
            'key' => $this->apiKey,
        ]);

        return $response->json()['items'] ?? [];
    }
}
