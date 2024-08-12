@extends('layouts.auth')
@section('title', 'Đăng ký')
@section('content')
    <div class="login-form">
        <div class="title">Đăng ký</div>
            <form method="post" action="{{route('register_store')}}">
                <div class="input-boxes">
                <div class="input-box">
                    <i class="fas fa-user"></i>
                    <input @error('name') class="input-with-errors" @enderror  type="text" value="{{old('name')}}" name="name" placeholder="Họ và tên" required>
                </div>
                @error('name') <div class="text"><p class="p-error">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input @error('email_address') class="input-with-errors" @enderror  type="email" value="{{old('email_address')}}" name="email_address" placeholder="Email" required>
                </div>
                @error('email_address') <div class="text"><p class="p-error">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-id-card"></i>
                    <input @error('user_name') class="input-with-errors" @enderror  type="text" value="{{old('user_name')}}" name="user_name" placeholder="Tên đăng nhập" required>
                </div>
                @error('user_name') <div class="text"><p class="p-error">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-key"></i>
                    <input @error('password') class="input-with-errors" @enderror type="password" name="password" placeholder="Mật khẩu" required>
                </div>
                @error('password') <div class="text"><p class="p-error">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" placeholder="Xác nhận Mật khẩu" required>
                </div>
                <div class="input-box">
                    <p>Bạn là: </p>
                    <div class="radio-select">
                        <input type="radio" name="account_type" id="is_student" value="is_student" checked>
                        <label for="is_student"> Học sinh</label>
                        <input type="radio" name="account_type" id="is_teacher" value="is_teacher">
                        <label for="is_teacher">Giáo viên</label>
                    </div>
                </div>
                <div class="button input-box">
                    <input type="submit" value="Đăng ký">
                </div>
                <div class="text-sign-up-text" >Đã có tài khoản? <a href="{{route('login')}}">Đăng nhập</a></div>
                </div>
            @csrf()
        </form>
    </div>
@endsection