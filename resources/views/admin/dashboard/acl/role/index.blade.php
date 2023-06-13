{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header with-border">
					<h4 class="card-title">Role Manage
						<a href="{{route('role.create')}}" class="btn btn-sm btn-primary pull-right">Create</a>
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
									@foreach($roles as $role)
										<tr>
											<td>{{$role->id}}</td>
											<td>{{$role->name}}</td>
											<td>{{$role->display_name}}</td>
											<td>{{$role->description}}</td>
											<td>{{$role->created_at}}</td>
											<td>
												<a href="{{route('role.edit',$role->id)}}" class="btn btn-sm bg-success"><i class="fa fa-edit"></i></a>

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