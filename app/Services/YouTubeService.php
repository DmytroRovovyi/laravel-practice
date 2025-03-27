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

    public function getPlaylistVideos($playlistId)
    {
        $response = Http::get("{$this->baseUrl}playlistItems", [
            'part' => 'snippet',
            'maxResults' => 5,
            'playlistId' => $playlistId,
            'key' => $this->apiKey,
        ]);

        return $response->json();
    }
}
