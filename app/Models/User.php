<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all the post from the user
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get all the comments from the user
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all the likes from the user
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get the profile associated with the user.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get all the friends from the user
     */
    public function friends()
    {
        return $this->hasMany(Friend::class);
    }

    function profileImage(): Attribute {
        return Attribute::get(fn($value) => !empty($value) ? url('/images/profiles') . DIRECTORY_SEPARATOR .  $value : null);
    }

}
