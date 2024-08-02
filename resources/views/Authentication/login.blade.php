<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Đăng nhập | Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @vite('resources/css/Authentication/style.css')
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
        <div class="front">
            <img src="images/Authentication/frontImg.jpg" alt="">
            <div class="text">
            <span class="text-1">Học tập là việc cả đời <br> Luôn là cơ hội để thành công</span>
            <span class="text-2">Hãy kết nối với chúng tôi</span>
            </div>
        </div>
        </div>
        <div class="forms">
            <div class="form-content">
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
            
        </div>
    </div>
</body>
</html>
