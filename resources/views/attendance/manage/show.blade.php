{{-- @extends('lawschools.main') --}}
@extends('partials.main')
@section('content')
<section class="content">
@include('attendance.header')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Student Attendance <p class="pull-right">Today Date :- {{date('d-m-Y')}} | Time: {{date('h:i A')}}</p></h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						Student Name : {{$student->f_name .' '. $student->l_name }}
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-3 form-group">
						<label>{{__('Start Date')}}</label>
						<input type="text" name="start_date" class="datepicker form-control" readonly="readonly" value="{{date('Y-m-d')}}">
					</div>
					<div class="col-md-3 form-group">
						<label>{{__('End Date')}}</label>
						<input type="text" name="end_date" class="datepicker form-control" readonly="readonly" value="{{date('Y-m-d')}}">
					</div>
					<div class="col-md-3 " style="padding-top: 26px">
						<button class="btn btn-sm btn-primary btnSearch"> Search</button>
						<button class="btn btn-sm btn-success btnUpdate" style="display:none">Update</button>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-12 tableBody">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script>
	$(document).ready(function(){
		$(function () {
			$(".datepicker").datepicker({
				format: 'yyyy-mm-dd'
			});
		});
		$('.btnSearch').on('click',function(e){
			e.preventDefault();
			attendance_filter();
		});
		$('.btnUpdate').on('click',function(e){
			e.preventDefault();
			var all_attendance_dates = [];
			var i = 0; 
			$('input[name="attendance_date[]"]').each(function(){
				all_attendance_dates[i++] = $(this).val() 
			});
			var checked_attendance_dates = [];
			var j = 0; 
			$('input[name="attendance_date[]"]:checked').each(function(){
				checked_attendance_dates[j++] = $(this).val();
			});

			var s_id = '{{$student->id}}';

			if(all_attendance_dates.length !=0){
				$.ajax({
					type:'post',
					url:'{{route('attendance.update')}}',
					data:{s_id:s_id,all_attendance_dates:all_attendance_dates,checked_attendance_dates:checked_attendance_dates},
					success:function(res){
						if(res =='success'){
							alert('Attendance Update')
							attendance_filter();
						}
					}
				})
			}
		});
		function attendance_filter(){
			var start_date = $('input[name="start_date"]').val();
			var end_date =  $('input[name="end_date"]').val();
			var s_id = '{{$student->id}}';
			if(start_date !='' && end_date !=''){
				if(end_date >= start_date){
					$.ajax({
						type:'post',
						url:'{{route('attendance.list')}}',
						data:{start_date:start_date,end_date:end_date,s_id:s_id},
						success:function(res){
							// console.log(res)
							$('.tableBody').empty().html(res);
							$('.btnUpdate').show();
						}
					});
				}else{
					alert('The end date must after start date');
				}
			}else{
				alert('The date field is required');
			}
		}
	});
</script>
@endsection
