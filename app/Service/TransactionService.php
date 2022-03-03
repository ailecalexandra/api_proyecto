<?php

namespace App\Service;

use Illuminate\Http\Request;

interface TransactionService
{
    public function storeTransaction(Request $request);
    public function updateTransaction(Request $request,int $id);
    public function indexTransaction(string $orderBy,string $type,int $perPage);
    public function showTransaction(int $id);
    public function deleteTransaction(int $id);

}
