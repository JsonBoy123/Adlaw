@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'Chat Or Messanger','description' => ''])

<div class="container container-div">
    <div class="row ">        
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text text-why pt-5">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="p-text">
        		Adlaw provides you a platform in which attorney and user can chat 24x7 regarding their cases. They can also share case related files to each other. By creating group attorney can add case related team members and chat with together. 

        	</p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/image/chat.png')}}" class="w-100 h-100">
                </div>

                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                    <p class="p-text"></p>
                    <ul class="feature_ul mt-4 p-text">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Push Notification</li> 
                         <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Message Encryption</li> 
                         <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Attach document and sent.</li> 

                    </ul>

                </div>
            </div>
            <div class="row">                
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                     <p class="p-text">
                         With the help of messenger anybody like other users can contact to attorney as a message chat by sending or receiving messages. Messages are automatically date and time stamped. Get notification if a message can be received. For security reasons, users should log out once they're finished as the computer they're using might be used by other people who, if they forgot to log out, would be able to gain access to their email. Messages can be sent 24 hours a day, 365 days a year.
                     </p> 
                    <ul class="feature_ul mt-4 p-text">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Click 'New' or 'Compose'.</li> 
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Click 'Send' to send the email.</li> 
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Write the message in the space below the Subject field.</li> 
                    </ul>
                </div>
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/image/messagebox.png')}}" class="w-100 h-100">
                </div>
            </div>
            <p class="p-text mt-4">
            
            </p>


        </div>
      <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('features.schedule_management')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('features.case_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection