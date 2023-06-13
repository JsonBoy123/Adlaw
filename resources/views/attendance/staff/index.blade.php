@extends('lawschools.main')
@section('content')
<section class="content">
@include('attendance.header')
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Staff Attendance <p class="pull-right">Today Date :- {{date('d-m-Y')}} | Time: {{date('h:i A')}}</p></h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2 form-group">
						{{-- <input type="text" name="attendance_date" readonly="readonly" class="datepicker form-control" value="{{date('Y-m-d')}}">  --}}
					</div>
					<div class="col-md-2"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><input type="checkbox" name="all" class="selectAll"></th>
									<th>Name</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
								<tr>
									<td>
										<input type="checkbox" name="s_id[]"  class="check" value="{{$user->id}}" {{count($user->attendances) !=0 ? 'checked="checked"' :''}}>
									</td>
									<td>{{$user->name}}</td>
									<td>
										{{count($user->attendances) !=0 ? ($user->attendances[0]->present) :''}}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<button class="btn btn-sm btn-success btnSubmit">Submit</button>
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
		$(document).on('click','.selectAll' ,function(){	
			if($(this).is( ":checked" )) {
				$('body .check').prop('checked',true);
			}else{
				$('body .check').prop('checked',false);
			}
		});
		$('.btnSubmit').on('click',function(e){
			e.preventDefault();
			console.log("adsasd")
			var present = [];
			var i = 0;
			$('input[name="s_id[]"]:checked').each(function() {
				present[i++] = $(this).val();
			});
			var j =0;
			var total = [];
			$('input[name="s_id[]"]').each(function() {
				total[j++] = $(this).val();
			});
			$.ajax({
				type: 'post',
				url: '{{route('attendance-staff.submit')}}',
				data:{present:present,total:total},
				success:function(res){
					if(res == 'success'){
						$.notify("Staff today attendance successfully submitted",'success');
						
					}else if(res =='warning'){
						$.notify("Staff today attendance already submitted");
					}else{
						$.notify("You can't submit weekend day attendance");
					}
				}

			})
		});
	});
</script>
@endsection