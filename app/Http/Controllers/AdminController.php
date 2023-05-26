<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Leave;
use App\Models\Transfer;
use DB;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    //
    public function index(){
        return view('home');
    }


    public function teachers()
    {
        $teachers = DB::table('users')
        ->join('teachers', 'users.id' ,'=', 'teachers.user_id')
        ->select('teachers.*', 'users.name', 'users.email')->paginate(3);

        return view('admin.teachers', compact('teachers'));
       // return response()->json($teachers);
    }

    public function leave()
    {
        $leaves = DB::table('users')
        ->join('leaves', 'users.id','=','leaves.user_id')
        ->join('teachers', 'users.id', '=', 'teachers.user_id')
        ->select('leaves.*','teachers.*','users.name','users.email')->where('status', 'pending')->get();
        return view('admin.leave', compact('leaves'));
    }

    //approved leave
    public function approved_leave()
    {
        $leaves = DB::table('users')
        ->join('leaves', 'users.id','=','leaves.user_id')
        ->join('teachers', 'users.id', '=', 'teachers.user_id')
        ->select('leaves.*','teachers.*','users.name','users.email')->where('status', 'approved')->get();
        return view('admin.approved', compact('leaves'));
    }

    // //pending leave
    // public function pending_leave()
    // {
    //     $leaves = DB::table('users')
    //     ->join('leaves', 'users.id','=','leaves.user_id')
    //     ->join('teachers', 'users.id', '=', 'teachers.user_id')
    //     ->select('leaves.*','teachers.*','users.name','users.email')->where('status', 'approved')->get();
    //     return view('admin.approved', compact('leaves'));
    // }


    public function transfers()
    {
        $transfers = DB::table('users')
        ->join('transfers', 'users.id','=','transfers.user_id')
        // ->join('teachers', 'users.id', '=', 'teachers.user_id')
        ->select('transfers.*','users.name','users.email')->where('status', 'pending')->get();
        return view('admin.transfers', compact('transfers'));
    }
    //approved transfers

    public function approve_transfers()
    {
        $transfers = DB::table('users')
        ->join('transfers', 'users.id','=','transfers.user_id')
        // ->join('teachers', 'users.id', '=', 'teachers.user_id')
        ->select('transfers.*','users.name','users.email')->where('status', 'approved')->get();
        return view('admin.trransfere-approved', compact('transfers'));
    }

    public function leaveReport()
    {
        $repo = DB::table('leaves')->where('status','pending')->count();
        $repo1 = DB::table('leaves')->where('status','approved')->count();
        $repo2 = DB::table('leaves')->where('status','deleted')->count();
        return view('admin.leave-report', compact(['repo', 'repo1', 'repo2']));
    }

    public function TransferReport()
    {
        $repo = DB::table('transfers')->where('status','pending')->count();
        $repo1 = DB::table('transfers')->where('status','approved')->count();
        $repo2 = DB::table('transfers')->where('status','deleted')->count();
        return view('admin.transfer-report', compact(['repo', 'repo1', 'repo2']));
    }

    // public function approveTransfere(Request $request, Transfer $transfer)
    // {
            
    //     // $transfer->id = $request->id;
    //     // $transfer->status = $request->status;
    //     // DB::table('transfers')->where('id', $transfer->id)->update(['status' => "approved"]);

    //     // return redirect()->back()->with('deleted', 'Transfer information approved successfully!');

        
    // }

    // public function approveTransfere(Request $request, Transfer $transfer) {
    //     if (Transfer::where('id', $transfer)->exists()) {
    //       $trans = Transfer::find($transfer);
  
    //       $trans->status = $request->status;
    //     //   $student->course = is_null($request->course) ? $student->course : $request->course;
    //       $trans->save();
  
    //       return response()->json([
    //         "message" => "records updated successfully"
    //       ], 200);
    //     } else {
    //       return response()->json([
    //         "message" => "Student not found"
    //       ], 404);
    //     }
    //   }

    // public function approveTransfere(Request $request, Transfer $transfer)
    //     {
    //         $transfer->status = 'approved';
    //         $transfer->save();

    //         return redirect()->back()->with('success', 'Transfer information approved successfully!');
    //     }

    public function approveTransfere(Request $request)
{
    // $transfer->update([
    //     'status' => 'approved',
    // ]);
    $trans->current_place = $request->current_place;
    $trans->id = $request->id;
    $trans->status = $request->status;

    DB::table('transfers')
    ->where('id', $trans)
    ->update(['status' => 'approved']);

    dd($trans);


    // return redirect()->back()->with('success', 'Transfer status has been updated successfully!');
}


}
