<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'post_id',
        'user_id',
        'comment_text'
    ];

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        $this->belongsTo(User::class);
    }

    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        $this->belongsTo(Post::class);
    }
}
