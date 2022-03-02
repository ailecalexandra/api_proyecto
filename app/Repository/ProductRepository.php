<?php

namespace App\Repository;

use App\Product;
use App\Service\ProductService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductRepository extends Repository implements ProductService
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function storeProduct(Request $request)
    {
        // TODO: Implement storeProduct() method.
    }

    public function updateProduct(Request $request, int $id)
    {
        $instance = $this->findModel($id);
        if ($instance === null)
        {
            return self::ERROR_NOT_FOUND;
        }
        $instance->fill($request->only(
            'name',
            'description'
        ));
        if ($instance->isClean()){
            return $this->errorResponse('Debe especificar al menos un valor diferente para actualizar',422);
        }
        $instance->save();
        return $this->succesResponse($instance);

        // TODO: Implement updateProduct() method.
    }

    public function indexProduct(object $params)
    {

        $category_id =$params->category_id;
        $products = $this->model->join('category_product','products.id','=','category_product.product_id')
            ->join('categories','category_product.category_id','=','categories.id')
            ->join('users as sellers','products.seller_id','=','sellers.id')
            ->search($params->search)
            ->categoryId($category_id)
            ->whereBetween('products.created_at',[$params->start_at,$params->end_at])
            ->select(
                'products.id',
                'categories.name as category_name',
                'products.description',
                'products.quantity',
                'products.status','products.image',
                'sellers.email',
                'products.created_at',
                'products.updated_at',
                'categories.id as category_id')
            ->orderBy($params->orderBy,$params->type)
            ->paginate($params->perPage);

        return $products;
        // TODO: Implement indexProduct() method.
    }

    public function showProduct(int $id)
    {
        $instance = $this->findModel($id);
        if ($instance === null){
            return self::ERROR_NOT_FOUND;
        }
        $instance->products;

        return $instance;
        // TODO: Implement showProduct() method.
    }

    public function deleteProduct(int $id)
    {

        try {
            $instance = $this->findModel($id);
            if ($instance === null) {
                $this->errorResponse('Not found',404);
            }
            $instance->delete();
            return $this->succesResponse(['date_deleted'=>$instance->deleted_at ,'message' => 'Category deleted successfully']);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
        // TODO: Implement deleteProduct() method.
    }
}
