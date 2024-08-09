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
                <a href="#">Thêm học sinh</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Đăng ký thông tin học sinh</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_name">Tên đăng nhập</label>
                                <input type="email" class="form-control" id="user_name" name="user_name"
                                    placeholder="nva123" />
                            </div>
                            <div class="form-group">
                                <label for="name">Họ tên học sinh</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nguyễn Văn A" />
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Nguyen123456" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Địa chỉ email</label>
                                <input type="email" class="form-control" id="email" name="email_address"
                                    placeholder="nguyenvana@gmail.com" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone_number"
                                    placeholder="0123456789" />
                            </div>

                            <div class="form-group">
                                <label for="datepicker">Sinh nhật</label>
                                <input type="text" class="form-control" id="datepicker" class="datepicker"
                                    name="date_of_birth" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Nơi ở hiện tại</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Thừa Thiên Huế" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-success">Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
