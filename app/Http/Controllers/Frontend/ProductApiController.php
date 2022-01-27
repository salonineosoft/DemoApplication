<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=[];
        $product = product::where('status','active')->get();
        foreach($product as $i)
        {
            $image_list = [];
            foreach($i->images as $image){
                $image_list[] = ["image" =>$image->image];
            }
            $list[] = [
                "id"         => $i->id,
                "name"       => $i->name,
                "price"      => $i->price,
                "quantity"   => $i->quantity,
                "sale_price" => $i->sale_price,
                "images"     => $image_list,
            ];
           
        }
        return response()->json(['product'=>$list]);
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // $details=productImage::join('products','products.id','=','product_images.product_id')->where('products.id',$id)->get();
        //return response()->json(['details' => $details]);
        
        $product = product::find($id);
        $images = $product->images;
        return response()->json(['product_price' => $product ,'product_image' => $images]);
    }

}
