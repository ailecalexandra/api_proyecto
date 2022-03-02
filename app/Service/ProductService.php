<?php

namespace App\Service;

use Illuminate\Http\Request;

interface ProductService
{
    public function storeProduct(Request $request);
    public function updateProduct(Request $request,int $id);
    public function indexProduct(object $params);
    public function showProduct(int $id);
    public function deleteProduct(int $id);

}
