<?php

namespace App\Service;

use Illuminate\Http\Request;

interface BuyerService
{
    public function storeBuyer(Request $request);
    public function updateBuyer(Request $request, int $id);
    public function indexBuyer(Request $request, int $id);
    public function showOne(int $id);

}
