<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Service\UserService;
use App\User;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends ApiController
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service=$service;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = $this->service->showAll();

        return $this->showAll($usuarios);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
   $reglas = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'password_confirmation'=>'required'
      ];
      $request->validate($reglas);

      $campos = $request->all();
      $campos ['pasword'] = bcrypt($request->password);
      $campos['verified'] = User::USUARIO_NO_VERIFICADO;
      $campos['verification_token'] = User::generarVerificationToken();
      $campos['admin'] = User::USUARIO_REGULAR;

      $usuario = User::create($campos);

      return $this->showOne($usuario, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        if ($usuario==null)
        {
          return response()->json(['data'=>'no se encontro el usuario'],404);
        }

         return $this->showOne($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $reglas = [
          'email' => 'email|unique:users,email,' . $user->id,
        ];
        $request->validate($reglas);
        if ($request->has('name')) {
          $user->name = $request->name;
        }

        if ($request->has('email') && $user->email != $request->email) {
          $user->verified = User::USUARIO_NO_VERIFICADO;
          $user->verification_token = User::generarVerificationToken();
          $user->email = $request->email;
        }

        if ($request->has('password')) {
          $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
          if (!$user->esVerificado()) {
            return response()->json(['error' => 'Unicamente los usuarion verificados pueden cambiar su valor de administrador', 'code' => 409], 409);
          }
          $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
          return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar', 'code' => 422], 422);
        }
        $user->save();

         return $this->showOne($user);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::findOrFail($id);

    try {
        $user->delete();
    } catch (\Throwable $th) {
      return response()->json(['el usuario no se puede eliminar'],412);
    }

       return $this->showOne($user);
    }




}
