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
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin123'),
            'role' => 'super-admin'
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);
        User::factory(8)->create();
        Post::factory(50)->create();
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
