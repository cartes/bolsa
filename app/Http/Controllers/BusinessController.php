<?php

namespace App\Http\Controllers;

use App\Business;
use App\Http\Requests\BusinessLoginRequest;
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

                return redirect()->route('post.create');
            } else {
                return back()->with('message', ['danger', 'Contraseña no coincide, inténtelo de nuevo']);
            }
        } else {
            return back()->with('message', ['warning', 'Email no está registrado como empresa']);
        }
    }
}
