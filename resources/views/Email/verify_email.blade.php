<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Xác Thực Tài Khoản</h1>
        </div>
        <div class="content">
            <p>Xin chào, <strong>{{$user->name}}</strong> - <strong>{{$user->email_address}}</strong></p>
            <p>Chúc mừng bạn đã đăng ký thành công tài khoản trên hệ thông ECM. Dưới đây là mã xác thực tài khoản của bạn:</p>
            <h3><strong>{{$user->email_verify_token}}</strong></h3>
            <p>Nếu bạn không yêu cầu xác thực này, vui lòng bỏ qua email này.</p>
        </div>
        <div class="footer">
            <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
            <p>&copy; 2024 ECM - Education Center Management.</p>
        </div>
    </div>
</body>
</html>