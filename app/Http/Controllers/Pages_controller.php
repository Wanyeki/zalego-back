<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\PagesContent;
use App\Models\Partners;
use App\Models\Projects;
use Illuminate\Http\Request;

class Pages_controller extends Controller
{
    public function home(){
        $partners=Partners::all();
        $cons=PagesContent::where('type','capability')->get();
        return view('index',["partners"=>$partners,'content'=>$cons]);

    }
    public function approach(){
        $cons=PagesContent::where('type','approach')->get();
        for($i=0;$i<count($cons); $i++){
            $cons[$i]->step=$i+1;
        }
        return view('approach',['content'=>$cons]);
    }
    public function sets(){
        $cons=PagesContent::where('type','sets')->get();
        return view('sets_us',['content'=>$cons]);
    }
    public function goals(){
        $cons=PagesContent::where('type','goal')->get();
        return view('goals',['content'=>$cons]);
    }
    public function portfolio(){
        $projects=Projects::all();
        $screenshots=[];
        foreach ($projects as $p) {
            $sp= explode(',',$p->screenshots);
            array_shift($sp);
            $screenshots[$p->id]=$sp;
        }
        return view('portfolio',['projects'=>$projects,'screenshots'=>$screenshots]);
    }
    public function contacts(){
        return view('contact');
    }


}
