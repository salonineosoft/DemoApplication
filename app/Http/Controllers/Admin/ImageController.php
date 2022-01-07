<?php

use Illuminate\Support\Facades\File;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\productImage;
use App\Models\product;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function image($id)
    {
       $image = ProductImage::where('id',$id)->delete();
       return back();
    }
}
