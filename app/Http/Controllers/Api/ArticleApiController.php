<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    /**
     * Metod create article
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $article = new Article($validated);
        $article->user_id = auth()->id();
        $article->save();

        return response()->json($article, 201);
    }

    /**
     * Metod get article
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $article = Article::with('user')->findOrFail($id);
        return response()->json($article);
    }

    /**
     * Metod update article
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        if ($article->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);
        $article->update($validated);

        return response()->json($article);
    }

    /**
     * Metod delete article
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $article = Article::findOrFail($id);

        if ($article->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $article->delete();

        return response()->json(['message' => 'Article deleted successfully']);
    }
}
