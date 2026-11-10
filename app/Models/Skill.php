<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
    ];

    // Relasi Skill dengan Project
    public function projects()
    {
        return $this->belongsToMany(Project::class)
                    ->withTimestamps();
    }
}
