{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header with-border">
					<h4 class="card-title">Permission Manage
						<a href="{{route('permission.create')}}" class="btn btn-sm btn-primary pull-right">Create</a>
					</h4>
				</div>
				<div class="card-body">
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
							<div class="card">
								<div class="card-header p-0" id="headingOne">
									<h2 class="mb-0">
									<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus"></i> All Permissions</button>									
									</h2>
								</div>
								<div id="collapseOne" class="collapse" aria-labelledby="headingOne">
								<div class="card-body">
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Display Name</th>
												<th>Description</th>
												<th>Created Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($permissions as $permission)
												<tr>
													<td>{{$permission->id}}</td>
													<td>{{$permission->name}}</td>
													<td>{{$permission->display_name}}</td>
													<td>{{$permission->description}}</td>
													<td>{{$permission->created_at}}</td>
													<td>
														<a href="{{route('permission.edit',$permission->id)}}" class="btn btn-sm bg-success"><i class="fa fa-edit"></i></a>

														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>	

						@foreach($modules as $module)
							<div class="card">
								<div class="card-header p-0" id="heading{{$module->id}}">
									<h2 class="mb-0">
									<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$module->id}}"><i class="fa fa-plus"></i> {{$module->name}}</button>									
									</h2>
								</div>
								<div id="collapse{{$module->id}}" class="collapse" aria-labelledby="heading{{$module->id}}" data-parent="#accordionExample">
								<div class="card-body">
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Display Name</th>
												<th>Description</th>
												<th>Created Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($module->permissions as $permission)
												<tr>
													<td>{{$permission->id}}</td>
													<td>{{$permission->name}}</td>
													<td>{{$permission->display_name}}</td>
													<td>{{$permission->description}}</td>
													<td>{{$permission->created_at}}</td>
													<td>
														<a href="{{route('permission.edit',$permission->id)}}" class="btn btn-sm bg-success"><i class="fa fa-edit"></i></a>

														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>	
						@endforeach					
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script >
	$(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	
        	$(this).prev(".text-click").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".text-click").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".text-click").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>
@endsection