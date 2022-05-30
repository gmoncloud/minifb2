<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'display_name',
        'profile_image',
        'education',
        'current_city',
        'hometown',
        'work'
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the friend that owns the profile.
     */
    public function friend()
    {
        return $this->hasOne(Friend::class);
    }
  
    function profileImage(): Attribute {
        return Attribute::get(fn($value) => !empty($value) ? url('/images/profiles') . DIRECTORY_SEPARATOR .  $value : null);
    }
}
