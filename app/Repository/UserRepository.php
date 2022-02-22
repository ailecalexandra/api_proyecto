<?php

namespace App\Repository;

use App\Service\UserService;
use App\Traits\ApiResponse;
use App\User;
use http\Env\Request;

class UserRepository extends Repository implements UserService
{
    use ApiResponse;
    protected $model;

    public function __construct(User $model)
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
            if ($instance === null)
                $this->errorResponse('not found',404);

            $instance->delete();
            return $instance->deleted_at;

        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function store (\Illuminate\Http\Request $request)
    {
        try {
            $campos = $request->all();
            $campos ['password'] = bcrypt($request->password);
            $campos['verified'] = User::USUARIO_NO_VERIFICADO;
            $campos['verification_token'] = User::generarVerificationToken();
            $campos['admin'] = User::USUARIO_REGULAR;
            $instance = $this->model->create($campos);

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
