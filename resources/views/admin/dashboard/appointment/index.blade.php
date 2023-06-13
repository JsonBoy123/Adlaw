@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">User Appointments Tables</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped table-bordered dataTable" id="myTable">
						<thead>
							<tr class="row">
								<th>SNo.</th>
								<th>Full Name</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>State</th>							
								<th>City</th>
							</tr>
						</thead>
						<tbody>
							<tr class="row">						
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>								
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('#myTable').DataTable({
        	searching:true,
        	scrolling:true,
		});
	})
</script>
@endsection