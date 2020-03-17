<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessMeta;
use App\Offers;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Mostrar modal con mensaje de la empresa
     */
    public function show($user, $offer)
    {
        $candidate = User::whereId($user)
            ->select(['id', 'name', 'surname'])
            ->first();
        $offer = Offers::whereId($offer)->first();

        $offers = Offers::whereSlug($offer->slug)->with('candidates', 'candidates.user', 'candidates.user.userMeta')->first();

        return back()->with(['modal' => ['true']]);
    }

    /**
     * Enviar el mensaje al usuario
     */

    /**
     * Usuario puede leer el mensaje
     */

    /**
     * Respueta del usuario al mensaje
     */
}
