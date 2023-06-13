@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'Schedule Management','description' => ''])

<div class="container container-div">
    <div class="row ">
        
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text text-why pt-5">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="p-text">
        		Adlaw allows law firms to create the schedule for a particular events. Its, not only schedules your clients, but also helps you manage your schedules by adding new or edit existing date. Allocate particular services to specified staff with respect to their designations and create a well functioning work environment. If your office has more than one lawyer or attorney working, add them into your adlaw account and let your clients see who is available at what time. Make time for people who really long you.
        	</p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/image/schedule.png')}}" class="w-100 h-100" alt="Schedule Show">
                </div>

                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                   <p class="p-text">You can see see all your upcoming appointments, your total revenue, your top staff and your top services. This makes it easier for you to analyze for which services appointments are booked the most on specific days and helps you hire more staff.</p>
                    <ul class="feature_ul mt-4 p-text">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" alt="left-arrow">Manage your Scheduling Time</li> 
                         <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" alt="left-arrow">Create your monthly, yearly, every day Scheduling</li> 
                    </ul>

                </div>
            </div>
            
            <p class="p-text mt-4">
            
            </p>


        </div>
       <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('features.hearing_management')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('features.chat_or_messanger')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection