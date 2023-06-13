@extends('layouts.default')
@section('title','Contact Us - Lawyers, Law Firm, Law School Portal | Legal Services |Adlaw')
@section('description','Contact us for all legal services or find the best Lawyers, law firms and law schools.')
@section('keywords', 'legal services, find a lawyer, lawyers portal India, find legal advisor, Best Lawyers in India, top lawyers, law firm portal, top lawyers in India, lawyers ranking in India')
@section('content')
@include('layouts.hero_section')

@include('layouts.page_head',['title' => 'CONTACT','description' => 'Do you have any questions? Please do not hesitate to contact us directly. <br> Our team will come back to you within a matter of hours to help you.'])

<div class="container mt-5 pt-5 mb-5  container-div">
      {{-- <div class="row">
        <div class="col-md-12">            
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
              </ol>
            </nav>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-md-12 mb-4">
            <h5 class="font-weight-bold">Contact</h5>
        </div> 
      </div> --}}
  <div class="row">
    <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 col-xl-12 m-auto">
        <div class="row">
        @if (session('message'))
        <div class="alert alert-success col-md-9">
        {{ session('message') }}
        </div>
        @endif
            <!--Grid column-->
        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 mb-4" >
              <div class="card shadow-sm" >

                <div class="card-header bg-white  text-center">
                  <h3 class="font-weight-bold">Get in Touch</h3>
                </div>
                <div class="card-body ">
                  <form id="contact-form"  action="{{route('contact.store')}}" method="POST">
                   {{ csrf_field() }}
                     <div class="row ">
                        <div class="col-md-6 form-group mb-4">
                              <label for="fname" class="font-weight-bold">Your First Name <span class="text-danger">*</span> </label>
                              <input type="text" name="fname" class="form-control input-box" placeholder="Enter First Name" value="{{old('fname')}}"> 
                              @error('fname')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                              @enderror                  
                        </div>
                        <div class="col-md-6 form-group mb-4">
                             <label for="name" class="font-weight-bold">Your Last Name <span class="text-danger">*</span> </label>
                              <input type="text" name="lname" class="form-control input-box" placeholder="Enter last name" value="{{old('lname')}}"> 
                              @error('lname')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                        </div>
                     </div>
                     <div class="row ">
                        <div class="col-md-6 form-group mb-4">
                            <label for="cemail" class=" font-weight-bold">Your Email Address<span class="text-danger">*</span></label>
                            <input type="email" id="email" name="cemail" class="form-control input-box" placeholder="Enter email address" value="{{old('cemail')}}">
                            @error('cemail')
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror  
                        </div>
                        <div class="col-md-6 form-group mb-4">
                              <label for="mobile" class="font-weight-bold">Your Mobile Number <span class="text-danger">*</span></label>
                              <input type="text" id="mobile" name="mobile_no" class="form-control input-box" placeholder="Enter mobile number" value="{{old('mobile_no')}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('mobile')}}">
                              @error('mobile_no')
                                <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror 
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                            <label for="address" class="font-weight-bold">Your Address </label>
                            <textarea class="form-control" name="address" placeholder="Enter your address" rows="2">{{ old('address')}}</textarea> 
                            @error('address')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror 
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                          <label for="message" class="font-weight-bold">Your message</label>
                          <textarea type="text" id="message" name="message" rows="3" class="form-control md-textarea" placeholder="Enter message here...">{{old('message')}}</textarea>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                            <button class="btn btn-md bg-success btn-round" type="submit"> Submit</button>
                        </div>
                     </div>
                    </form>
                  </div>
                
              </div>
            </div>                       
      <div class="col-md-3 text-center">
          <ul class="list-unstyled mb-0">
              <li><i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
                  <p>Adlaw </p>
              </li>

              <li><i class="fa fa-phone mt-4 fa-2x"></i>
                  <p>0731 404 3798</p>
              </li>

              <li><i class="fa fa-envelope mt-4 fa-2x"></i>
                  <p>info@adlaw.in</p>
              </li>
          </ul>
      </div>
<!--Grid column-->

    </div>
  </div>


  </div>
</div>

@endsection
