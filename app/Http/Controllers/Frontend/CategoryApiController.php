<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = category::where('status','active')->get();
        $product  = product::all();
        return response()->json($category); 
    }
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=category::join('product_categories','categories.id','=','product_categories.category_id')->join(
            'products','products.id','=','product_categories.product_id'
        )->join('product_images','products.id','=','product_images.product_id')->where('categories.id',$id)->get();
        return response()->json($category);
    }

}
