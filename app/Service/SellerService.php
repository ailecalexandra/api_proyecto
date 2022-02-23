<?php

namespace App\Service;

use Illuminate\Http\Request;

interface SellerService
{
    public function storeSeller(Request $request);
    public function updateSeller(Request $request,int $id);
    public function indexSeller(Request $request, int $id);
    public function showOne(int $id);


}
