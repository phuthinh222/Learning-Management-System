@extends('layouts.auth')
@section('title', 'Đăng ký')
@section('content')
    <div class="login-form">
        <div class="title">Đăng ký</div>
            <form method="post" action="{{route('register')}}">
                <div class="input-boxes">
                <div class="input-box">
                    <i class="fas fa-user"><span class="text-danger" > * </span></i>
                    <input @error('name') class="input-with-errors" @enderror  type="text" value="{{old('name')}}" name="name" placeholder="Họ và tên">
                </div>
                @error('name') <div class="text"><p class="p-error">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-envelope"><span class="text-danger" > * </span></i>
                    <input @error('email_address') class="input-with-errors" @enderror  type="text" value="{{old('email_address')}}" name="email_address" placeholder="Email">
                </div>
                @error('email_address') <div class="text"><p class="p-error">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-id-card"><span class="text-danger" > * </span></i>
                    <input @error('user_name') class="input-with-errors" @enderror  type="text" value="{{old('user_name')}}" name="user_name" placeholder="Tên đăng nhập">
                </div>
                @error('user_name') <div class="text"><p class="p-error">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-key"><span class="text-danger" > * </span></i>
                    <input @error('password') class="input-with-errors" @enderror type="password" name="password" placeholder="Mật khẩu">
                </div>
                @error('password') <div class="text"><p class="p-error">{{$message}}</p></div> @enderror
                <div class="input-box">
                    <i class="fas fa-lock"><span class="text-danger" > * </span></i>
                    <input type="password" name="password_confirmation" placeholder="Xác nhận Mật khẩu">
                </div>
                <div class="input-box">
                    <p>Bạn là: </p>
                    <div class="radio-select">
                        <input type="radio" name="account_type" id="is_student" value="is_student" {{ old('account_type', 'is_student') == 'is_student' ? 'checked' : '' }}>
                        <label for="is_student"> Học sinh</label>
                        <input type="radio" name="account_type" id="is_teacher" value="is_teacher" {{ old('account_type') == 'is_teacher' ? 'checked' : '' }}>
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