<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferStoreRequest;
use App\Http\Requests\TransferUpdateRequest;
use App\Models\Transfer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;


class TransferController extends Controller
{
    // public function index(Request $request)
    // {
    //     $user = Auth::user();
    //     $transfer = Transfer::get()
    //         ->where('user_id', $user->id)
    //         ->first();

    //     return view('transfer.index', compact('transfer'));
    // }

    // public function index(Request $request)
    //     {
    //         $user = Auth::user();
    //         $transfers = Transfer::where('user_id', $user->id)->get();

    //         return view('transfer.index', compact('transfers'));
    //     }

    public function index(Request $request)
    {
        $user = Auth::user();
        $transfers = Transfer::where('user_id', $user->id)->get();
        return view('transfer.index', compact('transfers'));
    }


    public function create(Request $request): Response
    {
        return view('transfer.create');
    }

    public function store(Request $request)
    {
        // $transfer = Transfer::create($request->validated());

        // $request->session()->flash('transfer.id', $transfer->id);

        // return redirect()->route('transfer.index');

        $validatedData = $request->validate([
            'current_place' => 'required',
            'from_school' => 'required',
            'to_school' => 'required',
            'reason_for_transfer' => 'required',
            'date_of_transfer' => 'required|date',
            'status' => 'required|in:pending,approved,rejected',
        ]);
    
        $transfer = new Transfer();
        $transfer->user_id = auth()->user()->id;
        $transfer->current_place = $validatedData['current_place'];
        $transfer->from_school = $validatedData['from_school'];
        $transfer->to_school = $validatedData['to_school'];
        $transfer->reason_for_transfer = $validatedData['reason_for_transfer'];
        $transfer->date_of_transfer = $validatedData['date_of_transfer'];
        $transfer->status = $validatedData['status'];
        $transfer->save();
    
        return redirect()->back()->with('success', 'Transfer information saved successfully!');
    }

    public function show(Request $request, Transfer $transfer): Response
    {
        return view('transfer.show', compact('transfer'));
    }

    public function edit(Request $request, Transfer $transfer)
    {
        return view('transfer.edit', compact('transfer'));
    }


    //update transfer request

    public function update(TransferUpdateRequest $request, Transfer $transfer)
    {
        $transfer->update($request->validated());

        $request->session()->flash('transfer.id', $transfer->id);

        // return redirect()->route('transfer.index');
        return redirect()->back()->with('success', 'Transfer information updated successfully!');

    }


    //update by admin
    public function approve(TransferUpdateRequest $request, Transfer $transfer)
    {
        $transfer->update($request->validated());

        $request->session()->flash('transfer.id', $transfer->id);

        // return redirect()->route('transfer.index');
        return redirect()->back()->with('success', 'Transfer information approved successfully!');

    }




    public function destroy(Request $request, Transfer $transfer)
    {
        $transfer->delete();

        return redirect()->back()->with('deleted', 'Transfer information removed successfully!');
    }
}
