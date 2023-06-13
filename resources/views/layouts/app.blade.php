<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
     <meta name="google-site-verification" content="2iDNtR3LqBEDPUP45mwIXtE6a1XdOf7y9cz8TRGqxB0" />
    <link rel = "icon" href ="{{asset('images/adlaw-logo.png')}}" type = "image/x-icon" style="line-height: 40px;">
    <!-- Styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','ADLAW')</title>

    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     {{-- {!! NoCaptcha::renderJs() !!} --}}
     <script async src="https://www.googletagmanager.com/gtag/js?id=UA-48209472-2"></script>


     <style type="text/css">
  .blink_me {
  animation: blinker 4s linear infinite;
  color:red;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
</style>
     
</head>
<body>
    <div id="app">
        {{--   <nav class="navbar navbar-expand-xl menunav p-0 fixed-top" >
          <div class="container-fluid">
              <a class="navbar-header p-1" href="{{url('/')}}"><img src="{{asset('images/adlaw-logo.png')}}" alt="Adlaw" style="width: 90px;"></a>

              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon text-white'"><i class="fa fa-bars" aria-hidden="true"></i></span>
              </button>
            <div class="collapse navbar-collapse " id="collapsibleNavbar">

 --}}

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('images/adlaw-logo.png')}}" alt="Adlaw" style="width: 70px;">
                    
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('/') }}">{{ __('Home') }}</a>
                        </li>
                        @guest
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script >
   $(document).ready(function(){
        $(".btn-refresh").click(function(){

            $.ajax({
             type:'GET',

             url:'/refresh_captcha',

             success:function(data){
                $(".captcha span").html(data.captcha);
             }
            });

        });

   });

</script>
</body>
</html>
