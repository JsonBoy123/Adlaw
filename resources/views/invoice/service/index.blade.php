@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"> 
					<h5>Invoice Services
						<a href="{{route('invoice_service.create')}}" class="pull-right btn btn-sm btn-primary">Service Add</a>
						<a href="{{route('invoice.index')}}" class="pull-right btn btn-sm btn-primary mr-2">Back</a>
					</h5>
				</div>
				<div class="card-body table-responsive" > 
					<table class="table table-bordered datatable">
						<thead>
							<tr>
								<th>#</th>
								<th>Service Category Name</th>
								<th>Service Name</th>	
								<th>Service Short Name</th>	
								<th>Service Rate</th>	
								<th>Service Discount</th>	
								<th>Service Status</th>	
								<th>Service Approval By Adlaw</th>	
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@php  $count = 1; @endphp
							@foreach($services as $service)
								<tr>
									<td>{{$count++}}</td>
									<td>{{$service->service_mast !='' ? ($service->service_mast->service_catg_mast !='' ? $service->service_mast->service_catg_mast->service_catg_desc : '') : '' }}</td>
									<td>{{$service->service_mast !='' ? $service->service_mast->service_desc : ''}}</td>
									<td>{{$service->service_mast !='' ? $service->service_mast->service_shrt_desc : ''}}</td>
									<td>{{$service->service_rate}}</td>
									<td>{{$service->service_discount}}</td>
									<td>{{Arr::get(SERVICE_STATUS,$service->status)}}</td>
									<td>{{Arr::get(SERVICE_STATUS,$service->approval)}}</td>
									<td>
										@if($service->status != 'A')
<a href="{{route('invoice_service.show',$service->id)}}" class="btn btn-sm btn-success" >Active</a>
										@endif
										{{-- <a href="{{route('invoice_service.edit',$service->id)}}" ><i class="fa fa-edit btn text-success"></i></a> --}}
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