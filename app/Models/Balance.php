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
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property int $owner_id
 * @property bool $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Balance whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Trans[] $trans
 * @property-read \App\Models\User $owner
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
}
