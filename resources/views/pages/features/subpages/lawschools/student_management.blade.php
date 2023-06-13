@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
<div class="container container-div">
    <div class="row ">
        <div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2 h2-text">
            <h2 class="h1-responsive font-weight-bold text-center text-uppercase text-white">Student Management</h2>          
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text">
            {{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
            <p class="p-text">
                Adlaw provide student login or profile in Student Management feature where law college can create students profile to appear the law courses and syllabus on the dashboard. Student dashboard includes the list of students with status such as pursuing, pass out or dropout from the course. It allows the details option of students in which Enrollment Number, Roll Number, Student Name, Qualification, Course Year of Admission, Semester Batch includes and filter the results accordingly. Law colleges also can manage the students with their profile or relevant courses they are doing, upload the student data (in which all the details of students included) on the portal and store the record of students.  
            </p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/student.png')}}" class="w-100 h-100">
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
                    <img src="{{asset('images/dashboard/student1.png')}}" class="w-100 h-100">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/student2.png')}}" class="w-100 h-100">
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
                    <img src="{{asset('images/dashboard/student3.png')}}" class="w-100 h-100">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/student4.png')}}" class="w-100 h-100">
                </div>

                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                <p class="p-text">
                   Adlaw offers profile management in which law colleges can create their profile, with all the details includes college name, date of registration, contact, e-mail address and prospectus etc. The created law colleges profile will be shown in search box as a result where user search for the law colleges. 
                </p> 
                </div>
            </div>
            <p class="p-text mt-4">
            
            </p>


        </div>
       <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('lawschools.profile_management')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('lawschools.document_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection