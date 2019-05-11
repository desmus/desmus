<!doctype html>

<html lang="{{ app()->getLocale() }}">
    
  <head>
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Desmus </title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <style>
            
      html, body {
        /*background-color: #fff;*/
        background-image: url(/images/background_4.jpeg);
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* Do not repeat the image */
        background-size: 68%;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
      }

      .full-height {
        height: 100vh;
      }

      .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
      }

      .position-ref {
        position: relative;
      }

      .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
      }

      .content {
        text-align: center;
      }

      .title {
        font-size: 84px;
        border-bottom: 1px solid rgba(255,255,255,0.2);
      }

      .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
      }

      .m-b-md {
        margin-bottom: 20px;
      }
        
    </style>
    
  </head>
    
  <body>
        
    <div class="flex-center position-ref full-height">
            
      @if (Route::has('login'))
                
        <div class="top-right links">
                    
          @auth
                        
            <a href="{{ url('/home') }}">Home</a>
                    
              @else
                        
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                    
          @endauth
                
        </div>
            
      @endif

      <div class="content" style="background: rgba(0,0,0,0.7); color: #fff; width: 90%; padding: 10% 2%;">
                
        <div class="title m-b-md">
                    
          Desmus
          <!--<p style = 'font-size: 15px'> A new way to organize your information </p>-->
                
        </div>

        <div class="links">
          <a href="" style="color: #fff;">About</a>
          <a href="" style="color: #fff;">Community</a>
          <a href="" style="color: #fff;">Contact</a>
        </div>
      
      </div>
        
    </div>
    
  </body>

</html>