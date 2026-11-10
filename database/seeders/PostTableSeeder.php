<?php

namespace Database\Seeders;

use App\Models\Post;             
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    public function run(): void
    {
        Post::truncate();
        
        for ($i = 1; $i <= 10; $i++) {
            Post::create([
                'title' => 'Post Judul Ke-' . $i,
                'description' => 'Deskripsi untuk post judul ke-' . $i,
            ]);
        }
    }
}