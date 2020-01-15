<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessMeta;
use App\Http\Requests\BusinessRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    public function postCreateForm()
    {
        return view('posts.create');
    }

    public function register(BusinessRegisterRequest $request)
    {
        $business = new Business;
        $businessMeta = new BusinessMeta;

        $business->rut_user = $request->rut;
        $business->password = Hash::make($request->password);
        $business->firstname = $request->firstname;
        $business->surname = $request->surname;
        $business->email = $request->email;
        $business->phone = $request->phone;

        $business->save();

        $businessMeta->id_business = $business->id;
        $businessMeta->rut_business = $request->rut;
        $businessMeta->business_name = $request->business_name;
        $businessMeta->activity = $request->activity;
        $businessMeta->phone = $request->phone;
        $businessMeta->employees = $request->employees;

        $businessMeta->save();

        session()->flush();
        session([
            'id' => $business->id,
            'name' => $businessMeta->business_name,
            'role' => 'Business'
        ]);

        return back()->with('message', ['success', 'Empresa Creada']);
    }
}
