<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Resources\BuyerCollection;
use App\Repository\SellerRepository;
use App\Seller;
use App\Service\SellerService;
use Illuminate\Http\Request;

class SellerController extends ApiController
{
    public function __construct(SellerRepository $repository)
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
        $type = $request->type == null ? 'DESC' : $request->type;
        $perPage = $request->perPage == null ? 10 : $request->perPage;
        $orderBy = $request->orderBy == null ? 'users.id':$request->orderBy;

        $vendedores = $this->repository->indexSeller($orderBy, $type, $perPage);

            //has('products')->with('products')->get()

        return $this->succesResponse($vendedores);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $vendedor = $this->repository->showOne($id);
        $vendedor->products;


         return $this->succesResponse($vendedor);
    }


}
