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
				<div class="row">
					<div class="col-md-12">
						<a href="{{route('attendance.manage_student')}}" class="btn btn-sm {{Request()->segment(3) == 'student' ? 'btn-primary' : 'btn-default'}}">Student attendance</a>
						<a href="{{route('attendance.manage_staff')}}" class="btn btn-sm {{Request()->segment(3) == 'staff' ? 'btn-primary' : 'btn-default'}} ">Staff attendance</a>
					</div>
				</div>

				<div class="row mt-4">
					@include('attendance.details')
					<div class="col-md-2">
						<input type="text" readonly="" name="attendance_date" value="{{date('Y-m-d')}}" class="datepicker form-control">
					</div>
				</div>
				<div class="row mt-4" >
					<div class="col-md-12 text-center">
						<button class="btn btn-sm btn-primary search">Search</button>
					</div>
				</div>
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
				$(".datepicker").datepicker({
					format: 'yyyy-mm-dd'
				});
			});

		$('.search').on('click',function(e){
			e.preventDefault();
			filter_students();
		});

		function filter_students(){
			var qual_catg_code = $('select[name="qual_catg_code"] option:selected').val();
			var qual_code = $('select[name="qual_code"] option:selected').val();
			var batch = $('select[name="batch"] option:selected').val();
			var year = $('select[name="year"] option:selected').val();
			var semester = $('select[name="semester"] option:selected').val();
			var attendance_date = $('input[name="attendance_date"]').val();
		
			
			if(qual_catg_code!='' && qual_code != '' && batch != '' && year != '' && semester !='' && attendance_date !=''){
				$.ajax({
					type:'post',
					url:'{{route('attendance.student_filter')}}',
					data:{qual_code:qual_code,qual_catg_code:qual_catg_code,batch:batch,year:year,semester:semester,attendance_date:attendance_date},
					success:function(res){
						 $('#tableBody').empty().html(res);
						// console.log(res);
					}
				});
							
			}
			else{
				$.notify('All select field are mandatory');
			}
		}


		$(document).on('click','#updateBtn',function(e){
			e.preventDefault();
			// console.log("adsasd")
			var present_student = [];
			var i = 0;
			$('input[name="s_id[]"]:checked').each(function() {
				present_student[i++] = $(this).val();
			});
			var j =0;
			var total_student = [];
			$('input[name="s_id[]"]').each(function() {
				total_student[j++] = $(this).val();
			});
			
			var attendance_date = $('input[name="attendance_date"]').val();
			// console.log(s_ids1);
			// if(present_student.length !=0){
				$.ajax({
					type:'post',
					url:'{{route('attendance.update')}}',
					data:{present_student:present_student,total_student:total_student,attendance_date:attendance_date},
					success:function(res){
						if(res == 'success'){
							alert('Students attendance updated successfully');
						}
						filter_students();
					}
				});

			// }else{
			// 	alert('Select the students first')
			// }	
		});



		// $(".attendance_date,.end_date").datepicker({
  //   		format : 'yyyy-mm-dd',
  //   	});

		// function filter_students(){
		// 	var qual_catg_code = $('select[name="qual_catg_code"] option:selected').val();
		// 	var qual_code = $('select[name="qual_code"] option:selected').val();
		// 	var batch = $('select[name="batch"] option:selected').val();
		// 	var year = $('select[name="year"] option:selected').val();
		// 	var semester = $('select[name="semester"] option:selected').val();
		// 	if(qual_catg_code!='' && qual_code != '' && batch != '' && year != '' && semester !=''){
		// 		$.ajax({
		// 			type:'post',
		// 			url:'{{route('attendance.student_filter')}}',
		// 			data:{qual_code:qual_code,qual_catg_code:qual_catg_code,batch:batch,year:year,semester:semester},
		// 			success:function(res){
		// 				$('#tableBody').empty().html(res);
		// 				// console.log(res);
		// 			}

		// 		})
		// 	}
		// 	else{
		// 		alert('All select field are mendarory');
		// 	}
		// }
	});
</script>
@endsection