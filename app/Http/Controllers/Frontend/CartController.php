<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\product;
use App\Models\Category;
use App\Models\countrie;
use Illuminate\Http\Request;
use App\Models\CustomerAddersse;
use App\Http\Controllers\Controller;
use App\Models\Order_item;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    
    public function cart(Request $request){
       
   $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();
   $cartContents = Cart::content();
   

        return view('Frontend.Cart',compact('categorie','cartContents'));
    }

               //farzana 
  //  public function addtoCart (Request $request){
  //       $product = product::find($request->id);
       
  //        if($product==null){
  //           return response()->json([
  //               'status' =>false,
  //               'message' =>'product not found',
  //           ]);
  //        }
  //        if(Cart::count() >0){
  //          //product found in cart
  //          $cartContent = Cart::content();
  //          $productAlreadyExist =false;
              
  //           foreach ($cartContent as $item){
  //               if ($item->id == $product->id){
  //                   $productAlreadyExist = true;
  //               }
  //           }

  //           if ($productAlreadyExist == false){
  //               Cart::add($product->id, $product->title,1,$product->price,$product->image);
  //               $status=true;
  //               $message =$product->title.' added in cart';
  //           } else {
  //               $status=false;
  //               $message =$product->title.' already added in cart';

  //           }
           
  //        } else {
  //           //card is empty
  //           Cart::add($product->id, $product->title,1,$product->price,$product->image);
  //           $status=true;
  //           $message =$product->title.'adde in cart';
  //        }
  //      return response()->json([
  //        'status' =>$status,
  //        'message'=>$message,
  //      ]);

  //   }


                       
   public function addtoCart (Request $request){
  
   
    $id = $request->id;
    $product = product::find($id);
 
     if($product == null){
        return response()->json([
            'status' =>false,
            'message' =>'product not found',
        ]);
     }

  if(Cart::count() >  0){
    $productAlreadyExist =false;

    
    foreach(Cart::content() as $item){

        if($item->id == $product->id){
            $productAlreadyExist =true;       
        }
    }


    if($productAlreadyExist == false){

        // Cart::add($product->id, $product->title,$product->price);
        Cart::add(['id' => $product->id, 'name' => $product->title, 'qty' =>1,  'price' =>$product->price]);
        $status = false;
        $message = 'Product add in Card';

    }
    else{
        $status = true;
        $message = 'Product all ready exist';

    }

    
}else{

    // Cart::add($product->id,$product->title,1,$product->price);
     Cart::add(['id' => $product->id, 'name' => $product->title, 'qty' =>1,  'price' =>$product->price]); 
    
    $status=false;
    $message = 'Product add in Card';
}
return response()->json([
    'status'=>$status,
    'message'=>$message,
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


       
    
    
 function delete($rowId){
  // Cart::find($id)->delete();
  Cart::remove($rowId);
  return back();
}




    public function checkout(){
           
   $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();
   $cartContents = Cart::content();



         if(Cart::content()->count() ==0){
               return view('Frontend.Cart',compact('categorie','cartContents'));
             }
        else{
              $countries=countrie::orderBy('name','ASC')->get();
              $CustomerAddersse = CustomerAddersse::where('user_id',auth()->user()->id)->first();
              $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();
    

  
       
     

 }
 return view('Frontend.checkout',compact('categorie','cartContents','countries','CustomerAddersse'));
 }




   function processCheckout(Request $request){

     // step 1 save user address


          $address = new CustomerAddersse();
          $address->user_id=auth()->user()->id;
          $address->first_name=$request->first_name;
          $address->last_name=$request->last_name;
          $address->email=$request->email;
          $address->mobile=$request->mobile;
          $address->countrie_id=$request->country;
          $address->address=$request->address;
          $address->apartment=$request->apartment;
          $address->city=$request->city;
          $address->state=$request->state;
          $address->zip=$request->zip;
          $address->notes=$request->notes;
          $address->save();

          //step 3 store data in order table
          if($request->payment_method_1 === 'cod'){

             $shipping= 0;
             $discount =0;
             $subTotal = Cart::subtotal(2,'.','');
             $grandTotal = $subTotal +$shipping;
            
          $order = new Order();
          $order->subtotal=$subTotal ;
          $order->shipping=$shipping;
          $order->grand_total=$grandTotal;
          $order->user_id=auth()->user()->id;
          $order->first_name=$request->first_name;
          $order->last_name=$request->last_name;
          $order->email=$request->email;
          $order->mobile=$request->mobile;
          $order->countrie_id=$request->country;
          $order->address=$request->address;
          $order->apartment=$request->apartment;
          $order->city=$request->city;
          $order->state=$request->state;
          $order->zip=$request->zip;
          $order->notes=$request->notes;
          $order->save(); 
       
              
            //step 3  order item in order item table

            foreach(Cart::content() as $item){
            $orderitem = new Order_item();
            $orderitem->product_id=$item->id;
            $orderitem ->order_id= $order->id;
            $orderitem ->name=$item->name;
            $orderitem ->qty= $item->qty;
            $orderitem ->price= $item->price;
             $orderitem ->total= $item->price*$item->qty;
            $orderitem->save();
            } }
        
        return back();  
           
    
   }


    
}

