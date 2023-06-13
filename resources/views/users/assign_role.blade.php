{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary">
					<div class="card-header">
						<h4 class="card-title">Assign Role 
							<a href="{{route('users.index')}}" class="btn btn-sm btn-primary pull-right">Back</a>
							
						</h4>
					</div>
					<div class="card-body">
						
						<div class="row">
							<div class="col-md-12">
								<h4 class="">User Name:- {{$user->name}}</h4>
							</div>
							<form action="{{route('user_role_assign')}}" method="post">
								@csrf
								<div class="col-md-12 form-group">
									@foreach($roles as $role)
										<input type="radio" name="role_id" value="{{$role->id}}" 
											@foreach($user->roles as $urole) 
												{{$urole->id == $role->id ? 'checked' : ''}}
											@endforeach> {{$role->display_name}}
										<br>
									@endforeach 
								</div>
								<div class="col-md-12 mt-4">
									<input type="hidden" name="user_id" value="{{$user->id}}">
									<input type="submit" class="btn btn-sm btn-success" value="Update">
								</div>
							</form>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<script>
  @if($message = Session::get('success'))
  		swal({
  			type:"success",
  		});
  @endif
</script>
@endsection