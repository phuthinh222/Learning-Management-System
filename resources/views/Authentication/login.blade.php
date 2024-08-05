@extends('layouts.auth')
@section('title', 'Đăng nhập')
@section('content')
            <div class="login-form">
                <div class="title">Đăng nhập</div>
            <form method="post" action="{{route('login_store')}}">
                <div class="input-boxes">
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input
                        @if(Session::has('login_error_username')) style="border-bottom: 2px solid #f54254;" @endif
                        @if(Session::has('login_error_verify')) style="border-bottom: 2px solid #f54254;" @endif
                        @error('user_name') style="border-bottom: 2px solid #f54254;" @enderror 
                    id="user_name" name="user_name" value="{{old('user_name')}}" type="text" placeholder="Email hoặc tên đăng nhập" required>
                </div>
                @if(Session::has('login_error_username')) <div class="text"><p style="color:#f54254">{{Session::get('login_error_username')}}</p></div> @endif
                @if(Session::has('login_error_verify')) <div class="text"><p style="color:#f54254">{{Session::get('login_error_verify')}}</p></div> @endif
                @error('user_name') <div class="text"><p style="color:#f54254">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input @if(Session::has('login_error_password')) style="border-bottom: 2px solid #f54254;" @endif id="password" name="password" type="password" placeholder="Mật khẩu" required>
                </div>
                @if(Session::has('login_error_password')) <div class="text"><p style="color:#f54254">{{Session::get('login_error_password')}}</p></div> @endif
                <div class="text"><a href="#">Quên mật khẩu?</a></div>
                <div class="button input-box">
                    <input type="submit" value="Sumbit">
                </div>
                <div class="button input-box">
                    <a href="{{route('google_index')}}" >
                        <i class="fab fa-google" style="color: #fff;margin-right: 15px"></i>
                        <p>Đăng nhập với Google</p>
                    </a>
                </div>
                <div class="text sign-up-text" style="display: flex;">Chưa có tài khoản? <a style="margin-left: 5px;" href="{{route('register')}}">Đăng ký ngay</a></div>
                </div>
                @csrf()
            </form>
        </div>
@endsection