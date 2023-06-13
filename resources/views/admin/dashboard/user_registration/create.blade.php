
@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Add User 
							<a href="{{route('registration')}}" class="btn btn-sm btn-primary pull-right">Back</a>
							
						</h3>
					</div>
					<div class="box-body">
						<form action="{{route('registration.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="referral_code">Referral Code</label>
									<input type="text" name="referral_code" value="{{old('referral_code')}}" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
									@error('referral_code')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="name">Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control timepicker" name="name" value="{{old('name')}}" required="required">  
									@error('name')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror      
								</div>	
								<div class="col-md-6 form-group">
									<label for="email">Email Address</label>
									<input type="text" name="email" class="form-control" value="{{old('email')}}">
									@error('email')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
							</div>	
							<div class="row">	
								<div class="col-md-6 form-group">
									<label for="mobile">Mobile Number <span class="text-danger">*</span></label>
									<input type="text" class="form-control timepicker" name="mobile" value="{{old('mobile')}}" required="required" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"> 
									@error('mobile')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror     
								</div>	
								<div class="col-md-6 form-group">
									<label for="gender">Gender <span class="text-danger">*</span></label>
									<select class="form-control" name="gender">
										<option value="">Select Gender</option>
										@foreach(GENDER as  $key => $gender)
											<option value="{{$key}}">{{$gender}}</option>
										@endforeach
									</select>
									@error('gender')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror     
								</div>	
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="licence_no">Bar Licence Number <span class="text-danger">*</span></label>
									<input type="text" class="form-control timepicker" name="licence_no" value="{{old('licence_no')}}" required="required"> 
									@error('licence_no')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 
								</div>
								<div class="col-md-6 form-group">
									<label for="estd_year">Experience</label>
									<input type="number" name="estd_year" class="form-control" value="{{old('estd_year')}}">
									@error('estd_year')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 
								</div>
							</div>		
							<div class="row">
								<div class="col-md-4 form-group">
									<label for="address">Address</label>
									<input type="text" name="address" value="{{old('address')}}" class="form-control">
									@error('address')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 	
								</div>
								<div class="col-md-4 form-group">
									<label for="state_code">State</label>
									<select class="form-control" name="state_code" id="state">
										<option value="">Select State</option>
										@foreach($states as $state)
											<option value="{{$state->state_code}}">{{$state->state_name}}</option>
										@endforeach
									</select>
									@error('state_code')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 	
								</div>
								<div class="col-md-4 form-group">
									<label for="city_code">City</label>
									<select class="form-control" name="city_code" id="city">
										
									</select>
									@error('city_code')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 	
								</div>
							</div>				
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="zip_code">Zip Code</label>
									<input type="text" name="zip_code" value="{{old('zip_code')}}" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
									@error('zip_code')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 
								</div>								
								<div class="col-md-6 form-group">
									<label for="photo">Photo</label>
									<input type="file" name="photo" value="form-control" >
									@error('photo')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 form-group">
									<label for="state1">Courts Type</label>
									<select class="form-control" name="state1" id="state1">
										<option value="">Select State</option>
										@foreach($states as $state)
											<option value="{{$state->state_code}}">{{$state->state_name}}</option>
										@endforeach
									</select>
									@error('state1')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 
								</div>
								<div class="col-md-4 form-group">
									<label for="court_type">Courts Type</label>
									<select class="form-control" name="court_type" id="court_type">
										
									</select>
									@error('court_type')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 
								</div>
								<div class="col-md-4 form-group">
									<label for="court_code">Working Courts</label>
									<select class="select2 form-control" name="court_code[]" id="workingCourts" multiple="multiple">


									</select>
									@error('court_code')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="specialization">Specialization</label>
									<select class="select2 form-control" name="specialization[]" multiple="multiple">
										<option value="">Select Specialization</option>
										@foreach($specs as $spec)
											<option value="{{$spec->catg_code}}">{{$spec->catg_desc}}</option>
										@endforeach
									</select>
									@error('specialization')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label for="about">About User</label>
									<textarea name="about" class="form-control tinymce" rows="10" cols="50" >{{old('about')}}</textarea>
									@error('about')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror 
								</div>
							</div>

							<div class="row mt-5">
								<div class="col-md-12 form-group ">
									<input type="submit" value="Submit" class="btn btn-sm btn-primary">
								</div>								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
		$(document).ready(function(){
			$('.select2').select2();
			$('#state1').on('change',function(){
	          	var state_code = $(this).val();
	          	state_city_court('',state_code,'#court_type');
	        });
			$('#court_type').on('change',function(){
		          var court_type = $(this).val();
		          court_fetch(court_type);

		       })

		      function court_fetch(court_type){
		        var state_code = $('#state1').val();
		          
		            $.ajax({
		              type:'GET',
		              url:"/user_court_list?court_type="+court_type+'&state_code='+state_code,
		              success:function(res){
		                if(res){
		                  $('#workingCourts').empty();
		                  $.each(res, function(i,v){
		                    console.log(v)
		                    $('#workingCourts').append('<option value="'+v.court_code+'">'+v.court_name+' at '+v.city_name+'</option>');
		                  });

		                }else{
		                  $('#workingCourts').empty();
		                }
		              }
		            });
		      }



			$('#state').on('change',function(e){
				e.preventDefault();
				var state_code = $(this).val();
				var city_code = "";
				state(state_code, city_code);
			});

			tinymce.init({
				selector: "textarea.tinymce",
				plugins: [
				"advlist autolink link image lists charmap print preview hr anchor pagebreak",
				
				"   directionality emoticons template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  forecolor backcolor ",
				height: 300,
			});
			 
		});
	</script>
@endsection