<?php

namespace App\Repository;

use App\Seller;
use App\Service\BuyerService;
use Illuminate\Http\Request;

class BuyerRepository extends Repository implements BuyerService
{
    public function __construct(Seller $model)
    {
        $this->model = $model;
    }


    public function storeBuyer(Request $request)
    {
        // TODO: Implement storeBuyer() method.
    }

    public function updateBuyer(Request $request, int $id)
    {
        // TODO: Implement updateBuyer() method.
    }

    public function indexBuyer($orderBy, $type, $perPage)
    {
        $buyers=$this->model->join('transactions','users.id','=','transactions.buyer_id')
            ->orderBy($orderBy,$type)
            ->paginate($perPage);
        return $buyers;

        // TODO: Implement indexBuyer() method.
    }

    public function showOne(int $id)
    {
        $instance = $this->find($id);
        if ($instance === null)
        {
            return self::ERROR_NOT_FOUND;
        }

        return $instance;

        // TODO: Implement showOne() method.
    }
}
