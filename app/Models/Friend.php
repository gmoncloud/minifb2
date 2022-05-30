<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'friend_id'
    ];

    /**
     * Get the user that owns the friend.
     */
    public function user()
    {
        return $this->belongsTo(Friend::class);
    }

    function profileImage(): Attribute {
        return Attribute::get(fn($value) => !empty($value) ? url('/images/profiles') . DIRECTORY_SEPARATOR .  $value : null);
    }
}
