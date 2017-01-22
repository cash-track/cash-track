<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User.
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $image
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Balance[] $balances
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Trans[] $transactions
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Balance[] $ownBalances
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
        'name', 'email', 'image', 'password',
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
}
