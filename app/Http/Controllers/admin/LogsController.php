<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Reply;
use App\TicketLogs;
use Illuminate\Http\Request;


class LogsController extends Controller
{
    public function getTicketLog($id)
    {
        $data = TicketLogs::select('*')->where('ticket_id', $id)->get();
        $replies= Reply::select('*')->where('ticket_id',$id)->get();
        $arr['replies']=$replies;
        $arr['data'] = $data;


        return view('admin.ticket-log', $arr);
    }
    public function getAllLogs(){
        $data=TicketLogs::select('*')->get();
        $arr['data']=$data;
        return view('admin.all-logs',$arr);
    }
}
