<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Trans.
 *
 * @property int $id
 * @property int $amount
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $balance_id
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereBalanceId($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Models\Balance $balance
 * @property string $title
 * @property string $description
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Trans whereDescription($value)
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
    public function balance()
    {
        return $this->belongsTo('App\Models\Balance');
    }
}
