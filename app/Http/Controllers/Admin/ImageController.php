<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
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
