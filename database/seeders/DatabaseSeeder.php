<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        #create 1 user
        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        #create 5 categories
        $categories = \App\Models\Category::factory()->count(5)->create();

        #create 10 tags
        $tags = \App\Models\Tag::factory()->count(10)->create();

        #create 20 posts linked to user and random category
        \App\Models\Post::factory(20)->create([
            'user_id' => $user->id,
            'category_id' => $categories->random()->id
        ])->each(function ($post) use ($tags) {
            #attach 2 random tags to each post
            $post->tags()->attach($tags->random(2));
        });
    }
}
