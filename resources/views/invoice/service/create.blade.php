@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"> 
					<h5>Service Add
						<a href="{{route('invoice_service.index')}}" class="btn btn-sm btn-primary pull-right">Back</a>
					</h5>
				</div>
				<div class="card-body table-responsive"> 
					<form method="post" action="{{route('invoice_service.store')}}" autocomplete="off">
						@csrf
						<div class="row form-group">
							<div class="col-md-6">
								<label class="required">Service Category Name</label>
								<select class="form-control" name="service_catg_code" id="service_catg" >
									<option value="">Select Service Category</option>
									@foreach($service_catgs as $service_catg)
									<option value="{{$service_catg->service_catg_code}}" {{(old('service_catg_code') == $service_catg->service_catg_code ? 'selected="selected"' :'')}}>{{$service_catg->service_catg_desc}}</option>

									@endforeach
								</select>
								@error('service_catg_code')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-6">
								<label class="required">Service Name</label>
								<select class="form-control" name="service_code" id="service_mast">
									
								</select>
								@error('service_code')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row form-group" id="service"  style="display: none;">
							<div class="col-md-6" >
								<label class="required">Custom Service Full Name</label>
								<input type="text" name="service_desc" value="{{old('service_desc')}}" class="form-control">
								@error('service_desc')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-6" >
								<label class="required">Custom Service Short Name</label>
								<input type="text" name="service_shrt_desc" value="{{old('service_shrt_desc')}}" class="form-control">
								@error('service_shrt_desc')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label class="required">Service Rate</label>
								<input type="text" name="service_rate" value="{{old('service_rate')}}" class="form-control"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
								@error('service_rate')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-6">
								<label class="required">Service Discount (In rupees)</label>
								<input type="text" name="service_discount" value="{{old('servive_discount') !='' ? old('service_discount') : '0'}}" class="form-control"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
								@error('service_discount')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-6">
								<label class="required">Service Status</label>
								<select name="status" class="form-control">	
									<option value="A" {{(old('status') =='A' ? 'selected="selected"' : '')}}>Active</option>
									<option value="P" {{(old('status') =='P' ? 'selected="selected"' : '')}}>Pending</option>
								</select>
								@error('status')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-success">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>		
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){

		$('.required').append("<span class='text-danger'>*</span>");

		var service_catg_code ="{{old('service_catg_code')}}";
		var service_code ="{{old('service_code')}}";
		if(service_catg_code != ''){
			service_mast_fetch('#service_mast',service_catg_code,service_code);
		}


		$('#service_catg').on('change',function(e){
			e.preventDefault();
			var service_catg_code = $(this).val();
			// console.log(service_catg_code);
			var service_mast_id = '#service_mast';
			service_mast_fetch(service_mast_id,service_catg_code);
		});

		$('#service_mast').on('change',function(e){
			e.preventDefault();
			var service_code = $(this).val();
			service_mast(service_code);
		});

		if(service_code !=''){
			service_mast(service_code);
		}


		function service_mast(service_code){
			if(service_code == 'other'){
				$('#service').show();
			}else{
				$('#service').hide();
			}
		}


	});
</script>
@endsection