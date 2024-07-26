<?php

namespace App\Http\Controllers\Frontend;

use App\Models\product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    public function addwishlist(Request $request){
             $product = product::where('id',$request->id)->first();
    
            if($product ==null ){
                return response()->json([
                    'status'=>true,
                    "message"=>'<div class="alert alert-success"><strong>"' .$product->title .'"</strong>Product not found Your wishlist</div>',
            
                ]);
    
    
            }
           
    
            Wishlist::updateOrCreate(
    
    
                [
    
                    'user_id'=> auth()->user()->id,
                    'product_id'=>$request->id ,
                ],
    
                [
                    'user_id'=> auth()->user()->id,
                    'product_id'=>$request->id ,
                ]
                 );
    
                return response()->json([
                    'status'=>true,
                    "message"=>'<div class="alert alert-success"><strong>"' .$product->title .'"</strong>Product add Your wishlist</div>',
    
                ]);
    
    
    
    
        }

                 //             deleted wishlist
 function removeWishlist(Request $request){
    $wishlist = Wishlist::where('user_id',auth()->user()->id)->where('product_id',$request->id)->first();

    if($wishlist == null){
        return response()->json([
            'status' =>true,
            'message' =>'Wishlist already removed',
        ]);
    }else{

        Wishlist::where('user_id',auth()->user()->id)->where('product_id',$request->id)->delete();
        return response()->json([
            'status' =>true,
             'message' =>'Wishlist removed success',
            
        ]);
    }

 }
   

    



    }




