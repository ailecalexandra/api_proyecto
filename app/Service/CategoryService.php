<?php

namespace App\Service;

use App\Category;
use Illuminate\Http\Request;

interface CategoryService
{
    public function storeCategory(Request $request);
    public function updateCategory(Request $request,int $id);
    public function indexCategory(string $orderBy,string $type,int $perPage);
    public function showCategory(int $id);
    public function deleteCategory(int $id);

}
