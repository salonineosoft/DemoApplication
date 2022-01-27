<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\configration;
use Illuminate\Http\Request;

class ConfigrationController extends Controller
{
    public function configration()
    {
        $config=configration::all();
        return response()->json(['config'=> $config]);

    }
}
