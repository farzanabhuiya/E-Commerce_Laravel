<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    

    public function index(Request $request){
        
        $orders = Order::latest('orders.created_at')->select('orders.*','users.name','users.email');
        $orders= $orders->leftjoin('users','users.id','orders.user_id');
        if($request->get('keyword') != ""){
            $orders =$orders->where('users.name','like','%'.$request->keyword.'%');
            $orders =$orders->orWhere('users.email','like','%'.$request->keyword.'%');
            $orders =$orders->orWhere('orders.id','like','%'.$request->keyword.'%');
        }   

        $orders= $orders->paginate(3);
        return view('backend.order.list',compact('orders'));


    }

    public function detail($orderId){
         $order = Order::select('orders.*','countries.name as countryName')
         ->where('orders.id',$orderId)
         ->leftjoin('countries','countries.id','orders.countrie_id')
         ->first();
         $orderItems =Order_item::where('order_id',$orderId)->get();
        return view('backend.order.detail',compact('order','orderItems'));

    }
}
