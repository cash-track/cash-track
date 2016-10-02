<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Trans
 *
 * @property integer $id
 * @property integer $amount
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $balance_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereBalanceId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Balance $balance
 */
class Trans extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'trans';

	/**
	 * Balance on trans
	 *
	 * @return Collection
	 */
	public function balance()
	{
		return $this->belongsTo('App\Models\Balance');
	}
}
