<?php

namespace App\Http\Controllers\Helpers;


use Illuminate\Support\Str;


trait SlugGenerator {


    public function generateslug($name, $model){
          
        $count = $model::where('slug','LIKE', '%'.str($name)->slug() . '%')->count();

        if($count >0){
            $count++;
           return $slug = str($name)->slug() . '-' . $count;
        }else{
           return $slug = str($name)->slug();
        }
 
    }
}


//     public function generateslug($model,$name,){
//     $count=$model::where('slug','LIKE','%'.Str::slug($name).'%')->count();
//     if($count>=0){
//        $count++;
//        $slug=Str::slug($name). '-' . $count;
//        return $slug;
//     }else{
    
//     $slug=Str::slug($name);
//      return $slug;
//     }
// }
