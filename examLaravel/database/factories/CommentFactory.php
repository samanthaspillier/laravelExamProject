<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
 

    protected $model = Comment::class;

    public function definition(): array
    {
        // Get a random user ID, ensuring at least one user exists
        $userId = User::inRandomOrder()->first()->id ?? User::factory()->create()->id;

        // Get a random post ID, ensuring at least one post exists
        $postId = Post::inRandomOrder()->first()->id ?? Post::factory()->create()->id;

        $publishedAt = $this->faker->dateTimeBetween('-1 month', 'now');
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Get a random user ID
            'post_id' => Post::inRandomOrder()->first()->id, // Get a random post ID
            'content' => $this->faker->paragraph, //content of the comment
            'created_at' => $publishedAt,
            'updated_at' => now(),
        ];
    }
}
