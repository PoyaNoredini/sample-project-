<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property-read Provider|null $provider
 * @property-read State|null $state
 * @property-read City|null $city
 */
class User extends Authenticatable implements JWTSubject
{
    protected $fillable = [
        'name',
        'user_name',
        'user_type',
        'phone_number',
        'state_id',
        'city_id',
        'password',
        'gender',
        'birthday',
        'bio',
        'profile'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'birthday' => 'datetime:Y-m-d'
    ];

    // JWT methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'user_type'    => $this->user_type,
            'phone_number' => $this->phone_number
        ];
    }

    // Relationships
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    // Morph relationships for posts, stories, etc.
    public function posts()
    {
        return $this->morphMany(Post::class, 'owner');
    }

    public function stories()
    {
        return $this->morphMany(Story::class, 'owner');
    }

    // Additional relationships
    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }

    public function userReports()
    {
        return $this->hasMany(UserReport::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'receiver');
    }

    public function sentDirects()
    {
        return $this->morphMany(Direct::class, 'sender');
    }

    public function receivedDirects()
    {
        return $this->morphMany(Direct::class, 'receiver');
    }

    public function archives()
    {
        return $this->morphMany(Archive::class, 'owner');
    }

    public function savedMessages()
    {
        return $this->morphMany(SaveMessage::class, 'owner');
    }

    public function seenOrLikes()
    {
        return $this->morphMany(SeenOrLike::class, 'owner');
    }

    public function logActivities()
    {
        return $this->morphMany(LogSystem::class, 'doer');
    }

    public function provider()
    {
        return $this->hasOne(Provider::class);
    }

    public function following()
    {
        return $this->hasMany(Following::class, 'from_id');
    }
    public function followers()
    {
        return $this->hasMany(Following::class, 'to_id');
    }
}
