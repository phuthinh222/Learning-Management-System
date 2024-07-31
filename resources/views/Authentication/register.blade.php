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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="list-style:none; padding-left:0">
                            @foreach ( $errors->all() as $error )
                                <li style="margin-left:0">{{ $error }}</li>                            
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('register_error'))
                    <div class="alert alert-danger">
                        <ul style="list-style-type:none">
                            <li>{{Session::get('register_error')}}</li>
                        </ul>
                    </div>
                @endif
                <div class="title">Đăng ký</div>
                <form method="post" action="{{route('register_store')}}">
                <div class="input-boxes">
                <div class="input-box">
                    <i class="fas fa-user"></i>
                    <input type="text" value="{{old('name')}}" name="name" placeholder="Họ và tên" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input type="email" value="{{old('email_address')}}" name="email_address" placeholder="Email" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-id-card"></i>
                    <input type="text" value="{{old('user_name')}}" name="user_name" placeholder="Tên đăng nhập" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-key"></i>
                    <input type="password" name="password" placeholder="Mật khẩu" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="repeat_password" placeholder="Xác nhận Mật khẩu" required>
                </div>
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
            <div class="signup-form">
            <div class="title">Đăng ký</div>
        </div>
        </div>
        </div>
    </div>
</body>
</html>
