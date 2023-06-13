 <table class="table table-striped table-bordered dataTable" id="myTable">
	<thead>
		<tr>							
			<th>SNo.</th>
			<th>Name</th>
			<th>Email</th>
			<th>Mobile</th>							
			<th>Package Name</th>
			<th>User Type</th>		
			<th>No. of Members</th>		
			<th>No. of Clients/Student</th>		
			<th>Status</th>		
			<th>Package Action</th>		
		</tr>
	</thead>
	<tbody>
		@foreach($subscriptions as $subscription)
			<tr>
				<td>{{$subscription->id}}</td>
				<td>{{$subscription->name}}</td>
				<td>{{$subscription->email}}</td>
				<td>{{$subscription->mobile}}</td>
				<td>{{$subscription->package->name}}</td>
				<td>{{$subscription->user->role->display_name}}</td>
				<td>{{$subscription->no_of_members}}</td>
				<td>{{$subscription->no_of_clients}}</td>
				<td class="text-capitalize">{{$subscription->status}}</td>
				<td>
					<a href="#" class="btn btn-sm btn-success"  id="activeModalBtn" data-id="{{$subscription->id}}" data-class="{{$subscription->package_id}}">Active</a>
					<a href="#" class="btn btn-sm btn-danger">Cancel</a>
					
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function(){
		$('#myTable').DataTable();
	});
</script>