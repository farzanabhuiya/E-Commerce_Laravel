<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;

use App\Models\DiscountCupon;
use App\Http\Controllers\Controller;

class DiscountCuponController extends Controller
{
    function index(Request $request){
    $cupons= DiscountCupon::latest()->paginate(3);
   return view('backend.Cupon.list_cupon',compact('cupons'));
    }


 
    function story(Request $request){
        $request->validate([
            'code' =>"required",
            'discount_amount' =>"required",
            'starts_at' =>"required",
            'expires_at' =>"required"
            ]);

        if(!empty($request->starts_at)){
            $start_time = Carbon::now()->format('Y/m/d H:i',$request->starts_at);
        }
   
        if(!empty($request->starts_at) && !empty($request->expires_at)){
              $expires = Carbon::now()->format('Y/m/d H:i',$request->expires_at); 
              $start = Carbon::now()->format('Y/m/d H:i',$request->starts_at);
        }

        $cupons= New DiscountCupon();
        $cupons->code=$request->code;
        $cupons->name=$request->name;
        $cupons->description=$request->description;
        $cupons->max_uses=$request->max_uses;
        $cupons->max_uses_user=$request->max_uses_user;
        $cupons->type=$request->type;
        $cupons->discount_amount=$request->discount_amount;
        $cupons->min_amount=$request->min_amount;
        $cupons->starts_at=$request->starts_at;
        $cupons->expires_at=$request->expires_at;
        $cupons->save();
        // $notification= 'Cupon Successfully Created';

        return back()->with('success','Cupon Successfully Created');
    }

    function create(){
        $cupons= DiscountCupon::latest()->paginate(3);
        return view('backend.Cupon.create',compact('cupons'));
    }

    }

