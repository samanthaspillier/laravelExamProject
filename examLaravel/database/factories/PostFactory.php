<?php

namespace Database\Factories;

use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */

class PostFactory extends Factory
{

    protected $model = Post::class;
     
    public function definition(): array
    {
        // Get a list of all cover images in the public/images/covers directory
        $coverImages = array_diff(
            scandir(public_path('images/covers')),
            ['.', '..']  // Exclude '.' and '..' from the list
        );

        // Select a random image from the list
        $coverImage = $coverImages[array_rand($coverImages)];

         // Generate a random date and time for published_at
        $publishedAt = $this->faker->dateTimeBetween('-1 month', 'now');

        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'published_at'=> $publishedAt,  
            'created_at' => $publishedAt,
            'updated_at' => now(),

            'cover_image' => 'images/covers/' . $coverImage, // Path relative to the public directory
        ];
    }
}
