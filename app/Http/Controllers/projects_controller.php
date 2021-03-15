<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use Illuminate\Support\Facades\Storage;

class projects_controller extends Controller
{
    public function save(Request $req){
        $this->validate($req,[
            'title'=>['required'],
            'short_description'=>['required'],
            'description'=>['required'],
        ]);
        if ($req->hasFile('main_image')) {
            //  Let's do everything here
            if ($req->file('main_image')->isValid()) {
                //
                $validated = $req->validate([
                    'name' => 'string|max:40',
                    'main_image' => 'mimes:jpeg,png|max:1014',
                ]);
                $extension = $req->main_image->extension();
                $req->main_image->storeAs('/public', $req->title.".".$extension);
                $url =Storage::url($req->title.".".$extension);
                $images=$req->file('screenshots');
                $urls='';
                if($images){
                foreach($images as $screenshot){
                    $extension = $screenshot->extension();
                    $filename=$screenshot->getClientOriginalName();
                    $screenshot->storeAs('/public', $filename);
                    $ur =Storage::url($filename);
                    $urls=$urls.','.$ur;


                }
            }

                Projects::create([
                    'title'=>$req->title,
                    'short_description'=>$req->short_description,
                    'description'=>$req->description,
                    'body'=>'write something',
                    'main_image'=>$url,
                    'screenshots'=>$urls,
                    'screenshot_type'=>$req->screenshot_type
                ]);
                return redirect()->back()->with('tab','portfolio');

            }
        }



    }
    public function delete(Request $req){
        $project=Projects::find($req->id);
        $project->delete();
        return ['deleted'=>true];

    }
    public function update(Request $req){

    }
    public function get_all(Request $req){
        $projects=Projects::all();
        return $projects;

    }
}
