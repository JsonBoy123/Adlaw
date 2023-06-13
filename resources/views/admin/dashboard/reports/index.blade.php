@extends('partials.main')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Registered Users List</h3>
				</div>
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-md-6 form-group mb-4">
							<select name="user_catg_id" class="form-control user_catg_id" >
								@foreach($roles as $role)
									<option value="{{$role->id}}">{{$role->display_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-12 mb-4 mt-4" id="usersTable">
							@include('admin.dashboard.reports.table')
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</section>

<script >
	$(document).ready(function(){
		$('.user_catg_id').on('change',function(e){
			e.preventDefault();
			var user_catg_id = $(this).val();
			$.ajax({
				type:'Post',
				url:"{{route('reports.filter')}}",
				data:{user_catg_id:user_catg_id},
				success:function(res){
					$('#usersTable').empty().html(res);
				}
			});
		})
	});

</script>

@endsection