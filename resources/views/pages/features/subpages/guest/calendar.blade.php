@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
<div class="container container-div">
    <div class="row ">
        <div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2 h2-text">
            <h2 class="h1-responsive font-weight-bold text-center text-uppercase text-white">Calendar</h2>          
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="p-text">
        		Adlaw helps you monitor what's going in your cases on one convenient, central calendar so nothing slips through the cracks. User can see occasions to specific cases created by lawyer or law firm. So whether it’s an upcoming court date or statement, to-dos, hearing sessions morning or evening etc. 
        	</p>
            <div class="row">
                 <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/calendar.png')}}" class="w-100 h-100">
                </div>

                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                    <p class="p-text">
                       The Adlaw Calendar ensures you’re always prepared. This feature provide a roll-up of all firm-wide appointments, deadlines, and meetings with lawyer on one central calendar so you can coordinate your efforts and see when others in your firm are available. Any time you create a calendar event by setting reminder, new or recurring for you, saving you time and hassle. Adlaw notifies all invited parties for you, saving you time and hassle.
                        
                    </p>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('guest.calendar')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('guest.search_lawyer')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
           
        </div>

    </div>
</div>
@endsection