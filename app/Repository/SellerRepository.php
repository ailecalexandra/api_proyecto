<?php

namespace App\Repository;

use App\Seller;
use App\Service\SellerService;

class SellerRepository extends Repository implements SellerService
{
    public function __construct(Seller $model)
    {
        $this->model = $model;
    }

}
