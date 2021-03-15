<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;

class Admin_controller extends Controller
{
    public function  dashboard(){
        if(auth()->user() && auth()->user()->type=='admin'){
            $projects=Projects::all();
            $partners=Partners::all();
            $users=User::all();
            $screenshots=[];
            foreach ($projects as $p) {
                $sp= explode(',',$p->screenshots);
                array_shift($sp);
                $screenshots[$p->id]=$sp;
            }

            $counts=[
                "projects_count"=>$projects->count(),
                "partners_count"=>$partners->count(),
                "users_count"=>$users->count(),
            ];
           return view('dash',['projects'=>$projects,'partners'=>$partners,'counts'=>$counts,'screenshots'=>$screenshots]);
        }

        return redirect()->route('home');
    }
}
