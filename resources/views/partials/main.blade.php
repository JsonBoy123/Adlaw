@include('partials.header')
<div class="wrapper">
@php

  $msg = \App\Models\MessageTalk::where('recv_id',Auth::user()->id)->where('status',0)->get();  

  // $users = \App\User::join('comp_mast_view', 'users.parent_id', '=','comp_mast_view.parent_id')->where('users.id',Auth::user()->id)->first();

  // $company_name = !empty($users->comp_name) ? $users->comp_name : '';

  $unbookings =  \App\Models\Booking::where('user_id',Auth::user()->id)
      ->where('client_status',1)
      ->where('user_status',0)
      ->get();  
    
  $messages = \App\Models\MessageTalk::select('msg_talks.*','users.name','users.photo')->join('users','users.id','=','msg_talks.sender_id')->where('recv_id',Auth::user()->id)->where('msg_talks.status',0)->get();

  $lawyer_pen = \App\User::with('state','city')->where('parent_id',Auth::user()->id)->where('user_flag','=','P')->get();

  $modules = \App\Models\Module::orderBy('line')->get();

  $packageCheck =  \App\Helpers\Helpers::user_package_check();
  $moduleShow = $packageCheck['moduleShow'];
  $packageModules  = $packageCheck['packageModules'];


  $pending_teacher = \App\User::where('parent_id',Auth::user()->id)->where('user_flag','=','P')->get();

  
  $users = \App\User::join('college_mast_view', 'users.parent_id', '=','college_mast_view.parent_id')->where('users.id',Auth::user()->id)->where('user_flag','ct')->first();


 $review = \App\Models\Review::where('review_status', 'C')->get();
    $subscriptions =   \App\Models\SubcriptionContact::with('user.role')->where('active','0')->get();
    // echo "<pre>";
    // print_r(gettype());
    // echo "</pre>";
   // die;
  @endphp
  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('/')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LW</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ADLAW</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu" >
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
           {{--  <li class="nav-item">
              <a href="{{ $moduleShow == true ? route('connect.index') : route('crm_dashboard.index') }}"><i class="fa fa-comments-o"></i></a>
            </li> --}}
{{--             <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              @if(count($messages) !=0)
                <span class="label label-success">{{count($messages)}}</span>
              @endif
            </a>
             @if(count($messages) !=0)
              <ul class="dropdown-menu">
                <li class="header">You have {{count($messages)}} messages</li>             
                <li>
                <ul class="menu">
                  @foreach($messages as $message)
                  <li><!-- start message -->
                    <a class="" href="{{route('message.show',['id'=>$message->id])}}">
                      <div class="pull-left">
                        @if($message->photo !='')
                          <img src="{{ asset('storage/profile_photo/'.$message->photo)}}" class="img-circle" alt="Sender Image" />
                        @else
                          <img src="{{asset('storage/profile_photo/default.png')}}"  class="img-circle" alt="Sender Image" /> 
                        @endif
                      </div>
                      <h4>
                        {{$message->name}}
                        <small>{{date('d-m-Y',strtotime($message->created_at))}}</small>
                      </h4>
                      <p>{{mb_substr($message->message,0,20).'...'}}</p>
                    </a>
                  </li>
                  @endforeach     
                 
                </ul>

              </li>
              <li class="footer"><a href="{{route('message.index')}}">See All Messages</a></li>
            </ul>
             @endif
          </li> --}}
        {{-- @include('notifications.notification') --}}
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger">{{count(Auth::user()->unreadNotifications)}}</span>
            </a>  
            <ul class="dropdown-menu">
              <li class="header">You have {{count(Auth::user()->unreadNotifications)}} notifications </li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @foreach(Auth::user()->unreadNotifications as $notification)
                  <li>
                     <a href="{{route('notification_read',$notification['id'])}}">
                        <i class="fa fa-tasks "></i> 

                        <span> {{str_limit($notification['data']['title'], $limit = 50, $end = '...') }} </span>
                        <br>
                        <span>{{$notification['data']['message']}}</span>
                       
                        <br> <span>{{$notification['created_at']->diffForHumans()}}</span>
                    </a>
                  </li>
                  @endforeach

                  <li>
                </li>
              </ul>
            </li>
            <li class="footer">
              <a href="{{route('all_notifications')}}">All Notifications</a>
            </li>
          </ul>

          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
          </li> -->
            
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if(Auth::user()->photo !='')
                    <img src="{{ asset('storage/profile_photo/'.Auth::user()->photo)}}" class="user-image" alt="User Image" />
                @else
                    <img src="{{asset('storage/profile_photo/default.png')}}"  class="user-image" alt="User Image" /> 
                @endif
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                @if(Auth::user()->photo !='')
                  <img src="{{ asset('storage/profile_photo/'.Auth::user()->photo)}}" class="img-circle" alt="User Image" />
                @else
                  <img src="{{asset('storage/profile_photo/default.png')}}"  class="img-circle" alt="User Image" /> 
                @endif

                <p>{{Auth::user()->name}}</p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('lawfirms.profile')}}" class="btn btn-default btn-flat">Profile</a>
                </div>
               {{--  <div class="pull-left ml-2">
                  <a href="{{route('lawfirms.profile')}}" class="btn btn-default btn-flat">Admin Control</a>
                </div> --}}
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                      </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           @if(Auth::user()->photo !='')
            <img src="{{ asset('storage/profile_photo/'.Auth::user()->photo)}}" class="img-circle" alt="User Image" />
            @else
            <img src="{{asset('storage/profile_photo/default.png')}}"  class="img-circle" alt="User Image" /> 
            @endif
          
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     <!--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Welcome to adlaw </li>
        @role('lawyer|lawcompany')
        <li class="{{Request()->segment(1).'/'.Request()->segment(2) == 'lawfirm/' ? 'active' : '' }} nav-item " >
            <a class="nav-link"  href="{{route ('lawfirm.index')}}">
               <i class="fa fa-tachometer"></i>
              <span >Dashboard</span>
            </a>
          </li>
           @foreach($modules as $module)
                  @if(in_array(Auth::user()->user_catg_id, json_decode($module->permissions)->can_view))
                    @if(Auth::user()->parent_id !=null )  
                      @if($module->show_team == '1' && $module->module_type == '2')
                        <li class="{{Request()->segment(1).'/'.Request()->segment(2) == $module->slug ? 'active' : '' }}" >
                          <a 
                       
                          href="{{ $module->link != null ? (in_array($module->id, $packageModules) ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('crm_dashboard.index')) : route('package.index')}}"

                          >
                            <i class="fa {{$module->icon}}"></i> <span>{{$module->name}}</span>
                          </a>
                        </li>
                      @endif
                    @else
                      @if($module->module_type == '2')
                      <li class="{{Request()->segment(1).'/'.Request()->segment(2) == $module->slug ? 'active' : '' }}">
                          <a 
                             href="{{ $module->link != null ? (in_array($module->id, $packageModules) ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('crm_dashboard.index')) : route('package.index')}}"
                          >
                            <i class="fa {{$module->icon}}"></i> <span>{{$module->name}}</span>
                          </a>
                        </li>
                        @endif
                    @endif
                  @endif
              @endforeach  


         
         {{--  @foreach($modules as $module)
            @if(in_array(Auth::user()->user_catg_id, json_decode($module->permissions)->can_view))
              @if(Auth::user()->parent_id !=null )  
                @if($module->show_team == '1' && $module->module_type == '2')
                  <li class="">
                    <a href="{{ $module->link != null ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('package.index')}}">
                      <i class="fa {{$module->icon}}"></i> <span>{{$module->name}}</span>
                    </a>
                  </li>
                @endif
              @else
                @if($module->module_type == '2')
                <li class="">
                    <a href="{{ $module->link != null ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('package.index')}}">
                      <i class="fa {{$module->icon}}"></i> <span>{{$module->name}}</span>
                    </a>
                  </li>
                  @endif
              @endif
            @endif
        @endforeach   --}}


       {{--    <li class="{{Request()->segment(1).'/'.Request()->segment(2) == 'lawfirm/'.Auth::user()->id ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('lawfirm.show',Auth::user()->id)}} ">
              <i class="fa fa-user"></i>
              <span >My Profile</span>
            </a>
          </li>
          @role('lawyer')
           <li class="{{Request()->segment(1) == 'specialization' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('specialization.index')}}">
              <i class="fa fa-balance-scale"></i>
              <span >Area Of Specialization</span>
            </a>
          </li>
          @endrole
            <li class="{{Request()->segment(1) == 'practicing_court' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('practicing_court.index')}}">
              <i class="fa fa-university"></i>
              <span >Working Courts</span>
            </a>
          </li>  

          @role('lawyer')
          <li class="{{Request()->segment(1) == 'qualification' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('qualification.index')}}">
              <i class="fa fa-graduation-cap"></i>
              <span >Qualification</span>
            </a>
          </li>
          @endrole
          @php 
            $segment = Request()->segment(2);
            $segment = explode(',', $segment);
            if(isset($segment[1])){
                $page_name = $segment[1];
            }  
            else{
              $page_name = ' ';
            }           

          @endphp
        @if(Auth::user()->parent_id ==null) <li class="{{Request()->segment(1) == 'appointment' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('appointment.index')}}">
              <i class="fa fa-calendar"></i>
              <span >Appointment Availability</span>
            </a>
          </li>          
    
           <li class="{{Request()->segment(1) == 'booking' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('booking.index')}}">
              <i class="fa fa-handshake-o"></i>
              <span >Appointments</span>
                @if(count($unbookings) !=0) 
                  <span class="pull-right-container">
                    <span class="label bg-orange pull-right">{{count($unbookings)}}</span>
                 </span>
                @endif
            </a>
          </li> 
        @endif --}}


       {{--     <li class="{{Request()->segment(1) == 'message' ? 'active' : '' }} {{Request()->segment(1) == 'sent_messages' ? 'active' : '' }} {{Request()->segment(1) == 'trash_message' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('message.index')}}">
              <i class="fa fa-envelope"></i>
              <span >Message Box </span>
             @if(count($msg) !=0) 
                <span class="pull-right-container">
                  <span class="label bg-red pull-right">{{count($msg)}}</span>
                </span>
              @endif

            </a>
          </li> --}}

           <li class="treeview {{Request()->segment(1) == 'crm_dashboard' ? 'active' : (Request()->segment(1) == 'clients' ? 'active' : (Request()->segment(1) == 'pms' ? 'active' : (Request()->segment(1) == 'teams' ? 'active' : (Request()->segment(1) == 'case_mast' ? 'active' : (Request()->segment(1) == 'calendar' ? 'active' : (Request()->segment(1) == 'docs' ? 'active' : (Request()->segment(1) == 'todos' ? 'active' : ''))))))) }}">
            <a href="#">
              <i class="fa fa-table"></i> <span>CRM</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=" {{Request()->segment(1) == 'crm_dashboard' ? 'active' : '' }}">
                <a href="{{route('crm_dashboard.index')}}">
                  <i class="fa fa-tachometer"></i> <span>{{__('CRM Dashboard')}}</span>
                </a>
              </li>

              @foreach($modules as $module)
                  @if(in_array(Auth::user()->user_catg_id, json_decode($module->permissions)->can_view))
                    @if(Auth::user()->parent_id !=null )  
                      @if($module->show_team == '1' && $module->module_type =='1' )
                       <li class="{{Request()->segment(1).'/'.Request()->segment(2) == $module->slug ? 'active' : '' }}">
                          <a 
                       
                          href="{{ $module->link != null ? (in_array($module->id, $packageModules) ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('crm_dashboard.index')) : route('package.index')}}"

                          >
                            <i class="fa {{$module->icon}}"></i> <span>{{$module->name}}</span>
                          </a>
                        </li>
                      @endif
                    @else
                      @if($module->module_type == '1')
                      <li class="{{Request()->segment(1).'/'.Request()->segment(2) == $module->slug ? 'active' : '' }}">
                          <a 
                             href="{{ $module->link != null ? (in_array($module->id, $packageModules) ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('crm_dashboard.index')) : route('package.index')}}"
                          >
                            <i class="fa {{$module->icon}}"></i> <span>{{$module->name}}</span>
                          </a>
                        </li>
                        @endif
                    @endif
                  @endif
              @endforeach  
              </ul>
            </li>
            @endrole

            @role('lawcollege|teacher|student')
                  <li class="{{Request()->segment(1).'/'.Request()->segment(2) == 'lawschools/' ? 'active' : '' }} nav-item">
                  <a class="nav-link" href="{{route('lawschools.index')}}">
                  <i class="fa fa-tachometer"></i>
                  <span>Dashboard</span>
                  </a>
                  </li>  
                  <li class="{{Request()->segment(1).'/'.Request()->segment(2) == 'lawschools/'.Auth::user()->id ? 'active' : '' }} nav-item">
                  <a class="nav-link" href="{{route('lawschools.show',Auth::user()->id)}}">
                  <i class="fa fa-user"></i>
                  <span>My Profile</span>
                  </a>
                  </li>
                  {{--    @role('lawcollege','teacher')
                  <li class="{{Request()->segment(1) == 'docs' ? 'active' : ''}} {{Request()->segment(1) == 'filestack-mgmt' ? 'active' : ''}}  nav-item">
                  <a class="nav-link" href="{{route('docs.home')}}">
                  <i class="fa fa-file"></i>
                  <span>Documents</span>
                  </a>
                  </li>

                  <li class="{{Request()->segment(2) == 'agenda' ? 'active' : ''}}   nav-item">
                  <a class="nav-link" href="{{route('agenda.index')}}">
                  <i class="fa fa-tasks"></i>
                  <span>Agenda</span>
                  </a>
                  </li>

                  @endrole
                  --}}

                  @role('lawcollege')
                  <li class="{{Request()->segment(1) == 'course' ? 'active' : '' }} nav-item">
                  <a class="nav-link" href="{{route('course.index')}}">
                  <i class="fa fa-gavel"></i>
                  <span>Courses</span>
                  </a>
                  </li>   


                  {{-- 
                  <li class="{{Request()->segment(1) == 'teams' ? 'active' : '' }} nav-item">
                  <a class="nav-link" href="{{route('teams.index')}}">
                  <i class="fa fa-users"></i>
                  <span>My Team Member</span>
                  @if(count($pending_teacher) !=0) 
                  <span class="pull-right-container">
                  <span class="label bg-orange pull-right">{{count($pending_teacher)}}</span>
                  </span>
                  @endif
                  </a>
                  </li> --}}
                  <li class="treeview {{Request()->segment(1) == 'student' ? 'active' : '' }} {{Request()->segment(1) == 'student_detail' ? 'active' : '' }} {{Request()->segment(1) == 'upload_student' ? 'active' : '' }} ">
                  <a class="nav-link" href="">
                  <i class="fa fa-graduation-cap"></i>
                  <span>Manage Student</span> <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>

                  <ul class="treeview-menu">
                  <li class="nav-item {{Request()->segment(1) == 'student' ? 'active' : ''}}">
                  <a href="{{route('student.index')}}" ><i class="fa fa-circle-o"></i> Dashboard</a>
                  </li>
                  <li class="nav-item {{Request()->segment(1) == 'student_detail' ? 'active' : ''}}">
                  <a href="{{route('student_detail.index')}}" ><i class="fa fa-circle-o"></i>Student Details</a>
                  </li>
                  <li class="nav-item {{Request()->segment(1) == 'manage_student' ? 'active' : ''}}">
                  <a href="{{route('student_manage.index')}}" ><i class="fa fa-circle-o"></i>Arrange Student</a>
                  </li>
                  <li class="nav-item {{Request()->segment(1) == 'upload_student' ? 'active' : ''}}">
                  <a href="{{route('upload_student')}}" ><i class="fa fa-circle-o"></i>Upload Student</a>
                  </li>
                  <li class="nav-item {{Request()->segment(1) == 'student_record' ? 'active' : ''}}">
                  <a href="{{route('student_record')}}" ><i class="fa fa-circle-o"></i>Records</a>
                  </li>
                  </ul>
                  </li>


                  <li class="treeview {{Request()->segment(1) == 'class' ? 'active' : '' }} {{Request()->segment(1) == 'class' ? 'active' : '' }} ">
                  <a class="nav-link" href="">
                  <i class="fa fa-graduation-cap"></i>
                  <span>Manage</span> <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>

                  <ul class="treeview-menu">
                  <li class="nav-item {{Request()->segment(1) == 'class' ? 'active' : ''}}">
                  <a href="{{route('batches.index')}}" ><i class="fa fa-circle-o"></i>Manage Batches</a>
                  </li>
                  <li class="nav-item {{Request()->segment(1) == 'class' ? 'active' : ''}}">
                  <a href="{{route('academic.index')}}" ><i class="fa fa-circle-o"></i>Academic Calendar</a>
                  </li>
                  <li class="nav-item {{Request()->segment(1) == 'class' ? 'active' : ''}}">
                  <a href="" ><i class="fa fa-circle-o"></i>Grade Master</a>
                  </li>
                  </ul>
                  </li> 
                  @endrole

                  @role('teacher')         
                  <li class="{{Request()->segment(1) == 'qualification' ? 'active' : '' }} nav-item">
                  <a class="nav-link" href="{{route('qualification.index')}}">
                  <i class="fa fa-graduation-cap"></i>
                  <span>Qualification</span>
                  </a>
                  </li>

                  @if(!empty($users->college_name))
                  <li class="header">Welcome to lawcollege </li>
                  <li class="{{Request()->segment(1).'/'.Request()->segment(2) == 'college/profile' ? 'active' : '' }} {{Request()->segment(1).'/'.Request()->segment(2) == 'college/courses' ? 'active' : '' }} treeview">
                  <a href="#">
                  <i class="fa fa-university"></i> <span>{{$users->college_name}}</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                  <li class="{{Request()->segment(1).'/'.Request()->segment(2) == 'college/profile' ? 'active' : '' }}"><a href="{{route('lawschools.college_profile')}}"><i class="fa fa-user"></i> Profile</a></li>
                  <li class="{{Request()->segment(1).'/'.Request()->segment(2) == 'college/courses' ? 'active' : '' }}"><a href="{{route('lawschools.college_courses')}}"><i class="fa fa-gavel"></i> Courses</a></li>
                  </ul>
                  </li>    
                  @endif
                  @endrole

                  <li class="treeview {{Request()->segment(1) == 'attendance' ? 'active' : '' }} ">
                  <a class="nav-link" href="">
                  <i class="fa fa-clock-o"></i>
                  <span>Manage Attendance</span> <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>

                  <ul class="treeview-menu">
                  <li class="nav-item {{Request()->segment(2) == 'dashboard' ? 'active' : ''}}">
                  <a href="{{route('attendance.index')}}" ><i class="fa fa-circle-o"></i>Dashboard</a>
                  </li>
                  <li class="nav-item {{Request()->segment(2) == 'student' ? 'active' : ''}}">
                  <a href="{{route('attendance.student')}}" ><i class="fa fa-circle-o"></i>Student Attendance</a>
                  </li>
                  <li class="nav-item {{Request()->segment(2) == 'staff' ? 'active' : ''}}">
                  <a href="{{route('attendance.staff')}}" ><i class="fa fa-circle-o"></i>Staff Attendance</a>
                  </li>
                  <li class="nav-item {{Request()->segment(2) == 'upload' ? 'active' : ''}}">
                  <a href="{{route('attendance.upload')}}" ><i class="fa fa-circle-o"></i>Upload Attendance</a>
                  </li>
                  <li class="nav-item {{Request()->segment(2) == 'manage' ? 'active' : ''}}">
                  <a href="{{route('attendance.manage_student')}}" ><i class="fa fa-circle-o"></i>Manage Attendance</a>
                  </li>
                  <li class="nav-item {{Request()->segment(2) == 'manage' ? 'active' : ''}}">
                  <a href="{{route('attendance.student_report')}}" ><i class="fa fa-circle-o"></i>Reports Attendance</a>
                  </li>
                  </ul>
                  </li>

                  <li class="treeview {{Request()->segment(1) == 'fees' ? 'active' : '' }}">
                  <a class="nav-link" href="">
                  <i class="fa fa-money"></i>
                  <span>Fees</span> <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>

                  <ul class="treeview-menu">
                  <li class="nav-item {{Request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                  <a href="{{route('fees.index')}}" ><i class="fa fa-circle-o"></i>dashboard</a>
                  </li>
                  </ul>
                  </li>     


                  <li class="treeview {{Request()->segment(1) == 'master' ? 'active' : '' }}">
                  <a href="#">
                  <i class="fa fa-table"></i> <span>CRM</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                  <li class="">
                  <a href="{{route('crm_dashboard.index')}}">
                  <i class="fa fa-tachometer"></i> <span>{{__('CRM Dashboard')}}</span>
                  </a>
                  </li>

                  @foreach($modules as $module)
                  @if(in_array(Auth::user()->user_catg_id, json_decode($module->permissions)->can_view))
                    @if(Auth::user()->parent_id !=null )  
                      @if($module->show_team == '1')
                        <li class="">
                          <a href="{{ $module->link != null ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('package.index')}}">
                            <i class="fa {{$module->icon}}"></i> <span>{{$module->name}}</span>
                          </a>
                        </li>
                      @endif
                    @else
                      <li class="">
                          <a href="{{ $module->link != null ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('package.index')}}">
                            <i class="fa {{$module->icon}}"></i> <span>{{$module->name}}</span>
                          </a>
                        </li>
                    @endif
                  @endif
                  @endforeach  
                  </ul>
                  </li>

                  @endrole

        @role('guest|client')
           <li class="{{Request()->segment(1)== 'customer' ? 'active' : '' }} nav-item " >
            <a class="nav-link"  href="{{route('customer')}}">
               <i class="fa fa-tachometer"></i>
              <span >Dashboard</span>
            </a>
          </li>
          <li class="{{Request()->segment(1) == 'appointmentShow' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('customer.appointment')}}">
              <i class="fa fa-calendar"></i>
              <span >Appointments</span>
            </a>
          </li>
        
           
          <li class="{{Request()->segment(1) == 'message' ? 'active' : '' }} {{Request()->segment(1) == 'sent_messages' ? 'active' : '' }} {{Request()->segment(1) == 'trash_message' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('message.index')}}">
              <i class="fa fa-envelope"></i>
              <span >Message Box </span>
             @if(count($msg) !=0) 
                <span class="pull-right-container">
                  <span class="label bg-red pull-right">{{count($msg)}}</span>
                </span>
              @endif

            </a>
          </li> 
          @role('guest')
          <li class="treeview {{Request()->segment(1) == 'master' ? 'active' : '' }}">
            <a href="{{route('package.index')}}">
              <i class="fa fa-table"></i> <span>CRM</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          
            <ul class="treeview-menu">
              <li class="">
                <a href="{{route('crm_dashboard.index')}}">
                  <i class="fa fa-tachometer"></i> <span>{{__('CRM Dashboard')}}</span>
                </a>
              </li>
              @foreach($modules as $module)
                  @if(in_array(Auth::user()->user_catg_id, json_decode($module->permissions)->can_view))
                    @if(Auth::user()->parent_id !=null )  
                      @if($module->show_team == '1')
                        <li class="">
                          <a href="{{ $module->link != null ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('package.index')}}">
                            <i class="fa {{$module->icon}}"></i> <span>{{$module->name}}</span>
                          </a>
                        </li>
                      @endif
                    @else
                      <li class="">
                          <a href="{{ $module->link != null ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('package.index')}}">
                            <i class="fa {{$module->icon}}"></i> <span>{{$module->name}}</span>
                          </a>
                        </li>
                    @endif
                  @endif
              @endforeach  
              </ul>
            </li>
            @endrole
        @endrole


        @role('admin')
          <li class="{{Request()->segment(1) == 'admin' ? 'active' : ''}} nav-item">
            <a class="nav-link" href="{{route('admin.index')}}">
             <i class="fa fa-tachometer"></i>
              <span> Dashboard</span>
            </a>
          </li> 
          @permission('registration_custom')
                <li class="{{Request()->url() == route('registration') ? 'active' : ''}} nav-item">
                  <a href="{{route('registration')}}" class="nav-link">
                    <i class="fa fa-users"></i>
                     <span> Registration Custom</span>
                  </a>
            </li>  
          @endpermission
          @permission('view_reports')
            <li class="{{Request()->segment(1) == 'reports' ? 'active' : ''}} nav-item">
            <a href="{{route('reports.index')}}" class="nav-link">
              <i class="fa fa-table"></i>
               <span> Reports</span>
            </a>
            </li>  
          @endpermission
        @permission('users_manage')  
        <li class="{{Request()->segment(1) == 'users' ? 'active' : ''}} nav-item">
            <a href="{{route('users.index')}}" class="nav-link">
              <i class="fa fa-users"></i>
               <span> Users</span>
            </a>
        </li>   

        <li class="{{Request()->segment(1) == 'referral' ? 'active' : ''}} nav-item">
            <a href="{{route('referral.index')}}" class="nav-link">
              <i class="fa fa-users"></i>
               <span> Referral Users</span>
            </a>
        </li>   

        @endpermission
        @permission('cause-list-upload')
            <li class="{{Request()->segment(1) == 'import-cause-list' ? 'active' : ''}} nav-item">
            <a href="{{route('admin.cause-list.index')}}" class="nav-link">
              <i class="fa fa-users"></i>
               <span> Cause-List Upload</span>
            </a>
        </li> 
        @endpermission

         @permission('manage_reviews')
           <li class="{{Request()->segment(1) == 'reviews' ? 'active' : ''}} nav-item">
            <a class="nav-link" href="{{route('admin.pending_reviews')}}">
              <i class="fa fa-comment"></i>
              <span class="">Reviews</span>
              @if(count($review) !=0)
              <span class="pull-right-container">
                <span class="label bg-red pull-right">{{count($review)}}</span>
              </span>
              @endif
            </a>
          </li>  
          
         @endpermission
          

        {{--    <li class="nav-item">
            <a class="nav-link" href="">
              <i class="fa fa-users"></i>
              <span class="menu-title"> Clients</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="">
              <i class="fa fa-book"></i>
              <span class="menu-title"> Case Diary</span>
            </a>
          </li> --}}
 {{--                    
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="fa fa-envelope"></i>
              <span class="menu-title"> Messages</span>
            </a>
          </li> --}}
         @permission('manage_blogs')

          <li class="{{Request()->segment(1) == 'blogger' ? 'active' : ''}} nav-item">
            <a class="nav-link" href="{{route('admin.bloguser')}}">
              <i class="fa fa-github"></i>
              <span class="menu-title">Blogger</span>
            </a>
          </li>

          <li class="{{Request()->segment(1) == 'blog' ? 'active' : ''}} nav-item">
            <a class="nav-link" href="{{route('blog.index')}}">
              <i class="fa fa-github"></i>
              <span class="menu-title"> Blog</span>
            </a>
          </li>


         @endpermission
          <li class="{{Request()->segment(1) == 'contact_details' ? 'active' : ''}} nav-item">
            <a class="nav-link" href="{{route('admin.contact_details')}}">
              <i class="fa fa-phone"></i>
              <span class="menu-title"> Contact Us</span>
            </a>
          </li>
          @permission('master_manage')
          <li class="treeview {{Request()->segment(1) == 'master' ? 'active' : '' }}">
            <a href="">
              <i class="fa fa-table"></i> <span>Master</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li class="treeview {{Request()->segment(2) == 'location' ? 'active' : '' }}">
                  <a href="">
                    <i class="fa fa-map-marker"></i> <span>Location</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li  class="{{Request()->segment(3) == 'country' ? 'active' : '' }}"><a href="{{route('country.index')}}"><i class="fa fa-circle-o"></i> Country</a></li>
                    <li  class="{{Request()->segment(3) == 'state' ? 'active' : '' }}"><a href="{{route('state.index')}}"><i class="fa fa-circle-o"></i> State</a></li>
                    <li  class="{{Request()->segment(3) == 'city' ? 'active' : '' }}"><a href="{{route('city.index')}}"><i class="fa fa-circle-o"></i> City</a></li>
                  </ul>
                </li>
                <li class="{{Request()->segment(2) == 'slots' ? 'active' : '' }} nav-item" ><a href="{{route('slots.index')}}"><i class="fa fa-clock-o"></i> Slots</a></li>
                <li class="{{ Request()->segment(2) == 'payment_mode' ? 'active' : '' }} nav-item" ><a href="{{route('payment_mode.index')}}"><i class="fa fa-money"></i> Payment Mode</a></li>
                <li class="{{ Request()->segment(2) == 'relation' ? 'active' : '' }} nav-item" ><a href="{{route('relation.index')}}"><i class="fa fa-circle-o"></i> Relation</a></li>
                <li class="{{ Request()->segment(2) == 'religion' ? 'active' : '' }} nav-item" ><a href="{{route('religion.index')}}"><i class="fa fa-circle-o"></i> Religion</a></li>
                <li class="{{ Request()->segment(2) == 'reservation' ? 'active' : '' }} nav-item" ><a href="{{route('reservation.index')}}"><i class="fa fa-circle-o"></i> Reservation Class</a></li>
                
              
                <li class="{{ Request()->segment(2) == 'profession' ? 'active' : '' }} nav-item" ><a href="{{route('profession.index')}}"><i class="fa fa-circle-o"></i> Profession</a></li>

                <li class="{{ Request()->segment(2) == 'designation' ? 'active' : '' }} nav-item" ><a href="{{route('designation.index')}}"><i class="fa fa-circle-o"></i> Designation</a></li>

                 <li class="treeview {{Request()->segment(2) == 'specialization' ? 'active' : '' }}">
                  <a href="">
                    <i class="fa fa-gavel"></i> <span>Specialization</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-left"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu"> 
                    <li class="{{Request()->segment(3) == 'spec_category' ? 'active' : '' }}"><a href="{{route('spec_category.index')}}"><i class="fa fa-circle-o"></i> Category</a></li>
                    <li class="{{Request()->segment(3) == 'spec_subcategory' ? 'active' : '' }}"><a href="{{route('spec_subcategory.index')}}"><i class="fa fa-circle-o"></i> Subcategory</a></li>
                  </ul>
                </li>

                <li class="treeview {{Request()->segment(2) == 'qualification' ? 'active' : '' }}">
                  <a href="">
                    <i class="fa fa-graduation-cap"></i> <span>Qualification</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-left"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu"> 
                    <li class="{{Request()->segment(3) == 'qual_category' ? 'active' : '' }}"><a href="{{route('qual_category.index')}}"><i class="fa fa-circle-o"></i> Category</a></li>
                    <li class="{{Request()->segment(3) == 'qual_subcategory' ? 'active' : '' }}"><a href="{{route('qual_subcategory.index')}}"><i class="fa fa-circle-o"></i> Subcategory</a></li>
                    <li class="{{Request()->segment(3) == 'qual_doc_type' ? 'active' : '' }}"><a href="{{route('qual_doc_type.index')}}"><i class="fa fa-circle-o"></i> Document Type</a></li>
                    <li class="{{Request()->segment(3) == 'qual_doc_mast' ? 'active' : '' }}"><a href="{{route('qual_doc_mast.index')}}"><i class="fa fa-circle-o"></i> Document Mast</a></li>
                  </ul>
                </li>
                <li class="{{Request()->segment(2) == 'case_type' ? 'active' : '' }}"><a href="{{route('case_type.index')}}"><i class="fa fa-book"></i> Case Type</a></li>
                <li class="treeview {{Request()->segment(2) == 'court' ? 'active' : '' }}">
                  <a href="">
                    <i class="fa fa-university"></i> <span>Court</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-left"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu"> 
                    <li class="{{Request()->segment(3) == 'court_category' ? 'active' : '' }}"><a href="{{route('court_category.index')}}"><i class="fa fa-circle-o"></i> Category</a></li>
                    <li class="{{Request()->segment(3) == 'court_subcategory' ? 'active' : '' }}"><a href="{{route('court_subcategory.index')}}"><i class="fa fa-circle-o"></i> Subcategory</a></li>
                  </ul>
                </li>
                             
            </ul>
          </li>
         

      @endpermission

      @permission('manage_uploads')

         <li class="nav-item">
            <a class="nav-link" href="{{route('admin.upload')}}">
              <i class="fa fa-upload"></i>
              <span class="menu-title"> Uploads</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('message_sent')}}">
              <i class="fa fa-upload"></i>
              <span class="menu-title"> Message</span>
            </a>
          </li>
         @endpermission
        @permission('acl_manage')
         <li class="treeview {{Request()->segment(1) == 'acl' ? 'active' : ''}}">
            <a href="">
              <i class="fa fa-table"></i> <span>ACL</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">  
                <li class="{{Request()->segment(2) == 'acl_package' ? 'active' : ''}}"><a href="{{route('acl_package.index')}}"><i class="fa fa-book"></i> <span>Package</span></a></li>
                <li class="{{Request()->segment(2) == 'acl_module' ? 'active' : ''}}"><a href="{{route('acl_module.index')}}"><i class="fa fa-book"></i> <span>Module</span></a></li>
                <li class="{{Request()->segment(2) == 'role' ? 'active' : ''}}"><a href="{{route('role.index')}}"><i class="fa fa-book"></i> <span>Roles </span></a></li>
                <li class="{{Request()->segment(2) == 'permission' ? 'active' : ''}}"><a href="{{route('permission.index')}}"><i class="fa fa-book"></i> <span>Permissions</span></a></li>
          </ul>
        </li>
        @endpermission
        @permission('manage_subscription')
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.show_subscription')}}">
              <i class="fa fa-phone"></i>
              <span >Subscription Contact</span>  
              @if(count($subscriptions) !=0)
              <span class="pull-right-container">
                <span class="label bg-red pull-right">{{count($subscriptions)}}</span>
              </span>
              @endif             
            </a>
        </li>
        @endpermission

        @permission('service_approve')
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.service_approve')}}">
              <i class="fa fa-cog"></i>
              <span >Service Approval</span>  
             {{--  @if(count($subscriptions) !=0)
              <span class="pull-right-container">
                <span class="label bg-red pull-right">{{count($subscriptions)}}</span>
              </span>
              @endif    --}}          
            </a>
          </li>
        @endpermission



        @permission('manage_user_appointment')
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.user_appointment')}}">
              <i class="fa fa-calendar"></i>
              <span >User Appointment</span>  
             {{--  @if(count($appointments) !=0)
              <span class="pull-right-container">
                <span class="label bg-red pull-right">{{count($subscriptions)}}</span>
              </span>
              @endif     --}}         
            </a>
        </li>
        @endpermission

        @endrole



          <li class="nav-item">
              <a class="nav-link" href="{{route('password_change')}}">
                <i class="fa fa-user"></i>
                <span >Change Password </span>               
              </a>
          </li>








