@extends('layouts.app')

@section('content')
<style>
    .table{
        font-size: 18px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h1>งาน :
                            @if($finddata->jobtype == 0)
                                เพาะปลูก
                            @elseif($finddata->jobtype == 1)
                                ปรับสภาพหน้าดิน
                            @elseif($finddata->jobtype == 2)
                                ดูแลและบำรุง
                            @else
                                เก็บเกี่ยว
                            @endif
                        </div>
                        <div class="col-2" align = 'right'>
                            @if(Auth::user()->is_admin == 0)
                                @if($check == 0)
                                    @if($finddata->job_status != 0)
                                    <button type="button" class="btn btn-secondary btn-lg" disabled>ไม่สามารถสมัครได้</button>
                                    @else
                                    <form action="{{ url('job/createJob/') }}" method="post">
                                    @csrf
                                        <input type="hidden" name="work_id" value="{{$finddata->id}}">
                                        <button type="submit" class="btn btn-success" onclick="return confirm('คุณต้องการสมัครงานนี้ใช่หรือไม่')">สมัครงาน</button>
                                    </form>
                                    @endif
                                @else
                                    @if($finddata->job_status != 0)
                                    <button type="button" class="btn btn-secondary btn-lg" disabled>ไม่สามารถสมัครได้</button>
                                    @else
                                    <form action="{{ url('job/delete/')}}" method="post">
                                    @csrf
                                        <input type="hidden" name="work_id" value="{{$finddata->id}}">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('คุณต้องการยกเลิกงานนี้ใช่หรือไม่')">ยกเลิกการสมัคร</button>
                                    </form>
                                    @endif
                                @endif
                            @else
                                <a href="{{ url('workdata/view_workdata/'.$finddata->id) }}" class="btn btn-primary">แก้ไข</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <center><img src="{{asset($finddata->photo)}}" class="img-responsive" alt="Image" style="height: 300px; object-fit: cover;"></center>
                <table class="table">
                    <tr>
                        <th scope="col" width="200px">
                            ชื่อ
                        </th>
                        <th scope="col">
                            : {{$finddata->name}} {{$finddata->lname}}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">
                            เบอร์โทร
                        </th>
                        <th scope="col">
                            : {{$finddata->phone_number}}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">
                            วันที่ต้องการให้เริ่มงาน
                        </th>
                        <th scope="col">
                            : {{date('d-m-Y', strtotime($finddata->jobdate))}}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">
                            ที่อยู่ของงาน
                        </th>
                        <th scope="col">
                            : {{$finddata->workplace}}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">
                            รายละเอียดงาน
                        </th>
                        <th scope="col">
                            : {{$finddata->jobdata}}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">
                            ขนาด
                        </th>
                        <th scope="col">
                            : {{$finddata->jobarea}}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">
                            สถานะ
                        </th>
                        <th scope="col">
                        @if($finddata->job_status == 0)
                            : ต้องการคนงาน
                        @elseif($finddata->job_status == 1)
                            : อยู่ระหว่างการทำงาน
                        @else
                            : เสร็จเรียบร้อย
                        @endif
                        </th>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
