@extends("layouts.default")

@section('title','Lawyers/Lawfirms Login | Adlaw')
@section('description','Get best CRM for law firms, lawyers and law school in Indore. Our law office management software will offer you to get the best CRM, lawyers, law firms and law schools.')
@section('keywords', 'CRM for law firms, online law office management software, lawyer office software, law CRM software, CRM for law firms, best CRM for lawyers')

@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'LOGIN','description' => ''])

<div class="container container-div">   
    {{-- <div class="row">
        <div class="col-md-12">            
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
              </ol>
            </nav>
        </div>
    </div> --}}
    <div class="row mb-5 pt-5" >
        <div class="col-md-7 mb-5">
            <div class="card shadow-sm">
                <div class="card-header p-4 bg-white ">{{ __('Login') }}</div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}" autocomplete="off" autofocus="off">
                        {{ csrf_field()}}
                        @if($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{$message}}
                            </div>
                        @endif

                        @if($message = Session::get('warning'))
                            <div class="alert alert-warning">
                                   {{$message}}
                            </div>
                        @endif
           
                        <div class="row">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail or Mobile Number') }}</label> --}}

                            <div class="col-md-12 form-group mb-4">
                                <input id="email" type="text" class="input-box form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus placeholder="Enter Your Email Address or Mobile Number">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-12 form-group  mb-4">
                                <input id="password" type="password" class="input-box form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Your Password" required autocomplete="off">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                       {{--  <div class="form-group">
                            <div class="col-md-6 offset-md-4">  
                         
                                  {!! NoCaptcha::renderJs() !!}
                                  {!! NoCaptcha::display() !!}
                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                            </div>
                        </div> --}}
                      {{--   <div class="form-group row {{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <div class="col-md-6 offset-md-4">
                                <div class="captcha mb-2">
                                    <span>{!! captcha_img('flat') !!}</span>

                                    <button type="button" class="btn btn-success btn-refresh ml-4"><i class="fa fa-refresh text-white"></i></button>
                                </div>
                                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                @error('captcha')
                                  <span class="help-block text-danger">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                          </div>
                      </div> --}}


                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link pull-right font-sm" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-5">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm main-section text-center">
                        <div class="card-body">
                            <h5 class="font-weight-bold">It’s secure and confidential</h5>
                            <p class="font-size-13">The information provided on Adlaw.in is provided AS IS, subject to <a href="{{route('tos')}}" class="text-primary">Terms of Use</a> & <a href="{{route('privacy_policy')}}" class="text-primary">Privacy Policy</a>. It is solely available at your request for informational purposes only, should not be interpreted as soliciting or advertisement. In cases where the user has any legal issues, he/she in all cases must seek independent legal advice.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card shadow-sm main-section text-center">
                        <div class="card-body">
                            <h5 class="font-weight-bold">About ADLAW</h5>
                            <p class="font-size-13">
                                Our aim to establish Adlaw is to make an interactive online platform that makes it faster and easier to discover and employ top-rated lawyers, law school and law company. 
                            </p>
                            <a href="{{route('about_us')}}" class="btn btn-sm btn-primary">More Info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
