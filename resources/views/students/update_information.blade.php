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
                                    <input disabled type="email" class="form-control" id="user_name" name="user_name" value="{{Auth::user()->user_name}}"
                                        placeholder="nva123" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Họ tên học sinh <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}"
                                        placeholder="Nguyễn Văn A" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Nơi ở hiện tại <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{Auth::user()->address}}"
                                        placeholder="Thừa Thiên Huế" />
                                </div>
                               
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Địa chỉ email <span class="text-danger">*</span></label>
                                    <input disabled type="email" class="form-control" id="email" name="email_address" value="{{Auth::user()->email_address}}"
                                        placeholder="nguyenvana@gmail.com" />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="phone" name="phone_number"  value="{{Auth::user()->phone_number}}"
                                        placeholder="0123456789" />
                                </div>
    
                                <div class="form-group">
                                    <label for="datepicker">Sinh nhật</label>
                                    <input type="text" class="form-control" id="datepicker" class="datepicker"  value="{{Auth::user()->date_of_birth}}"
                                        name="date_of_birth" />
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-action ">
                        <button class="btn btn-danger">Trở lại</button>
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
