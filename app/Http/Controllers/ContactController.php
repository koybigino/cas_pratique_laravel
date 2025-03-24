<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contact(){
        return view("contact");
    }

    public function envoyer(Request $request){
        
        $validate = Validator::make([
            "nom" => $request->input('nom'),
            "email" => $request->input('email'),
            "message" => $request->input('message')
        ],
        [
            "nom" => "required|min:3|max:20|string",
            "email" => "required|email",
            "message" => "required|string|min:10",
        ]);

        $datas = $validate->validated();

        Mail::to(env("MAIL_FROM_ADDRESS"))->send(new ContactMail($datas));

        return redirect()->route("contact")->with("success", "Votre Message a bien été envoyée !");
    }
}
