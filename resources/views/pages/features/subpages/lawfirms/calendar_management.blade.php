@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'Calendar Management','description' => ''])

<div class="container container-div">
    <div class="row ">
        
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text text-why pt-5">        	
        	<p class="p-text">
        		Managing an organized law firm is challenging without visibility into your staff’s schedule. Adlaw helps you monitor what's going in your cases on one convenient, central calendar so nothing slips through the cracks. Create and connect occasions to specific cases and share them with clients as well as users. So whether it’s an upcoming court date or statement, the Adlaw Calendar ensures you’re always prepared. This feature provide a roll-up of all firm-wide appointments, deadlines and staff meetings on one central calendar so you can coordinate your efforts and see when others in your firm are available.
        	</p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/image/calendar.png')}}" class="w-100 h-100" alt="Case hearing and todos show"> 
                </div>
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                  <p class="p-text mt-4"> Adlaw helps you monitor what's going on in your cases on one convenient, central calendar so nothing slips through the cracks. Create and connect occasions to specific cases and share them with clients as well as users. So whether it’s an upcoming court date or statement, the Adlaw Calendar ensures you’re always prepared. This element gives you a chance to deal with your company's case, staff, and customer events easily.</p>
                     <ul class="feature_ul mt-4 p-text">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Case related hearing show in calendar</li> 
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">To-do show in calendar</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Case related To-do show in calendar</li>

                    </ul>

                </div>
            </div>
              <div class="row">
               
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                    <p class="p-text mt-4">
                        Any time you create a calendar event, new or recurring, notifies all invited parties for you, saving your time and hassle. Adlaw notifies all invited parties for you, saving your time and hassle.
                    </p>
                    <ul class="feature_ul mt-4 p-text">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}" al>Hearing and Todos create easily</li> 
                    </ul>

                </div>
                 <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/image/calendar_hearing.png')}}" class="w-100 h-100" alt="Create case hearing and todos in calendar">
                </div>
            </div>
            


        </div>
       <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('features.client_management')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('features.document_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection