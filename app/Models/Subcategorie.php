<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategorie extends Model
{
    use HasFactory;
     
  ///subcatrgory
    function category(){
        return $this->belongsTo(Category::class);
    }
}
