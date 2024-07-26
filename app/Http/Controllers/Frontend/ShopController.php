<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subcategorie;

class ShopController extends Controller
{
   public function index(Request $request, $categoryslug = null, $subcategorieslug = null){
    $categorySeleted='';
    $subcategorieSeleted='';
    $brandsArray =[];
   

   $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();
    $brands= Brand::orderBy('name','ASC')->where('status',1)->get();
    $products=product::orderBy('id','DESC')->where('status',1)->get();
    // $products = product::where('status',1);


  
    

     //apply filters here
     if(!empty($categoryslug)){
      $category = Category::where('slug',$categoryslug)->first();
      $products = product::where('category_id',$category->id)->get();
      $categorySeleted=$category->id;
     }


     if(!empty($subcategorieslug)){
      $subcategorie= Subcategorie::where('slug',$subcategorieslug)->first();
      $products = product::where('subcategorie_id',$subcategorie->id)->get();
      $subcategorieSeleted=$subcategorie->id;
     }

     if(!empty ($request->get('brand'))){
      $brandsArray = explode(',',$request->get('brand'));
      $products = product::whereIn('brand_id',$brandsArray)->get();

     }

    if( !empty($request->get('price_max'))) { 
 
      if($request->get('price_min') !== "" && $request->get('price_max') !== ""){
     
        if($request->get('price_max') ==100000){
           $products = $products->whereBetween('price',[intval($request->get('price_min')),100000]);
       
        }else{
           $products = $products->whereBetween('price',[intval($request->get('price_min')),intval($request->get('price_max'))]);
        
        }
        
      }

    }





          //search 
          // if(!empty($request->get('search'))){
          //   $products = $products->where('title','like','%' .$request->get('search'). '%');
          //   // dd($product);
          // }

          if(!empty($request->get('search'))){
            $products = product::where('title','like','%' .$request->get('search'). '%')->get();
            // dd($product);
          }




    //  $products = $products->orderBy('id','DESC');
    //  $products = $products->get();

 
   //   if( $request->get('sort') != '') {
   //    if( $request->get('sort') == 'latest'){
   //       $products = $products->orderBy('id','DESC');
   //    }else if($request->get('sort') == 'pice_asc'){
   //       $products = product::orderBy('price','ASC')->get();

   //    }else{
   //       $products = product::orderBy('price','DESC')->get();
   //    }
   //  } else{
   //       $products = product::orderBy('id','DESC')->get();
   //    }
     
   //   $products = $products->get();

     $data['categorie']=$categorie;
     $data['brands']=$brands;
     $data['products']= $products;
    
     $data['categorySeleted']=$categorySeleted;
     $data['subcategorieSeleted']=$subcategorieSeleted;
     $data['brandsArray']=$brandsArray;
     $data['priceMax'] =(intval($request->get('price_max')) == 0) ? 100000 : $request->get('price_max');
     $data['priceMin'] =intval($request->get('price_min'));
    //$data['sort']    =$request->get('sort');
    return view('Frontend.shop',$data);
   }





   public function product($slug){
      $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->get();
    $product = product::where('slug',$slug)->first();
   

    $relatedproducts=[];
    if($product->related_products != ''){
      $productArray = explode(',',$product->related_products);
      $relatedproducts = product::whereIn('id',$productArray)->get();

    }
   
   //  if($product == null){
   //    abort(404);
   //  }
    return view('Frontend.product',compact('product','categorie','relatedproducts'));

   }
}
