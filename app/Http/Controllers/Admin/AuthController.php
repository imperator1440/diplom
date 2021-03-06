<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.login');   
    }


    public function logout()
    {
        auth("admin")->logout();

        return redirect(route("home"));
    }

    public function login(Request $request){
       
        $validateParameters = $request->validate([
            'email' => ["required", "email", "string"],
            'password' => ["required"]
        ]);

        if(auth("admin")->attempt($validateParameters)){
            return redirect(route("admin.posts.index"));
        };

        return redirect(route("admin.login"))->withErrors(["email" => "User is not found or data is incorrect"]);
    }

}
