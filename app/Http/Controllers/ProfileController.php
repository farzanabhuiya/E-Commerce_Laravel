<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Foundation\Auth\User;

class ProfileController extends Controller
{
   public function showfile(){
        return view('backend.profile');
   }

   public function profileUpdate(Request $request){


    $request->validate([

        'name'=>'required|max:15',
        'email' =>'required|email|unique:users,email,'.auth()->user()->id,
        'profile_img' =>'nullable|mimes:jpg,png,jpeg,svg'
       ]);



       if($request->hasFile('profile_img')){
        $ext=$request->profile_img->extension();
        $profileName=auth()->user()->name.'-' . Carbon::now()->format('d-m-y-h-m-s'). '.'.$ext;
        $request->profile_img->storeAS('users', $profileName,'public');
    }
    $user = User::find(auth()->user()->id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->profile_img =$profileName??null;
    $user->save();
    return back();
    
    
    
   }

   public function profileAccount(Request $request){
    $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();
    return view('Account.account',compact('categorie'));
   }
}
