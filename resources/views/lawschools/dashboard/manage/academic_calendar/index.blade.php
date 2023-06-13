{{-- @extends('lawschools.main') --}}
@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Academic Calendar List<a href="{{route('academic.create')}}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i>	Add New</a></h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-2 mt-2 form-group">
								<input type="text" name="year" class="datepicker form-control" value="{{date('Y')}}" readonly="readonly">
							</div>
							<div class="col-md-12 mt-2">
								@if($message = Session::get('success'))
									<div class="alert bg-success">
										{{$message}}
									</div>
								@endif
							</div>
							<div class="col-md-12 mt-2 table-responsive">
								@include('lawschools.dashboard.manage.academic_calendar.table')					
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection