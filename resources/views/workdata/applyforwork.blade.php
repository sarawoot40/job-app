@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4">
                            <h1>ข้อมูลงานทั้งหมด</h1>
                        </div>
                        <div class="col-4">
                            <form action="{{ route('forWork') }}" method="get">
                            <select name="select_query" class="form-select" onchange="this.form.submit();">
                                <option value="" @if(isset($_GET['select_query']) && $_GET['select_query'] == "") selected @endif>ทั้งหมด</option>
                                <option value="0" @if(isset($_GET['select_query']) && $_GET['select_query'] == "0") selected @endif>ต้องการคนงาน</option>
                                <option value="1" @if(isset($_GET['select_query']) && $_GET['select_query'] == 1) selected @endif>อยู่ระหว่างการทำงาน</option>
                                <option value="2" @if(isset($_GET['select_query']) && $_GET['select_query'] == 2) selected @endif>เสร็จเรียบร้อย</option> 
                            </select>
                            </form>
                        </div>
                        <div class="col-4">
                            <form class="d-flex" method="get" action="{{ route('forWork') }}">
                                <input class="form-control" type="search" name="query" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <table class="table" id="my-table">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่สมัครงาน</th>
                            <th scope="col">ชื่อผู้สมัครงาน</th>
                            <th scope="col">เบอร์ผู้สมัครงาน</th>
                            <th scope="col">ชื่อเจ้าของงาน</th>
                            <th scope="col">เบอร์เจ้าของงาน</th>
                            <th scope="col">ประเภทงาน</th>
                            <th scope="col">วันที่ต้องการให้เริ่มงาน</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">เพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                            <th scope="row">{{ $data->firstItem()+$loop->index }}</th>
                            <td>{{date('d-m-Y H:i:s', strtotime($row->created_at))}}</td>
                            <td>{{$row->name_user}} {{$row->lname_user}}</td>
                            <td>{{$row->phone_number_user}}</td>
                            <td>{{$row->name}} {{$row->lname}}</td>
                            <td>{{$row->phone_number}}</td>
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
                                <td style="color: blue;">ต้องการคนงาน</td>
                            @elseif($row->job_status == 1)
                                <td style="color: orange;">อยู่ระหว่างการทำงาน</td>
                            @else($row->job_status == 2)
                                <td style="color: red;">เสร็จเรียบร้อย</td>
                            @endif
                            <td><a href="{{ url('workdata/coordinate/'.$row->id) }}" class="btn btn-success">ข้อมูลเพิ่มเติม</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $('#my-table').DataTable({
  // other options...
  initComplete: function() {
    this.api().columns().every(function() {
      var column = this;
      if (column.header().innerHTML == "job_status") { // replace with your column header
        var select = $('#status-filter');
        select.on('change', function() {
          var val = $.fn.dataTable.util.escapeRegex($(this).val());
          column.search(val ? '^'+val+'$' : '', true, false).draw();
        });
        column.data().unique().sort().each(function(d, j) {
          select.append('<option value="'+d+'">'+d+'</option>')
        });
      }
    });
  }
});
</script> 
@endsection