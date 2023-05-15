<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherStoreRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{

    public function home(){
        return view('teacher-home');
    }

    
    public function index(Request $request)
    {
        $teachers = Teacher::all();

        return view('teacher.index', compact('teachers'));
    }

    public function create(Request $request)
    {
        return view('teacher.create');
    }

 

    public function store(TeacherStoreRequest $request)
    {
        //$teacher = Teacher::create($request->validated());
        //$teacher->addRole('teacher'); 

        $validator = Validator::make($request->all(), [
            // 'full_name' => ['required', 'string', 'max:400'],
            'email' => ['required', 'email', 'max:100'],
            'gender' => ['required', 'string', 'max:20'],
            'role' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:400'],
            'id_no' => ['required', 'string', 'max:100'],
            'dob' => ['required', 'string', 'max:30'],
            'grade_level' => ['required', 'string', 'max:200'],
            'district' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'class_course' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:400'],
            'school' => ['required', 'string', 'max:150'],
            'password' => ['required', 'string', 'max:8'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->addRole($request->role);

            $teacher = new Teacher();
            $teacher->user_id = $user->id;
            $teacher->gender = $request->gender;
            $teacher->phone = $request->phone;
            $teacher->id_no = $request->id_no;
            $teacher->dob = $request->dob;
            $teacher->grade_level = $request->grade_level;
            $teacher->district = $request->district;
            $teacher->province = $request->province;
            $teacher->qualification = $request->qualification;
            $teacher->class_course = $request->class_course;
            $teacher->school = $request->school;
            $teacher->save();
            return back()->with('success', 'Teacher created successfully');

        // return redirect()->route('teacher.index');
    }

    public function show(Request $request, Teacher $teacher)
    {
        return view('teacher.show', compact('teacher'));
    }

    public function edit(Request $request, Teacher $teacher): Response
    {
        return view('teacher.edit', compact('teacher'));
    }

    public function update(TeacherUpdateRequest $request, Teacher $teacher): Response
    {
        $teacher->update($request->validated());

        $request->session()->flash('teacher.id', $teacher->id);

        return redirect()->route('teacher.index');
    }

    public function destroy(Request $request, Teacher $teacher): Response
    {
        $teacher->delete();

        return redirect()->route('teacher.index');
    }
}
