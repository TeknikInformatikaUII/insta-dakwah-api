<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable,
        Authorizable,
        HasApiTokens;

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
     * The attributes rules.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'address' => 'required',
        'phone' => 'required',
        'photo_url' => 'required',
        'biography' => 'required',
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
        return $this->user_status_id === 1;
    }

    /**
     * Determine whether the user is banned.
     *
     * @return bool
     */
    public function isBanned()
    {
        return $this->user_status_id === 2;
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
            storage_path($value) :
            url('images/profile/user-default.png');
    }
}
