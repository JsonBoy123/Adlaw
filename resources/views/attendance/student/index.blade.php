{{-- @extends('lawschools.main') --}}
@extends('partials.main')
@section('content')
<section class="content">
@include('attendance.header')
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Student Attendance <p class="pull-right">Today Date :- {{date('d-m-Y')}} | Time: {{date('h:i A')}}</p></h4>

			</div>
			<div class="panel-body">
				<div class="row">
					@include('attendance.details')
					<div class="col-md-2">
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
<script>
	$(document).ready(function(){
		$(document).on('click','.selectAll' ,function(){	
			 console.log('select');
			 if ($(this).is( ":checked" )) {
				$('body .check').prop('checked',true);

			 }else{
				$('body .check').prop('checked',false);
			 }
		});

		$('.search').on('click',function(e){
			e.preventDefault();
			filter_students();
		});

		$(document).on('click','#btnSubmit',function(e){
			e.preventDefault();
			console.log("adsasd")
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
			
			// console.log(s_ids1);
			// if(present_student.length !=0){
			$.ajax({
				type:'post',
				url:'{{route('attendance.submit')}}',
				data:{present_student:present_student,total_student:total_student},
				success:function(res){
					// console.log(res)
					if(res == 'success'){
						$.notify("Students attendance successfully submitted",'success');
						
					}else if(res =='warning'){
						$.notify("Student attendance already submitted");
					}else{
						$.notify("You can't submit weekend day attendance");
					}
					filter_students();
				}
			});

			// }else{
			// 	alert('Select the students first')
			// }	
		});
		function filter_students(){
			var qual_catg_code = $('select[name="qual_catg_code"] option:selected').val();
			var qual_code = $('select[name="qual_code"] option:selected').val();
			var batch = $('select[name="batch"] option:selected').val();
			var year = $('select[name="year"] option:selected').val();
			var semester = $('select[name="semester"] option:selected').val();
			if(qual_catg_code!='' && qual_code != '' && batch != '' && year != '' && semester !=''){
				$.ajax({
					type:'post',
					url:'{{route('attendance.student_fetch')}}',
					data:{qual_code:qual_code,qual_catg_code:qual_catg_code,batch:batch,year:year,semester:semester},
					success:function(res){
						$('#tableBody').empty().html(res);
						// console.log(res);
					}

				})
			}
			else{
				$.notify("All select field are mandatory.");
			}
		}
	})
</script>
@endsection

