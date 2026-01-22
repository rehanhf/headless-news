<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    #post belongs to one category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    #post belongs to one author (user)
    public function author(): BelongsTo
    {
        #explicitly say 'user_id' because function name is 'author'
        return $this->belongsTo(User::class, 'user_id');
    }

    #post has many tags
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
