<?php

namespace App\Http\Controllers;
use App\Models\JobAndUser;
use App\Models\WorkData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_work = WorkData::all();
        return view('home',compact('all_work'));
    }
    public function adminHome()
    {
        return view('adminHome');
    }

    public function viewdataWork($id){
        $finddata = WorkData::find($id);
        $work_id = (int)$id;
        $user_id = Auth::user()->id;
        $check = JobAndUser::where('user_id', '=', $user_id)->where('work_id', '=', $work_id)->count();
        return view('view_Work',compact('finddata','check'));
    }
}
