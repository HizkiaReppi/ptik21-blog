<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Hizkia Reppi',
            'username' => 'hizkiareppi',
            'email' => 'hizkiareppi@gmail.com',
            'password' => bcrypt('hizkia123'),
            'role' => 'super-admin'
        ]);
        User::factory()->create([
            'name' => 'Jefren Reppi',
            'username' => 'jefrenreppi',
            'email' => 'jefrenreppi@gmail.com',
            'password' => bcrypt('jefren123'),
            'role' => 'admin'
        ]);
        User::factory()->create([
            'name' => 'Hizkia Jefren',
            'username' => 'hjefren',
            'email' => 'hjefren@gmail.com',
            'password' => bcrypt('hjefren123'),
            'role' => 'user'
        ]);
        Post::factory(10)->create();
        Category::factory()->create([
            'name' => 'Programming',
            'slug' => 'programming'
        ]);
        Category::factory()->create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);
        Category::factory()->create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);
        Category::factory()->create([
            'name' => 'Network',
            'slug' => 'network'
        ]);
        Category::factory()->create([
            'name' => 'Research',
            'slug' => 'research'
        ]);
    }
}
