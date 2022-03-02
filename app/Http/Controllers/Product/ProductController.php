<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ProductRequest;
use App\Service\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    protected $orderBy;
    protected $params;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
        $this->orderBy= [
            'category_name'=>'categories.name',
            'id'=>'products.id',
            'description'=>'products.id',
            'quantity'=>'products.quantity',
            'status'=>'products.status',
            'image'=>'products.image',
            'created_at'=>'products.created_at',
            'update_at'=>'products.update_at',
            'email'=>'sellers.email',
            'category_id'=>'categories.id',
            ];
        $this->params =(object) [
            'start_at'=>null,
            'end_at'=>null,
            'orderBy'=>null,
            'search' =>null,
            'perPage'=>null,
            'type'=>null,
            'category_id'=> null
        ];


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate(
            [
            "start_at" => 'date',
            'end_at' => 'date',

           ],
            [
                'start_at.date'=> 'la fecha de inicio debe ser de tipo date',
                'end_at.date'=> 'la fecha de fin debe ser de tipo date',
                'start_at.before' => 'la fecha de fin debe ser posterior a la de incio',
                'end_at.after' => 'la fecha de inicio debe ser anterior a la de fin'
            ]
        );


        $this->params->type = $request->type ?? 'DESC';
        $this->params->perPage = $request->perPage ?? 10;
        $this->params->orderBy =  $this->orderBy[$request->orderBy] ?? 'products.id';
        $this->params->search = $request->search ?? '';
        $this->params->category_id = $request->category_id ?? '';
        $this->params->start_at = Carbon::parse($request->start_at) ?? Carbon::now()->subYear();
        $this->params->end_at = Carbon::parse($request->end_at) ?? Carbon::now();

        $products = $this->service->indexProduct($this->params);
        return $this->succesResponse($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->service->showProduct($id);

        return $this->service->showProduct($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $id)
    {
        $product=$this->service->updateProduct($request, $id);

        return $this->succesResponse($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->service->deleteProduct($id);

        return $product;
    }
}
