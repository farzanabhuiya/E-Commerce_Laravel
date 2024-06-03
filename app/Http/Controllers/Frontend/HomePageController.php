<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Subcategorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\product;

class HomePageController extends Controller
{
  public function index(){


   $categorie= Category::orderBy('name','ASC')->with('Subcategorie')->where('showhome','Yes')->get();


   $products=product::where('is_featured','Yes')->orderBy('id','DESC')->where('status',1)->get();
   $latestproducts=product::orderBy('id','DESC')->where('status',1)->latest()->take(8)->get();
    return view('Frontend.Homepage',compact('categorie','products','latestproducts'));
  }
}
