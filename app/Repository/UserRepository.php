<?php

namespace App\Repository;

use App\Service\UserService;
use App\Traits\ApiResponse;
use App\User;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository implements UserService
{
    use ApiResponse;
    protected $model;

    public function __construct(User $model)
    {
        $this->model= $model;
    }

    public function findUser(int $id)
    {
        return $this->model->find($id);
    }

    public function showOneUser(int $id)
    {
        $instance = $this->findUser($id);
        if ($instance === null)
        {
            return 'not found';
        }
        return $instance;
    }

    public function showAllUser()
    {
        return $this->model->all();
    }

    public function deleteUser($id)
    {
        try {
            $instance = $this->find($id);
            if ($instance === null)
                $this->errorResponse('not found',404);

            $instance->delete();
            return $this->succesResponse(['date_deleted'=>$instance->deleted_at,'message' => 'User deleted successfully']);
//
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function storeUser(\Illuminate\Http\Request $request)
    {
        try {
            $campos = $request->all();
            $campos ['password'] = bcrypt($request->password);
            $campos['verified'] = User::USUARIO_NO_VERIFICADO;
            $campos['verification_token'] = User::generarVerificationToken();
            $campos['admin'] = User::USUARIO_REGULAR;
            $instance = $this->model->create($campos);

            return $instance;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function showTransactions(User $user)
    {
        //TODO: Implement showTransactions(). method.
    }

}
