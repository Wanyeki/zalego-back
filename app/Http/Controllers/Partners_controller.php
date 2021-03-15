<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Partners_controller extends Controller
{
 public function save( Request $req){
    $this->validate($req,[
        'name'=>['required']
    ]);
    if ($req->file('logo')->isValid()) {
        //
        $validated = $req->validate([
            'name' => 'string|max:40',
            'logo' => 'mimes:jpeg,png|max:1014',
        ]);
        $extension = $req->logo->extension();
        $req->logo->storeAs('/public', $req->name.".".$extension);
        $url =Storage::url($req->name.".".$extension);

    Partners::create([
        'name'=>$req->name,
        'logo'=>$url
    ]);
    return  redirect()->back()->with('tab','partners');
 }
 }

 public function delete(Request $req){
    $project=Partners::find($req->id);
    $project->delete();
    return ['deleted'=>true];

}
}
