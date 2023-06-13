<table class="table table-striped table-bordered">
	<thead>
		<th>#</th>
		<th>attendance Date</th>
		<th>Status</th>
		<th>Action</th>
	</thead>
	<tbody>
		@php $count =1 @endphp
		@foreach($attendances as $attendance)
			<tr>
				<td>{{$count++}}</td>
				<td>{{$attendance->attendance_date}}</td>
				<td>{{$attendance->present}}</td>
				<td>
					<input type="checkbox" name="attendance_date[]"  class="check" value="{{$attendance->attendance_date}}" {{$attendance->present == 'P' ? 'checked="checked"' : ''}}>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>