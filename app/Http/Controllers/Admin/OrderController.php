<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\orderdetail;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
    $order = orderdetail::paginate(5);
    return view('Admin.OrderManagement.ShowOrder',compact('order'));
    }
}
