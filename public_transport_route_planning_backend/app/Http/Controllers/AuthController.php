<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $login_credentials = [
            'name'=>$request->name,
            'password'=>$request->password
        ];
        if(!Auth::attempt($login_credentials)){
            return response()->json(['error' => 'Lietotājvārds un/vai parole nav pareiza!']);
        }

        $accessToken = Auth::user()->createToken('Token Name')->accessToken;
        return response()->json(['user'=> Auth::user(),'token' => $accessToken], 200);
    }

    public function authenticatedUserDetails(){
        //returns details
        return response()->json(['authenticated-user' => auth()->user()], 200);
    }
}
