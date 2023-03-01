@extends('layouts.app')

@section('content')
<style>
.btn{
    color: blue;
    border-color: blue;
    }
.form-select{
    color: blue;
    border-color: blue;
}
p {
  font-family: 'Kanit', sans-serif;
  color: #34495e;
  font-size: 18px;
}
.px {
    color: black;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>ผู้สมัครงาน</h2></div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-4" style="float:none;margin:auto;">
                        <center><img src="{{asset($data[0]->photo_user)}}" class="img-responsive" alt="Image" style="height: 200px; width: 200; object-fit: cover;"></center>
                        </div>
                        <div class="col-2">
                            <p>ชื่อ</p>
                            <p>ที่อยู่</p>
                            <p>เบอร์โทร</p>
                            <p>ประสบการณ์</p>
                            <p>อุปกรณ์ในการทำงาน</p>
                            <p>คนงาน</p>
                            <p>งานที่สามารถทำได้</p>
                        </div>
                        <div class="col-6">
                            <p>{{$data[0]->name_user}} {{$data[0]->lname_user}}</p>
                            <p>{{$data[0]->address}}</p>
                            <p>{{$data[0]->phone_number_user}}</p>
                            <p>
                            @if($data[0]->experience == 0)
                                น้อยกว่า 1 ปี
                            @elseif($data[0]->experience == 1)
                                มากกว่า 1 ปี
                            @elseif($data[0]->experience == 2)
                                มากกว่า 3 ปี
                            @else
                                มากกว่า 5 ปี
                            @endif
                            </p>
                            <p>{{$data[0]->equipment}}</p>
                            <p>{{$data[0]->worker}}</p>
                            <p>{{$data[0]->work}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h2>เจ้าของงาน</h2>
                        </div>
                        <div class="col-4">
                        <form action="{{ url('workdata/updatestatus/'.$data[0]->work_id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="input-group">
                            <label class="input-group-text" id="basic-addon2">เปลี่ยนสถานะ</label>
                                <select name="job_status" class="form-select" required>
                                    <option value="0" @if($data[0]->job_status == 0) selected @endif>ต้องการคนงาน</option>
                                    <option value="1" @if($data[0]->job_status == 1) selected @endif>อยู่ระหว่างการทำงาน</option>
                                    <option value="2" @if($data[0]->job_status == 2) selected @endif>เสร็จเรียบร้อย</option> 
                                </select>
                                <button onclick="return confirm('คุณต้องการแก้ไขข้อมูลนี้ใช่หรือไม่')" class="btn btn-outline-secondary" type="submit">ยืนยัน</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-4" style="float:none;margin:auto;">
                        <center><img src="{{asset($data[0]->photo)}}" class="img-responsive" alt="Image" style="height: 200px; width: 200; object-fit: cover;"></center>
                        </div>
                        <div class="col-2">
                            <p>ชื่อ</p>
                            <p>เบอร์โทร</p>
                            <p>ประเภทงาน</p>
                            <p>ที่อยู่ของงาน</p>
                            <p>รายละเอียดงาน</p>
                            <p>ขนาดของงาน</p>
                            <p>วันที่ต้องการให้เริ่มงาน</p>
                        </div>
                        <div class="col-6">
                            <p>{{$data[0]->name}} {{$data[0]->lname}}</p>
                            <p>{{$data[0]->phone_number}}</p>
                            <p>
                            @if($data[0]->jobtype == 0)
                                เพาะปลูก
                            @elseif($data[0]->jobtype == 1)
                                ปรับสภาพหน้าดิน
                            @elseif($data[0]->jobtype == 2)
                                ดูแลและบำรุง
                            @else
                                เก็บเกี่ยว
                            @endif
                            </p>
                            <p>{{$data[0]->workplace}}</p>
                            <p>{{$data[0]->jobdata}}</p>
                            <p>{{$data[0]->jobarea}}</p>
                            <p>{{date('d-m-Y', strtotime($data[0]->jobdate))}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
