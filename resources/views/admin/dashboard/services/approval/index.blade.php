@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"> 
					<h5>Service Approval</h5>
				</div>
				<div class="card-body table-responsive"> 
					@if($message = Session::get('success'))
						<div class="alert bg-success">
							{{$message}}
						</div>
					@endif
					<table class="table table-bordered datatable" >
						<thead>
							<tr>
								<th>#</th>
								<th>Service Category Name</th>
								<th>Service Name</th>
								<th>Service Short Name</th>
								<th>Client Name</th>
								<th>Client Type</th>
								<th>Client Mobile</th>
								<th>Client Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@php $count = 1; @endphp
						@foreach($services as $service)
							<tr>
								<td>{{$count++}}</td>
								<td>{{$service->service_mast !='' ? ($service->service_mast->service_catg_mast !='' ? $service->service_mast->service_catg_mast->service_catg_desc : '') : '' }}</td>
								<td>{{$service->service_mast !='' ? $service->service_mast->service_desc : ''}}</td>
								<td>{{$service->service_mast !='' ? $service->service_mast->service_shrt_desc : ''}}</td>

								<td>{{$service->user !='' ? $service->user->name : ''}}</td>

								<td>{{Arr::get($roles,$service->user->user_catg_id)}}</td>
								<td>{{$service->user !='' ? $service->user->email : ''}}</td>
								<td>{{$service->user !='' ? $service->user->mobile : ''}}</td>
								<td style="width: 15%">
									<a href="{{route('admin.services_approved',[$service->id,'approve'])}}" class="btn btn-sm btn-success">Approve</a>
									<a href="{{route('admin.services_approved',[$service->id,'decline'])}}" class="btn btn-sm btn-danger">Decline</a>
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
<script type="text/javascript">
	$(document).ready(function(){
		$('.datatable').DataTable();


	});
</script>
@endsection