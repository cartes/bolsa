<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalDataRequest;
use App\Http\Requests\UserRegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function login(Request $request)
    {
        $usr = $request->email;
        $user = User::where('email', $usr)->first();

        if (Hash::check($request->password, $user->password)) {
            session(['id' => $user->id, 'name' => $user->name . ' ' . $user->surname]);
            return view('home', compact('user'));
        } else {
            return view('home', [
                'code' => 400,
                'message' => 'Combinación email y clave no corresponden'
            ]);
        }
    }

    public function logout(Request $request)
    {
        session()->flush();

        return route('/');
    }

    public function store(UserRegisterRequest $request)
    {
        $user = new User;

        $user->name = $request->firstName;
        $user->surname = $request->lastName;
        $user->rut_user = $request->rut;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        try {
            $user->save();

            $data = [
                'code' => 200,
                'message' => __('Guardado con éxito')
            ];
            return view('home', $data);
        } catch (\Exception $error) {
            $data = [
                'code' => 400,
                'message' => __('Error al guardar los datos' . $error)
            ];
        }
    }

}
