<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class PageController extends Controller
{
    public function index (){
      $pages = Page::get();
      return view('backend.Page.List',compact('pages'));
    }


    public function create (){
        return view('backend.Page.create');
    }


    public function story (Request $request){
        $pages = new Page();
        $pages->name= $request->name;
        $count=Page::where('slug','like','%' .str($request->name)->slug() .'%')->count();
        if($count>0){
            $count++;
            $slug = str($request->name)->slug().'-'.$count;
        }else{
            $slug = str($request->name)->slug();
        }
        $pages->slug = $slug;
        $pages->content= $request->content;
        $pages->save();
        return back()->with('success','Pages Successfully Created');
    

        
    }
    public function edit ($id){
        $page = Page::find($id);
        return view('backend.Page.edit',compact('page'));
    }

    public function update (Request $request,$id){
        $pages = Page::find($id);
        $pages->name= $request->name;
        $count=Page::where('slug','like','%' .str($request->name)->slug() .'%')->count();
        if($count>0){
            $count++;
            $slug = str($request->name)->slug().'-'.$count;
        }else{
            $slug = str($request->name)->slug();
        }
        $pages->slug = $slug;
        $pages->content= $request->content;
        $pages->save();
        return back()->with('success','Pages Successfully Update');

    }

    public function deleted ($id){
        Page::find($id)->delete();
        return back();
    }
    
    
}
