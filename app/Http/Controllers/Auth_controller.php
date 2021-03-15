<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Auth_controller extends Controller
{
    public function login(Request $req){
        if ($req->submit == 'Sign in') {
            $this->validate($req, [
                'email' => ['required', 'max:255'],
                'password' => ['required', 'max:255'],
            ]);
            $login=Auth::attempt(['email' => $req->email, 'password' => $req->password]);
                if($login){

                    return redirect()->route('home');
                }else{
                    return redirect()->back()->with('status','login failed');
                }


        } else {
            $this->validate($req, [
                'username' => ['required', 'max:255'],
                'email' => ['required', 'max:255'],
                'password' => ['required', 'max:255'],
            ]);
            User::create([
                'name' => $req-> username,
                'email' => $req->email,
                'password' => Hash::make($req->password)
            ]);

            $login=Auth::attempt(['email' => $req->email, 'password' => $req->password]);
            if($login){
                return redirect()->route('home');
            }else{
                return redirect()->back()->with('status','login failed');
            }
        }

    }
    public function open_login(){
        return view('login');

    }
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
