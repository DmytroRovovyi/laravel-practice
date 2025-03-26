<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Article;
use App\Models\User;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imageUrl = $this->faker->imageUrl(800, 600, 'business'); // Генерація URL зображення

        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'user_id' => User::inRandomOrder()->first()->id, // Призначити випадкового користувача
            'image' => $imageUrl, // Встановити URL зображення
        ];
    }
}
