<?php

namespace App\Http\Controllers\admin;;

use App\Http\Controllers\Controller;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function add(Request $request){
        $emp_name=Auth::user()->name;
        Reply::create([
            'ticket_id'=>$request->input('ticket_id'),
            'reply'=>$request->input('reply'),
            'emp_name'=>$emp_name,

        ]);
        return redirect()->back();

    }
    public function getReplies(Request $request){
        $ajax=$request->input('tik_id');
        $data=Reply::select('emp_name','reply','created_at')->where('ticket_id',$ajax)->get();

        return response()->json($data);

    }
}
