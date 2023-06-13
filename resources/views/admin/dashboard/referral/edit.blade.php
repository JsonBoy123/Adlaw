{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Edit Referral User 
							<a href="{{route('referral.index')}}" class="btn btn-sm btn-primary pull-right">Back</a>
						
						</h3>
					</div>
					<div class="box-body">
						<form action="{{route('referral.update',$referral->id)}}" method="post">
							@csrf
							@method('patch')
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="name">Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control timepicker" name="name" value="{{old('name') ?? $referral->name}}">  
									@error('name')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror      
								</div>	
								<div class="col-md-6 form-group">
									<label for="email">Email Address <span class="text-danger">*</span></label>
									<input type="text" name="email" class="form-control" value="{{old('email') ?? $referral->email}}">
									@error('email')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
						
								<div class="col-md-6 form-group">
									<label for="mobile">Mobile Number <span class="text-danger">*</span></label>
									<input type="text" class="form-control timepicker" name="mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('mobile') ?? $referral->mobile}}"> 
									@error('mobile')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror     
								</div>	
								
								{{-- <div class="col-md-6 form-group">
									<label for="address">Address <span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="address" value="{{old('address')}}"> 
									@error('address')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror     
								</div>		 --}}			
								<div class="col-md-6 form-group">
									<label for="state_code">State <span class="text-danger">*</span> </label>
									<select name="state_code" class="form-control" id="state">
										<option value="0">Select state</option>
										@foreach($states as $state)
											<option value="{{ $state->state_code }}" {{old('state_code') == $state->state_code ? 'selected' : ''}} {{$referral->state_code ==$state->state_code ? 'selected' : ''}}>{{ $state->state_name}}</option>
										@endforeach
									</select>
									@error('state_code')
					                    <span class="invalid-feedback text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
					                @enderror 
								</div>
								<div class="col-md-6 form-group">
									<label for="city_code">City <span class="text-danger">*</span> </label>
									<select name="city_code" class="form-control " id="city">
									</select>
									@error('city_code')
					                    <span class="invalid-feedback text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
					                @enderror
								</div>
								{{-- <div class="col-md-6 form-group" >
									<label for="zip_code">Zip Code <span class="text-danger">*</span></label>
									<input type="text" name="zip_code" class="form-control " value=" {{ old('zip_code')}}" placeholder="Enter Zip code" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
									@error('zip_code')
					                    <span class="invalid-feedback text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
					                @enderror

								</div> --}}
							</div>
							<div class="row ">
								<div class="col-md-12 ">
									<input type="hidden" name="country_code" value="102">
									<input type="submit" value="Submit" class="btn btn-sm btn-primary">
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

	$('#state').on('change',function(e){
		e.preventDefault();
		var state_code = $(this).val();
		var city_code = "";
		state(state_code, city_code);
	});

	var state_code =("{{old('state_code')}}" == '' ? "{{$referral->state_code}}" : "{{old('state_code')}}" );  
	var city_code = ("{{old('city_code')}}" == '' ? "{{$referral->city_code}}" : "{{old('city_code')}}" );

	if(state_code !=''){
		state(state_code, city_code);
	}

});
</script>
@endsection