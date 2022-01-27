<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\category;
use App\Models\coupon;
use App\Models\product;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {     
        $data                           = [];
        $data['totalActiveCategory']    = category::where('status','active')->count();
        $data['totalInactiveCategory']  = category::where('status','inactive')->count();
        $data['totalActiveCoupons']     = coupon::where('status','active')->count();
        $data['totalInactiveCoupons']   = coupon::where('status','inactive')->count();
        $data['totalActiveUser']        = user::where('status','active')->count();
        $data['totalInactiveUser']      = user::where('status','inactive')->count();
        $data['totalActiveProduct']     = product::where('status','active')->count();
        $data['totalInactiveProduct']   = product::where('status','inactive')->count();
        if ($data) {
            return view('Admin/AdminDash',$data);
           return $data;
        }
        return 0; 
       // return view('dashboard');
        // if(Auth::User()->role_id==2){
        //     return view('dashboard');
        // }
        // elseif(Auth::User()->role_id==1){
        //     return "sjdgsudgus";
    }
     

}