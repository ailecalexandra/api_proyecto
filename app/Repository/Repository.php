<?php

namespace App\Repository;

use App\Enums\ErrorEnum;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\ResponseTrait;

class Repository implements ErrorEnum {
    use ApiResponse;
    protected $model;
    public function __construct(Model $model){
        $this->model= $model;

    }
    public function findModel( int $id){
        return $this->model->find($id);
    }
    public function allModel(){
        return $this->model->all();
    }



}
