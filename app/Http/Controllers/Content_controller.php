<?php

namespace App\Http\Controllers;

use App\Models\PagesContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Content_controller extends Controller
{
   public function  get_content(Request $req){
    $content=PagesContent::where('type',$req->type)->get();
    return ["content"=>$content];
   }


   public function save(Request $req){
    $this->validate($req,[
        'description'=>['required']
    ]);
    $icon=$req->file('icon');
    $ur='';
    if($icon){
        $extension = $icon->extension();
        $filename=$icon->getClientOriginalName();
        $icon->storeAs('/public', $filename);
        $ur =Storage::url($filename);
    }

    PagesContent::create([
        'title'=>$req->title,
        'description'=>$req->description,
        'icon'=>$ur,
        'type'=>$req->type
    ]);
    return  redirect()->back()->with('tab','goals');
   }

   public function delete(Request $req){
    $content=PagesContent::find($req->id);
    $content->delete();

    $cons=PagesContent::where('type',$req->type)->get();
    return ['deleted'=>true,'content'=>$cons];
}
}
