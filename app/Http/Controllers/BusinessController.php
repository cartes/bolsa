<?php

namespace App\Http\Controllers;

use App\Business;
use App\Http\Requests\BusinessLoginRequest;
use App\Http\Requests\CreateOfferRequest;
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

    public function createOffer(CreateOfferRequest $request)
    {
        $offer = new Offers;
        $business_id = session()->get('id');

        $offer->id_business = $business_id;
        $offer->title = $request->title;
        $offer->description = $request->description;
        $offer->area = $request->area;
        $offer->sub_area = $request->subarea;
        $offer->country = $request->country;
        $offer->state = $request->state;
        $offer->city = $request->city;
        $offer->comune = $request->comune;
        $offer->address = $request->address;
        $offer->salary = $request->salary;

        $offer->save();

        return back()->with('message', ['success', 'Publicación de nueva oferta exitosa']);
    }

    public function profileIndex(Request $request) {
        return;
    }
}
