{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">

				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Upload
						</h3>
					</div>
					<div class="box-body">
						@if($message = Session::get('success'))
							<div class="alert bg-success">
								{{$message}}
							</div>
						@endif
						<form action="{{route('admin.importData')}}" method="post" enctype="multipart/form-data">
							@csrf
						<div class="row">
							<div class="col-md-6 form-group">
								<select class="form-control" name="type">
									<option value="">Select Import Data Type</option>
									<option value="2">Lawyers</option>
									<option value="3">Law Firms</option>
									<option value="4">Law Schools</option>
								</select>
								@error('type')
				                  <span class="invalid-feedback d-block text-danger" role="alert">
				                  <strong>{{ $message }}</strong>
				                  </span>
				                @enderror
							</div>
							<div class="col-md-6 form-group">
								<input type="file" name="file" class="form-control">
								@error('file')
				                  <span class="invalid-feedback d-block text-danger" role="alert">
				                  <strong>{{ $message }}</strong>
				                  </span>
				                @enderror
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" class="btn btn-success btn-sm">Submit</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection