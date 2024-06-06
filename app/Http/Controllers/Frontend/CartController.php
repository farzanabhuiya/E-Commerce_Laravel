<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    
    public function cart(Request $request){
       
   $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();
   $cartContents = Cart::content();
   

        return view('Frontend.Cart',compact('categorie','cartContents'));
    }


   public function addtoCart (Request $request){
        // dd($request->id);
        $product = product::find($request->id);
       
         if($product==null){
            return response()->json([
                'status' =>false,
                'message' =>'product not found',
            ]);
         }
         if(Cart::count() >0){
           //product found in cart
           $cartContent = Cart::content();
           $productAlreadyExist =false;
              
            foreach ($cartContent as $item){
                if ($item->id == $product->id){
                    $productAlreadyExist = true;
                }
            }

            if ($productAlreadyExist == false){
                Cart::add($product->id, $product->title,1,$product->price,$product->image);
                $status=true;
                $message =$product->title.' added in cart';
            } else {
                $status=false;
                $message =$product->title.' already added in cart';

            }
           
         } else {
            //card is empty
            Cart::add($product->id, $product->title,1,$product->price,$product->image);
            $status=true;
            $message =$product->title.'addedin cart';
         }
       return response()->json([
         'status' =>$status,
         'message'=>$message
       ]);

    }


    function updateCart(Request $request){
        $rowId =$request->rowId;
        // dd($rowId);
        $qty =$request->qty;
        Cart::update($rowId,$qty);
    
         
        $message = 'Card Update Successfully';
        session()->flash('success',$message );
        return response()->json([
            'status' =>true,
            'message' =>$message,
        ]);
    }


    
 function delete($id){
    Cart::find($id)->delete();
    return back();
}
}
