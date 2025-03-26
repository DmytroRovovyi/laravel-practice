<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|string',
        ]);

        $article = new Article($validated);
        $article->user_id = auth()->id();

        if ($request->has('image')) {
            $imageData = $request->input('image');
            if (empty($imageData)) {
                return response()->json(['error' => 'Image data is empty'], 400);
            }

            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $imageData = base64_decode($imageData);
                $imageName = uniqid() . '.' . $type[1];
                Storage::disk('public')->put('images/' . $imageName, $imageData);

                $article->image = 'images/' . $imageName;
            } else {
                return response()->json(['error' => 'Invalid image format'], 400);
            }
        }
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
            'image' => 'nullable|string',
        ]);

        if ($request->has('image')) {
            $imageData = $request->input('image');
            if (empty($imageData)) {
                return response()->json(['error' => 'Image data is empty'], 400);
            }

            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $imageData = base64_decode($imageData);
                $imageName = uniqid() . '.' . $type[1]; // Генеруємо унікальне ім'я зображення
                Storage::disk('public')->put('images/' . $imageName, $imageData);

                $article->image = 'images/' . $imageName;
            } else {
                return response()->json(['error' => 'Invalid image format'], 400);
            }
        }

        $article->update($validated);

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
