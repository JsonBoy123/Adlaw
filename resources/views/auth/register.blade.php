@extends("layouts.default")

@section('title','Lawyers/Lawfirms Login | Adlaw')
@section('description','Get best CRM for law firms, lawyers and law school in Indore. Our law office management software will offer you to get the best CRM, lawyers, law firms and law schools.')
@section('keywords', 'CRM for law firms, online law office management software, lawyer office software, law CRM software, CRM for law firms, best CRM for lawyers')

@section('content')

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-48209472-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-48209472-2');
</script>
<style type="text/css">
  .blink_me {
      animation: blinker 3s linear infinite;
      /*color: red;*/
      /*background: yellow;*/
      /*text-align: center;  */
  }

  @keyframes blinker {
    50% {
      opacity: 0;
  }
</style>
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'REGISTER','description' => ''])
{{-- Hurry Up !!! Register Now ! <br> Avail promotional offer of profile worth Rs. 4000/- for limited registration --}}
<div class="container container-div">   
  {{--   <div class="row">
        <div class="col-md-12">            
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Register</li>
              </ol>
            </nav>
        </div>
    </div> --}}
    <div class="row mb-5 pt-5">
      <div class="col-md-7 mb-5">
        <div class="card shadow-sm">
          <div class="card-header bg-white p-4">Register</div>
              <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    @if($message = Session::get('Error'))
                        <div class="alert alert-danger">
                           {{$message}}
                        </div>
                    @endif
                    <div class="row">
                        {{-- <label for="user_category" class="col-md-4 col-form-label text-md-right">User Category</label> --}}

                        <div class="col-md-12 form-group mb-4">
                           <select name="user_category" class="form-control input-box" id="user_category"  > 
                            <option value="0">Select User Type</option>
                            @foreach($user_catgs as $user_catg)
                                <option value="{{ $user_catg->id}}" {{old('user_category')== $user_catg->id ? 'selected' : ''}}>{{ $user_catg->display_name}}</option>
                                @endforeach
                           </select>

                            @error('user_category')
                                <span class="help-block text-danger font-size-12">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> --}}

                        <div class="col-md-12 form-group mb-4">
                            <input id="name" type="text" class="form-control input-box @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter Your Name">

                            @error('name')
                              <span class="help-block text-danger font-size-12">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                        <div class="col-md-12 form-group mb-4">
                            <input id="email" type="email" class="form-control input-box @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Your Email Address">

                           @error('email')
                              <span class="help-block text-danger font-size-12">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                    </div>

                     <div class="row">
                        {{-- <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number')}}</label> --}}
                        <div class="col-md-12 form-group mb-4"> 
                            <input type="text" name="mobile" class="form-control input-box @error('mobile') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('mobile')}}" required placeholder="Enter Your Mobile Number">
                            @error('mobile')
                              <span class="help-block text-danger font-size-12">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}
                        <div class="col-md-12 form-group mb-4">
                            <input id="password" type="password" class="form-control input-box @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter Password">

                            @error('password')
                              <span class="help-block text-danger font-size-12">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> --}}

                        <div class="col-md-12 form-group mb-4">
                            <input id="password-confirm" type="password" class="form-control input-box" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>
                    </div>
                   
                    <div class="row {{ $errors->has('captcha') ? ' has-error' : '' }}">
                        <div class=" col-md-12 form-group mb-4">
                            <div class="captcha mb-2">
                                <span>{!! captcha_img('flat') !!}</span>

                                <button type="button" class="btn btn-success btn-refresh ml-4"><i class="fa fa-refresh text-white"></i></button>
                            </div>
                            <input id="captcha" type="text" class="form-control input-box @error('captcha') is-invalid @enderror"  placeholder="Enter Captcha" name="captcha">
                            @error('captcha')
                              <span class="help-block text-danger font-size-12">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                      </div>
                    </div>
                    <div class="row">
                        {{-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Referral Code') }}</label> --}}

                        <div class="col-md-12 form-group mb-4">
                            <input id="referral_code" type="text" class="form-control input-box @error('referral_code') is-invalid @enderror" name="referral_code" value="{{ old('referral_code') ?? (isset($referral_code) ? $referral_code : '')}}"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"  placeholder="Enter Referral Code"  {{isset($referral_code) ? 'readonly="readonly"' : ''}}>

                            @error('referral_code')
                              <span class="help-block text-danger font-size-12">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                    </div>
                    
                    {{-- <div class="row" style="display: none" id="genderDiv">
                         <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender')}}</label>
                         <div class="col-md-6">
                              <select name="gender" class="form-control">
                                  <option value="0">Select Gender</option>
                                  <option value='m'>Male</option>
                                  <option value='f'>Female</option>
                                  <option value='t'>Other</option>
                              </select>

                         </div>
                         @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row" style="display: none" id="dateDiv">
                    
                        <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                        <div class="col-md-6">

                        <input type="date" value="{{old('dob')}}" class="form-control border border-secondary" name="dob">

                        @error('dob')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </div>
                    <div class="row" style="display: none" id="stateDiv">
                        <input type="hidden" name="country_code" value="102">
                         <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
                        <div class="col-md-6">
                            
                            <select class="form-control" name="state_code" id="state">
                                <option value="0"> Select state</option>
                                @foreach($states as $state)
                                <option value="{{ $state->state_code }}">{{ $state->state_name}}</option>
                                @endforeach
                            </select>
                        </div>
                         @error('state_code')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="row" style="display: none" id="cityDiv">
                         <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="city_code" id="city">
                                
                            </select>
                        </div>
                         @error('city_code')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div> --}}

                    <div class="row mb-0">
                        <div class="col-md-12 form-group mb-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
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
                <div class="col-md-12 mb-4">
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
                <div class="col-md-12">
                  <div class="card shadow-sm main-section text-center">
                    <div class="card-body">
                        <h5 class="font-weight-bold">Contact Us</h5>
                        <p class="font-size-13">
                          Do you have any questions? Please do not hesitate to contact us directly.
Our team will come back to you within a matter of hours to help you.
                        </p>
                        <a href="{{route('contact.index')}}" class="btn btn-sm btn-primary">Contact Info</a>

                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
@endsection
