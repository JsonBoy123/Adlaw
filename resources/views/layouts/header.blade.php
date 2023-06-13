<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <title>Adlaw</title> -->
    <meta charset="utf-8">
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name = "yandex-verification" content ="fd5fd18d4ad9d2c5" />
    {{--<link rel="canonical" href="https://www.adlaw.in/"/>--}}
    <meta name="google-site-verification" content="2iDNtR3LqBEDPUP45mwIXtE6a1XdOf7y9cz8TRGqxB0" />
    <meta name="msvalidate.01" content="6F506835CAC88EA43F48320DD4F03DF3" />
    <title>@yield('title','ADLAW')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title','ADLAW')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:url" content="http://www.adlaw.in/" />
    <meta property="og:site_name" content="Adlaw" />
    <link rel = "icon" href ="{{asset('images/adlaw-logo.png')}}" alt="Adlaw" type = "image/x-icon" style="line-height: 40px;">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/topbar.css') }}" />

    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/find_city_lawyer.css') }}" /> 
    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/find_research_platform.css') }}" />
    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/footer.css') }}" />
    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/lawyer_profile_backup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/star-rating-svg.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard/search_all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard/btn-social.css')}}">
    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/font-size.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    {{-- <link rel="stylesheet" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"> --}}
    
    <link href="https://cdn.jsdelivr.net/sweetalert2/4.2.4/sweetalert2.min.css" rel="stylesheet"/>
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-48209472-2"></script>

<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body >

<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="fa fa-envelope"></i> <a href="mailto:contact@example.com">info@adlaw.in</a>
        <i class="fa fa-phone"></i> 0731 404 3798
        <i class="fa fa-map-marker"></i> Laxyo House, County Park, Indore
      </div>
      <div class="social-links">
        <a href="https://www.facebook.com/Adlaw-109225687182044/?modal=admin_todo_tour" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="https://twitter.com/adlaw6" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="https://www.linkedin.com/in/adlaw-in-7b9632187/" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
  </div>
<nav class="navbar navbar-expand-xl menunav p-0 fixed-top bg-color-mobile" >
    <div class="container">
      <a class="navbar-header" href="{{url('/')}}">
        <img src="{{asset('images/adlaw-logo.png')}}" alt="Adlaw" id="beforeScrollLogo">
      </a>

      <a href="javascript:void(0)" class="nav-link ped-4 searchHeader navbar-toggler ml-auto font-size-15 text-white" ata-toggle="collapse" data-target="#collapsibleNavbar"><i class="fa fa-search" ></i> SEARCH</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon text-white"><i class="fa fa-bars" aria-hidden="true"></i></span>
      </button>
      <div class="collapse navbar-collapse " id="collapsibleNavbar">
        <ul class="nav navbar-nav ml-auto customNav">
            <li class="nav-item {{Request()->segment(1) == '' ? 'active_class' : '' }}">
                <a href="{{route('/')}}"  class="nav-link ped-4">HOME</a>
            </li> 

            <li class="nav-item dropdown ">
                <a class="ped-4 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  ABOUT
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{route('about_us')}}">ABOUT</a>
                  <a class="dropdown-item" href="{{route('why_adlaw')}}">Why ADLAW?</a>
                </div>
            </li>
           {{--  <li class="nav-item">
                <a href="{{route('about_us')}}"  class="nav-link ped-4">ABOUT</a>
            </li>  --}}
            <li class="nav-item">
                <a href="{{route('faqs')}}"  class="nav-link ped-4">FAQs</a>
            </li> 

            <li class="nav-item dropdown">
              <a class="ped-4 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                SERVICES
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('lawfirms')}}">LAWYERS/LAW FIRMS</a>
                <a class="dropdown-item" href="{{route('search')}}">COMPANY/OTHER LAW USERS</a>
                <a class="dropdown-item" href="{{route('lawschools')}}">LAW SCHOOLS/STUDENTS</a>
              </div>
            </li>

           {{--  <li class="nav-item {{Request()->segment(1) == 'about-us' ? 'active_class' : '' }}">
                <a href="{{route('about_us')}}"  class="ped-4 nav-link" >ABOUT</a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a href="#" class="nav-link p-3">Why ADLAW?</a></li>
                    <li class="nav-item"><a href="#" class="nav-link p-3">More</a></li>
                </ul>
            </li>
            <li class="nav-item {{Request()->segment(1) == 'why-adlaw' ? 'active_class' : '' }}">
                <a href="{{route('why_adlaw')}}"  class="nav-link ped-4">WHY ADLAW</a>
            </li> --}}
         {{--    <li class="nav-item {{Request()->segment(2) == 'lawfirms' ? 'active_class' : '' }}">
                <a class="nav-link ped-4 " href="{{route('lawfirms')}}">LAWYERS/LAW FIRMS </a>
            </li>

            <li class="nav-item {{Request()->segment(2) == 'search' ? 'active_class' : '' }} ">
                <a class="nav-link ped-4" href="{{route('search')}}">COMPANY/OTHER LAW USERS</a>
            </li>
            <li class="nav-item {{Request()->segment(2) == 'lawschools' ? 'active_class' : '' }} ">
                <a class="nav-link ped-4" href="{{route('lawschools')}}">LAW SCHOOLS/STUDENTS</a>
            </li> --}}
            <li class="nav-item {{Request()->segment(1) == 'contact' ? 'active_class' : '' }}">
                <a href="{{route('contact.index')}}" class="nav-link ped-4">CONTACT</a>
            </li> 
            @guest
            <li class="nav-item">
                <a href="{{route('login')}}" class="nav-link ped-4">LOGIN</a>
            </li>
            @endguest

            @guest
            <li class="nav-item">
                <a href="{{route('register')}}" class="nav-link ped-4">REGISTER</a>
            </li>
            @endguest

            @if(Auth::user())
            <li class="nav-item dropdown ">
              <a class="dropdown-toggle nav-link ped-4" href="{{route('register')}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(Auth::user()->photo !='')
                <img src="{{ asset('storage/profile_photo/'.Auth::user()->photo)}}"  style="width: 33px; height: 29px;" class="" />
                @else
                <img src="{{asset('storage/profile_photo/default.png')}}"  style="width: 33px; height: 29px;" class="rounded-circle" />
                @endif
              </a>
              <ul class="dropdown-menu " style=" left:-45px;">
                <li class="nav-item">
                  <a class="nav-link p-3 text-dark"  href="{{route('login')}}">{{ __('Dashboard') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link p-3 text-dark" href="#">{{ __('Messages') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link p-3 text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
              </ul>
            </li>
            @endif

             <li class="nav-item"> <a href="javascript:void(0)" class="nav-link ped-4 searchHeader"><i class="fa fa-search"></i> SEARCH</a></li>

            </ul>
        </div> 
    </div>
</nav>
<div class="modal" tabindex="-1" role="dialog" id="searchModal">
  <div class="modal-dialog modal-dialog-custom" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <form  action="{{route('search')}}" method="get" autocomplete="off">
            @csrf
          <div class="row">
              <div class="col-md-12">
                  <div class="input-group">
                      <input type="text" name="user_name" class="form-control input-box" placeholder="Select from 2,00,000 + lawyers across 650 + Cities in India" aria-describedby="basic-addon2" id="model_user_name">
                      <div class="input-group-append">
                        <button class="btn  btn-primary text-black" type="submit">Search</button>
                      </div>
                    </div>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>