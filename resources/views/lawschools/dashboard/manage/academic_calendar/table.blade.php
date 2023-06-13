<table class="table table-striped table-bordered myTable" >
	<thead>
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Date From</th>
			<th>Date Upto</th>
			<th>Holiday</th>
			<th>Exam</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@php $count = 0; @endphp 
		@foreach($academics as $academic)
		<tr>
			<td>{{++$count}}</td>
			<td>{{$academic->title}}</td>
			<td>{{$academic->date_from}}</td>
			<td>{{$academic->date_upto}}</td>
			<td><span class="badge bg-blue">{{$academic->is_holiday == '1' ? 'Yes' : ''}}</span></td>
			<td><span class="badge bg-blue">{{$academic->is_exam == '1' ? 'Yes' : ''}}</span></td>
			<td>{{$academic->description}}</td>
			<td>
				{{-- <a href="{{route('academic.show',$academic->id)}}" class="btn"><i class="fa fa-eye text-primary"></i></a> --}}
				<a href="{{route('academic.edit',$academic->id)}}" class="btn"><i class="fa fa-edit text-success"></i></a>
				<a href="{{route('academic.destroy',$academic->id)}}" class="btn" ><i class="fa fa-trash text-danger"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>			
<script>
	$(document).ready(function(){
		$('.myTable').DataTable();
	})
</script>