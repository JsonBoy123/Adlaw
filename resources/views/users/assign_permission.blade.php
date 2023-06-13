{{-- @extends('admin.main') --}}
@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary">
					<div class="card-header">
						<h4 class="card-title">Assign Permission 
							<a href="{{route('users.index')}}" class="btn btn-sm btn-primary pull-right">Back</a>
							
						</h4>
					</div>
					<div class="card-body">
						
						<div class="row">
							<div class="col-md-12 mb-4">
								<h4 class="">User Name:- {{$user->name}}  <button class="pull-right btn btn-sm btn-success btnSumbmit">Update</button>
									<input type="hidden" name="user_id" value="{{$user->id}}">
								

								</h4>
							</div>
						</div>
						<div class="col-md-12">
							<div class="card">
								<div class="card-header p-0" id="headingOne">
									<h2 class="mb-0">
									<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus"></i> All Permissions</button>									
									</h2>
								</div>
								<div id="collapseOne" class="collapse" aria-labelledby="headingOne">
									<div class="card-body">									
										@foreach($permissions as $permission)
										<input type="checkbox" name="permission_id[]" class="permission_id" value="{{$permission->id}}" 
											@foreach($user->permissions as $upermission) 
												{{$upermission->id == $permission->id ? 'checked' : ''}}
											@endforeach> {{$permission->display_name}}
										<br>
										@endforeach 							
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
								<div id="collapse{{$module->id}}" class="collapse" aria-labelledby="heading{{$module->id}}">
									<div class="card-body">									
										@foreach($module->permissions as $permission)
										<input type="checkbox" name="permission_id[]" class="permission_id" value="{{$permission->id}}" 
											@foreach($user->permissions as $upermission) 
												{{$upermission->id == $permission->id ? 'checked' : ''}}
											@endforeach> {{$permission->display_name}}
										<br>
										@endforeach 							
									</div>
								</div>
							</div>	
						@endforeach

							{{-- <form action="{{route('user_permission_assign')}}" method="post">
								@csrf
								<div class="col-md-12 form-group">
									@foreach($permissions as $permission)
										<input type="checkbox" name="permission_id[]" value="{{$permission->id}}" 
											@foreach($user->permissions as $upermission) 
												{{$upermission->id == $permission->id ? 'checked' : ''}}
											@endforeach> {{$permission->display_name}}
										<br>
									@endforeach 
								</div>
								<div class="col-md-12 mt-4">
									<input type="hidden" name="user_id" value="{{$user->id}}">
									<input type="submit" class="btn btn-sm btn-success" value="Update">
								</div>
							</form> --}}
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<script type="text/javascript">
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

        $('.btnSumbmit').on('click',function(e){
        	e.preventDefault();
			var permission_id = [];
			var user_id = $('input[name="user_id"]').val();

			$('.permission_id:checked').each(function() {
				permission_id.push($(this).val());
			});
			$.ajax({
				type:'POST',
				url:"{{route('user_permission_assign')}}",
				data:{user_id:user_id,permission_id:permission_id},
				success:function(res){
					if(res == 'success'){
						alert('Permissions assigned sucessfully');
						location.reload();
					}
				}


			});

        });
    });
</script>
@endsection