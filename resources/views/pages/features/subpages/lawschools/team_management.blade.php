@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
<div class="container container-div">
    <div class="row ">
        <div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2 h2-text">
            <h2 class="h1-responsive font-weight-bold text-center text-uppercase text-white">Team Management</h2>          
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="p-text">
        		Team management is a critical part of organizing and keeping track of team assigned by the management. It means of ensuring role-based access and control, ensuring that the required levels of privacy and collaboration are facilitated clearly. Adlaw’s team management feature is allows the college management to create the team of students or college faculties or individual profile and search them by name. In this dashboard the user also can be created one by one and check their login history. 
        	</p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/team.png')}}" class="w-100 h-100">
                </div>
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                    <ul class="feature_ul ">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Add any number of clients easily</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Easily maintain Indiviual and Corporate Client</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Client related cases maintain</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Client related cases maintain</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Client related cases maintain</li>
                    </ul>
                </div>
            </div>
            <div class="row">                
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                   <p class="p-text">
                        User or student can find the law colleges by name anywhere and get full profile details of law colleges, courses and other information related law education. 
                   </p>
                </div>
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/team1.png')}}" class="w-100 h-100">
                </div>
            </div>
            <p class="p-text mt-4">
                 Team manager can form perceptions about your firm from various things, from how you handle your team members and deal with them.
            </p>


        </div>
       <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('lawschools.document_management')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('lawschools.agenda_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection