<?php

namespace App\Http\Controllers;

use App\Mail\replys;
use App\Models\Messages;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Messages_controller extends Controller
{
    public function save_message(Request $req){
        $validated=$this->validate($req,[
            "name"=>['required', 'max:255'],
            "email"=>['required', 'max:255','email'],
            "subject"=>['required'],
            "message"=>['required']
           ]);
           Messages::create([
               'name' => $req-> name,
               'email' => $req->email,
               'message' =>  $req->message,
               'subject' =>  $req->subject,
           ]);
           // return $req;
           $messages=Messages::all();
           return [
               'saved'=>true,
               'messages'=>$messages
           ];
    }

    public function get_messages(Request $req){
        $messages=Messages::all();
        return [
            'messages'=>$messages
        ];

    }

    public function delete(Request $req){
        $message=Messages::find($req->id);
        $message->delete();
        $messages=Messages::all();
        return [
            'deleted'=>true,
            'messages'=>$messages
        ];
    }

    public function read_message(Request $req){
        $message=Messages::find($req->id);
        $messages=[];
        if($message){
            $message->status='1';
            $message->save();
            $messages=Messages::all();
             return [
            'updated'=>true,
            'messages'=>$messages,
            'id'=>$req->id
        ];
        }

    }

    public function send_email(Request $req){
        Mail::to($req->email)->send(new replys($req));
    }
}


