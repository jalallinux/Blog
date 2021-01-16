<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'body'  => $this->faker->randomHtml(),
            'cover'  => 'https://picsum.photos/300/200?random=' . $this->faker->numberBetween(1, 10000),
            'caption'  => $this->faker->realText(),
            'category_id' => function () {
                return random_int(1, Category::count());
            },
            'user_id' => function () {
                return random_int(1, User::count());
            },
            'created_at' => $this->faker->dateTimeBetween('-10 hours')
        ];
    }
}
