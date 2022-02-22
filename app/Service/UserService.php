<?php

namespace App\Service;

use Illuminate\Http\Request;

interface UserService
{
    public function showOne(int $id);
    public function showAll();
    public function delete($id);
    public function find (int $id);
    public function store(Request $request);

}
