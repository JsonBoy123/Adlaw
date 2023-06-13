{{-- @extends('lawschools.main') --}}
@extends('partials.main')
@section('content')
<section class="content">
@include('attendance.header')
 <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Attendance Report<p class="pull-right">Today Date :- {{date('d-m-Y')}} | Time: {{date('h:i A')}}</p></h4>

			</div>
			<div class="panel-body">
				<div class="row mb-4">
					<div class="col-md-12">
						<a href="{{route('attendance.student_report')}}" class="btn btn-sm {{Request()->segment(3) == 'student' ? 'btn-primary' : 'btn-default'}}">{{__('Student Report')}}</a>
						<a href="{{route('attendance.staff_report')}}" class="btn btn-sm {{Request()->segment(3) == 'staff' ? 'btn-primary' : 'btn-default'}}">{{__('Staff Report')}}</a>
					</div>
				</div>
				<form action="{{route('attendance.staff_report_generate')}}" method="post">
					@csrf
					<div class="row mt-4">
						<div class="col-md-2">
							<input type="text" readonly="" name="attendance_date" value="{{date('Y-m')}}" class="datepicker form-control">
							@error('attendance_date')
								<span class="invalid-feedback text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>				
						<div class="col-md-2">
							<button class="btn btn-sm btn-primary search">Search</button>
						</div>
					</div>
				</form>
				<br>
				<div class="row">
					<div class="col-md-12" id="tableBody" ></div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script >
	$(document).ready(function(){
		$(function () {
			$('.datepicker').datepicker( {
			    format: "yyyy-mm",
			    viewMode: "months", 
			    minViewMode: "months"
			});
		});
	});
</script>
@endsection