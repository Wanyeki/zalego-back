<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class Newsletter_controller extends Controller
{
   public function add(Request $req){

        $this->validate($req,[
            "email"=>['required','email']
        ]);

        Newsletter::create([
            "email"=>$req->email
        ]);

        return [
            'subscribed'=>true,
            "email"=>$req->email
        ];
   }
}
