<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body'  => $this->faker->realText(),
            'post_id' => function() {
                return random_int(1, Post::count());
            },
            'user_id' => function() {
                return random_int(1, User::count());
            },
            'created_at' => $this->faker->dateTimeBetween('-10 hours')
        ];
    }
}
