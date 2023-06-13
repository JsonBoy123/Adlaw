<table class="table table-hover table-striped table-bordered"  id="ClientsTable">
	<thead class="bg-default">
		<tr class="row">
			<th></th>
			<th>Name</th>
			<th>Registration Date</th>
			<th>Gender</th>
			<th>Mobile</th>
			<th>Address</th>
			<th>Type</th>
			<th>Action</th>

		</tr>
	</thead>
	<tbody>
		<?php $count = 0; ?>

		@foreach($clients as $client)
			<tr class="row">
				<td>{{++$count}}</td>

				<td>{{$client->cust_name}}</td>

			 	<td><?php echo date('d-m-Y', strtotime($client->regsdate)); ?></td>

				<td>
					@if($client->gender=='m')
						{{'Male'}}
					@elseif($client->gender=='f')
						{{'Female'}}
					@elseif($client->gender=='t')
						{{'Other'}}
					@else
						{{'-'}}
					@endif

				</td>

				<td>								
					<p>{{$client->mobile1}}</p>
					<p>{{$client->mobile2}}</p>
				</td>						

				<td>{{$client->custaddr ? $client->custaddr : '-'}}</td>

				<td>{{$client->cust_type_name ? $client->cust_type_name : '-' }}</td>
				<td class="d-flex">
					
					<form action="{{route('clients.destroy', ['cust_id' =>$client->cust_id])}}" method="POST" id="delform_{{$client->cust_id}}">
						@method('DELETE')

						<span>
							<a href="{{route('clients.edit', $client->cust_id)}}" ><i class=" btn fa fa-edit text-green" style="font-size: 16px;"></i></a></span>
						<span>
							{{-- <a href="javascript:$('#delform_{{$client->cust_id}}').submit();"  onclick="return confirm('Are you sure?')" ><i class="btn fa fa-trash text-red" style="font-size: 16px;" ></i></a> --}}
						</span>
						<span>
							<a href="{{route('clients.show', $client->cust_id )}}" ><i class="btn fa fa-eye text-primary" style="font-size: 16px;"></i></a>
							
						</span>
						@csrf
					</form>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
{{ $clients->links()}}
<script>
	$(document).ready(function(){
		$('#ClientsTable').DataTable();
	});
</script>