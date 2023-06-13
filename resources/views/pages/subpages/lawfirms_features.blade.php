@extends("layouts.default")

@section('title','Top Legal Firms in India | Best Corporate Law Firm | Top 5 Law Firms | Adlaw')
@section('description','Find best corporate law firm, among the top Indian law firms. Adlaw helps the users to get best legal firm for all law related services.')
@section('keywords','top 5 law firms in India, Law Firms In India, list of law firm in India, top Indian legal firms, best corporate law firm in India, top legal firms in India, top Indian law firms')
@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'LAWYER / LAWFIRMS FEATURES','description' => 'Featured CRM Solutions For Lawyer / Law Firms !'])

<div class="container-fluid container-div">        
        <div class="row col-sm-12 col-lg-12 col-xs-12 mb-5 pt-5">
        	{{-- image div  --}}
        	<div class="col-md-6 p-5">
        		<img src="{{asset('images/Lawyer-LawFirms.png')}}" alt="Lawyer-LawFirms in India" style="height:100%; width: 100%;">
        	</div>
        	{{-- content div --}}
        	<div class="col-sm-6 col-lg-6 col-md-6" >
                <h4 class="font-weight-bold text-captialize mt-2 mb-2">Featured CRM Solutions For Lawyer / Law Firms !</h4>
                <br>
        		<p class="p-text text-why">                
                    When it comes to lawyer’s requirements/necessities, our easy-to-use CRM solution for Lawyer / Law Firms allows you to keep record all your record confidential for better output of team members. It improvise your team’s work effectively. With Adlaw, you’ll have all the data you need to coach your team to success. Lawyers or Law Firms can have all details on one click in real-time. No matters where you are. You can discharge your obligation at your ease with roaming office facilities. With the help of Adlaw CRM you can get a complete case management solution, manage your Scheduling Time, Daily service report, information of team members, hearing date details for the lawyers/law firms to assign priorities, build momentum, collaborate without confusions and ensure that action steps are taken on time, every time. If not, don’t worry, Adlaw will remind you. 
                </p>
                <p class="p-text text-why">
                    This CRM will ensure in essential to manage work load effectively, helping you and your team members stay focused and organized. Adlaw offers a secure way to manage your client relationships and cases. You can access it from anywhere, share information and extract historical information into analytics reports that will help you continually improve the profitability of your law firm.
                </p>
                <p class="p-text text-why">    
                    We provide you an integrated law CRM solution that does all the management work for you. Regardless of whether you need to catch up with key contacts all the more consistently, streamline intake to convert more leads into clients, effective and confidential management of your data, or just get back some of your valuable time. We make your work more easy and efficient because of our professional approach and our constant improvements.
                    Adlaw has everything you need to organize, track, and nurture your work.
                </p>  
        	</div>
        </div>
</div>

  <section class="border-bottom bg-light" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <h2 class="font-weight-bold text-center text-captialize">All Features</h2>
                <span class="span-line mt-4 mb-4"></span>
                    
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-4 my-5">
                 <a href="{{route('features.case_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/case3.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Case Diary Management</h4>
                            
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.client_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/users.jpg')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Client Management</h4>
                         
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.calendar_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/calendar.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Calendar Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.document_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/document.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Document Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.appointment_schedule')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/appointment11.jpg')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Appointment Schedule Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.agenda_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/agenda2.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">DSR Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.team_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/teams.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Team Members Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.profile_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/profile.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Profile Management</h4>
                           
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.todo_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/todos1.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">To-Dos Management</h4>
                        </div>
                    </div>
                </a>
                </div>

                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.hearing_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/gavel.jpg')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Hearing Date Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.schedule_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/appointment.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Schedule Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.chat_or_messanger')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/chat1.jpg')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Messaging</h4>
                        </div>
                    </div>
                </a>
                </div>

            </div>
        </div>
  </section>

@endsection