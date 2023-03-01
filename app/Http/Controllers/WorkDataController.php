<?php

namespace App\Http\Controllers;

use App\Models\JobAndUser;
use App\Models\User;
use App\Models\WorkData;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkDataController extends Controller
{
    public function addWork(){
        return view('workdata/add_workdata');
    }

    public function createWork(Request $request)
    {
        $request->validate([
            'photo'=>'mimes:jpg,jpeg,png'
        ]);
            $insertimg = $request->file('photo');
            if($insertimg){
            //สร้างชื่อภาพ
            $name_gen = hexdec(uniqid());
            //ดึงนามสกุลของภาพ
            $img_ext = strtolower($insertimg->getClientOriginalExtension());
            //รวมชื่อกับสกุล ต่อสติง
            $img_name = $name_gen.'.'.$img_ext;
            $upload_location = 'image/workphoto/';
            $full_path = $upload_location.$img_name;
                
                $add_work = new WorkData;
                $add_work->name = $request->name;
                $add_work->lname = $request->lname;
                $add_work->photo = $full_path;
                $add_work->phone_number = $request->phone_number;
                $add_work->jobtype = $request->jobtype;
                $add_work->workplace = $request->workplace;
                $add_work->jobdata = $request->jobdata;
                $add_work->jobarea = $request->jobarea;
                $add_work->jobdate = $request->jobdate;
                $add_work->job_status = $request->job_status;
                $add_work->admin_id = Auth::user()->id;
                $add_work->save();
            $insertimg->move($upload_location,$img_name);
            return redirect()->route('allWork')->with('success',"บันทึกข้อมูลเรียบร้อย");
        }else{
            $add_work = new WorkData;
            $add_work->name = $request->name;
            $add_work->lname = $request->lname;
            $add_work->phone_number = $request->phone_number;
            $add_work->jobtype = $request->jobtype;
            $add_work->workplace = $request->workplace;
            $add_work->jobdata = $request->jobdata;
            $add_work->jobarea = $request->jobarea;
            $add_work->jobdate = $request->jobdate;
            $add_work->job_status = $request->job_status;
            $add_work->admin_id = Auth::user()->id;
            $add_work->save();
            return redirect()->route('allWork')->with('success',"บันทึกข้อมูลเรียบร้อย");
        }
    }
    public function allWork(){
        if(isset($_GET['query']))
        {
            $search_text = $_GET['query'];
            $all_work = WorkData::where('name','like','%'.$search_text.'%')->orWhere('lname','like','%'.$search_text.'%')
            ->paginate(10);
        }else{
            $all_work = WorkData::paginate(10);
        }
        return view('workdata/all_workdata',compact('all_work'));
    }
    public function viewWork($id){
        //dd(Auth::user()->id);
        $find_work = WorkData::find($id);
        return view('workdata/add_workdata',compact('find_work'));
    }

    public function updateWork(Request $request,$id){
        $request->validate([
            'photo'=>'mimes:jpg,jpeg,png'
        ]);
            $insertimg = $request->file('photo');
            if($insertimg){
            //สร้างชื่อภาพ
            $name_gen = hexdec(uniqid());
            //ดึงนามสกุลของภาพ
            $img_ext = strtolower($insertimg->getClientOriginalExtension());
            //รวมชื่อกับสกุล ต่อสติง
            $img_name = $name_gen.'.'.$img_ext;
            $upload_location = 'image/workphoto/';
            $full_path = $upload_location.$img_name;

            WorkData::find($id)->update([
                'name'=> $request->name,
                'lname'=> $request->lname,
                'photo'=> $full_path,
                'phone_number'=> $request->phone_number,
                'jobtype'=> $request->jobtype,
                'workplace'=> $request->workplace,
                'jobdata'=> $request->jobdata,
                'jobarea'=> $request->jobarea,
                'jobdate'=> $request->jobdate,
                'job_status'=> $request->job_status,
                'admin_id'=> Auth::user()->id
            ]);
            $insertimg->move($upload_location,$img_name);
            return redirect()->route('allWork')->with('success',"บันทึกข้อมูลเรียบร้อย");
        }else{
            WorkData::find($id)->update([
                'name'=> $request->name,
                'lname'=> $request->lname,
                'phone_number'=> $request->phone_number,
                'jobtype'=> $request->jobtype,
                'workplace'=> $request->workplace,
                'jobdata'=> $request->jobdata,
                'jobarea'=> $request->jobarea,
                'jobdate'=> $request->jobdate,
                'job_status'=> $request->job_status,
                'admin_id'=> Auth::user()->id
            ]);
            return redirect()->route('allWork')->with('success',"บันทึกข้อมูลเรียบร้อย");
        }
    }
    public function forWork()
    {
        if(isset($_GET['query']))
        {
            $search_text = $_GET['query'];
            $data = DB::table('job_and_users')
            ->join('work_data', 'work_data.id', '=', 'job_and_users.work_id')
            ->join('users', 'users.id', '=', 'job_and_users.user_id')
            ->select('users.*','work_data.*','job_and_users.*')
            ->where('name','like','%'.$search_text.'%')->orWhere('lname','like','%'.$search_text.'%')
            ->orWhere('name_user','like','%'.$search_text.'%')->orWhere('lname_user','like','%'.$search_text.'%')
            ->orderByDesc('job_and_users.created_at')
            ->paginate(10);
        }elseif(isset($_GET['select_query']))
        {
            $search_select = $_GET['select_query'];
            $data = DB::table('job_and_users')
            ->join('work_data', 'work_data.id', '=', 'job_and_users.work_id')
            ->join('users', 'users.id', '=', 'job_and_users.user_id')
            ->select('users.*','work_data.*','job_and_users.*')
            ->where('job_status','like','%'.$search_select.'%')
            ->orderByDesc('job_and_users.created_at')
            ->paginate(10);
        }else{
            $data = DB::table('job_and_users')
            ->join('work_data', 'work_data.id', '=', 'job_and_users.work_id')
            ->join('users', 'users.id', '=', 'job_and_users.user_id')
            ->select('users.*','work_data.*','job_and_users.*')
            ->orderByDesc('job_and_users.created_at')
            ->paginate(10);
        }

        // if(isset($_GET['select_query']))
        // {
        //     $search_select = $_GET['select_query'];
        //     $data = DB::table('job_and_users')
        //     ->join('work_data', 'work_data.id', '=', 'job_and_users.work_id')
        //     ->join('users', 'users.id', '=', 'job_and_users.user_id')
        //     ->select('users.*','work_data.*','job_and_users.*')
        //     ->where('job_status','like','%'.$search_select.'%')
        //     ->orderByDesc('job_and_users.created_at')
        //     ->paginate(10);
        // }else{
        //     $data = DB::table('job_and_users')
        //     ->join('work_data', 'work_data.id', '=', 'job_and_users.work_id')
        //     ->join('users', 'users.id', '=', 'job_and_users.user_id')
        //     ->select('users.*','work_data.*','job_and_users.*')
        //     ->orderByDesc('job_and_users.created_at')
        //     ->paginate(10);
        // }
        return view('workdata/applyforwork',compact('data'));
    }

    public function coordinate($id)
    {
        $data = JobAndUser::join('work_data', 'work_data.id', '=', 'job_and_users.work_id')
        ->join('users', 'users.id', '=', 'job_and_users.user_id')
        ->where('job_and_users.id','=', $id)->get();
        //$data = JobAndUser::where('user_id', '=', Auth::user()->id);
        //dd($data);
        return view('workdata/coordinate',compact('data'));
    }
    public function updatestatus(Request $request,$id){
                WorkData::find($id)->update([
                'job_status'=> $request->job_status,
                'admin_id'=> Auth::user()->id
            ]);
            return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->action == 'edit')
    		{
    			$data = array(
    				'name'	=>	$request->name,
    				'lname'		=>	$request->lname,
    			);
    			DB::table('work_data')
    				->where('id', $request->id)
    				->update($data);
    		}
    		if($request->action == 'delete')
    		{
    			DB::table('work_data')
    				->where('id', $request->id)
    				->delete();
    		}
    		return response()->json($request);
    	}
    }
}

