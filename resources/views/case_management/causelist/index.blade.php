@extends('partials.main')
@section('content')
	<section class="content">
	  <div class="row">
	    <div class="col-md-12 m-auto"  >
	      <div class="box" >
	      	<div class="card-header">
	      		<div class="row">
	      			<div class="col-md-6">
	      				<h4>Cause List</h4>
	      			</div>
	      			<div class="col-md-4 pull-right form-group">
	      				<input type="text" name="date" class="form-control" value="{{date('Y-m-d')}}" id="datepicker" readonly="readonly">
	      			</div>

	      		</div>
	      		
	      	</div>
	      	<div class="card-body">
	      		<div class="row">
	      			<div class="col-md-12 mb-4">
	      				<a href="{{route('cause-list.show')}}" class="btn btn-sm btn-default">Print</a>
	      			</div>
	      			<div class="col-md-12" id="causeListTable" style="max-height:600px; overflow-y: scroll; ">
	      				@include('case_management.causelist.show')
	      			</div>
	      		</div>
	      	</div>
	      </div>
	  </div>
	</div>
</section>
<script>
	$(document).ready(function(){

		$(function () {
			$("#datepicker").datepicker({
				format: 'yyyy-mm-dd',
			});
		});

		$(document).on('blur','#datepicker',function(){
				var date = $(this).val();
				// console.log(date);
				$.ajax({
					type:'POST',
					url:"{{route('cause-list.filter')}}",
					data:{date:date},
					success:function(res){
						$('#causeListTable').empty().html(res);
					}

				});
		});
		
	});
</script>
@endsection