<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'category_id'=> random_int(1,8),
            'title' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'slug' => Str::slug($this->faker->sentence($nbWords = 10, $variableNbWords = true)),
            'image' => 'https://cdn.britannica.com/39/7139-050-A88818BB/Himalayan-chocolate-point.jpg',
            'body' => $this->faker->paragraph($nbSentences = 20, $variableNbSentences = true),
            'view_count' => random_int(10,100),
            'status' => 1
        ];
    }
}
