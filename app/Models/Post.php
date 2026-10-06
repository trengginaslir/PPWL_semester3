<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    // Scope: post yang dibuat hari ini
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', today());
    }

    // Scope: post dengan judul mengandung kata tertentu
    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        return $query->where('title', 'like', "%{$keyword}%");
    }

    // Scope: post terbaru
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Scope: post yang sudah dipublikasikan
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
}