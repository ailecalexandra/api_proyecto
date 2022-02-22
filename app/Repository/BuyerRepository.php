<?php

namespace App\Repository;

class BuyerRepository extends Repository
{
    public function __construct(Seller $model)
    {
        $this->model = $model;
    }

}
