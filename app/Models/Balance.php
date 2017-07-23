<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Collection, Model
};
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    BelongsToMany,
    HasMany
};

/**
 * App\Models\Balance.
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
    public function trans() :HasMany
    {
        return $this->hasMany('App\Models\Trans');
    }

    /**
     * Get all transactions.
     *
     * @return Collection
     */
    public function getTrans() :Collection
    {
        return $this->trans()->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get the all users of balance.
     *
     * @return BelongsToMany
     */
    public function users() :BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'user_balance', 'balance_id', 'user_id');
    }

    /**
     * Get balance owner
     *
     * @return BelongsTo
     */
    public function owner() :BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }

    /**
     * Check if user assigned to balance.
     *
     * @param User $user
     *
     * @return bool
     */
    public function hasUser(User $user) :bool
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
    public function getCredit() :int
    {
        $trans = $this->trans()->where('type', '=', '-')->sum('amount');

        return intval($trans, 10);
    }

    /**
     * Get all of debited of balance.
     *
     * @return int
     */
    public function getDebit() :int
    {
        $trans = $this->trans()->where('type', '=', '+')->sum('amount');

        return intval($trans, 10);
    }

    /**
     * Calculate summary of balance.
     *
     * @return int
     */
    public function getBalance() :int
    {
        $credit = $this->getCredit();
        $debit = $this->getDebit();

        return $debit - $credit;
    }

    /**
     * Get public link of balance
     *
     * @return string
     */
    public function publicLink()
    {
        return route('user.balance', [
            'users'     => $this->owner->nick ? $this->owner->nick : $this->owner_id,
            'balance'   => $this->slug ? $this->slug : $this->id
        ]);
    }
}
