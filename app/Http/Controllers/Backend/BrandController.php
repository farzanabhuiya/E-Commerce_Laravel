<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\SlugGenerator;

class BrandController extends Controller
{
    use SlugGenerator;

    // function index(Request $request){
    //     $brands= Brand::latest();
    //     if(!empty($request->get('key'))){
    //       $brands=$brands->where('name','like','%'.$request->get('key').'%');
    //     }
    //     $brands=$brands->paginate(3);

    //  return view('backend.Brand.create-brand',compact('brands'));
    // }




    function index(){
        $brands= Brand::latest()->paginate(3);

     return view('backend.Brand.create-brand',compact('brands'));
    }



    public function create(Request $request){
     $brand =new Brand();
     $brand->name =$request->name;
     $brand->slug=$this->generateslug($request->name,Brand::class);
     $brand->save();
     return back();
    }
 

public function story(){
    $brands= Brand::latest()->paginate(3);
    return view('backend.Brand.List-brands',compact('brands'));
}

public function edit($id){
 
    $brand=Brand::find($id);
    return view('backend.Brand.edit_band',compact('brand'));
}

public function update(Request $request,$id){
     $brand = Brand::find($id);
     $brand->name =$request->name;
     $brand->slug=$this->generateslug($request->name,Brand::class);
     $brand->save();
     $brands= Brand::latest()->paginate(3);
     return view('backend.Brand.List-brands',compact('brands'));
}


public function delete($id){
    $brands=Brand::find($id)->delete();
    return view('backend.Brand.List-brands',compact('brands'));
  
}
}
