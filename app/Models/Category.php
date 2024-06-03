<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    function Subcategorie(){
        return $this->hasMany(Subcategorie::class);
    }



    function Brand(){
        return $this->hasMany(Brand::class);
    }

    
    function product(){
        return $this->hasMany(product::class);
    }











   
}
