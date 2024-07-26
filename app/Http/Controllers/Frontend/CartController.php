<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\product;
use App\Mail\OrderEmail;
use App\Models\Category;
use App\Models\countrie;
use App\Models\Shipping;
use App\Models\Order_item;
use Illuminate\Http\Request;
use App\Models\DiscountCupon;
use App\Models\CustomerAddersse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Helpers\email;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Helpers\SlugGenerator;

// use Illuminate\Contracts\Session\Session;

class CartController extends Controller
{
  use email;

    
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
  
    if(Auth::check()==false){
      return redirect()->route('login');

  }
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
        $status = true;
        // $status = false;
        $message = 'Product add in Card';

    }else{
        $status = false;
        // $status = true;
        $message = 'Product all ready exist';

    }

    
}else{

    // Cart::add($product->id,$product->title,1,$product->price);
     Cart::add(['id' => $product->id, 'name' => $product->title, 'qty' =>1,  'price' =>$product->price]); 
    
    // $status=false;
    $status=true;
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
          $discount =0;
          $CustomerAddersse = CustomerAddersse::where('user_id',auth()->user()->id)->first();

         if(Cart::content()->count() ==0){
               return view('Frontend.Cart',compact('categorie','cartContents'));
             }
        else{
              $countries=countrie::orderBy('name','ASC')->get();
              $CustomerAddersse = CustomerAddersse::where('user_id',auth()->user()->id)->first();
              $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();
              $subTotal = Cart::subtotal(2,'.','');
             
              //apply discount
           
              if(session()->has('code')){
                $code = session()->get('code');
        
                  if($code->type == "percent"){
                    $discount = ($code->discount_amount/100)*$subTotal;
                  }else{
                    $discount = $code->discount_amount;
                  }
               }


              ///calculate shipping here
              if( $CustomerAddersse  != null){
                $usercountry= $CustomerAddersse->countrie_id;
                $shippingInfo = Shipping::where('countrie_id',$usercountry)->first();
              //  dd($usercountry);
                 
              // start
              //jodi shipping ay moddha country amount select kora nah thake tojon rest niba and ai logic hobe
              if( $shippingInfo == null){
                $shippingInfo = Shipping::where('countrie_id','rest')->first();
              }
              // end
                
                $totalqty =0;
                $totalshipping=0;
                $grandTotal =0;
            foreach(Cart::content()as $item){
                 $totalqty += $item->qty; 
                }
  
                $totalshipping =  $totalqty*$shippingInfo->amount;
                $grandTotal  = ($subTotal-$discount)+$totalshipping;
             }else{
                $grandTotal  = ($subTotal-$discount);
                $totalshipping =0;
             }  
 }

 $data['categorie']=$categorie;
 $data['cartContents']=$cartContents;
 $data['countries']= $countries;
 $data['CustomerAddersse']=$CustomerAddersse;
 $data['totalshipping']=$totalshipping;
 $data['grandTotal']=$grandTotal;
 $data['discount']=$discount;
return view('Frontend.checkout',$data);
}




   function processCheckout(Request $request){
      
     // step 1 save user addres
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
             $discountCodeId ='';
             $promoCode = '';
             $shipping= 0;
             $discount =0;
             $subTotal = Cart::subtotal(2,'.','');

         //apply discount here
       if(session()->has('code')){
        $code = session()->get('code');

          if($code->type == "percent"){
            $discount = ($code->discount_amount/100)*$subTotal;
          }else{
            $discount = $code->discount_amount;
          } 
          $discountCodeId =$code->id;
          $promoCode =$code->code;
       }



                //calculate shipping
         $shippingInfo=Shipping::where('countrie_id',$request->country)->first();
       
        $totalqty =0;
        foreach(Cart::content()as $item){
         $totalqty += $item->qty; 
        }

         if($shippingInfo != null){
            $shipping= $totalqty*$shippingInfo->amount;
            $grandTotal =($subTotal-$discount)+$shipping; 

       }else{

           $shippingInfo=Shipping::where('countrie_id','rest')->first();
           $shipping= $totalqty*$shippingInfo->amount;
           $grandTotal =($subTotal-$discount)+ $shipping; 
       }   

          $order = new Order();
          $order->subtotal=$subTotal ;
          $order->shipping=$shipping;
          $order->grand_total=$grandTotal;
          $order->discount=$discount;
          $order->coupon_code=$promoCode;
          $order->coupon_code_id=$discountCodeId;
          $order->payment_status="not paid";
          $order->status='pending';
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
            }
            session()->forget('code');
            Cart::destroy();
            //send order email
            // $this->orderEmail($order->id,'customer');

         }
