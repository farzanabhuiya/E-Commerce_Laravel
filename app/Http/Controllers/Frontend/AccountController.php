<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Wishlist;

class AccountController extends Controller
{
    public function Order(){
        $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();

        $orders= Order::where('user_id',auth()->user()->id)->orderBy('created_at','DESC')->get();

        $data['categorie'] =$categorie;
        $data['orders'] =$orders;
         return view('Frontend.Account.order',$data);
    }

    public function OrderDetail($id){
        $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();

        $order= Order::where('user_id',auth()->user()->id)->where('id',$id)->first();
        $orderItems= Order_item::where('order_id',$id)->get();
        $ordercounts= Order_item::where('order_id',$id)->count();

        $data['categorie'] =$categorie;
        $data['order'] =$order;
        $data['orderItems'] =$orderItems;
        $data['ordercounts'] = $ordercounts;
        return view('Frontend.Account.order_detail',$data);
    }
    function wishlist(Request $request){
        $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();

        $wishlists = Wishlist::where('user_id',auth()->user()->id)->with('product')->get();
        return view('Frontend.Account.wishlist',compact('wishlists','categorie'));
    }
 
}
