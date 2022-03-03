<?php

namespace App\Repository;

use App\Service\TransactionService;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TransactionRepository extends Repository implements TransactionService
{
    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    public function storeTransaction(Request $request)
    {
        // TODO: Implement storeTransaction() method.
    }

    public function updateTransaction(Request $request, int $id)
    {
        $instance = $this->findModel($id);
        if ($instance === null)
        {
            return self::ERROR_NOT_FOUND;
        }
        $instance->fill($request->only(
            'quantity',
            'buyer_id',
            'product_id'
        ));
        if ($instance->isClean()){
            return  $this->errorResponse('Debe especificar al menos un valor diferente para actualizar',422);
        }
        $instance->save();
        return $this->succesResponse($instance);
        // TODO: Implement updateTransaction() method.
    }

    public function indexTransaction(string $orderBy, string $type, int $perPage)
    {
        //   $categories = $this->model->join('category_product','categories.id','=','category_product.category_id')
        //            ->join('products','category_product.product_id','=','products.id')
        //            ->orderBy($orderBy,$type)
        //            ->paginate($perPage);
        //        return $categories;
        $transactions = $this->model
            ->join('users as sellers','transactions.seller_id','=','sellers.id')
            ->join('users as buyers','transactions.buyer_id','=','buyers.id')
            ->join('products','transactions.product_id','=','products.id')
            ->orderBy($orderBy,$type)
            ->paginate($perPage);

        return($transactions);
        // TODO: Implement indexTransaction() method.
    }

    public function showTransaction(int $id)
    {
        $instance = $this->findModel($id);
        if ($instance === null){
            return self::ERROR_NOT_FOUND;
        }
        $instance->products;

        return $instance;
        // TODO: Implement showTransaction() method.
    }

    public function deleteTransaction(int $id)
    {
        // TODO: Implement deleteTransaction() method.
    }
}
