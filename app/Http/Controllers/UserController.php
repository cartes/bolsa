<?php

namespace App\Http\Controllers;

use App\Candidates;
use App\Http\Requests\PersonalDataRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Offers;
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
        $offers = Offers::withCount('candidates')
            ->with('business')
            ->with('businessMeta')
            ->latest()
            ->paginate(20);

        if (Hash::check($request->password, $user->password)) {
            session([
                'id' => $user->id,
                'role' => 'user',
                'name' => $user->name . ' ' . $user->surname
            ]);
            return view('home', compact('user', 'offers'));
        } else {
            return back()->with('message', ['danger', 'Combinación email y clave no corresponden']);
        }
    }

    public function logout(Request $request)
    {
        session()->flush();

        return redirect()->route('home');
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

    public function showoffers()
    {
        $id = session()->get('id');
        $user = User::where('id', $id)->select(['name', 'rut_user'])->first();

        $candidates = Candidates::where('id_user', $id)
            ->with(['offers', 'user', 'offers.businessMeta'])
            ->paginate(10);

        if ($user) {
            return view('user.offers', compact('candidates', 'user'));
        } else {
            return back()->with('message', ['danger', 'No puedes acceder a esta página']);
        }
    }

    public function file(User $id)
    {
        $user = $id->with('userMeta', 'userExperience', 'userLanguage', 'userSkills', 'userEducation')->first();

        return view('user.file', compact('user'));
    }
}
