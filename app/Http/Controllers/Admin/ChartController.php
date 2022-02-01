<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ChartController extends Controller
{
    /* Function For SalesReport Chart */

    public function salesReport()
    {
        $sales = DB::select(DB::raw("select sum(quantity) as total,product_id as name from orderdetails group by product_id "));
        $data = "";
        foreach ($sales as $i) {
            $data .= " ['" . $i->name . "'," . $i->total . "],";
        }
        $details = $data;
        return view('Admin.Chart', compact('details'));
    } 

    /* Function For UserReport Chart*/

    public function userReport()
    {
        $users = DB::select(DB::raw("select count(*) as total,role_id as name from users group by role_id "));
        $data = "";
        foreach ($users as $i) {
            $data .= " ['" . $i->name . "'," . $i->total . "],";
        }
        $user_details = $data;
        return view('Admin.UserChart', compact('user_details'));
    }
    
    /* Functions For Coupon Report Chart */
    public function couponReport()
    {
        $coupons = DB::select(DB::raw("select count(*) as total,status from coupons  group by status "));
        $data = "";
        foreach ($coupons as $i) {
            $data .= " ['" . $i->status . "'," . $i->total . "],";
        }
        $coupons_details = $data;
        return view('Admin.CouponChart', compact('coupons_details'));
    }
}
