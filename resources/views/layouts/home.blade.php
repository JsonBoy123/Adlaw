  @extends("layouts.default")

@section('title','Top Lawyers, Law Firm Portal | Find a Lawyer, Legal Advisor | Lawyers Ranking in India, | Adlaw')
@section('description','Adlaw is a Lawyer and Firm Portal where you can find a lawyer, legal advisor and law ranking at all locations around India.')
@section('keywords', 'find a lawyer, lawyers portal India, find legal advisor, Best Lawyers in India, top lawyers, law firm portal, top lawyers in India, lawyers ranking in India')
@section('content')
@include('layouts.slider')

@php 
$states = DB::table('users')
     ->select(DB::raw('count(users.id) as state_count, state_mast.state_name,state_mast.state_code'))
     ->where('users.user_catg_id', '=', 2)
     ->where('users.state_code', '!=', null)
     ->join('state_mast','users.state_code', '=','state_mast.state_code')
     ->groupBy('users.state_code')     
     ->orderBy('state_count','desc')
     ->limit(15)
     ->get();
@endphp



{{-- <section class="py-5 ">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              
          </div>
      </div>
  </div>
    <div class="container">
        <div class="row" >
            <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                <h2 class="m-title" data-aos="flip-left"  >Why ADLAW?</h2>
                
                <p class="text-why p-text" >Adlaw.in is an effective online platform that makes it quicker and simpler to discover and contract Top Rated Lawyers in any city/court in India since you deserve access to top-rate, proficient legal advice from Top Rated Lawyers out there. We are set to make the legal experience astonishing by making legal services brilliant, cost-effective and on-demand for each need you are user, lawyer or law student.</p>


                <p class="text-why p-text" >Adlaw keeps everything in one spot the majority of your significant case subtleties — reports, contacts, schedules, messages, assignments, solicitations — are accessible in a solitary, sorted out area. Rather than looking crosswise over changed frameworks and programming with numerous login, monitor it all in adlaw. We help you to consult and contract the best legal advisers in India for District Courts, High Court and Supreme Court matters. Use filters to narrow your search and find the best advocate in India for your legitimate issue. Get top legal counselors in India for a family question or separation matters, property matter, work or work court matter, criminal issue, recuperation or check bob matters, tax collection or corporate issues, or an attorney master in some other field of law.</p>

                
            </div>
            <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                <h2 class="m-title"><br></h2>

                <p class="text-why p-text">Adlaw is accessible whether you're at the workplace, in court or someplace in the middle. Via internet browser you can access case records, complete tasks, and share invoices. With adlaw on the go, you can be productive no matter where you are..
                With an instinctive interface and simple to learn usefulness, Adlaw is designed to access rapidly by everybody, paying little respect to technical savvy. Whether you’re signing in for the first time or trying out a new feature, adlaw allows you to find value with minimal ramp time.</p>


                <p class="text-why p-text"> We offer incorporated solutions that address our customer’s needs. All solutions are tailored to customer-specific requirements. Reduced overlap time, speedier turnaround time and prompter responses are ingrained into our system.</p>   
            </div>
        </div>
    </div>
</section> --}}



<section class="mt-5 mb-5">
  <div class="container">
    <div class="row">
        <div class="col-md-11 m-auto">
            <div class="card shadow-sm card-border-top">
                <div class="card-header text-center p-2 ">
                  <h5 class="card-title text-primary">Number of Lawyers in States</h5>
                </div>
                <div class="card-body p-5 bg-gray" >
                    <div class="row" id="stateRow">
                      @foreach($states as $state)
                        <div class="col-md-4">
                            <a href="javascript:void(0)" class="text-primary stateView" id="{{$state->state_code}}" data-id="{{$state->state_name}}"> <i class="fa fa-map-marker "></i> {{$state->state_name}} ({{$state->state_count}})</a><br/><br/>
                        </div>
                      @endforeach
                          
                        
                    </div>
                   
                    <div class="row" id="stateRow1">
                        <div class="col-md-12 mt-5 text-center">                          
                            <a href="{{route('search')}}" class="btn btn-sm btn-primary p-2">Search Other States</a>
                        </div>
                    </div>

                    <div class="row d-none" id="cityRow">
                        
                        
                    </div>
                    <div class="row d-none" id="cityRow1">
                        <div class="col-md-12 mt-5 text-center">
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary p-2" id="backStateBtn">Back</a>
                            <a href="{{route('search')}}" class="btn btn-sm btn-primary p-2">Search Other Cities</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
{{-- 
<section class="mt-5" >
  <hr>
  <div class="container">
    <div class="row">
        <div class="col-md-11 m-auto pt-5 pb-5">
            <div class="card shadow-sm card-border-top">
                <div class="card-header text-center p-2 ">
                  <h5 class="card-title text-primary">Lawyer Specialization</h5>
                </div>
                <div class="card-body p-5 bg-gray">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Arbitration and Conciliation</a><br/><br/>

                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Banking and Finance</a><br/><br/>

                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Civil Law</a><br/><br/>

                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Criminal Law</a><br/><br/>
                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Constitutional Law</a><br/><br/>
                        </div>
                        <div class="col-md-4">
                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Corporate Law</a><br/><br/>
                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Consumer Law</a><br/><br/>
                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Cyber Law </a><br/><br/>
                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Education Law </a><br/><br/>
                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Election Law </a><br/><br/>
                        </div>
                        <div class="col-md-4">
                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Environmental Law </a><br/><br/>
                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Family Law </a><br/><br/>
                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Insurance Law </a><br/><br/>
                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Media Law </a><br/><br/>

                            <a href="" class="text-primary"> <i class="fa fa-balance-scale"></i> Property Law </a><br/><br/>
                        </div>
                        <div class="col-md-12 mt-5 text-center">
                            <a href="" class="btn btn-sm btn-primary p-2">Search in Other Courts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section> --}}

@include('layouts.features.category')

{{-- <div id="demo" class="carousel slide mb-5 mt-5" data-ride="carousel" data-interval="false">
  <ul class="carousel-indicators" >
    <li data-target="#demo" data-slide-to="0" class="active" style="background-color: #3379fd !important"></li>
     <li data-target="#demo" data-slide-to="1" style="background-color: #3379fd !important"></li> 
     <li data-target="#demo" data-slide-to="2" style="background-color: #3379fd !important"></li> 
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner" style="background-color: #fbfbfb">
    <div class="carousel-item active">
       @include('layouts.features.lawfirms')
    </div>
    <div class="carousel-item">
       @include('layouts.features.guest')
      
    </div>
    <div class="carousel-item">
       @include('layouts.features.lawschools')
     
    </div>
  </div>
</div>

 --}}
{{-- <section class="counts main-section">
  <div class="container">
    <div class="row">
        <div class="col-md-12 m-auto">
           <h4 class="card-title text-center">Client Testimonial</h4>
              
        </div>
      </div>
    </div>
</section> --}}

{{-- @include('pages.features.lawfirms') --}}
{{-- @include('pages.features.guest') --}}
{{-- @include('pages.features.lawschools') --}}
{{-- @include('layouts.footer') --}}

@endsection