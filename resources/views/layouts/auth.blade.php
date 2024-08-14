<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Auth')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @vite('resources/css/Authentication/style.scss')
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('styles')
   </head>
   <body>
    <div class="container">
        <div class="cover">
        <div class="front">
            <img src="{{asset('images/Authentication/frontImg.jpg')}}" alt="">
            <div class="text">
            <span class="text-1">Học tập là việc cả đời <br> Luôn là cơ hội để thành công</span>
            <span class="text-2">Hãy kết nối với chúng tôi</span>
            </div>
        </div>
        </div>
        <div class="forms">
            <div class="form-content"> 
                @yield('content')
            </div>
        </div>       
        </div>
    </div>   
   </body>