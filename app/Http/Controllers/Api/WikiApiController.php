<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessWikiPage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WikiApiController extends Controller
{
    /**
     * Handle incoming JSON request with Wikipedia titles.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'titles' => 'required|array',
            'titles.*' => 'string|min:1',
        ]);

        $titles = array_map('trim', $request->input('titles'));

        foreach ($titles as $title) {
            ProcessWikiPage::dispatch($title);
        }

        return response()->json([
            'message' => 'Article titles successfully added to the processing queue',
            'titles' => $titles,
        ], 201);
    }
}
