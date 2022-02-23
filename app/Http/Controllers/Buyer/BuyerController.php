<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use App\Http\Resources\BuyerCollection;
use App\Repository\BuyerRepository;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyerController extends ApiController
{
    public function __construct(BuyerRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->type === null ? 'DESC' : $request->type;
        $perPage = $request->perPage == null ? 10 : $request->perPage;
        $orderBy = $request->orderBy === null ? 'users.id': $request->orderBy;


        $compradores = Transaction::join('users','transactions.buyer_id','=','users.id')
            ->orderBy($orderBy,$type)
            ->paginate($perPage);

        return new BuyerCollection($compradores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
         $comprador = $this->repository->showOne($id);
         $comprador->transactions;

         return $this->succesResponse($comprador);

    }



}
