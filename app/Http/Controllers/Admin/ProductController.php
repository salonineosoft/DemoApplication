<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\category;
use App\Models\product;
use App\Models\product_category;
use App\Models\productImage;
use App\Models\product_attribute;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::paginate(5);
        return view("Admin.ProductManagement.ShowProduct", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = category::all();
        return view("Admin.ProductManagement.AddProduct", compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validateProduct = $request->validate([
                'name'        => 'required',
                'description' => 'required',
                'quantity'    => 'required|numeric',
                'price'       => 'required|numeric',
                'sale_price'  => 'required|numeric',
                'status'      => 'required'
            ]);

            if ($validateProduct) {
                $name         = $request->name;
                $description  = $request->description;
                $quantity     = $request->quantity;
                $price        = $request->price;
                $sale_price   = $request->sale_price;
                $productInsertId        = DB::table('Products')->insertGetId([
                    
                    'name'       => $name,
                    'description' => $description,
                    'quantity'    => $quantity,
                    'price'       => $price,
                    'sale_price'  => $sale_price,
                    'status'      => $request->status,
                ]);    
                    if ($productInsertId) {
                    $productAttributeId  = Product_attribute::insertGetId([
                        'name'       => $name,
                        'price'      => $price,
                        'quantity'   => $quantity,
                        'product_id' => $productInsertId
                    ]);   
                    if ( $productAttributeId && $request->hasFile('image')) {
                        $images = $request->file('image');
                        foreach ($images as $i) {
                            $name = rand() . $i->getClientOriginalName();
                            if ($i->move(public_path('uploads/'), $name)) {
                                ProductImage::insert([
                                    'image'      => $name,
                                    'product_id' => $productInsertId,
                                ]);
                            }
                        }
                    }
                }  
                DB::table('product_categories')->insert([
                    'category_id' => $request->category,
                    'product_id'  => $productInsertId,
                ]);
                return back()->with('msg','successfully inserted data');
            } 
        } catch(Exception $e) {
            return back()->with('err','Something went wrong.');
        }  
       
    }  
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::all()->where('id',$id)->first();
        $product_image=productImage::all()->where('product_id',$id);
        $category=category::all();
        return view('Admin.ProductManagement.EditProduct',compact('data','category','product_image'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $data = product::where('id',$request->uid)->update([
                'name'         => $request->name,
                'description'  => $request->description,
                'quantity'     => $request->quantity,
                'price'        => $request->price,
                'sale_price'   => $request->sale_price,
                'status'       => $request->status
            ]);
            if($data){
                product_attribute::where('product_id',$request->uid)->update([
                'name'       => $request->name,
                'price'      => $request->price,
                'quantity'   => $request->quantity,
                ]);
                product_category::where('product_id',$request->uid)->update([
                    'category_id' => $request->category,
                ]);
                if($request->hasFile('image')) {
                    $deleteImage = productImage::where('product_id',$request->uid)->get();
                    foreach ($deleteImage as $i) {
                        unlink("uploads/" .$i->image);
                    }
                    productImage::where('product_id',$request->uid)->delete();
                    $images = $request->file('image');
                    foreach ($images as $i) {
                        $name = rand() . $i->getClientOriginalName();
                        $i->move(public_path('uploads/'), $name);
                        ProductImage::insert([
                            'image'      => $name,
                            'product_id' => $request->uid,
                        ]);
                    }
                
                }
            }
            return back()->with('msg','successfully updated data');
        } catch(Exception $e) {
            return back()->with('err','Something went wrong.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $data = product::find($id)->delete();
        return redirect('products');
    }
}
