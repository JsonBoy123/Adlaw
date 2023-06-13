{{-- @extends('lawschools.main') --}}
@extends('partials.main')
@section('content')
<section class="content">
@include('fees.header')
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="card card-primary">
			<div class="card-header p-2">
				<h4 class="card-title"><b>FEES</b></h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 text-center">
						<a href="">
							<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'fees' ? 'active-li' : ''}}" >
								<i class="fa fa-cubes"></i>
								<h5>Fee</h5>
							</div>
						</a>
						<a href="">
							<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'fees' ? 'active-li' : ''}}" >
								<i class="fa fa-cubes"></i>
								<h5>Draft Fee</h5>
							</div>
						</a>
						<a href="">
							<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'fees' ? 'active-li' : ''}}" >
								<i class="fa fa-cubes"></i>
								<h5>Fee Setting</h5>
							</div>
						</a>
						<a href="">
							<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'fees' ? 'active-li' : ''}}" >
								<i class="fa fa-cubes"></i>
								<h5>New Admission Fees</h5>
							</div>
						</a>
						<a href="">
							<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'fees' ? 'active-li' : ''}}" >
								<i class="fa fa-cubes"></i>
								<h5>Dynamic Fees</h5>
							</div>
						</a>
						<a href="">
							<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'fees' ? 'active-li' : ''}}" >
								<i class="fa fa-cubes"></i>
								<h5>Pay Regular Fees</h5>
							</div>
						</a> 
						<a href="">
							<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'fees' ? 'active-li' : ''}}" >
								<i class="fa fa-cubes"></i>
								<h5>Concession</h5>
							</div>
						</a> 
						<a href="">
							<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'fees' ? 'active-li' : ''}}" >
								<i class="fa fa-cubes"></i>
								<h5>Paid History</h5>
							</div>
						</a> 
						<a href="">
							<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'fees' ? 'active-li' : ''}}" >
								<i class="fa fa-cubes"></i>
								<h5>Bulk Fees Upload</h5>
							</div>
						</a> 
						<a href="">
							<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'fees' ? 'active-li' : ''}}" >
								<i class="fa fa-cubes"></i>
								<h5>Fees Discount</h5>
							</div>
						</a> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection