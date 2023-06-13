<table class="table table-striped table-bordered dataTable" id="myTable">
	<thead>
		<tr class="row">							
			<th>SNo.</th>
			<th>Name</th>
			<th>Email</th>
			<th>Mobile</th>							
			<th>City</th>
			<th>State</th>
			<th>Status</th>
			<th>Registration Date</th>
			<th>Directory User</th>
		</tr>
	</thead>
	<tbody>
		<?php $count=0; ?>
		@foreach($users as $user)
		<tr class="row">						
			<td>{{++$count}}</td>
			<td>{{$user->name}}</td>
			<td>{{$user->email}}</td>
			<td>{{$user->mobile}}</td>
			<td>{{$user->city != null  ? $user->city->city_name : ''}}</td>
			<td>{{$user->state != null  ? $user->state->state_name : ''}}</td>
			<td>{{$user->status =='A' ? 'Active' : 'Pending'}}</td>
			<td>{{date('d-m-Y',strtotime($user->registration_date))}}</td>
			<td>{{$user->on_database == '1' ? 'Yes' : 'No'}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$('#myTable').DataTable( {
		
			searching:true,
        	scrolling:true,
	        dom: 'Bfrtip',
	        buttons: [
	            'copy', 'csv', 'excel', 'pdf','print'
	        ]

		} );
			
		
		// $('#myTable').DataTable({
  //       	searching:true,
  //       	scrolling:true,
		// });
	})
</script>