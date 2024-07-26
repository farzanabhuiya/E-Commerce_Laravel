<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Subcategorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\SlugGenerator;

class SubcategorieController extends Controller
{
    use SlugGenerator;
    public function index(Request $request){
     

        //$categories= Category::latest()->get();
      $subcategories = Subcategorie::with('category')->get();
      // if(!empty($request->get('keyword'))){

      //   $subcategories= $subcategories->where('name','like','%'.$request->get('keyword').'%');
      // }
      // $subcategories = $subcategories->paginate(3);
  
      $categories = Category::with('Subcategorie')->select('id','name')->latest()->get();
      return view('backend.Subcategorie.create-subcategorie',compact('categories','subcategories'));
  }

  
public function create(Request $request){

    $Subcategory= new Subcategorie();
    $Subcategory->category_id=$request->category_id;
    $Subcategory->name=$request->name;
    $count=Subcategorie::where('slug','LIKE', '%'.str($request->name)->slug() .'%')->count();
      if($count>0){
      $count++;
      $slug=str($request->name)->slug() . '-' . $count;
        }else{
             $slug= str($request->name)->slug();
        }  
        
        $Subcategory->slug=$slug;
        $Subcategory->showhome=$request->showhome;

   // $Subcategory->slug=$this->generateslug($request->name,Subcategory::class);
    $Subcategory->save();
    return back()->with('success','Category Update Successfully Created');;

}
 
public function story(){

  $subcategories = Subcategorie::with('category')->latest()->paginate(5);
  return view('backend.Subcategorie.List-subcategorie',compact('subcategories'));
}

public function edit($id){

  $subcategory= Subcategorie::find($id);
 
return view('backend.Subcategorie.edit-subcategorie',compact('subcategory'));
}


public function update(Request $request,$id){


  $Subcategory= new Subcategorie();
  $Subcategory->category_id=$request->category_id;
  $Subcategory->name=$request->name;

        $count=Subcategorie::where('slug','LIKE', '%'.str($request->name)->slug() .'%')->count();
                 if($count>0){
            $count++;
            $slug=str($request->name)->slug() . '-' . $count;
      }else{
           $slug= str($request->name)->slug();
      }  
      
      $Subcategory->slug=$slug;
      $Subcategory->save();
       $subcategories = Subcategorie::where('category_id', $request->category_id)->latest()->paginate(5);
      return view('backend.Subcategorie.List-subcategorie',compact('Subcategory','subcategories'))->with('success','Subcategories Update Successfully Created');;
    }




public function deleted($id){
Subcategorie::find($id)->delete();
  return back();
  
}





    ///product page subcategorie
public function getSubcategories(Request $request){
  $subcategories= Subcategorie::where('category_id',$request->categoryId)->get();
  return $subcategories;
}
}
