{{-- @extends('lawschools.main') --}}
@extends('partials.main')
@section('content')
<section class="content">
@include('attendance.header')
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Upload Attendance <p class="pull-right">Today Date :- {{date('d-m-Y')}} | Time: {{date('h:i A')}}</p></h4>
			</div>
			<div class="panel-body">
				<form action="{{route('attendance.import')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-8" style="margin-top: 10px;" >
							<h4><b>Import Attendence Month Wise</b></h4>
							<br>
							<label>Upload File</label>
							<input type="file" name="file" >
							@error('file')
								<span class="text-danger">
									<strong>{{$message}}</strong>
								</span>
							@enderror
							<br>
							<input type="submit" value="Submit" class="btn btn-sm btn-primary">
							<br>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
</section>
@endsection