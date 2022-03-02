<?php

namespace App\Repository;

use App\Category;
use App\Service\CategoryService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class CategoryRepository extends Repository implements CategoryService
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }


    public function storeCategory(Request $request)
    {
        // TODO: Implement storeCategory() method.
    }

    public function updateCategory(Request $request, int $id)
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
            return  $this->errorResponse('Debe especificar al menos un valor diferente para actualizar',422);
        }
        $instance->save();
        return $this->succesResponse($instance);
        // TODO: Implement updateCategory() method.
    }

    public function indexCategory(string $orderBy, string $type, int $perPage)
    {
        $categories = $this->model->join('category_product','categories.id','=','category_product.category_id')
            ->join('products','category_product.product_id','=','products.id')
            ->orderBy($orderBy,$type)
            ->paginate($perPage);
        return $categories;
        // TODO: Implement indexCategory() method.
    }

    public function showCategory(int $id)
    {
        $instance = $this->findModel($id);
        if ($instance === null){
            return self::ERROR_NOT_FOUND;
        }
        $instance->products;

        return $instance;
        // TODO: Implement showOne() method.
    }

    public function deleteCategory(int $id)
    {

        try {
            $instance = $this->findModel($id);
            if ($instance === null) {
                $this->errorResponse('Not found', 404);
            }

            $instance->delete();
            return $this->succesResponse(['date_deleted'=>$instance->deleted_at ,'message' => 'Category deleted successfully']);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

        // TODO: Implement deleteCategory() method.
    }
}
