<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Balance
 *
 * @property integer $id
 * @property integer $amount
 * @property boolean $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Balance extends Model
{
	/**
	 * @var string
	 */
    protected $table = 'balances';

	/**
	 * Transes on balance
	 *
	 * @return Collection
	 */
	public function trans()
	{
		return $this->hasMany('App\Models\Trans')->get();
	}

	/**
	 * Get the all users of balance
	 *
	 * @return Collection
	 */
	public function users()
	{
		return $this->belongsToMany('App\Models\User', 'user_balance', 'balance_id', 'user_id')->get();
	}
}
