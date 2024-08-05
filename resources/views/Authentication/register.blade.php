@extends('layouts.auth')
@section('title', 'Đăng nhập')
@section('content')
    <div class="login-form">
        <div class="title">Đăng ký</div>
            <form method="post" action="{{route('register_store')}}">
                <div class="input-boxes">
                <div class="input-box">
                    <i class="fas fa-user"></i>
                    <input @error('name') style="border-bottom: 2px solid #f54254;" @enderror  type="text" value="{{old('name')}}" name="name" placeholder="Họ và tên" required>
                </div>
                @error('name') <div class="text"><p style="color:#f54254; margin-bottom:0">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input @error('email_address') style="border-bottom: 2px solid #f54254;" @enderror  type="email" value="{{old('email_address')}}" name="email_address" placeholder="Email" required>
                </div>
                @error('email_address') <div class="text"><p style="color:#f54254; margin-bottom:0">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-id-card"></i>
                    <input @error('user_name') style="border-bottom: 2px solid #f54254;" @enderror  type="text" value="{{old('user_name')}}" name="user_name" placeholder="Tên đăng nhập" required>
                </div>
                @error('user_name') <div class="text"><p style="color:#f54254; margin-bottom:0">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-key"></i>
                    <input @error('password') style="border-bottom: 2px solid #f54254;" @enderror type="password" name="password" placeholder="Mật khẩu" required>
                </div>
                @error('password') <div class="text"><p style="color:#f54254; margin-bottom:0">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input @error('repeat_password') style="border-bottom: 2px solid #f54254;" @enderror type="password" name="password_confirmation" placeholder="Xác nhận Mật khẩu" required>
                </div>
                @error('repeat_password') <div class="text"><p style="color:#f54254"; margin-bottom:0>{{$message}}</p></div> @enderror
                <div class="input-box">
                    <p style="font-size:20px; color: #63b9db">Bạn là: </p>
                    <div class="radio-select" style="Display:flex; margin-bottom:13px;">
                        <input style="margin-left: 20px; margin-top:5px" type="radio" name="account_type" id="is_student" value="is_student" checked>
                        <label style="text-align: center; margin-left:5px;  white-space: nowrap" for="is_student"> Học sinh</label>
                        <input style="margin-left: 20px; margin-top:5px" type="radio" name="account_type" id="is_teacher" value="is_teacher">
                        <label style="text-align: center; margin-left:5px;  white-space: nowrap" for="is_teacher">Giáo viên</label>
                    </div>
                </div>
                <div class="button input-box">
                    <input type="submit" value="Đăng ký">
                </div>
                <div class="text sign-up-text" style="display: flex;">Đã có tài khoản? <a style="margin-left: 5px;" href="{{route('login')}}">Đăng nhập</a></div>
                </div>
            @csrf()
        </form>
    </div>
@endsection