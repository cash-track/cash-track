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
		return $this->hasMany('App\Models\Trans')->orderBy('created_at', 'desc')->get();
	}

	/**
	 * Get the all users of balance
	 *
	 * @return Collection
	 */
	public function users()
	{
		return $this->belongsToMany('App\Models\User', 'user_balance', 'balance_id', 'user_id');
	}

	/**
	 * Get all of credited of balance
	 *
	 * @return int
	 */
	public function getCredit()
	{
		$trans = $this->trans()->where('type', '=', '-')->sum('amount');
		return intval($trans, 10);
	}

	/**
	 * Get all of debited of balance
	 *
	 * @return int
	 */
	public function getDebit()
	{
		$trans = $this->trans()->where('type', '=', '+')->sum('amount');
		return intval($trans, 10);
	}

	/**
	 * Calculate summary of balance
	 *
	 * @return int
	 */
	public function getBalance()
	{
		$credit = $this->getCredit();
		$debit = $this->getDebit() + $this->amount;
		return $debit - $credit;
	}
}
