<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Mostrar modal con mensaje de la empresa
     */
    public function show(Request $request)
    {
        $user = User::whereId($request->input('user'))
            ->select(['name', 'surname'])
            ->first();

        $messages = Message::where([
            "offer_id" => $request->input('offer'),
            "user_id" => $request->input('user')
        ])->get();

        $response = [
            "user" => $user,
            "messages" => $messages
        ];

        return response()->json($response, 200);
    }

    /**
     * Enviar el mensaje al usuario
     */
    public function send(Request $request)
    {
        $request->merge(['status' => Message::SENDED]);
        dd($request);
    }

    /**
     * Usuario puede leer el mensaje
     */

    /**
     * Respueta del usuario al mensaje
     */
}
