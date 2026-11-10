<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Batas maksimal gambar gallery untuk setiap project
    public const MAX_GALLERY_IMAGES = 10;

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'category_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)
                    ->orderBy('sort_order');
    }

    // Relasi Project dengan Skill
    public function skills()
    {
        return $this->belongsToMany(Skill::class)
                    ->withTimestamps();
    }
}
