<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'سید محمد جواد',
            'family' => 'جلال زاده',
            'email' => 'smjjalalzadeh93@gmail.com'
        ]);

        User::factory(29)->create();
        Category::factory()->count(20)->create();
        Post::factory()->count(2000)->create();
    }
}
