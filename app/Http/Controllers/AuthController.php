<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        
        return view("login");
    }

    public function seLoger(Request $request){
        
        $validator = Validator::make(
            [
                "email" => $request->input('email'),
                "password" => $request->input('password')
            ],
            [
                "email" => ["email", "required"],
                "password" => ["required", "min:4"]
            ]
        );

        $datas = $validator->validated();

        if(Auth::attempt($datas)){
            $request->session()->regenerate();
            return redirect()->intended(route("article.index"));
        } else {
            return redirect()->route("auth.login")->withErrors([
                "invalid" => "Informations invalides !"
            ])->onlyInput('email');
        }
    }

    public function logout(){
        Auth::logout();

        return redirect()->route("auth.login");
    }
}
