<?php

namespace App\Http\Actions\Api;

use Illuminate\Http\Request;
use App\Models\Contact;

use App\Http\Actions\Controller;

class PostContact extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            "firstname" => "alpha|max:200",
            "lastname" => "alpha|max:200",
            "email" => "email|required",
            "message" => "max:5000|required",
        ]);

        $contact = new Contact;
        $contact->firstname = $validated['firstname'];
        $contact->lastname = $validated['lastname'];
        $contact->email = $validated['email'];
        $contact->message = $validated['message'];
        $contact->save();

        return response([], 204);
    }
}
