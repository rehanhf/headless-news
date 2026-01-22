<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     use HasFactory;
    #category has many posts
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
