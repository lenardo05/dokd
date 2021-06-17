<?php

namespace App\Http\Controllers\API;

use Session;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateForm;
use App\Http\Requests\UserUpdateForm;
use App\Http\Requests\LoginForm;

class UserController extends Controller
{

    /**
     * Get users
     */
    public function index()
    {
        try {

            $users = User::all()->toArray();
            $response = [
                'success' => [
                    'message' => ['Usuário cadastrado com sucesso'],
                ]
            ];
            $status = 200;

        } catch (Exception $ex) {

            print_r($ex);
            $response = [
                'errors' => [
                    'message' => ['Algo deu errado']
                ]
            ];
            $status = 422;

        }

            //return response()->json($users, 200);
        return response()->json($users, $status);
    }

    /**
     * Add user
     */
    public function store(UserCreateForm $request)
    {
        try {

            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $response = [
                'success' => [
                    'message' => ['Usuário cadastrado com sucesso'],
                ]
            ];
            $status = 201;

        } catch (Exception $ex) {
            $response = [
                'errors' => [
                    'message' => ['Algo deu errado']
                ]
            ];
            $status = 422;

        }

        return response()->json($response, $status);
    }

    /**
     * Edit user
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user, 200);
    }

    /**
     * Update user
     */
    public function update($id, UserUpdateForm $request)
    {
        try {

            $user = User::find($id);
            $user->name     = $request->get('name');
            $user->email    = $request->get('email');
            $user->password = $request->password != NULL ? Hash::make($request->password) : $user->password;
            $user->update();

            $response = [
                'success' => [
                    'message' => ['Usuário atualizado com sucesso'],
                ]
            ];
            $status = 200;

        } catch (Exception $ex) {

            $response = [
                'errors' => [
                    'message' => ['Algo deu errado']
                ]
            ];
            $status = 422;

        }

        return response()->json($response, $status);
    }

    /**
     * Delete user
     */
    public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            $response = [
                'success' => [
                    'message' => ['Usuário excluído com sucesso'],
                ]
            ];
            $status = 200;

        } catch (Exception $ex) {

           $response = [
                'errors' => [
                    'message' => ['Algo deu errado']
                ]
            ];
            $status = 422;

        }

        return response()->json($response, $status);
    }

    /**
     * Register
     */
    public function register(UserCreateForm $request)
    {
        try {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $response = [
                'success' => [
                    'message' => ['Usuário cadastrado com sucesso'],
                ]
            ];
            $status = 200;

        } catch (Exception $ex) {

           $response = [
                'errors' => [
                    'message' => ['Algo deu errado']
                ]
            ];
            $status = 422;

        }

        return response()->json($response, $status);
    }

    /**
     * Login
     */
    public function login(LoginForm $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($credentials)){

            $response = [
                'success' => true
            ];
            $status = 200;

        }
        else {

            $response = [
                'errors' => [
                    'message' => ['Usuário não autorizado']
                ]
            ];
            $status = 401;

        }

        return response()->json($response, $status);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Session::flush();

        $response = [
            'success' => true
        ];
        $status = 200;

        return response()->json($response, $status);
    }
}
