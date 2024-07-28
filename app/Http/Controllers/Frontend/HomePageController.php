<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Models\User;
use App\Models\product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Subcategorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

class HomePageController extends Controller
{
  public function index(){


   $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();
   $products=product::where('is_featured','Yes')->orderBy('id','DESC')->where('status',1)->get();
   $latestproducts=product::orderBy('id','DESC')->where('status',1)->latest()->take(8)->get();
   $pages = Page::get();
    return view('Frontend.Homepage',compact('categorie','products','latestproducts','pages'));
  }





    //frontend page
  public function page($slug){
    
    $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();
     $page = Page::where('slug',$slug)->first();
     $pages = Page::get();
     return view('Frontend.Page.page',compact('page','categorie','pages'));
}

public function contactEmail(Request $request){

  $request->validate([
    'name' =>"required",
    'email' =>"required|email",
    'subject' =>"required|min:10"
    ]);

    $mailData =[
      'name' => $request->name,
      'email' => $request->email,
      'subject' => $request->subject,
      'message' => $request->message,
      'mail_subject' =>'You have receive a contact email'
    ];

    $admin = User::where('id',1)->first();
    Mail::to($admin->email)->send(new ContactEmail($mailData));
    return back()->with('success','You Success Message');
  

}

}
