{{-- @extends('lawfirm.main') --}}
@extends('partials.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="card card-primary">
			<div class="card-header with-border" >

				<h3 class="card-title" style="margin-top: 10px;">Clients ({{count($clients)}}) 
				<a href="{{route('clients.create')}}" class="btn btn-sm btn-primary pull-right"> Add Client</a>
				
				</h3>
				
			</div>
			<div class="card-body table-responsive" >
				<div class="row">
					<div class="col-md-4 mb-4">
						<select name="status" class=" pull-right form-control" id="status" autocomplete="off" autofocus="off">
							@foreach($status_types as $status)
							
								<option value="{{ $status->status_id }}" {{old('status_id')==$status->status_id  ? 'selected' : ''}}>{{ $status->status_desc }}</option>
						
							@endforeach	
						</select>
					</div>
				</div>

				@if($message = Session::get('success'))
					<div class="alert bg-success">
						{{$message}}
					</div>
				@endif
				<div class="col-md-12 table-responsive mt-4" id="tableBody">
					@include('clients.table')
				</div>
			</div>
		</div>
	</div>
</div>

</section>
<script>
	$(document).ready(function(){
		$('#status').on('change',function(e){
			e.preventDefault();

			var status = $(this).val();
			console.log(status);

			$.ajax({
				type:'get',
				url:"{{url('client_filter')}}/"+status,
				success:function(res){
					$('#tableBody').empty().html(res);
				}
			})

		})
		


	});
</script>
@endsection