{{-- 

         @if(Auth::user()->parent_id ==null) <li class="{{Request()->segment(1) == 'clients' ? 'active' : '' }} {{$page_name == 'clients' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('clients.index')}}">
              <i class="fa fa-users"></i>
              <span >My Clients</span>
            </a>
          </li>
        @endif
          <li class="{{Request()->segment(1) == 'case_mast' ? 'active' : '' }} {{$page_name == 'case_diary' ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('case_mast.index')}}">
              <i class="fa fa-book"></i>
              <span >Case Diary</span>             
            </a>
          </li>
      

        <li class="{{Request()->segment(2) == 'agenda' ? 'active' : ''}}   nav-item">
            <a class="nav-link" href="{{route('agenda.index')}}">
            <i class="fa fa-tasks"></i>
            <span>Agenda</span>
            </a>
        </li>
        {{-- <li class="{{Request()->segment(2) == 'schedule' ? 'active' : ''}} nav-item">
            <a class="nav-link" href="{{route('schedule.index')}}">
            <i class="fa fa-tasks"></i>
            <span>Schedules</span>
            </a>
        </li> --}}
       {{--  <li class="{{Request()->segment(1) == 'docs' ? 'active' : ''}} {{Request()->segment(1) == 'filestack-mgmt' ? 'active' : ''}}  nav-item">
            <a class="nav-link" href="{{route('docs.home')}}">
            <i class="fa fa-file"></i>
            <span>Documents</span>
            </a>
        </li>

      
        <li class="{{Request()->segment(1) == 'calendar' ? 'active' : ''}} nav-item">
            <a class="nav-link" href="{{route('calendar.index')}}">
            <i class="fa fa-calendar"></i>
            <span>Calendar</span>
            </a>
        </li>

       
        <li class="{{Request()->segment(1) == 'todos' ? 'active' : ''}} nav-item">
            <a class="nav-link" href="{{route('todos.index')}}">
            <i class="fa fa-tasks"></i>
            <span >Todos</span>
            </a>
        </li>
     

        @if(Auth::user()->parent_id ==null)
        <li class="{{Request()->segment(1) == 'teams' ? 'active' : '' }} nav-item">
          <a class="nav-link" href="{{route('teams.index')}}">
            <i class="fa fa-users"></i>
            <span>My Team Member</span>
             @if(count($lawyer_pen) !=0) 
                <span class="pull-right-container">
                  <span class="label bg-orange pull-right">{{count($lawyer_pen)}}</span>
                </span>
              @endif
          </a>
        </li>

        @endif --}} 

      
        {{-- @endif --}}

{{--           @role('lawyer')
           @if($company_name)
              <li class="header">Welcome to {{$company_name}} </li>
              <li class="{{Request()->segment(1) == 'company_profile' ? 'active' : '' }} treeview">
                  <a href="#">
                  <i class="fa fa-university"></i>
                  <span>{{$company_name}}</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  
                </a>
                <ul class="treeview-menu">
                  <li class="{{Request()->segment(1) == 'company_profile' ? 'active' : '' }}"><a href="{{route('lawfirm.company_profile')}}" ><i class="fa fa-user"></i> Profile</a></li>
                  <li><a href=""><i class="fa fa-circle-o"></i> Allot Case</a></li>
              
                </ul>
            </li>


            @endif   

            @endrole
 --}}

           {{--  <li class="header bg-red"><p style="padding-top:8px; padding-bottom: 0px; font-size: 12px; ">Launching Soon..</p></li> --}}
        
          {{-- <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-bell"></i>
              <span >Notifications</span>
            </a>
          </li>


           <li class="nav-item">
            <a class="nav-link" href="">
              <i class="fa fa-briefcase"></i>
              <span >My Brief Case</span>
            </a>
          </li> --}}

         
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-capitalize">{{__('Dashboard')}}</h1>

      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>

        {{-- <li class="active text-capitalize">{{(__('lawyer'))}}</li> --}}
        @if(Request()->segment(1) != '')
          <li class="active text-capitalize">{{Request()->segment(1)}}</li>
        @endif
      </ol>
    </section>



@yield('content')
@include('partials.footer')