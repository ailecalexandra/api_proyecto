<?php

namespace App;

use App\Scopes\Buyer\BuyerScope;

class Buyer extends User
{

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::addGlobalScope(new BuyerScope);
    }

    public function transactions()
    {
      return $this->hasMany(Transaction::class);
    }
}
