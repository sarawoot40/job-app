@extends('layouts.app')

@section('content')
<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}
.button5 {
  background-color: white;
  color: black;
  border: 2px solid #555555;
}
.button5:hover {
  background-color: #555555;
  color: white;
}
.body {
  font-family: 'Brush Script MT', cursive;
}
</style>
<div class="container body">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>งานทั้งหมด</h1></div>
                <div class="card-body">
                <section class="pt-4">
            <div class="container px-lg-5">
                <!-- Page Features-->
                <div class="row gx-lg-5">
                    @foreach($all_work as $row)
                    <div class="col-lg-6 col-xxl-4 mb-5">
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                                <div>
                                    @if($row->job_status == 0)
                                        <h5 style="color: blue;">ต้องการคนงาน</h5>
                                    @elseif($row->job_status == 1)
                                        <h5 style="color: orange;">อยู่ระหว่างการทำงาน</h5>
                                    @else($row->job_status == 2)
                                        <h5 style="color: red;">เสร็จเรียบร้อย</h5>
                                    @endif
                                    </h5>
                                </div>
                                <h2 class="fs-4 fw-bold">งาน : 
                                    @if($row->jobtype == 0)
                                        เพาะปลูก
                                    @elseif($row->jobtype == 1)
                                        ปรับสภาพหน้าดิน
                                    @elseif($row->jobtype == 2)
                                        ดูแลและบำรุง
                                    @else
                                        เก็บเกี่ยว
                                    @endif
                                </h2>
                                <p><img src="{{asset($row->photo)}}" class="img-responsive" alt="Image" style="height: 200px; width: 250px; object-fit: cover;"></p>
                                <h5>{{$row->jobdata}}</h5>
                                <h5>ต้องการให้เริ่มงาน : {{date('d-m-Y', strtotime($row->jobdate))}}</h5>
                                <h5>ขนาด : {{$row->jobarea}}</h5>
                                <a href="{{ url('view_work/'.$row->id) }}" class="button button5">ดูลายละเอียดเพิ่มเติม</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
