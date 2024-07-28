<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::latest();
        $users= $users->paginate(8);
        return view('backend.Users.list',compact('users'));
    }

    public function create(){
        return view('backend.Users.create');
    }
  
    public function story(Request $request){
        //dd($request->all());
        $request->validate([

            'name'=>'required|max:12',
            'email' =>'required|email|unique:users',
            'profile_img' =>'nullable|mimes:jpg,png,jpeg,svg',
             'mobile'=>'required|max:11',
            'password'=>'required|max:8',
           ]);
   

        // $users = User::find(auth()->user()->id);
        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->profile_img =$profileName??null;
        $users->status = $request->status;
        $users->mobile = $request->mobile;
        $users->password = Hash::make($request->password);
        $users->save();
        //  dd($users);

        return back()->with('success','User Successfully Created');
    }

    public function edit($id){
        $user = User::find($id);
      
        return view('backend.Users.edit',compact('user'));
    }


    public function update(Request $request,$id){
    
        //  $user = User::find(auth()->user()->id);
        $user=User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile_img =$profileName??null;
        $user->status = $request->status;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->save();
        $user= User::latest()->paginate(8);
        return back()->with('success','User Successfully Update');
    }



    public function deleted($id){
        User::find($id)->delete();
        return back();
    }
}
