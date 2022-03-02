<?php

namespace App\Service;

use Illuminate\Http\Request;

interface UserService
{
    public function showOneUser(int $id);
    public function showAllUser();
    public function deleteUser($id);
    public function findUser(int $id);
    public function storeUser(Request $request);

}
