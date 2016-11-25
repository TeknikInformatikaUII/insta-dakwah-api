<?php

namespace App;

use Storage;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable,
        Authorizable,
        HasApiTokens,
        HasRolesAndAbilities,
        Reportable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'photo_url',
        'biography',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'activation_key',
        'password',
    ];

    /**
     * Get all users following us.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'user_id')->withTimestamps();
    }

    /**
     * Get all users we are following.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'user_id', 'follower_id')->withTimestamps();
    }

    /**
     * Determine whether the user is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->user_status_id === UserStatus::ACTIVE;
    }

    /**
     * Determine whether the user is banned.
     *
     * @return bool
     */
    public function isBanned()
    {
        return $this->user_status_id === UserStatus::BANNED;
    }

    /**
     * Get the profile photo URL attribute.
     *
     * @param string|null $value
     * @return string
     */
    public function getPhotoUrlAttribute($value)
    {
        return $value ?
            Storage::url($value) :
            url('images/profile/user-default.png');
    }
}
