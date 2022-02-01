<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
     /* Function For dawnload Pdf */
    public function export_user_pdf()
    {        
        $user=User::where('role_id','5')->get();
        view()->share('user',$user);
        $pdf = PDF::loadView('pdf.user',['user'=>$user]);
        return $pdf->download('user.pdf');      
    }

    /* Function For View Pdf */
    public function view_user_pdf()
    {    
        $user=User::where('role_id','5')->get();
        view()->share('user',$user);
        $pdf = PDF::loadView('pdf.user',['user'=>$user]);
        return $pdf->stream('user.pdf');  
    }
}
