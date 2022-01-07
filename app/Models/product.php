<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
  //  protected $fillable = ['name'],['description'];
  protected $guarded = [];  
   
    use HasFactory;
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }   
    public static function countActiveCategory(){
      $data=product::where('status','active')->count();
      if($data){
          return redirect('/Admin/AdminDash');
      }
     // return 0;
  }
}
