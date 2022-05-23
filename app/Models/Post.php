<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'written_text',
        'post_image',
    ];

    /**
     * Get all the comments from the post
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all the likes from the post
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
