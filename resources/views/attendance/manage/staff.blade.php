{{-- @extends('lawschools.main') --}}
@extends('partials.main')
@section('content')
<section class="content">
@include('attendance.header')
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Manage Attendance <p class="pull-right">Today Date :- {{date('d-m-Y')}} | Time: {{date('h:i A')}}</p></h4>

			</div>
			<div class="panel-body">
				<div class="row mb-4">
					<div class="col-md-12">
						<a href="{{route('attendance.manage_student')}}" class="btn btn-sm {{Request()->segment(3) == 'student' ? 'btn-primary' : 'btn-default'}}">Student attendance</a>
						<a href="{{route('attendance.manage_staff')}}" class="btn btn-sm {{Request()->segment(3) == 'staff' ? 'btn-primary' : 'btn-default'}} ">Staff attendance</a>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-md-2">
						<input type="text" readonly="" name="attendance_date" value="{{date('Y-m-d')}}" class="datepicker form-control">
					</div>
					<div class="col-md-2">
						<button class="btn btn-sm btn-primary search">Search</button>
					</div>
				</div>
				
				<br>
				<div class="row">
					<div class="col-md-12" id="tableBody" >
						@include('attendance.manage.staff_table')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
	<script >
		$(document).ready(function(){
			$(function () {
				$(".datepicker").datepicker({
					format: 'yyyy-mm-dd'
				});
			});

		$('.search').on('click',function(e){
			e.preventDefault();
			var attendance_date = $('input[name="attendance_date"]').val();

			filter_staff(attendance_date)
		});

		function filter_staff(attendance_date){
			$.ajax({
					type:'post',
					url:'{{route('attendance.staff_filter')}}',
					data:{attendance_date:attendance_date},
					success:function(res){
						 $('#tableBody').empty().html(res);
						// console.log(res);
					}
				});
		}
			$(document).on('click','#updateBtn',function(e){
			e.preventDefault();
			// console.log("adsasd")
			var presents = [];
			var i = 0;
			$('input[name="emp_id[]"]:checked').each(function() {
				presents[i++] = $(this).val();
			});
			var j =0;
			var totals = [];
			$('input[name="emp_id[]"]').each(function() {
				totals[j++] = $(this).val();
			});
			
			var attendance_date = $('input[name="attendance_date"]').val();
			
				$.ajax({
					type:'post',
					url:'{{route('attendance.staff_update')}}',
					data:{presents:presents,totals:totals,attendance_date:attendance_date},
					success:function(res){
						if(res == 'success'){
							$.notify('Staff attendance updated successfully','success');
						}
						filter_staff(attendance_date);	
					}
				});

			// }else{
			// 	alert('Select the students first')
			// }	
		});

		
	});
</script>
@endsection