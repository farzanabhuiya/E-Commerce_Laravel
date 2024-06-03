<?php

namespace App\Http\Controllers\Backend;


use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\SlugGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
  use SlugGenerator;


    public function index(Request $request){

        $categories= Category::latest();
        if (!empty($request->get('keyword'))){
            $categories= $categories->where('name','like','%'.$request->get('keyword').'%');

        }
        $categories= $categories->paginate(3);
       return view('backend.Category.ListCategory',compact('categories'));
    }

    public function store(Request $request){  

         $fileName = time().'.'.$request->image->extension();  
         $request->image->storeAS('category',$fileName,'public'); 
        $category =new Category();
        $category->name=$request->name;
        $category->slug=$this->generateslug($request->name,Category::class);
         $category->image= $fileName;
         $category->showhome=$request->showhome;
         $category->status=$request->status;
        $category->save();
        return view('backend.Category.create-category',compact('category'));
    }

    public function create(){
        $categories= Category::latest()->paginate(3);
        return view('backend.Category.create-category',compact('categories'));  
    }
      public function edit($id){
      $category=Category::find($id);
        return view('backend.Category.Edit',compact('category')); 
    }  

    public function update(Request $request,$id){
       
        $fileName = time().'.'.$request->image->extension();  
        $request->image->storeAS('category',$fileName,'public');
        $category=Category::find($id);
        $category->name=$request->name;
        $category->image= $fileName;
        $category->save();
        $categories= Category::latest()->paginate(3);
       return view('backend.Category.ListCategory',compact('category','categories'));
    } 
    public function destroy($id){
        Category::find($id)->delete();
        return back();
        
    }
}
