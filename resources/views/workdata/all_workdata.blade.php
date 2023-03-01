@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1>ข้อมูลงานทั้งหมด</h1>
                        </div>
                        <div class="col">
                            <form class="d-flex" method="get" action="{{ route('allWork') }}">
                                <input class="form-control" type="search" name="query" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">ประเภทของงาน</th>
                            <th scope="col">วันที่ต้องการให้เริ่มงาน</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">รายละเอียดงาน</th>
                            <th scope="col">เพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($all_work as $row)
                            <tr>
                            <th scope="row">{{ $all_work->firstItem()+$loop->index }}</th>
                            <td>{{$row->name}} {{$row->lname}}</td>
                            @if($row->jobtype == 0)
                                <td>เพาะปลูก</td>
                            @elseif($row->jobtype == 1)
                                <td>ปรับสภาพหน้าดิน</td>
                            @elseif($row->jobtype == 2)
                                <td>ดูแลและบำรุง</td>
                            @else
                                <td>เก็บเกี่ยว</td>
                            @endif
                            <td>{{date('d-m-Y', strtotime($row->jobdate))}}</td>
                            @if($row->job_status == 0)
                                <td>ต้องการคนงาน</td>
                            @elseif($row->job_status == 1)
                                <td>อยู่ระหว่างการทำงาน</td>
                            @else($row->job_status == 2)
                                <td>เสร็จเรียบร้อย</td>
                            @endif
                            <td>{{$row->jobdata}}</td>
                            <td><a href="{{ url('workdata/view_workdata/'.$row->id) }}" class="btn btn-success">ข้อมูลเพิ่มเติม</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection