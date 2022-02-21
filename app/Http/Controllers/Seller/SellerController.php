<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Seller;
use Illuminate\Http\Request;

class SellerController extends ApiController
{
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

        $vendedor = Seller::find($id);
        

        if ($vendedor==null)
        {
            return response()->json(['data'=>'no se encontro el usuario'],404);
        }

      $products=$vendedor->products()->first();
      if(empty($products) || $products===null){
        return response()->json(['data'=>'no existen productos en este usuario'],422);
      }

         return $this->showOne($vendedor);
    }

    
}
