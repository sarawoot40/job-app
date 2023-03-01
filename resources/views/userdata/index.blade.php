@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                    <div class="col-md-6"><h1>ข้อมูลของคุณ</h1></div>
                    <div class="col-md-6" align = 'right'><a href="{{ route('addUser') }}" class="btn btn-warning">แก้ไขข้อมูล</a></div>
                    </div>
                </div>

                <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-12">
                        <img src="{{asset($data->photo_user)}}" class="img-responsive" alt="Image" style="height: 200px;">
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="name_user" value="{{$data->name_user}}" disabled readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="lname_user" value="{{$data->lname_user}}" disabled readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">ที่อยู่</label>
                        <textarea type="text" class="form-control" name="address" disabled readonly>{{$data->address}}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" name="phone_number_user" value="{{$data->phone_number_user}}" disabled readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">ประสบการณ์</label>
                        @if($data->experience == 0)
                            <input type="text" class="form-control" name="experience" value="น้อยกว่า 1 ปี" disabled readonly>
                        @elseif($data->experience == 1)
                            <input type="text" class="form-control" name="experience" value="มากกว่า 1 ปี" disabled readonly>
                        @elseif($data->experience == 2)
                            <input type="text" class="form-control" name="experience" value="มากกว่า 3 ปี" disabled readonly>
                        @else
                            <input type="text" class="form-control" name="experience" value="มากกว่า 5 ปี" disabled readonly>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">คนงาน / ทีมงาน</label>
                        <input type="text" class="form-control" name="worker" value="{{$data->worker}}" disabled readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">อุปกรณ์ในการทำงาน / เครื่องมือ</label>
                        <textarea type="text" class="form-control" name="equipment" disabled readonly>{{$data->equipment}}</textarea>
                    </div>
                    
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">งานที่สามารถทำได้</label>
                        <textarea type="text" class="form-control" name="work" disabled readonly>{{$data->work}}</textarea>
                    </div>
                </form> 
                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection