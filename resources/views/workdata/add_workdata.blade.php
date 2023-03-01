@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>กรองข้อมูลของงาน</h1></div>

                <div class="card-body">
                    @if(isset($find_work->id))
                        <form class="row g-3" action="{{ url('workdata/update/'.$find_work->id) }}" method="post" enctype="multipart/form-data">
                    @else    
                        <form class="row g-3" action="{{ route('createWork') }}" method="post" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="name" value="@if(isset($find_work->name)){{$find_work->name}}@endif">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="lname" value="@if(isset($find_work->lname)){{$find_work->lname}}@endif">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" name="phone_number" value="@if(isset($find_work->phone_number)){{$find_work->phone_number}}@endif">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">ประเภทของงาน</label>
                        <select name="jobtype" class="form-select" required>
                            <option value="0" @if(isset($find_work->jobtype) && $find_work->jobtype == 0) selected @endif>เพาะปลูก</option>
                            <option value="1" @if(isset($find_work->jobtype) && $find_work->jobtype == 1) selected @endif>ปรับสภาพหน้าดิน</option>
                            <option value="2" @if(isset($find_work->jobtype) && $find_work->jobtype == 2) selected @endif>ดูแลและบำรุง</option> 
                            <option value="3" @if(isset($find_work->jobtype) && $find_work->jobtype == 3) selected @endif>เก็บเกี่ยว</option>  
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">วันที่ต้องการให้เริ่มงาน</label>
                        <input type="date" class="form-control" name="jobdate" value="@if(isset($find_work->jobdate)){{$find_work->jobdate}}@endif">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">ที่อยู่ของงาน</label>
                        <textarea type="text" class="form-control" name="workplace">@if(isset($find_work->workplace)){{$find_work->workplace}}@endif</textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">รายละเอียดงาน</label>
                        <textarea type="text" class="form-control" name="jobdata">@if(isset($find_work->jobdata)){{$find_work->jobdata}}@endif</textarea>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">พื้นที่ของงานหรือขนาดของงาน</label>
                        <input type="text" class="form-control" name="jobarea" value="@if(isset($find_work->jobarea)){{$find_work->jobarea}}@endif">
                    </div>
                    <div class="col-md-6">
                        <label for="inputZip" class="form-label">สถานะ</label>
                        <select name="job_status" class="form-select" required>
                            <option value="0" @if(isset($find_work->job_status) && $find_work->job_status == 0) selected @endif>ต้องการคนงาน</option>
                            <option value="1" @if(isset($find_work->job_status) && $find_work->job_status == 1) selected @endif>อยู่ระหว่างการทำงาน</option>
                            <option value="2" @if(isset($find_work->job_status) && $find_work->job_status == 2) selected @endif>เสร็จเรียบร้อย</option> 
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label">รูปภาพ</label>
                        <input type="file" class="form-control" name="photo">
                    </div>
                    @if(isset($find_work->photo))  
                    <div  class="col-3">
                        <input type="hidden" value="{{$find_work->photo}}" name="old_image">
                        <img src="{{asset($find_work->photo)}}" class="img-responsive" alt="Image" style="height: 200px;">
                    </div>
                    @endif
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary" style="width: 30%;">ตกลง</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection