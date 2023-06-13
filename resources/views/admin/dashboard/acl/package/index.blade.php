{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Module Package</h3>
					<a href="{{route('acl_package.create')}}" class="pull-right btn btn-sm btn-primary">Create Package</a>
				</div>
			
				<div class="box-body">
					 <div class="row">
			            <div class="col-md-12">
			                @if($message = Session::get('success'))
			                  <div class="alert bg-success">
			                      {{$message}}
			                  </div>
			                @endif  
			            </div>
			          </div>
					<div class="row">
						<div class="col-md-12 table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Price</th>
										<th>Duration Type</th>
										<th>Duration</th>
										<th>Modules</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($packages as $package)
										<tr>
											<td>{{$package->id}}</td>
											<td>{{$package->name}}</td>
											<td><i class="fa fa-rupee"></i> {{$package->price}}</td>
											<td> {{$package->duration_type}}</td>
											<td> {{$package->duration}}</td>
											<td>
												@foreach($package->modules as $p_module)
													<span class="text-success btn-default btn">{{$p_module->module->name}}</span>
												@endforeach
											</td>
											<td>
												<a href="{{route('acl_package.edit',$package->id)}}" class="btn-sm bg-success"><i class="fa fa-edit"></i></a>

											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</section>
@endsection