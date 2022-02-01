<?php


namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class WishlistApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wish=wishlist::all();
        return response()->json($wish);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products = wishlist::where("user_email",$request->user_email)->get();
        $flag = 0;
        foreach($products as $i){
            if($i->product_id == $request->product_id){
                $flag = 1;
                break;
            }
        }
        if ($flag != 0) {
            return response()->json(["message" => "Already Added."]);
        } 
        else{
        $data=wishlist::insert([
            "user_email"    => $request->user_email,
            "product_id"    => $request->product_id,
            "product_image" => $request->product_image,
            "product_price" => $request->product_price,
            "product_name"  => $request->product_name,
        ]);
        return response()->json(["data"=>$data,"message"=>"Sucess"]);
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
        $wish=wishlist::find($id)->delete();
    
        return response()->json(["data"=>$wish,"message"=>"Delete Sucess"]);

    }
}

