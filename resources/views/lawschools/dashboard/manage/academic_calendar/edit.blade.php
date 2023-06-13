{{-- @extends('lawschools.main') --}}
@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Academic Calendar Edit<a href="{{route('academic.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('academic.update',$academic->id)}}" method="post">
							@method('patch')
							@csrf
							<div class="row">
								<div class="col-md-12 form-group">
									<label for="title" class="required">Title</label>
									<input type="text" name="title" class="form-control" value="{{old('title') ?? $academic->title}}" placeholder="Enter title here">
									@error('title')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-6 form-group">
									<label for="date_from" class="required">Date From</label>
									<input type="text" class="form-control datepicker" value="{{old('date_from') ?? date('Y-m-d',strtotime($academic->date_from))}}" name="date_from" placeholder="Date from" readonly="readonly" >
									@error('date_from')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-6 form-group">
									<label for="date_upto" class="required">Date Upto</label>
									<input type="text" class="form-control datepicker" value="{{old('date_upto') ?? date('Y-m-d',strtotime($academic->date_upto))}}" name="date_upto" placeholder="Date Upto" readonly="readonly" >
									@error('date_upto')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-6 form-group">
									<input type="radio" name="status" value="H" {{old('status') == 'H' ? 'checked="checked"' : ($academic->is_holiday == '1' ? 'checked="checked"' : '')}} >
									<label for="status">Is Holiday</label>
									<br>
									<input type="radio" name="status" value="E" {{old('status') == 'E' ? 'checked="checked"' : ($academic->is_exam == '1' ? 'checked="checked"' : '')}}>
									<label for="status">Is Exam</label>
								</div>
								<div class="col-md-8 form-group">
									<label for="description" class="required">Description</label>
									<textarea class="form-control" rows="5" cols="5" name="description">{{old('description') ?? $academic->description}}</textarea>
									@error('description')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-12 form-group">
									<button class="btn btn-success btn-sm" >Submit</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
		$(document).ready(function(){
			$(function(){
				$('.datepicker').datepicker({
					format : 'yyyy-mm-dd'	
				});
			});
			$('.required').append('<span class="text-danger">*</span>')
		});
	</script>
@endsection