<?php

namespace App\Repository;

use App\Service\UserService;
use App\User;

class UserRepository extends Repository implements UserService
{
    protected $model;

    public function __contruct(User $model)
    {
        $this->model=$model;
    }

    public function find (int $id)
    {
        return $this->model->find($id);
    }

    public function showOne(int $id)
    {
        $instance = $this->find($id);
        if ($instance === null)
        {
            return 'not found';
        }
        return $instance;
    }

    public function showAll()
    {
        return $this->model->all();
    }

    public function delete($id)
    {
        try {
            $instance = $this -> find($id);
            $instance->delete();
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function store (array $data)
    {
        try {
            $instance = $this->model->create($data);
            return $instance;
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }

    public function showTransactions(User $user)
    {
        //TODO: Implement showTransactions(). method.
    }

}
