<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User.
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * Set full or relative URL to default user image
     */
    const DEFAULT_IMAGE_URL = 'https://dummyimage.com/600/666/fff.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'nick',  'email', 'image', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return default image of user if not specified
     *
     * @param string|null $value
     * @return string
     */
    public function getImageAttribute($value) :string {
        return !is_null($value) ? $value : self::DEFAULT_IMAGE_URL;
    }

    /**
     * Get the balances for user.
     *
     * @return BelongsToMany
     */
    public function balances() :BelongsToMany
    {
        return $this->belongsToMany('App\Models\Balance', 'user_balance', 'user_id', 'balance_id');
    }

    /**
     * Get the own balances for user
     *
     * @return HasMany
     */
    public function ownBalances() :HasMany
    {
        return $this->hasMany('App\Models\Balance', 'owner_id');
    }

    /**
     * The transactions of users
     *
     * @return HasMany
     */
    public function transactions() :HasMany
    {
        return $this->hasMany('App\Models\Trans');
    }

    /**
     * Get link for user profile
     *
     * @return string
     */
    public function link()
    {
        if(is_null($this->nick))
            return route('user.show', $this->id);

        return route('user.show', $this->nick);
    }
}
