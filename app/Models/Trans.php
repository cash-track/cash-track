<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Trans.
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
