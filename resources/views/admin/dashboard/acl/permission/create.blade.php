@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header with-border">
					<h4 class="card-title">Permission Create
						<a href="{{route('permission.index')}}" class="btn btn-sm btn-primary pull-right">Back</a>
					</h4>
				</div>
				<div class="card-body">
					<form action="{{route('permission.store')}}" method="post">
						@csrf
						<div class="row">
							<div class="col-md-6 form-group">
								<label class="required">Name</label>
								<input type="text" name="name" class="form-control" required="required" value="{{old('name')}}">
								@error('name')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div> 

							<div class="col-md-6 form-group">
								<label class="required">Display name</label>
								<input type="text" name="display_name" class="form-control" required="required" value="{{old('display_name')}}">
								@error('display_name')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-6 form-group">
								<label class="">Module</label>
								<select class="form-control" name="module_id">
									<option value="">Select Module</option>
									@foreach($modules as $module)
										<option value="{{$module->id}}" {{old('module_id') == $module->id ? 'selected' : ''}}>{{$module->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-12 form-group">
								<label class="required">Description</label>
								<textarea class="form-control" name="description" rows="5" cols="5">{{old('description')}}</textarea>
								@error('description')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" class="btn btn-sm btn-success">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection