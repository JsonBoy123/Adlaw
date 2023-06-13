{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Referral Users <a href="{{route('referral.create')}}" class="btn btn-sm btn-primary pull-right">Add Referral User</a></h3>
					</div>
					<div class="box-body table-responsive">
						@if($message = Session::get('success'))
							<div class="alert bg-success">
								{{$message}}
							</div>
						@endif
						<table class="table table-striped table-bordered" id="myTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Email Address</th>
									<th>Mobile Number</th>
									<th>Referral Code</th>
									<th>State</th>
									<th>City</th>
									<th>Summary Count</th>
									<th >Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($referrals as $referral)
									<tr>
										<td>{{$referral->id}}</td>
										<td>{{$referral->name}}</td>
										<td>{{$referral->email}}</td>
										<td>{{$referral->mobile}}</td>
										<td>{{$referral->referral_code}}</td>
										<td>{{$referral->state->state_name}}</td>
										<td>{{$referral->city->city_name}}</td>
										<td>{{$referral->summary_count}}</td>
										<td>
											<a href="{{route('referral.edit',$referral->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>
											<a href="{{route('referral.delete',$referral->id)}}"><i class="fa fa-trash text-red btn btn-sm"  onclick="return confirm('Are you sure?')"></i></a>

											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script >
		$(document).ready(function(){		
			$('#myTable').DataTable();
	
		});
	</script>
@endsection