<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><input type="checkbox" name="all" class="selectAll"></th>
			<th>Name</th>
			<th>Attendance Date</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach($attendance_staffs as $attendance_staff)
		<tr>
			<td>
				<input type="checkbox" name="emp_id[]"  class="check" value="{{$attendance_staff->staff->id}}" {{$attendance_staff->present == 'P' ? 'checked="checked"' : '' }} >
			</td>
			<td>{{$attendance_staff->staff->name}}</td>
			<td>{{$attendance_staff->attendance_date}}</td>
			<td>
				{{$attendance_staff->present}}
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