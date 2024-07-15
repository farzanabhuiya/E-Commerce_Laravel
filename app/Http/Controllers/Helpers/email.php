<?php

namespace App\Http\Controllers\Helpers;

use App\Models\Order;
use App\Mail\OrderEmail;
use Illuminate\Support\Facades\Mail;

trait email{
     
    public function orderEmail($orderId,$userType="customer"){
        $order =Order::Where('id',$orderId)->with('items')->first();

          if($userType == 'customer'){
            $subject = 'Thanks for your order';
            $email= $order->email;

          }else{

            $subject = 'Your have received an order';
            $email =env('ADMIN_EMAI');
          }


        $mailData = [
            'subject' =>$subject,
            'order' =>$order,
            'userType' =>$userType
        ];

        Mail::to($email)->send(new OrderEmail($mailData));
        // dd($order);
      
    }
}


  /////////////// sudu mailtrap
//     public function orderEmail($orderId){
//         $order =Order::Where('id',$orderId)->with('items')->first();

//         $mailData = [
//             'subject' =>$subject,
//             'order' =>$order,
//         ];

//         Mail::to($order->email)->send(new OrderEmail($mailData));
//         // dd($order);

// }