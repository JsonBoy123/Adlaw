{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12 m-auto">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title" >Edit Package</h3>
			 <a href="{{route('acl_package.index')}}" class="btn btn-sm btn-info pull-right">Back</a>

			</div>
			<div class="box-body">
				<form action="{{route('acl_package.update',$package->id)}}" method="post"> 
					@method('PATCH')
					@csrf
					<div class="row">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Package Name</label>
							<input type="text" name="name" class="form-control" placeholder="Enter package name" value="{{old('name') ?? $package->name}}">
							@error('name')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Package Price</label> <span class="text-muted">(In Rupees)</span>
							<input type="text" name="price" class="form-control" placeholder="Enter package price" value="{{old('price') ?? $package->price}}">
							@error('price')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Duration Type</label>
							<select name="duration_type" class="form-control">
								<option value="day" {{old('duration_type') == 'day' ? 'selected' : ($package->duration_type == 'day' ? 'selected' : '')}}>Day</option>
								<option value="month" {{old('duration_type') == 'month' ? 'selected' : ($package->duration_type == 'month' ? 'selected' : '')}}>Month</option>
								<option value="year" {{old('duration_type') == 'year' ? 'selected' : ($package->duration_type == 'year' ? 'selected' : '')}}>Year</option>
							</select>
							@error('duration_type')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Duration</label>
							<input type="text" name="duration" class="form-control" placeholder="Enter duration" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('duration') ?? $package->duration}}">
							@error('duration')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<label class="required">Module Assine</label>
							<select name="module_id[]" class="form-control select2" multiple="multiple">
								{{-- <option value="0" >Select Module</option> --}}
								@foreach($modules as $module)
									<option value="{{$module->id}}" @foreach($package->modules as $p_module)  
											{{$p_module->module_id == $module->id ? 'selected' : ''}}
										@endforeach  {{ (collect(old('module_id'))->contains($module->id)) ? 'selected':'' }}>{{$module->name}}</option>
								@endforeach
							</select>
							@error('module_id')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label class="required">Package Description</label>
							<textarea name="description" rows="10" cols="50" class="form-control tinymce" placeholder="" >{{old('description') ?? $package->description}}</textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 form-group">
							<button class="btn btn-sm btn-success">Update</button>
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
		$('label.required').append('<span class="text-danger"> <strong>*</strong> </span>');
		$('.select2').select2({
		  placeholder: 'Select Module',
		  allowClear: true
		});
	 
	})
</script>
@endsection