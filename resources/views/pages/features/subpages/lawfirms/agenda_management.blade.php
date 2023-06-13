@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'Daily Service Report Management','description' => ''])

<div class="container container-div ">
    <div class="row ">
       
        <div class="col-sm-12 col-lg-12 col-xs-12 pt-5 feature-p-text">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="p-text text-why">
        		Daily Service Report Management allows the lawyers/law firms to assign priorities, build momentum, collaborate without confusions and ensure that action steps are taken on time, every time. They are also essential to manage work overload effectively, helping you and your team members stay focused and organized. Beyond the cases, Daily Service Report help in strengthening the efficiency of day-to-day firm operations while also positively influencing individual productivity. They play an important role in enabling lawyers and law firms to produce the results they seek. 

        	</p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4 ">
                    <img src="{{asset('images/dashboard/image/agenda_add.png')}}" class="w-100 h-100" alt="DSR create">
                </div>

                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                <p class="p-text text-why">
                    In this feature you can Create any number of Daily Service Report, Link tasks to cases, Set calendar deadlines, Assign tasks to team members, View pending, upcoming and completed tasks, Set email and/or SMS reminders to your own frequencies for the exact alerts you want and Edit or delete tasks as needed.
                </p>
                    <ul class="feature_ul mt-4 text-why p-text">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" alt="left-arrow">Manage your Daily Service Report</li> 
                         <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" alt="left-arrow">Crearte number of Daily Service Report</li> 
                         <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" alt="left-arrow">Daily Service Report used for as attendance purpose.</li> 

                    </ul>

                </div>
            </div>
            <div class="row">                
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                     <p class="p-text text-why">In this feature you can submit your Daily Service Report. you can also show your today Daily Service Report and overall Daily Service Report</p>
                    <ul class="feature_ul mt-4 text-why p-text">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" alt="left-arrow">You can create DSR time easily </li> 
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" alt="left-arrow">Response can be filled before the time, after that you cannot reply.</li> 
                      
                    </ul>
                </div>
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4 ">
                    <img src="{{asset('images/dashboard/image/agenda.png')}}" class="w-100 h-100" alt="DSR Response Show">
                </div>
            </div>
            <p class="p-text text-why mt-4">
            
            </p>


        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('features.appointment_schedule')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('features.team_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection