@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
<div class="container container-div">
    <div class="row ">
        <div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2 h2-text">
            <h2 class="h1-responsive font-weight-bold text-center text-uppercase text-white">Course and Batch Management</h2>          
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="p-text">
        		Course and Batch Management feature offered by adlaw is designed for law colleges where they manage batch of students and courses what they provide. This includes the list of all law courses offering by the law colleges. The course name, qualification name, course duration, and syllabus can be added by law colleges. Students can find relevant course, course duration and see the syllabus offered by law colleges. 
        	</p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/course.png')}}" class="w-100 h-100">
                </div>
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                    <ul class="feature_ul ">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Easily create Lawshools courses.</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Courses duration define.</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Batch Management Easily Create.</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Easily update courses details.</li>

                    </ul>
                </div>
            </div>
            <p class="p-text mt-4">
                 The batches can be filtered by batch name, start date, end date where the college management can manage the batches by adding new and update existing. The details can be searched by the course name and qualification name from the search box. 
            </p>


        </div>
      <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('lawschools.agenda_management')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('lawschools.profile_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection