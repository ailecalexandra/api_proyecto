<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponse
{
  public function succesResponse($data, $code=200)
  {
    return response()->json(['data' => $data], $code);
  }

  protected function errorResponse($message, $code=500)
  {
    return response()->json(['error' => $message, 'code' => $code], $code);
  }

  protected function showAll(Collection $collection, $code = 200)
  {
    return $this->succesResponse($collection, $code);
  }

  protected function showOne(Model $instance, $code = 200)
  {
    return $this->succesResponse($instance, $code);
  }



}
