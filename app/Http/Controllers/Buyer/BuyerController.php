<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class BuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $compradores = Buyer::has('transactions')->with('transactions')->get();

        return $this->showAll($compradores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function show($id)
    {
         $comprador = Buyer::find($id);
        if ($comprador==null)
        {
          return response()->json(['data'=>'no se encontro el usuario'],404);
        }

        $transactions=$comprador->transactions()->first();
        if (empty($transactions) || $transactions===null) {
             return response()->json(['data'=>'no exiten transacciones en este usuario'],422);
          }

         return $this->showOne($comprador);
        
    }


   
}
