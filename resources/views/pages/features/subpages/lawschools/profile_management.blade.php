@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
<div class="container container-div">
    <div class="row ">
        <div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2 h2-text">
            <h2 class="h1-responsive font-weight-bold text-center text-uppercase text-white">Profile Management</h2>          
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text">
            {{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
            <!-- <p class="text-justify">
                Online appointment booking system make your life stress free by creating a platform through which your clients can schedule their appointments directly. Adlaw allows the appointment schedule management feature that is It, not only schedules your clients, but also helps you manage your schedules by adding new or edit existing date. Allocate particular services to specified staff with respect to their designations and create a well functioning work environment.
            </p> -->

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/profile.png')}}" class="w-100 h-100">
                </div>

                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                <p class="p-text">
                    Adlaw offers profile management in which law colleges can create their profile, with all the details includes college name, date of registration, contact, e-mail address and prospectus etc. The created law colleges profile will be shown in search box as a result where user search for the law colleges.
                </p>
                </div>
            </div>
            <div class="row">                
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                <p class="p-text">
                    User or student can find the law colleges by name anywhere and get full profile details of law colleges, courses and other information related law education. 
                </p>   
                </div>
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/profile1.png')}}" class="w-100 h-100">
                </div>
            </div>
            <p class="text-justify mt-4">
            
            </p>


        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('lawschools.course_management')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('lawschools.student_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection