<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');

        if(Auth::user()->hasRole('user')){
            return redirect()->route('home.teacher');
        }elseif(Auth::user()->hasRole('admin')){
            return redirect()->route('home.admin');
        }else{
            dd('not defined role');
        }
    }

    //user profile

    // public function profile()
    // {
    //     $user=Auth::user()->id;
    //     $profile = DB::table('users')
    //     ->join('teachers', 'users.id','=','teachers.user_id')
    //     ->select('teachers.*','users.name', 'users.email')->where('teachers.user_id', $user);
    //     // return view('teacher.profile', compact('profile'));
    //     return response()->json($profile);
    // }

//     public function profile()
// {
//     $user = Auth::user()->id;
//     $profile = User::with('teachers')->where('id', $user)->first();
//     return view('teacher.profile', compact('profile'));
//     // return response()->json($profile);
// }

public function profile()
{
    $user = Auth::user();
    $profile = DB::table('users')
        ->join('teachers', 'users.id', '=', 'teachers.user_id')
        ->select('teachers.*', 'users.name', 'users.email')
        ->where('teachers.user_id', $user->id)
        ->first();

    return view('teacher.profile', compact('profile'));
}


}
