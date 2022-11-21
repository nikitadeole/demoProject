<?php

namespace Database\Seeders;

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
        \App\Models\User::factory()->count(20)->create()->each(function($user) {
            $user->posts()->save(\App\Models\Post::factory()->make()); 
        });
    }
}
