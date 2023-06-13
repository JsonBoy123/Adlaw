@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"> 
					<h5>Invoice Services
						<a href="{{route('invoice_service.create')}}" class="pull-right btn btn-sm btn-primary">Service Add</a>
					</h5>
				</div>
				<div class="card-body table-responsive"> 
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Service Category Name</th>
								<th>Service Name</th>	
								<th>Service Short Name</th>	
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						
							<tr>
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
		
	});
</script>
@endsection