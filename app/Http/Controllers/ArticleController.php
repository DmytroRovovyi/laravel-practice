<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\YouTubeService;

class ArticleController extends Controller
{
    protected $youtubeService;

    /**
     * @param YouTubeService $youtubeService
     */
    public function __construct(YouTubeService $youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }

    /**
     * Metod get article
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $articles = Article::paginate(4);
        $videos = $this->youtubeService->getPlaylistVideos('PLXFqgSHv3_6j-sS48aBF6Z2NB6jV5K1wN');

        return view('welcome', compact('articles', 'videos'));
    }
}
