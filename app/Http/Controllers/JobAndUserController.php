<?php

namespace App\Http\Controllers;

use App\Models\JobAndUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobAndUserController extends Controller
{
    public function createJob(Request $request){
        //dd($request);
        $add_job = new JobAndUser;
        $add_job->work_id = $request->work_id;
        $add_job->user_id = Auth::user()->id;
        $add_job->save();
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }
    public function softdelete_job(Request $request){
        $request = $request->work_id;
        $user_id = Auth::user()->id;
        JobAndUser::where('user_id', '=', $user_id)->where('work_id', '=', $request)->forceDelete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }
}
