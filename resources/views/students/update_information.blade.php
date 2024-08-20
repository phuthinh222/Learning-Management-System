@extends('layouts.app')

@section('breadcrumbs')
<div class="page-header">
    <h3 class="fw-bold mb-3">Học sinh</h3>
    <ul class="breadcrumbs mb-3">
        <li class="nav-home">
            <a href="#">
                <i class="icon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Học sinh</a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Cập nhật thông tin học sinh</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Cập nhật thông tin học sinh</div>
            </div>
            <form action="{{Route('student.update',Auth::user()->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_name">Tên đăng nhập <span class="text-danger">*</span></label>
                                <input disabled type="text" class="form-control" value="{{Auth::user()->user_name}}"
                                    placeholder="nva123" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_address">Email<span class="text-danger">*</span></label>
                                <input disabled type="text" class="form-control" value="{{Auth::user()->email_address}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Họ tên học sinh <span class="text-danger">*</span></label>
                                <input @error('name') class="form-control is-invalid" @enderror type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                                    placeholder="Nguyễn Văn A" />
                                @error('name') <div class="invalid-feedback">{{$message}}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                                <input @error('phone_number') class="form-control is-invalid" @enderror type="tel" class="form-control" id="phone" name="phone_number" value="{{ old('phone_number', Auth::user()->phone_number) }}"
                                    placeholder="0123456789" />
                                @error('phone_number') <div class="invalid-feedback">{{$message}}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Nơi ở hiện tại <span class="text-danger">*</span></label>
                                <input @error('address') class="form-control is-invalid" @enderror type="text" class="form-control" id="address" name="address" value="{{ old('address', Auth::user()->address) }}"
                                    placeholder="Thừa Thiên Huế" />
                                @error('address') <div class="invalid-feedback">{{$message}}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="datepicker">Sinh nhật</label>
                                <input @error('date_of_birth') class="form-control is-invalid" @enderror type="text" class="form-control" id="datepicker" class="datepicker" name="date_of_birth"
                                    value="{{old('date_of_birth', Auth::user()->date_of_birth)}}" />
                                @error('date_of_birth') <div class="invalid-feedback">{{$message}}</div>@enderror
                            </div>
                        </div>
                    </div>
                            
                </div>
                <div class="card-action ">

                    <a href="{{route('student.index')}}" class="btn btn-danger">Trở lại</a>
                    <button type="submit" class="btn btn-success">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection