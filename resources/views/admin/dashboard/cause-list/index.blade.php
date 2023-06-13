@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">

				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Cause List Upload 
						</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								@if($message = Session::get('success'))
								<div class="alert bg-success">
									{{$message}}
								</div>
								@endif

								<form action="{{route('admin.cause-list.import')}}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="row">							
									<div class="col-md-6 form-group">
										<input type="file" name="file" class="form-control">
										@error('file')
						                  <span class="invalid-feedback d-block text-danger" role="alert">
						                  <strong>{{ $message }}</strong>
						                  </span>
						                @enderror
									</div>
									<div class="col-md-6">
										<label>Cause List format download here..</label>
										{{-- <a href=""></a> --}}
									</div>
									<div class="col-md-12 form-group">
										<button type="submit" class="btn btn-success btn-sm">Submit</button>
									</div>
								</div>
								</form>
							</div>
						<!-- 	<div class="col-md-3 form-group">
								<input type="text" name="licence_no" class="form-control " value="" placeholder="Enter Licence number">
							</div> -->

							<div class="col-md-4 form-group">
								
								<input type="text" readonly="" name="start_date" class="form-control datepicker" value="{{date('Y-m-d')}}">
							</div>
							<div class="col-md-4 form-group">
							
								<input type="text" readonly="" name="end_date" class="form-control datepicker" value="{{date('Y-m-d')}}">
							</div>
							<div class="col-md-1 pt-2"> 
								<button class="btn btn-sm btn-primary " id=filterBtn>Filter</button>
							</div>
							<div class="col-md-12" id="cause-list-table">
								@include('admin.dashboard.cause-list.table')
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<script >
		$(document).ready(function(){
			$(function() {
				$('.datepicker').datepicker({
					format:'yyyy-mm-dd'
				});
			});

			$(document).on('click','#filterBtn',function(e){
				e.preventDefault();
				var start_date = $('input[name="start_date"]').val();
				var end_date = $('input[name="end_date"]').val();
				var licence_no = $('input[name="licence_no"]').val();
				$.ajax({
					type:'POST',
					url:"{{route('admin.cause-list_filter')}}",
					data:{start_date:start_date,end_date:end_date,licence_no:licence_no},
					success:function(res){
						console.log(res);
						$('#cause-list-table').empty().html(res);
					}


				});
			});
		});
	</script>
@endsection