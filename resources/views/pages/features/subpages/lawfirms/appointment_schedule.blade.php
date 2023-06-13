@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'Appointment Schedule Management','description' => ''])

<div class="container container-div">
    <div class="row ">
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text pt-5">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="p-text text-why">
        		Online appointment booking system make your life stress free by creating a platform through which your clients can schedule their appointments directly. Adlaw allows the appointment schedule management feature that, It not only schedules your clients, but also helps you manage your schedules by adding new or edit existing date. Allocate particular services to specified staff with respect to their designations and create a well-functioning work environment.
        	</p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/image/appointment-schedule.png')}}" class="w-100 h-100" alt="Appointment Schedule Show">
                </div>

                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                   <p class="p-text text-why">
                       If your office has more than one lawyer or attorney working, add them into your adlaw account and let your clients see who is available at what time. Make time for people who really long you. 
                   </p>
                    <ul class="feature_ul mt-4 p-text text-why">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" alt="left-arrow">Manage your Scheduling Time</li> 
                    </ul>

                </div>
            </div>
            <div class="row">                
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                   <p class="p-text text-why" >
                       If your office has more than one lawyer or attorney working, add them into your adlaw account and let your clients see who is available at what time. Make time for people who really long you. 
                   </p>
                    <ul class="feature_ul mt-4 p-text text-why">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" alt="left-arrow">You can also confirmed appointment</li> 
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" alt="left-arrow">You can see unconfirmed appointment</li> 
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" alt="left-arrow">You can also cancelled appointment</li> 
                    </ul>
                </div>
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/image/appointment.png')}}" class="w-100 h-100" alt="Appointment Confirmation">
                </div>
            </div>
            <p class="p-text text-why mt-4">
            
            </p>


        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('features.document_management')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('features.agenda_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection