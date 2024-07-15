<?php

namespace App\Http\Controllers\Helpers;


use App\Models\Order;
use App\Mail\OrderEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


trait SlugGenerator {


    public function generateslug($name, $model){
          
        $count = $model::where('slug','LIKE', '%'.str($name)->slug() . '%')->count();

        if($count >0){
            $count++;
           return $slug = str($name)->slug() . '-' . $count;
        }else{
           return $slug = str($name)->slug();
        }
 
    }

    public function orderEmail($orderId){
        $order =Order::where('id',$orderId)->with('items')->first();

        $mailData = [
            'subjet' => 'Thanks for your order',
            'order' =>$order
        ];

        Mail::to($order->email)->send(new OrderEmail($mailData));
      
    }
}


//     public function generateslug($model,$name,){
//     $count=$model::where('slug','LIKE','%'.Str::slug($name).'%')->count();
//     if($count>=0){
//        $count++;
//        $slug=Str::slug($name). '-' . $count;
//        return $slug;
//     }else{
    
//     $slug=Str::slug($name);
//      return $slug;
//     }
// }
