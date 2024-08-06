@extends('layouts.auth')
@section('title', 'Đăng ký')
@section('content')
            <div class="login-form">
                <div class="title">Xác thực Email</div>
                <div class="text sign-up-text">Xin chào {{$user->name}}! Một mã xác thực đã được gửi tới địa chỉ email: {{$user->email_address}} của bạn. Hãy nhập nó để tiến hành xác thực tài khoản nhé!</div>
                <form method="post" action="{{route('email_verify_store', ['id' => $user->id])}}">
                <div class="input-boxes">
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input
                        @if(session('failed_verify')) style="border-bottom: 2px solid #f54254;" @endif
                    id="email_verify_token" name="email_verify_token" value="{{old('email_verify_token')}}" type="text" placeholder="Mã xác thực" required>
                </div>
                @if(session('failed_verify')) <div class="text"><p style="color:#f54254">{{session('failed_verify')}}</p></div> @endif
                <div class="button input-box">
                    <input type="submit" value="Xác nhận">
                </div>
                @csrf()
            </form>
        </div>
@endsection