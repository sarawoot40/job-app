<?php

namespace App\Http\Controllers;

use App\Models\JobAndUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserdataController extends Controller
{
    public function index()
    {
        $data = User::find(Auth::user()->id);
        return view('userdata/index',compact('data'));
    }
    public function addUser()
    {
        $data = User::find(Auth::user()->id);
        return view('userdata/add_datauser',compact('data'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'photo_user'=>'mimes:jpg,jpeg,png'
        ]);
        $insertimg = $request->file('photo_user');

        if($insertimg){
            //สร้างชื่อภาพ
            $name_gen = hexdec(uniqid());
            //ดึงนามสกุลของภาพ
            $img_ext = strtolower($insertimg->getClientOriginalExtension());
            //รวมชื่อกับสกุล ต่อสติง
            $img_name = $name_gen.'.'.$img_ext;
            $upload_location = 'image/userphoto/';
            $full_path = $upload_location.$img_name;

            User::find(Auth::user()->id)->update([
                'name_user'=> $request->name_user,
                'lname_user'=> $request->lname_user,
                'address'=> $request->address,
                'photo_user'=> $full_path,
                'phone_number_user'=> $request->phone_number_user,
                'experience'=> $request->experience,
                'worker'=> $request->worker,
                'equipment'=> $request->equipment,
                'work'=> $request->work
            ]);
            //ลบภาพเก่าและแทนที่ด้วยภาพใหม่
            $old_img = $request->old_image;
            if($old_img){
            unlink($old_img);
            }
            $insertimg->move($upload_location,$img_name);
            return redirect()->route('index')->with('success',"อัพเดทข้อมูลเรียบร้อย");
        }else{
            User::find(Auth::user()->id)->update([
                'name_user'=> $request->name_user,
                'lname_user'=> $request->lname_user,
                'address'=> $request->address,
                'phone_number_user'=> $request->phone_number_user,
                'experience'=> $request->experience,
                'worker'=> $request->worker,
                'equipment'=> $request->equipment,
                'work'=> $request->work
            ]);
            return redirect()->route('index')->with('success',"อัพเดทข้อมูลเรียบร้อย");
        }
    }

    public function yourWork()
    {
        $data = DB::table('job_and_users')
        ->join('work_data', 'work_data.id', '=', 'job_and_users.work_id')
        ->where('job_and_users.user_id', '=', Auth::user()->id)
        ->paginate(10);
        //$data = JobAndUser::where('user_id', '=', Auth::user()->id);
        //dd($data);
        return view('userdata/your_work',compact('data'));
    }
}
