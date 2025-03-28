<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\YouTubeService;
use App\Services\WikipediaService;

class SearchController extends Controller
{
    protected $youtubeService;
    protected $wikipediaService;

    public function __construct(YouTubeService $youtubeService, WikipediaService $wikipediaService)
    {
        $this->youtubeService = $youtubeService;
        $this->wikipediaService = $wikipediaService;
    }

    public function wikipedia(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $videos = $this->youtubeService->searchVideos($query);
            $wikipedias = $this->wikipediaService->searchWikipedia($query);
        } else {
            $videos = [];
            $wikipedias = [];
        }

        return view('wikipedia', compact('videos', 'wikipedias', 'query'));
    }
}
