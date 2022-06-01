<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property mixed $user_id
 * @method static create(array $input)
 */

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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the profile.
     */
    public function friend(): HasOne
    {
        return $this->hasOne(Friend::class);
    }

    public function profileImage(): Attribute
    {
        return Attribute::get(fn($value) => !empty($value) ? url('/images/profiles') . DIRECTORY_SEPARATOR .  $value : null);
    }
}
