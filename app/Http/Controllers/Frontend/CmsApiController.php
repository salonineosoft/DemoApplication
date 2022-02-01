<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\cms;
use Illuminate\Http\Request;

class CmsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms = cms::all();
        foreach($cms as $c){
            $listcms[]=[
                'id'    => $c->id,
                'title' => $c->title,
                'body'  => $c->body,
                'image' => asset('uploads/'.$c->image)
              ];
          }
 
        return response()->json(['cms' => $listcms]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = [];
        $cms=cms::find($id);
            $list[] = [
                'id'    => $cms->id,
                'title' => $cms->title,
                'body'  => $cms->body,
                'image' => asset('uploads/'.$cms->image),
            ];
        return response()->json(['cmsbyid' => $list]);
    }
}
