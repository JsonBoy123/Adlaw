<section class="py-1 border-bottom bg-light" >
    <h1 class="font-weight-bold text-center text-captialize">Company / Other Law Users Features</h1>
     <span class="span-line mt-4 mb-4"></span>
     <br>
   {{--  <p class="text-muted text-center" >
    Everything you need to manage your account.

    </p> --}}
  {{--   <p class="text-muted text-center"></p> --}}
    <div class="container">
        <div class="row" align="center">
            {{-- <div class="col-md-3 mb-4">
                <h4 class="font-weight-bold">Profile</h4>
                <p class="p-text">
                {{str_limit('Adlaw offers profile management in which user can create their profile, update and deactivate the profile whether user is a guest, lawyer or law intern. In the profile users can put all the detail about their area of specialization and relevant cases.',$limit = 250, $end = '...')}}              
                </p>                
                <a href="{{route('guest.profile_management')}}" class="btn btn-sm btn-info">More Info</a>
            </div> --}}
            <div class="col-md-4 mb-4">
                <a href="{{route('search')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/search.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Search Lawyer / Law Firms </h4>
                            <p class="p-text">
                              Search and find lawyer, law school or law firm near you, No matter where you are located.
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/calendar.jpg')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Calendar</h4>
                            <p class="p-text">
                            Adlaw helps you monitor what's going in your cases on one convenient, central calendar so nothing slips through the cracks.
                            </p>
                      
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/case-rel.jpg')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Case Related Information</h4>
                            <p class="p-text">
                            Once you have a list of cases, you can sort and view by ‘running’, ‘closed’ or ‘transferred/NOC’ filters.
                            </p>
                      
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>
            {{-- <div class="col-md-3 mb-4">
                <h4 class="font-weight-bold">Reviews to Lawyer / Law Firms and LawSchools</h4>
                <p class="p-text">
                {{str_limit("Adlaw helps you monitor what's going in your cases on one convenient, central calendar so nothing slips through the cracks. User can see occasions to specific cases created by lawyer or law firm. So whether it’s an upcoming court date or statement, to-dos, hearing sessions morning or evening etc. The Adlaw Calendar ensures you’re always prepared.",$limit = 224, $end = '...')}}  
                
                </p>
                <a href="" class="btn btn-sm btn-info">More Info</a>
            </div> --}}

            <div class="col-md-4 mb-4">
                <a href="" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/appointment.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Book An Appointment</h4>
                            <p class="p-text">
                            After finding a relevant law firm, lawyer or law school user can book appointment accordingly and see the status of appointment whether it is confirmed pending or canceled. 
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>
           {{--  <div class="col-md-4 mb-4 ">
                <a href="{{route('features.calendar_management')}}" class="feature-link">
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/calendar.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Calendar management</h4>
                            <p class="p-text">
                                Managing an organized law firm is challenging without visibility into your staff’s schedule. 
                            </p>
                         </div>
                         <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div> --}}
            <div class="col-md-4 mb-4 ">
                <a href="{{route('features.document_management')}}" class="feature-link">
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/document.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Document Management</h4>
                            <p class="p-text">
                                It allows professionals to write the cases in word processing software and store the files with specifically labeled meta-data. With the adlaw Dropbox combination.
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">    
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>

      
            <div class="col-md-4 mb-4 ">
                <a href="{{route('features.appointment_schedule')}}" class="feature-link">
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/appointment11.jpg')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Appointment Schedule Management</h4>
                            <p class="p-text">
                            Online appointment booking system make your life stress free by creating a platform through which your clients can schedule their appointments directly.
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>
          
            <div class="col-md-4 mb-4 ">
                <a href="{{route('features.agenda_management')}}" class="feature-link">
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/agenda2.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">DSR Management</h4>
                            <p class="p-text">
                            Daily Service Report Management allows the lawyers/law firms to assign priorities and ensure that action steps are taken on every time. 
                            </p>
                        </div>
                         <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4 ">
                <a href="{{route('features.team_management')}}" class="feature-link">
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/teams.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Team Members Management</h4>
                            <p class="p-text">
                            Adlaw's team members management feature used to create new user, edit and delete user.
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4 ">
                <a href="{{route('features.profile_management')}}"  class="feature-link">
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/profile.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Profile Management</h4>
                            <p class="p-text">
                            Adlaw offers profile management in which lawyers can create their profile, update and delete the profile. 
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>            
            <div class="col-md-4 mb-4 ">
                <a href="{{route('features.todo_management')}}" class="feature-link">
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/todos1.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">To-Dos Management</h4>
                            <p class="p-text">
                            To-dos are a viable way to assign priorities, gather speed, work together that move steps are made on schedule, every time.    
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>

            {{-- <div class="col-md-4 mb-4 ">
                <a href="{{route('features.hearing_management')}}" class="feature-link">
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/course.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Hearing Date Management</h4>
                            <p class="p-text">
                            To keep track of your hearing dates adlaw offer hearing date management system.
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div> --}}

            <div class="col-md-4 mb-4 ">
                 <a href="{{route('features.schedule_management')}}" class="feature-link">
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/appointment.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                        <h4 class="font-weight-bold">Schedule Management</h4>
                            <p class="p-text">
                            Adlaw allows law firms to create the schedule for a particular events. 
                            </p>  
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4 ">
                <a href="{{route('features.chat_or_messanger')}}" class="feature-link">
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/chat1.jpg')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                       
                        <h4 class="font-weight-bold">Messaging</h4>
                        <p class="p-text">
                            Adlaw offer to Messaging System. You easily reply your lawyer and client message.           
                        </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
         
           {{--  <div class="col-md-3 mb-4">
                <h4 class="font-weight-bold">Case Related Information</h4>
                <p class="p-text">
                    {{str_limit("Once you have a list of cases, you can sort and view by ‘running’, ‘closed’ or ‘transferred/NOC’ filters. You can filter cases by a number of criteria, such as title, case number, client, team member and more. There is no other quicker way to find and refer to cases, especially if you’re working on a number of cases and have a full case diary.",$limit = 240, $end="...")}}
                
                </p>
                <a href="" class="btn btn-sm btn-info">More Info</a>
            </div>
            <div class="col-md-3 mb-4">
                <h4 class="font-weight-bold">Case Hearing Notification</h4>
                <p class="p-text">
                    {{str_limit("You will be notify about all the case related hearing dates. Adlaw offers you a view of all the details you have entered, cases related and documents uploaded for each matter in a clean, clutter-free way. Case Hearing Notification enables you to manage your time as well as track time spent by team members on case-related activities.",$limit = 230, $end="...")}}
                </p>
                <a href="" class="btn btn-sm btn-info">More Info</a>
            </div> --}}
          {{--   <div class="col-md-3 mb-4">
                <h4 class="font-weight-bold">Chat Or Messanger</h4>
                <p class="p-text">
                {{str_limit("Our case management system has made managing information easier than ever before. Create a case in just a few seconds. The case will create its activity stream as you keep adding information, making updates and attaching documents. Everything comes together seamlessly to provide the big picture systematically.",$limit = 220, $end="...")}}
                </p>
                <a href="" class="btn btn-sm btn-info">More Info</a>
            </div> --}}

        </div>
    </div>
    <br>
    <br>
  </section>