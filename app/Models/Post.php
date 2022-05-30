<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    function postImage(): Attribute {
        return Attribute::get(fn($value) => !empty($value) ? url('/images/posts') . DIRECTORY_SEPARATOR .  $value : null);
    }
}
