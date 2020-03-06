<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessMeta;
use App\Http\Requests\BusinessLoginRequest;
use App\Http\Requests\BusinessProfileRequest;
use App\Http\Requests\BusinessRegisterRequest;
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
        $business = Business::where('email', $request->email)->first();

        if ($business) {
            if (Hash::check($request->password, $business->password)) {
                session([
                    'id' => $business->id,
                    'name' => $business->business_meta->business_name,
                    'role' => 'business'
                ]);

                return redirect()->route('offer.admin');
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
        dd($request);
    }

    public function updateProfile(BusinessProfileRequest $request)
    {

        $id_meta = BusinessMeta::where('id_business', session()->get('id'))->select('id', 'id_business')->first();

        BusinessMeta::where('id', $id_meta->id)
            ->update([
                'business_name' => $request->businessName,
                'rut_business' => $request->rut_business,
                'fantasy_name' => $request->fantasy_name,
                'activity' => $request->activity,
                'address' => $request->address,
                'state' => $request->state,
                'city' => $request->city,
                'comune' => $request->comune,
                'phone' => $request->phone,
                'employees' => $request->employees,
                'entry' => $request->entry
            ]);
        Business::where('id', session()->get('id'))
            ->update([
                'email' => $request->email,
                'firstname' => $request->userName,
                'surname' => $request->userSurname,
                'position' => $request->userPosition,
                'phone' => $request->userPhone,
            ]);

        return back()->with('message', ['success', 'Perfil editado correctamente']);
    }

    public function file($id)
    {
        $business = Business::whereId($id)->withCount('offers')->with('business_meta', 'offers')->first();

        return view('business.file', compact('business'));
    }
}
