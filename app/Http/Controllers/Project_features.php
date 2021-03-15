<?php

namespace App\Http\Controllers;

use App\Models\ProjectFeature;
use App\Models\Projects;
use Illuminate\Http\Request;

class Project_features extends Controller
{
  public function add(Request $req){
    $this->validate($req,[
        'title'=>['required'],
        'description'=>['required'],
        'project_id'=>['required']
    ]);

    ProjectFeature::create([
        'title'=>$req->title,
        'description'=>$req->description,
        'project_id'=>$req->project_id
    ]);

    $features=ProjectFeature::where('project_id',$req->project_id)->get();

    return [
        'saved'=>true,
        'features'=>$features
    ];
  }
  public function all(Request $req){
      $features=ProjectFeature::where('project_id',$req->project_id)->get();
      $project=Projects::find($req->project_id);

      return ["features"=>$features,"project"=>$project];

  }

  public function delete(Request $req){
    $feature=ProjectFeature::find($req->feature_id);
    $feature->delete();
    $features=ProjectFeature::where('project_id',$req->project_id)->get();

    return [
        'deleted'=>true,
        'features'=>$features
    ];
  }
}
