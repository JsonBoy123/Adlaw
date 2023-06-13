@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'To-dos Management','description' => ''])

<div class="container container-div">
    <div class="row ">        
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text text-why pt-5">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="p-text">
        		To-dos are effective way to assign priorities, build momentum, collaborate without confusions and ensure that action steps are taken on time, every time. They are fundamental to oversee work over-burden adequately, helping you and your colleagues remain engaged and composed.  
        	</p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/image/todo.png')}}" class="w-100 h-100">
                </div>

                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
               <p class="p-text">
                    Beyond your cases, to-dos help in strengthening the efficiency of day-to-day firm operations while also positively influencing individual productivity. They play an important role in enabling lawyers and law firms to produce the results they seek. In this you can Create any number of to-do tasks, Link tasks to cases, Assign tasks to team members, Set calendar deadlines, view pending, upcoming and completed tasks and Edit or delete tasks as needed.
               </p>
                   {{--  <ul class="feature_ul mt-4">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Easily team create.</li> 
                         <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Assign user in team.</li> 
                    </ul> --}}

                </div>
            </div>

          {{--   <div class="row">                
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
            <a href="{{route('features.profile_management')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('features.hearing_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection