<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
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
    public function index()
    {

        $vendedores = Seller::has('products')->with('products')->get();

        return $this->showAll($vendedores);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $vendedor = $this->repository->find($id);

        if ($vendedor==null)
        {
            return $this->errorResponse('not found',404);
        }

         return $this->showOne($vendedor);
    }


}
