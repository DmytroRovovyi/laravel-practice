<?php

namespace App\Http\Controllers;

use App\Services\YouTubeService;

class YouTubeController extends Controller
{
    protected $youtubeService;

    public function __construct(YouTubeService $youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }

    public function showPlaylistVideos($playlistId)
    {
        $videos = $this->youtubeService->getPlaylistVideos($playlistId);

        return response()->json($videos);
    }
}
