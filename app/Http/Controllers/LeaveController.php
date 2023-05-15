<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveStoreRequest;
use App\Http\Requests\LeaveUpdateRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Leave;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $leaves = Leave::where('user_id', $user->id)->get();


        return view('leave.index', compact('leaves'));
    }


    public function create(Request $request): Response
    {
        return view('leave.create');
    }

    public function store(Request $request)
    {
        // $leave = Leave::create($request->validated());

        // $request->session()->flash('leave.id', $leave->id);

        // return redirect()->route('leave.index');
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'leave_type' => 'required|string',
            'reason_for_leave' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $leave = new Leave;
        $leave->user_id = $request->input('user_id');
        $leave->start_date = $request->input('start_date');
        $leave->end_date = $request->input('end_date');
        $leave->leave_type = $request->input('leave_type');
        $leave->reason_for_leave = $request->input('reason_for_leave');
        $leave->status = $request->input('status');

        $leave->save();

        // Redirect to the leave index page with a success message
        return redirect()->route('leave.index')->with('success', 'Leave record created successfully.');

    }

    public function show(Request $request, Leave $leave): Response
    {
        return view('leave.show', compact('leave'));
    }

    public function edit(Request $request, Leave $leave): Response
    {
        return view('leave.edit', compact('leave'));
    }

    public function update(LeaveUpdateRequest $request, Leave $leave)
    {
        $leave->update($request->validated());

        $request->session()->flash('leave.id', $leave->id);

        return redirect()->route('leave.index')->with('success', 'Leave record updated successfully.');
    }

    public function destroy(Request $request, Leave $leave)
    {
        $leave->delete();

        return redirect()->route('leave.index')->with('deleted', 'Leave record deleted successfully.');
    }
}
