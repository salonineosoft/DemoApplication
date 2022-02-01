<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Newsletter;
class NewsLetterController extends Controller
{
    public function PostNewsLetter(Request $request)
    {
        if (Newsletter::isSubscribed($request->subscriber_email)) {
            return response()->json(["message" => "you Already Subscribed."]);
        } else {
            Newsletter::subscribe($request->subscriber_email);
            return response()->json(["message" => "Thanks"]);
        }
    }
}
