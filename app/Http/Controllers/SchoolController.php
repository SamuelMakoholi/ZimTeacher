<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolStoreRequest;
use App\Http\Requests\SchoolUpdateRequest;
use App\Models\School;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SchoolController extends Controller
{
    public function index(Request $request): Response
    {
        $schools = School::all();

        return view('school.index', compact('schools'));
    }

    public function create(Request $request): Response
    {
        return view('school.create');
    }

    public function store(SchoolStoreRequest $request): Response
    {
        $school = School::create($request->validated());

        $request->session()->flash('school.id', $school->id);

        return redirect()->route('school.index');
    }

    public function show(Request $request, School $school): Response
    {
        return view('school.show', compact('school'));
    }

    public function edit(Request $request, School $school): Response
    {
        return view('school.edit', compact('school'));
    }

    public function update(SchoolUpdateRequest $request, School $school): Response
    {
        $school->update($request->validated());

        $request->session()->flash('school.id', $school->id);

        return redirect()->route('school.index');
    }

    public function destroy(Request $request, School $school): Response
    {
        $school->delete();

        return redirect()->route('school.index');
    }
}
