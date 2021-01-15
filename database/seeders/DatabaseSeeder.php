<?php

namespace Database\Seeders;

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
    }
}