//          $productDetailsMail =[
//           'order_id'=>$order->id ,
//           'orederDetails'=>'ordersuccss',

//  ];

// //  dd(is_array($productDetailsMail));
//  Mail::to($request->email)->send(new OrderEmail($productDetailsMail));


        // return back();           
        return view('Frontend.checkout');
      
   }



   function getorderSummery(Request $request){

       $subTotal = Cart::subtotal(2,'.','');
       $discount= 0;
       $discountString='';
       
       //apply discount here
       if(session()->has('code')){
        $code = session()->get('code');

          if($code->type == "percent"){
            $discount = ($code->discount_amount/100)*$subTotal;
          }else{
            $discount = $code->discount_amount;
          }
          $discountString='<div class="mt-4" id="discount_res">
                    <strong>'.session()->get('code')->code.'</strong>
                    <a class="btn btn-sm btn-danger" id="remove_discount"><i class="fa fa-times"></i></a>
                </div>'; 
       }


        if($request->countrie_id >0){

        $shippingInfo=Shipping::where('countrie_id',$request->countrie_id)->first();

        $totalqty =0;
        foreach(Cart::content()as $item){
         $totalqty += $item->qty; 
        }



        if($shippingInfo != null){
          
            $shipping= $totalqty*$shippingInfo->amount;
            $grandTotal = ($subTotal-$discount)+$shipping; 

               return response()->json([
               'status' =>true,
               'grandTotal' =>  number_format($grandTotal,2),
               'discount' =>$discount,
               'discountString' =>$discountString,
               'shipping'=>number_format($shipping,2), 
           ]);

       }else{

           $shippingInfo=Shipping::where('countrie_id','rest')->first();
           $shipping= $totalqty*$shippingInfo->amount;
           $grandTotal = ($subTotal-$discount)+$shipping; 

           return response()->json([
               'status' =>true,
               'grandTotal' => number_format($grandTotal,2),
               'discount' =>$discount,
               'discountString' =>$discountString,
               'shipping'=>number_format($shipping,2),
                     ]);
              }
            
            } else{
         return response()->json([
            'status' =>true,
            'grandTotal' => number_format(($subTotal-$discount),2),
            'discount' =>$discount,
            'discountString' =>$discountString,
            'shipping'=>number_format(0,2), 

               ]);

           }

      }





     public function applycoupon(Request $request){
      // return $request->all();
         $code = DiscountCupon::where('code',$request->code)->first();
         if($code == null){
     
             return response()->json([
                 'status' =>false,
                 'message' =>'Invalid discount coupone',
      
     
            ]); 
         }
             ///max_uses check

           if( $code->max_uses >0){
             $couponused= Order::where('coupon_code_id',$code->id)->count();
             if($couponused >= $code->max_uses){
                    
                 return response()->json([
                   'status' =>false,
                   'message' =>'Invalid discount coupone',
               ]); 
            }
           }
 

           ///max_uses user check
          if( $code->max_uses_user >0){
          
            $couponusedByuder= Order::where(['coupon_code_id'=> $code->id,'user_id' =>auth()->user()->id])->count();
            if($couponusedByuder >= $code->max_uses_user){
                          
                  return response()->json([
                    'status' =>false,
                    'message' =>'You already used this coupone code',
                ]); 
              }
          }
         
          //min_amount condution check
          $subTotal = Cart::subtotal(2,'.','');
          if($code->min_amount > 0){
             if($subTotal< $code->min_amount){
              return response()->json([
                'status' =>false,
                'message' =>'You amount must be $' .$code->min_amount.'.',
                  ]);
             }
          }

       session()->put('code',$code);
       return $this->getorderSummery($request);

   }



   public function removeCoupon(Request $request){
     session()->forget('code');
     return $this->getorderSummery($request);
   }
   




   
}

    
    
    
    
    
 