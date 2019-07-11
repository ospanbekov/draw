<?php

namespace App\Models;

use App\Collections\Account as AccountCollection;
use App\Models\Abstracts\AbstractModel;

class Account extends AbstractModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'currency', 'description'
    ];

    /**
     * @param array $models
     * @return AccountCollection|\Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = []) {
        return new AccountCollection($models);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeHistory ($query) {
        return $query->orderBy('id', 'ASC');
    }
}
