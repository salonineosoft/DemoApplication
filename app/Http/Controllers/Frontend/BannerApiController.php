<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\banner;
use Illuminate\Http\Request;

class BannerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Bannerdata = banner::where('status','active')->get();
        return response()->json(["banners" => $Bannerdata],201);
    }
}
