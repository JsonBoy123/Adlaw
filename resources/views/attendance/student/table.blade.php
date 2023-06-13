<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>
				<input type="checkbox" name="all" class="selectAll">
			</th>
			<th>Name</th>
			{{-- <th>Enrollment Number</th> --}}
			<th>Roll Number</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach($students as $student)
			<tr>
				<td>
					<input type="checkbox" name="s_id[]"  class="check" value="{{$student->id}}" 
						@if(!empty($attendance_students))
						@foreach($attendance_students as $attendance_student)
							@if($attendance_student->s_id == $student->id)
								checked="checked" 
							@endif
						@endforeach
					@endif

					>
					{{-- <button class="btn btn-sm btn-success">P</i></button>	
					<button class="btn btn-sm btn-danger">A</i></button>	 --}}
				</td>
				<td>{{$student->f_name .' '. $student->l_name }}</td>
				{{-- <td>{{$student->enroll_no}}</td> --}}
				<td>{{$student->roll_no}}</td>
				<td>
					@if(!empty($attendance_students))
						@foreach($attendance_students as $attendance_student)
							@if($attendance_student->s_id == $student->id)
								{{$attendance_student->present}}
							@endif
						@endforeach
					@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
<div class="row">
	<div class="col-md-12">
		<button class="btn btn-sm btn-success pull-right" id="btnSubmit">Submit</button>
	</div>
</div>