<?php

namespace App\Http\Controllers\Backend;

use App\Models\countrie;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Shipping;

use function PHPUnit\Framework\returnValueMap;

class ShippingController extends Controller
{
     function create(){

        $countries=countrie::orderBy('name','ASC')->get();
        $shippings = Shipping::select('shippings.*','countries.name')->
        leftjoin('countries', 'countries.id','shippings.countrie_id')->get();
     return view('backend.Shipping.create',compact('countries','shippings'));
     }


     function story(Request $request){

      // $count= Shipping::where('countrie_id',$request->country)->count();
      // if($count >0){
      //    return
      // }
        $shippings =new Shipping();
        $shippings->countrie_id=$request->country;
        $shippings->amount= $request->amount;
        $shippings->save();
        return back();

}
}
