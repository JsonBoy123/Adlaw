@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'Hearing Management','description' => ''])
<div class="container container-div">
    <div class="row ">
       
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text text-why pt-5">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="p-text">
        		Monitoring your hearing dates is a fundamental task. The cumbersome way to do it is to visit the court’s website and then record the details on your phone/computer or a physical file for as long as the case remains open. With Adlaw you can monitor hearing dates with outstanding effectiveness. 
        	</p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/image/case_hearing.png')}}" class="w-100 h-100">
                </div>

                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                <p class="p-text">
                    Its auto synchronization feature instantly captures the new hearing date assigned by the court, and sends you an email and SMS/text message. It filters the hearing dates pertaining to your case only and automatically creates a calendar entry. You don't need to waste time in visiting court websites every time and conducting a search. Do everything once on a single screen from the comfort of your dashboard and keep receiving reminders in a timely manner.         
                </p>    
                
                    <ul class="feature_ul mt-4 p-text">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Hearing Date Create.</li> 
                         {{-- <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Assign user in team.</li>  --}}
                    </ul>

                </div>
            </div>

           {{--  <div class="row">                
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                     In this feature you can create user.
                    <ul class="feature_ul mt-4">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Create User</li> 
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">User last login history</li> 
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">User Assign cases show</li> 
                    </ul>
                </div>
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/profile1.png')}}" class="w-100 h-100">
                </div>
            </div> --}}

        </div>
      <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('features.todo_management')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('features.schedule_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection