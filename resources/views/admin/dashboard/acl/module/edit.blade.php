{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12 m-auto">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title" >Edit Module</h3>
			 <a href="{{route('acl_module.index')}}" class="btn btn-sm btn-info pull-right">Back</a>

			</div>
			<div class="box-body">
				<form action="{{route('acl_module.update',$module->id)}}" method="post"> 
					@method('PATCH')
					@csrf
					<div class="row">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Module Name</label>
							<input type="text" name="name" class="form-control" placeholder="Enter module name" value="{{old('name') ?? $module->name}}">
							@error('name')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>	
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Module Status</label>	
							<select name="is_active" class="form-control" id="status">
								<option value="1" {{old('is_active') == '1' ? 'selected' : ''}} {{$module->is_active == '1' ? 'selected' : ''}}> Active</option>
								<option value="0" {{old('is_active') == '0' ? 'selected' : ''}} {{$module->is_active == '0' ? 'selected' : ''}}> Pending</option>
							</select>
							@error('is_active')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
										
					</div>
					<div class="row"  id="dateDiv" style="display: none">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">		
							<label class="required">Module Form Date</label>					
							<input type="text" name="from" class="form-control datepicker" placeholder="Enter from date" value="{{old('from') ?? $module->from}}" readonly> 
							@error('from')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Module To Date</label>					
							<input type="text" name="to" class="form-control datepicker" placeholder="Enter to date" value="{{old('to') ?? $module->to}}" readonly> 
							@error('to')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">							
							<label class="required">Module Link</label>					
							<input type="text" name="link" class="form-control" placeholder="Enter module link" value="{{old('link') ?? $module->link}}"> 
							@error('link')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Icon</label>
							<input type="text" name="icon" class="form-control" placeholder="Enter icon name" value="{{old('icon') ?? $module->icon}}">
							@error('icon')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>	
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Roles</label> <span class="text-muted"> (Who can view this module)</span>
							<select name="permissions[]" class="form-control select2" multiple="multiple" required="required">
								<option value="0" disabled="">Select Roles</option> 
								@foreach($roles as $role)
									<option value="{{$role->id}}" {{$module->permissions !=null ? (in_array( $role->id , json_decode($module->permissions)->can_view) == '1' ? 'selected' : '' )  : '' }}>{{$role->display_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Show Team member</label>
							<select class="form-control" name="show_team">
								<option value="1" {{$module->show_team == '1' ? 'selected' : '' }}>Yes</option>
								<option value="0" {{$module->show_team == '0' ? 'selected' : '' }}>No</option>
							</select>
						</div>
					 </div>
					 <div class="row">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Module Type</label> {{-- <span class="text-muted"></span> --}}
							<select name="module_type" class="form-control" required="required">
								<option value="" >Select Module Type</option> 
								@foreach(MODULETYPE as $key => $value)
									<option value="{{$key}}" {{$module->module_type == $key ? 'selected' : ''}}>{{$value}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Module Line</label>
							<input type="text" name="line" class="form-control" placeholder="Enter module line" value="{{old('line') ?? $module->line}}"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
							@error('line')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>	
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<button class="btn btn-sm btn-success">Submit</button>
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
			$('.select2').select2({
				placeholder: 'Select Roles',
			});
		$('label.required').append('<span class="text-danger"> <strong>*</strong> </span>');
		
		$(function () {
			$(".datepicker").datepicker();
		});


		var status = "{{old('is_active') !='' ? old('is_active') : '1'}}";
		statusDiv(status);
		$('#status').on('change',function(){
			var status = $(this).val();
			statusDiv(status);
		});


		function statusDiv(status){
			if(status == '1'){
				$('#dateDiv').hide();
			}else{
				$('#dateDiv').show();

			}
		}
	})
</script>
@endsection