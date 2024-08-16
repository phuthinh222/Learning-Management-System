@extends('layouts.auth')
@section('title', 'Đăng nhập')
@section('content')
            <div class="login-form">
                <div class="title">Đăng nhập</div>
            <form method="post" action="{{route('login')}}">
                <div class="input-boxes">
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input
                        @if(Session::has('login_error_username')) class="input-with-errors" @endif
                        @if(Session::has('login_error_verify')) class="input-with-errors" @endif
                        @error('user_name') class="input-with-errors" @enderror 
                    id="user_name" name="user_name" value="{{old('user_name')}}" type="text" placeholder="Email hoặc tên đăng nhập">
                </div>
                @if(Session::has('login_error_username')) <div class="text"><p class="p-error">{{Session::get('login_error_username')}}</p></div> @endif
                @if(Session::has('login_error_verify')) <div class="text"><p class="p-error">{{Session::get('login_error_verify')}}</p></div> @endif
                @error('user_name') <div class="text"><p class="p-error">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input @if(Session::has('login_error_password')) class="input-with-errors" @endif id="password" name="password" type="password" placeholder="Mật khẩu">
                </div>
                @if(Session::has('login_error_password')) <div class="text"><p class="p-error">{{Session::get('login_error_password')}}</p></div> @endif
                <div class="text"><a href="#">Quên mật khẩu?</a></div>
                <div class="button input-box">
                    <input type="submit" value="Đăng nhập">
                </div>
                <div class="button input-box">
                    <a href="{{route('google_index')}}" >
                        <i class="fab fa-google"></i>
                        <p>Đăng nhập với Google</p>
                    </a>
                </div>
                <div class="text-sign-up-text">Chưa có tài khoản? <a href="{{route('register')}}">Đăng ký ngay</a></div>
                </div>
                @csrf()
            </form>
        </div>
@endsection