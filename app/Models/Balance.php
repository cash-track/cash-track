<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Balance.
 *
 * @property int $id
 * @property int $amount
 * @property bool $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 */
class Balance extends Model
{
    /**
     * @var string
     */
    protected $table = 'balances';

    /**
     * Transactions on balance.
     *
     * @return HasMany
     */
    public function trans()
    {
        return $this->hasMany('App\Models\Trans');
    }

    /**
     * Get all transactions.
     *
     * @return Collection
     */
    public function getTrans()
    {
        return $this->trans()->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get the all users of balance.
     *
     * @return Collection
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_balance', 'balance_id', 'user_id');
    }

    /**
     * Check if user assigned to balance.
     *
     * @param User $user
     *
     * @return bool
     */
    public function hasUser($user)
    {
        if ($user instanceof User) {
            return (bool) $this->users()->get()->whereStrict('id', $user->id)->count();
        }

        return false;
    }

    /**
     * Get all of credited of balance.
     *
     * @return int
     */
    public function getCredit()
    {
        $trans = $this->trans()->where('type', '=', '-')->sum('amount');

        return intval($trans, 10);
    }

    /**
     * Get all of debited of balance.
     *
     * @return int
     */
    public function getDebit()
    {
        $trans = $this->trans()->where('type', '=', '+')->sum('amount');

        return intval($trans, 10);
    }

    /**
     * Calculate summary of balance.
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
