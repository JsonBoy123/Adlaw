<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>
				<input type="checkbox" name="all" class="selectAll">
			</th>
			<th>Name</th>
			<th>Roll Number</th>
			<th>Attendance Date</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach($attendance_students as $attendance_student)
			<tr>
				<td>
					<input type="checkbox" name="s_id[]"  class="check" value="{{$attendance_student->student->id}}" 
						{{$attendance_student->present == 'P' ? 'checked="checked"' : '' }}

					>
					{{-- <button class="btn btn-sm btn-success">P</i></button>	
					<button class="btn btn-sm btn-danger">A</i></button>	 --}}
				</td>
				<td>{{$attendance_student->student->f_name .' '. $attendance_student->student->l_name }}</td>
				<td>{{$attendance_student->student->roll_no}}</td>
				<td>{{$attendance_student->attendance_date}}</td>
				<td>
					{{$attendance_student->present}}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
<div class="row">
	<div class="col-md-12">
		<button class="btn btn-sm btn-success pull-right" id="updateBtn">Update</button>
	</div>
</div>