<?php

namespace App\Service;

interface UserService
{
    public function showOne(int $id);
    public function showAll();
    public function delete($id);
    public function find (int $id);
    public function store(array $data);

}
