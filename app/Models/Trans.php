<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Trans.
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $amount
 * @property string $type
 * @property string $title
 * @property string $description
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $balance_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereBalanceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereUserId($value)
 * @property-read \App\Models\Balance $balance
 * @property-read \App\Models\User $user
 */
class Trans extends Model
{
    /**
     * @var string
     */
    protected $table = 'trans';

    /**
     * Balance on trans.
     *
     * @return BelongsTo
     */
    public function balance() :BelongsTo
    {
        return $this->belongsTo('App\Models\Balance');
    }

	/**
	 * User on trans
	 *
	 * @return BelongsTo
	 */
    public function user() :BelongsTo
    {
    	return $this->belongsTo('App\Models\User');
    }

	/**
	 * Get author info
	 *
	 * @return User
	 */
    public function getUser() :User
    {
    	return $this->user()->get();
    }
}
