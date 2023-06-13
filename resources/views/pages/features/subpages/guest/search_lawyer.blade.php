@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
<div class="container container-div">
    <div class="row ">
        <div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2 h2-text">
            <h2 class="h1-responsive font-weight-bold text-center text-uppercase text-white">Search Laywer / Lawfirms </h2>          
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="p-text">
        		Search and find lawyer, law firm near you, No matter where you are located or what legal issue you are facing or wanting practice with a top rated law school, you will find the right attorney in this legal platform. you can connect with any lawyer and law firm read attorney's peer & client reviews, and find fellow graduates and alumni from your law firms. 
        	</p>
            <div class="row">
                 <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/search_lawyer.png')}}" class="w-100 h-100">
                </div>

                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                    <p class="p-text">
                        Get Top Rated lawyers, law firms or attorneys in your area based on specialty, area of practice or by location if you are looking for professional advocates, lawyers, law firms in India for Deeds, family, patent, copyright, trademark and real Firm in India. 
                    </p>
                    <ul class="feature_ul mt-4">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"></li> 
                    </ul>

                </div>
            </div>
            <div class="row">                
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                     In this feature you can Easily Find beast lawfirms for your case
                    <ul class="feature_ul mt-4">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Lawfirm search by name  </li> 
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Practicing courts, state and city wise lawfirms search  </li> 
                       
                    </ul>
                </div>
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4 border">
                    <img src="{{asset('images/dashboard/search_lawyer1.png')}}" class="w-100 h-100">
                </div>
            </div>


        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{url('/')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('guest.calendar')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
           
        </div>

    </div>
</div>
@endsection