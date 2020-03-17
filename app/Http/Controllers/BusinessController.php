<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessMeta;
use App\Http\Requests\BusinessLoginRequest;
use App\Http\Requests\BusinessProfileRequest;
use App\Http\Requests\BusinessRegisterRequest;
use App\Offers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BusinessController extends Controller
{
    public function index()
    {
        return view('business.index');
    }

    public function login(BusinessLoginRequest $request)
    {
        $business = Business::where('email', $request->email)
            ->with('business_meta')
            ->withCount('offers')
            ->first();

        if ($business) {
            if (Hash::check($request->password, $business->password)) {
                if ($business->business_meta) {
                    session([
                        'id' => $business->id,
                        'name' => $business->business_meta->business_name,
                        'role' => 'business'
                    ]);
                    if (!is_null($request->redirect)) {
                        return redirect()->route($request->redirect);
                    } else {
                        return redirect()->route('offer.admin');
                    }
                } else {
                    session([
                        'id' => $business->id,
                        'name' => $business->firstname . ' ' . $business->surname,
                        'role' => 'business'
                    ]);
                    return redirect()->route('business.profile')->with('message', ['secondary', 'Ingrese los datos de su empresa o negocio']);
                }
            } else {
                return back()->with('message', ['danger', 'Contraseña no coincide, inténtelo de nuevo']);
            }
        } else {
            return back()->with('message', ['warning', 'Email no está registrado como empresa']);
        }
    }

    public function profileIndex(Request $request)
    {
        $id = session()->get('id');
        $business = Business::where('id', $id)
            ->with('business_meta')
            ->first();

        return view('business.profile', compact('business'));
    }

    public function register(BusinessRegisterRequest $request)
    {
        $pass = Hash::make($request->passbusiness);
        $request->merge(['email' => $request->email_business]);
        $request->merge(['phone' => $request->phone_business]);
        $request->merge(['password' => $pass]);

        $business = Business::create($request->input());

        return back()->with('message', ['success', 'Registro exitoso']);
    }

    public function updateProfile(BusinessProfileRequest $request)
    {
        $id = session()->get('id');
        BusinessMeta::updateOrCreate(['id_business' => $id], $request->input());

        return back()->with('message', ['success', 'Perfil editado correctamente'])->with(compact('offers'));
    }

    public function file($id)
    {
        $business = Business::whereId($id)->withCount('offers')->with('business_meta', 'offers')->first();

        return view('business.file', compact('business'));
    }
}
