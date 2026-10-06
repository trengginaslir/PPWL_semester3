<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    public function created(Post $post): void
    {
        Log::info("Post dibuat: {$post->title}");
    }

    public function updated(Post $post): void
    {
        Log::info("Post diubah: {$post->title}");
    }

    public function deleted(Post $post): void
    {
        Log::info("Post dihapus: {$post->title}");
    }

    public function restored(Post $post): void
    {
        Log::info("Post dikembalikan: {$post->title}");
    }

    public function forceDeleted(Post $post): void
    {
        Log::info("Post dihapus permanen: {$post->title}");
    }
}