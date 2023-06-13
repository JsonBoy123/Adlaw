@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					Registered Users
				</div>
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-md-12 mb-4">
							<a href="{{route('registration.create')}}" class="btn btn-sm btn-primary pull-right">Add User</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 table-responsive">
							<table class="table table-bordered table-hover" id="myTable">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Referal Code</th>
										<th>Bar Licence Number</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $count =1; @endphp
									@foreach($users as $user)
										<tr>
											<td>{{$count ++}}</td>
											<td>{{$user->name}}</td>
											<td>{{$user->email}}</td>
											<td>{{$user->mobile}}</td>
											<td>{{$user->referral_code}}</td>
											<td>{{$user->licence_no}}</td>
											<td></td>
										</tr>	
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Referal Code</th>
										<th>Bar Licence Number</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
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