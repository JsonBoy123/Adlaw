{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Module</h3>
					<a href="{{route('acl_module.create')}}" class="pull-right btn btn-sm btn-primary">Create Module</a>
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
										<th>Icon</th>
										<th>Link</th>
										<th>Show Team Member</th>
										{{-- <th>Can View</th> --}}
										{{-- <th>From</th>
										<th>To</th> --}}
										<th>Module Type</th>
										<th>Status</th>
										{{-- <th>Created At</th> --}}
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($modules as $module)
										<tr>
											<td>{{$module->line}}</td>
											<td>{{$module->name}}</td>
											<td>{{$module->icon}}</td>
											<td>{{$module->link}}</td>
											<td>{{Arr::get(MODULETYPE,$module->module_type)}}</td>
											<td>{{Arr::get(SHOWMEMBR,$module->show_team)}}</td>
											{{-- <td>
												@foreach ($roles as $role) 
									               @if(in_array($role->id, json_decode($module->permissions)->can_view))
									                	{{$role->name}},
									               @endif
           									 	@endforeach</td> --}}
											{{-- <td>{{$module->from != '' ? $module->from : ''}}</td>
											<td>{{$module->to != '' ? $module->to : ''}}</td>	 --}}

											<td>{{$module->is_active == '1' ? 'Active' : 'Pending'}}</td>
											{{-- <td>{{date('d-m-Y',strtotime($module->created_at))}}</td> --}}
											<td>
												<a href="{{route('acl_module.edit',$module->id)}}" class="btn btn-sm bg-success "><i class="fa fa-edit"></i></a>
												<button class="btn btn-sm bg-info btnShow" id="{{$module->id}}" ><i class="fa fa-eye"></i> </button>
												{{-- <a href="" class="btn btn-sm bg-danger"><i class="fa fa-trash"></i></a> --}}
											</td> 
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal fade" id="modalExample">
						<div class="modal-dialog">
							<div class="modal-content" id="moduleData">								
							 
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$('.btnShow').on('click',function(){
			var module_id = $(this).attr('id');
			$.ajax({
				type:'GET',
				url:"{{url('acl/acl_module')}}/"+module_id,
				success:function(res){
					console.log(res);
					$('#moduleData').html(res);
					$('#modalExample').modal('show');
				}
			})
			//$
		})
	})
</script>
@endsection