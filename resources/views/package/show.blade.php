{{-- @extends(Auth::user()->user_catg_id == 2 ? 'lawfirm.main' : (Auth::user()->user_catg_id == 3 ? 'lawfirm.main' : (Auth::user()->user_catg_id == 4 ? 'lawschools.main' : (Auth::user()->user_catg_id == 6 ? 'lawschools.main' : (Auth::user()->user_catg_id == 7 ? 'lawschools.main' : (Auth::use()->user_catg_id == 5 ? 'customer.main' : 'admin.main')))))) --}}
@extends('partials.main')
@section('content')
<section class="content">
	
<div class="row">
	<div class="col-md-12">
		<div class="card card-primary">
			<div class="card-header">
				<a href="{{route('package.index')}}" class="btn btn-sm btn-info pull-right">Back</a>					
			</div>
			<div class="card-body">
				<div class="row">

					<div class="col-md-5">
				<h2 style="font-weight: bold;">{{$package->name}}</h2>
				<h4><i class="fa fa-rupee"></i> {{$package->price}}</h4>
				<h4>{{$package->duration}} - {{$package->duration_type}}</h4>

				<h4>
					@php 
						echo $package->description;
					@endphp
				</h4>
			
						<h4 style="font-weight: bold;">Modules </h4>
						<ul>							
							@foreach($package->modules as $pmodule)
								<li> {{$pmodule->module->name}}</li>
							@endforeach
						</ul>
					</div>
					<div class="col-md-7">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Package Payment</h4>
							</div>
							<div class="card-body">
								<form action="{{route("package.store")}}" method="post">
									@csrf
								<div class="row">	

									<div class="col-md-6 form-group" >
										<label>Package Plan Amount</label>
										<input type="text" name="amount" class="form-control" value="{{$package->price}}" readonly="readonly">
									</div>
								</div>
									
								<div class="row">
									<div class="col-md-6 form-group">
										<label>Package Duration</label>
										<input type="text" readonly="" value="{{$package->duration}} - {{$package->duration_type}}" >
									</div>
									<div class="col-md-12 form-group">
										<input type="hidden" name="package_id" value="{{$package->id}}">
										<button class="btn btn-sm btn-success btnSubmit" type="submit">Confirm Package Payment</button>
									</div>
								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
{{-- 				
<div class="modal fade modal_check" id="">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Package Payment Confirmation</h4>
			</div>
			<div class="modal-body" id="case-body">
				<div class="row">
					<div class=""></div>
				</div>
			</div>
			 <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		</div>
	</div>
</div> --}}
			</div>
		</div>
	</div>
</div>
</section>
<script>
	$(document).ready(function(){


		// $('.btnSubmit').on('click',function(){
		// 	$('.modal_check').modal('show');
		// });
	})

</script>
@endsection