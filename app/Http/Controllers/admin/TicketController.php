<?php

namespace App\Http\Controllers\admin;;

use App\Http\Controllers\Controller;
use App\TicketLogs;
use App\Ticket;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function index()

    {

        $data = Ticket::select('*')->get();
        $currentUser = Auth::user()->name;
//        $replies = Reply::select('*')->get();
//        $arr['replies']=$replies;
        $arr['data'] = $data;
        $arr['currentuser'] = $currentUser;


        return view('admin.all-tickets', $arr);


    }

    public function insert(Request $request)
    {

        $new_ticket= Ticket::create(
            ['emp_name' => $request->input('employeeName'),
                'student_name' => $request->input('studentName'),
                'phone_no' => $request->input('phone'),
                'issue' => $request->input('problem'),
                'resp_emp' => $request->input('targetPerson'),
                'notes' => $request->input('notes'),
                'status' => $request->input('status'),
                'notes2' => $request->input('notes2'),


            ]

        );
        $new=  Ticket::select('student_name', 'phone_no', 'issue', 'resp_emp', 'notes', 'status')->where('id',$new_ticket->id )->get();
        TicketLogs::create([
            'ticket_id'=>$new_ticket->id,
            'ticket_data'=>$new,
            'modified_by'=>Auth::user()->name,
            'description'=>'ادراج'
        ]);
        return redirect()->back()->with('success', 'inserted');

    }

    public function delete($id, $resp_emp, $emp_name)
    {
        $resp_id = User::select('id')->where('name', $resp_emp)->first();
        $emp_id = User::select('id')->where('name', $emp_name)->first();
        $user_id = (Auth::user()->id);

        if ($user_id == (($resp_id != null) ? $resp_id->id : -1) || $user_id == (($emp_id != null) ? $emp_id->id : -1)) {

            $ticket_data = Ticket::select('student_name', 'phone_no', 'issue', 'resp_emp', 'notes', 'status')->where('id', $id)->get();
            TicketLogs::create([
                'ticket_id' => $id,
                'ticket_data' => $ticket_data,
                'modified_by' => Auth::user()->name,
                'description' => 'حذف',
            ]);
            $ticket = Ticket::find($id)->delete();

            return redirect()->back()->with('success', 'deleted');
        } else return redirect()->back()->with('failed', 'u cannot delete it');


    }

    public function edit(Request $request)
    {
        $resp_id = User::select('id')->where('name', $request->input('targetPerson'))->first();
        $emp_id = User::select('id')->where('name', $request->input('employeeName'))->first();
        $user_id = (Auth::user()->id);



        if ($user_id == (($resp_id != null) ? $resp_id->id : -1) || $user_id == (($emp_id != null) ? $emp_id->id : -1)) {


            $tick = Ticket::find($request->input('id'));
            $tick->student_name = $request->input('studentName');
            $tick->phone_no = $request->input('phone');
            $tick->issue = $request->input('problem');
            $tick->resp_emp = $request->input('targetPerson');
            $tick->notes = $request->input('notes');
            $tick->status = $request->input('status');
            $tick->notes2 = $request->input('notes2');
            $tick->save();
            $ticket_data = Ticket::select('student_name', 'phone_no', 'issue', 'resp_emp', 'notes', 'status')->where('id', $request->input('id'))->get();


            TicketLogs::create(
                [
                    'ticket_id' => $request->input('id'),
                    'ticket_data' => $ticket_data,
                    'modified_by' => Auth::user()->name,
                    'description' => 'تعديل',

                ]
            );
            return redirect()->back()->with('success', 'edited successfully');


        }

        return redirect()->back()->with('failed', 'u cannot edit ');


    }

}
