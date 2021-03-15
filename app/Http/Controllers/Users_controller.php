<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Users_controller extends Controller
{
    public function get_all(){
        $users=User::all();
        return $users;
    }

    public function delete(Request $req){
        $user=User::where('email',$req->email);
        $user->delete();
        $users=User::all();
        return [
            'deleted'=>true,
            'users'=>$users
        ];
    }

    public function make_admin(Request $req){
        $user=User::find($req->id);
        if($user->type=='admin'){
            $user->type='user';
        }else{
            $user->type='admin';
        }
        $user->save();
        $users=User::all();
        return [
            'updated'=>true,
            'users'=>$users,
            'id'=>$req->id,
            'user'=>$user
        ];
    }
    public function add(Request $req){
        $validated=$this->validate($req,[
         "name"=>['required', 'max:255'],
         "email"=>['required', 'max:255','email']
        ]);
        User::create([
            'name' => $req-> name,
            'email' => $req->email,
            'password' => Hash::make('changeme')
        ]);
        // return $req;
        $users=User::all();
        return [
            'saved'=>true,
            'users'=>$users
        ];
    }
}
