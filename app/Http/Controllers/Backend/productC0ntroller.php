<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class productC0ntroller extends Controller
{
    function create(){

        $products=product::get();
        $categories=Category::get();
        $brands =Brand::get();
        return view('backend.product.create-product',compact('categories','brands','products'));
    }

    public function story(Request $request){
        // $fileName=Str::uuid().'.'.$request->image_pic->extension();
        $fileName = time().'.'.$request->image->extension();  
        $request->image->storeAS('Product',$fileName,'public');
         $product=new product();
     
        $product->title=$request->title;
        $count=product::where('slug','LIKE', '%'.str($request->title)->slug() .'%')->count();
                 if($count>0){
            $count++;
            $slug=str($request->title)->slug() . '-' . $count;
      }else{
           $slug= str($request->title)->slug();
      }  
        $product->slug=$slug;
        $product->description=$request->description;
        $product->shipping_returns=$request->shipping_returns;
        $product->short_description=$request->short_description;
        $product->related_products=(!empty($request->related_products) ? implode(',',$request->related_products):'');
        $product->image=$fileName;
        $product->price=$request->price;
        $product->compare_price=$request->compare_price;
        $product->category_id=$request->category;
        $product->subcategorie_id=$request->subcategorie;
        $product->brand_id=$request->brand;
        $product->is_featured=$request->is_featured;
        $product->sku=$request->sku;
        $product->barcode=$request->barcode;
        $product->track_qty=$request->track_qty;
        $product->qty=$request->qty;
        $product->status=$request->status;
        $product->save();
        // return view('backend.product.create-product',compact('product'));
       return back();

    }


    public function allProduct(){

        $products=product::latest()->paginate(5); 
      return view('backend.product.List-products',compact('products'));  
    }

    function edit($id){
      $product=product::find($id);
      $categories=Category::get();
      $brands =Brand::get();
      $relatedproducts=[];
      if($product->related_products != ''){
        $productArray = explode(',',$product->related_products);
        $relatedproducts = product::whereIn('id',$productArray)->get();

      }
      return view('backend.product.edit-product',compact('product','categories','brands','relatedproducts'));
    }

    function update(Request $request,$id){
       // $fileName=Str::uuid().'.'.$request->image_pic->extension();
       $fileName = time().'.'.$request->image->extension();  
       $request->image->storeAS('Product',$fileName,'public');
        $product= product::find($id);
        $product->title=$request->title;
        $count=product::where('slug','LIKE', '%'.str($request->title)->slug() .'%')->count();
                 if($count>0){
            $count++;
            $slug=str($request->title)->slug() . '-' . $count;
      }else{
           $slug= str($request->title)->slug();
      }  
        $product->slug=$slug;
       $product->description=$request->description;
       $product->shipping_returns=$request->shipping_returns;
       $product->short_description=$request->short_description;
       $product->related_products=(!empty($request->related_products) ? implode(',',$request->related_products):'');
       $product->image=$fileName;
       $product->price=$request->price;
       $product->compare_price=$request->compare_price;
       $product->category_id=$request->category;
       $product->subcategorie_id=$request->subcategorie;
       $product->brand_id=$request->brand;
       $product->is_featured=$request->is_featured;
       $product->sku=$request->sku;
       $product->barcode=$request->barcode;
       $product->track_qty=$request->track_qty;
       $product->qty=$request->qty;
       $product->status=$request->status;
       $product->save();
       $products= product::latest()->paginate(5);
       return view('backend.product.List-products',compact('product','products'));

    }

    public function delete($id){
      product::find($id)->delete();
      return back();
      
  }


  function relatedproduct(Request $request){
      $tempProduct = [];
    if($request->term != ""){
      $products = product::where('title','like','%' .$request->term.'%')->get();


      if($products != null){
        foreach ($products as $product){
          $tempProduct[] = array('id'=>$product->id, 'text'=>$product->title);

        }
      }
    }
     return response()->json([
      'tags' =>$tempProduct,
      'status' =>true,
     ]);
  }
}
