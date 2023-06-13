{{-- @extends(Auth::user()->user_catg_id == '5' ? 'customer.main' : (Auth::user()->user_catg_id == '2' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '3' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '4' ? 'lawschools.main' : (Auth::user()->user_catg_id == '6' ? 'lawschools.main' : (Auth::user()->user_catg_id == '7' ? 'lawschools.main' : 'admin.main')))))) --}}
@extends('partials.main')
@section('content')

<section class="content">

    <div class="row">
     @foreach($packages as $package)
      <div class="col-lg-4 col-md-4 col-sm-12 col-xl-4 col-xs-12 " style="margin-top: 10px; margin-bottom: 20px;">

        <div class="card mb-5 mb-lg-0 shadow-md ">
          <div class="card-body">
            <h3 class="card-title text-muted text-uppercase text-center">{{$package->name}}</h3>
            <h4 class="card-price text-center"><i class="fa fa-rupee"></i> {{$package->price}} </h4>
            <h4 class="card-price text-center">{{$package->duration}} - {{$package->duration_type}}</h4>
            <hr>
            @php 
              echo $package->description;
            @endphp
          {{--   <ul class="fa-ul">
              <li><span class="fa-li"><i class="fa fa-check"></i></span>100 Clients</li>
              <li><span class="fa-li"><i class="fa fa-check"></i></span>5GB Storage</li>
              <li><span class="fa-li"><i class="fa fa-check"></i></span>Unlimited Public Projects</li>
              <li><span class="fa-li"><i class="fa fa-check"></i></span>Community Access</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Unlimited Private Projects</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Dedicated Phone Support</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Free Subdomain</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Monthly Status Reports</li>
            </ul> --}}
            <a href="{{route('package.show', $package->id)}}" class="btn btn-block btn-primary text-uppercase" style="border-radius: 8px;">Buy</a>
          </div>
        </div>
      </div>
     @endforeach
    </div>

</section>
@endsection