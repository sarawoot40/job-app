@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>กรองข้อมูลของคุณ</h1></div>

                <div class="card-body">     
                <form class="row g-3" action="{{ route('create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="name_user" value="@if(isset($data->name_user)){{$data->name_user}}@endif">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="lname_user" value="@if(isset($data->lname_user)){{$data->lname_user}}@endif">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">ที่อยู่</label>
                        <textarea type="text" class="form-control" name="address">@if(isset($data->address)){{$data->address}}@endif</textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" name="phone_number_user" value="@if(isset($data->phone_number_user)){{$data->phone_number_user}}@endif">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">ประสบการณ์</label>
                        <select name="experience" class="form-select" required>
                            <option value="0" @if(isset($data->experience) && $data->experience == 0) selected @endif>น้อยกว่า 1 ปี</option>
                            <option value="1" @if(isset($data->experience) && $data->experience == 1) selected @endif>มากกว่า 1 ปี</option>
                            <option value="2" @if(isset($data->experience) && $data->experience == 2) selected @endif>มากกว่า 3 ปี</option> 
                            <option value="3" @if(isset($data->experience) && $data->experience == 3) selected @endif>มากกว่า 5 ปี</option>  
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">คนงาน / ทีมงาน</label>
                        <input type="text" class="form-control" name="worker" value="@if(isset($data->worker)){{$data->worker}}@endif">
                    </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">อุปกรณ์ในการทำงาน / เครื่องมือ</label>
                        <textarea type="text" class="form-control" name="equipment">@if(isset($data->equipment)){{$data->equipment}}@endif</textarea>
                    </div>
                    
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">งานที่สามารถทำได้</label>
                        <textarea type="text" class="form-control" name="work">@if(isset($data->work)){{$data->work}}@endif</textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label">รูปภาพ</label>
                        <input type="file" class="form-control" name="photo_user">
                    </div>
                    @if(isset($data->photo))  
                    <div  class="col-3">
                        <input type="hidden" value="{{$data->photo}}" name="old_image">
                        <img src="{{asset($data->photo)}}" class="img-responsive" alt="Image" style="height: 200px;">
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