<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

class Repository{
    protected $model;
    public function __construct(Model $model){
        $this->model= $model;

    }
    public function find ( int $id){
        return $this->model->find($id);
    }
    public function all(){
        return $this->model->all();
    }



}
