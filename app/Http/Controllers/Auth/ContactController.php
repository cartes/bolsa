<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Mail;

class ContactController extends Controller
{
    public function getContactPage() {
        return view('contact.contact');
    }

    public function saveContact(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message_user' => 'required'
        ]);

        //dd($request);

        $contact = new Contact();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->subject = $request->subject;
        $contact->message = $request->message_user;

        $contact->save();

        \Mail::send('contact.contact_email', [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'subject' => $request->get('subject'),
            'message_user' => $request->get('message_user'),
        ], function ($message) use ($request) {
            $message->from($request->email);
            $message->to('osanchez@editec.cl');
        });

        return back()->with('message', ['success', 'Hemos recibido su mensaje']);
    }

}
