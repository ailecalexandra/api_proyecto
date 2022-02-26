<?php

namespace App\Repository;

use App\Enums\ErrorEnum;
use App\Seller;
use App\Service\SellerService;
use Illuminate\Http\Request;

class SellerRepository extends Repository implements SellerService
{
    public function __construct(Seller $model)
    {
        $this->model = $model;
    }

    public function storeSeller(Request $request)
    {
        // TODO: Implement storeSeller() method.
    }

    public function updateSeller(Request $request, int $id)
    {
        // TODO: Implement updateSeller() method.
    }

    public function indexSeller($orderBy, $type, $perPage)
    {
        $sellers=$this->model->join('products','users.id','=','products.seller_id')
            ->orderBy($orderBy,$type)
            ->paginate($perPage);
        return $sellers;





        // TODO: Implement indexSeller() method.
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
