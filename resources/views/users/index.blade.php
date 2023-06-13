{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Users <a href="{{route('users.create')}}" class="btn btn-sm btn-primary pull-right">Add User</a></h3>


						<div class="row">
							<div class="col-md-4 mt-4 form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="col-md-4 mt-4 form-group">
								<label>User Category</label>
								<select class="form-control">
									<option value="0">--- All ---</option>
									@foreach($roles as $role)
										<option value="{{$role->id}}">{{$role->display_name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-4 mt-4 form-group">
								<label>Types</label>
								<select class="form-control">
									<option value="0">--- All ---</option>
									<option value="5">Registered Users</option>	
									<option value="4">Import Users</option>
									<option value="5">Registered Import Users</option>	
									<option value="1">Subscription Users</option>
									<option value="2">UnSubscription Users</option>
								</select>
							</div>
							<div class="col-md-1 mt-4 form-group">
								<label></label>
								<button class="btn btn-sm btn-info form-control mt-2" id="filterBtn">Filter</button>
							</div>
						</div>
					</div>
					<div class="box-body table-responsive">
						@if($message = Session::get('success'))
							<div class="alert bg-success">
								{{$message}}
							</div>
						@endif
						<div class="row">
							<div class="col-md-12 table-responsive" id="tablebody">
								@include('users.table')
							</div>
						</div>
						
					</div>
				</div>
			</div>
@include('models.old_package')	
@include('models.login_history')	
@include('models.supscription_package_active')	
</div>
</section>
<script type="text/javascript">

	function loginhistory($id){
		var id = $id;
		$.ajax({
			type:'POST',
			url: "{{ route('login_history')}}",
			data: {id:id},
			success:function(res){

				$('#login_time').empty();
				$('#login_time').append("<td>"+(res.last_login_in_at !=null ? res.last_login_in_at : '')+"</td>");
				$('#login_time').append("<td>"+(res.last_logout_in_at != null ? res.last_logout_in_at : '-' )+"</td>");
				$('#login').modal('show');
				// console.log(res.last_login_in_at);
			}
		});
	}

	$(document).ready(function(){		
	// $('#myTable').DataTable();
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});



		$(document).on('click','#filterBtn',function(e){
			e.preventDefault();
			var name = $('input[name="name"]').val();	
			
			$.ajax({
				type:'POST',
				url:'{{route('filterUser')}}',
				data:{name:name},
				success:function(res){
					$('#tablebody').empty().html(res);
					
				}
			});
		})

		$(function () {
			$('.datepicker').datepicker({ 
					setDate: new Date(),
					formate:'YYYY-m-d',
						singleDatePicker: true,
					showDropdowns: true,
			});
		});


		$(document).on('click','#activeModalBtn',function(e){
				e.preventDefault();
			var id = $(this).attr('data-id');
			var btn_id = $(this).attr('btn_id');
			$('#activeModal').modal('show');

			$('input[name="subscription_id"]').val(id);
			$('input[name="btn_id"]').val(btn_id);

		});


		$(document).on('click','#oldPackageModel',function(e){
			
			e.preventDefault();	
			var id = $(this).attr('data-id');	
			
			$.ajax({
				type:'GET',
				url:'/users/old_package/'+id,
				success:function(res){
					console.log(res)
					$('#oldPackageTable').empty().html(res);
					$('#oldPackage').modal('show');
				}
			});
		});

		$("#activeForm").submit(function(e){
			e.preventDefault();
			var package_id = $('select[name="package_id"] option:selected' ).val();	
			var discount_status = $('select[name="discount_status"] option:selected' ).val();	
			var discount_perc = $('input[name="discount_perc"]').val();	
			var reference_by  = 	$('input[name="reference_by"]').val();		
			if(package_id != '0'){
				if(discount_status !='0'){
					if(discount_perc !='' && reference_by !=''){
						submitForm();
						return false;
					}else{
						alert('All field are mendatory')
					}
				}else{
					submitForm();
					return false;
				}
				
			}else{
				alert('First select package');
			}
		});
		function submitForm(){
			$.ajax({
				type: "POST",
				url: "{{route('admin.subscription_package_active')}}",
				cache:false,
				data: $('form#activeForm').serialize(),
				success: function(response){
					 $("#activeModal").modal('hide');
					 
					 alert("User Plan Active Successfully");
					 location.reload();
					// console.log(response);
				},
				error: function(){
					alert("Error");
				}
			});
		}


		$(document).on('change','.discount_status',function(e){
			e.preventDefault();
			var status = $(this).val();
			// console.log(status);
			if(status !=0){
				$('#discountDiv').show();				
			}else{
				$('#discountDiv').hide();
				$('input[name="dicount_amount"]').val(''); 
			   	$('input[name="net_amount"]').val('');
			   	$('input[name="discount_perc"]').val('');
			   	$('input[name="reference_by"]').val('');			   	
			   	$('.percent_error').hide();

			}
		});

		$('.checkDate').click(function() {
			var check = $('.checkDate').prop('checked');		
			if(check){
				$('input[name="start_date"],input[name="end_date"]').addClass('datepicker');
				$('.datepicker').datepicker('update');
			}else{
				$('.datepicker').datepicker('remove');
				$('input[name="start_date"], input[name="end_date"]').removeClass('datepicker');
				// $(".datepicker").datepicker("disable");
				//   $('input[name="start_date"]').datepicker("destroy");
			}
		});

		$(document).on('change','.package',function(e){
			e.preventDefault();
			var id = $(this).val();
			if(id !=0){
				$.ajax({
					type:'GET',
					url:"{{route('admin.package_fetch')}}?id="+id,
					success:function(res){
						var date = new Date(); 
						var start_date = dateFormat(date);

						$('input[name="start_date"]').val(start_date);
						$('input[name="package_amount"]').val(res.price);

						if(res.duration_type == 'month'){				
							var e_date = new Date(date.setMonth(date.getMonth() + parseInt(res.duration)));
							

						}else if(res.duration_type == 'year'){
							var e_date = new Date(date.setFullYear(date.getFullYear() + parseInt(res.duration)));
						}else if(res.duration_type == 'day'){

							var e_date = new Date(date.setDate(date.getDate() + parseInt(res.duration)));
							
						}
						var end_date = dateFormat(e_date);
						$('input[name="end_date"]').val(end_date);
						var percent = $.trim($('.discount_perc').val());
						discount_percent(percent);
						console.log(percent);
					}


				});
			}else{
				$('input[name="package_amount"]').val('');
				$('input[name="dicount_amount"]').val(''); 
			   	$('input[name="net_amount"]').val('');
			   	$('input[name="discount_perc"]').val('');
			   	$('input[name="reference_by"]').val('');
			   	$('input[name="start_date"], input[name="end_date"]').val('');
			   	$('.percent_error').hide();
			}
		});

		$(document).on('keyup', '.discount_perc', function(e){
			e.preventDefault();
			var percent = $.trim($(this).val());
			discount_percent(percent);

		});

		function discount_percent(percent){
			var package_id = $('select[name="package_id"] option:selected' ).val();	
			var package_amount = $('input[name="package_amount"]' ).val();	
			
			var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
			var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
			if(package_id !=0){  
				if(percent !=''){    			
					if(re.test(percent)){  
		    			if(re1.test(percent)){ 
		    				if(percent <= 100){
			    				var d_amount = (package_amount * percent) / 100 ;
			    				var net_amount = package_amount - d_amount;
			    				$('input[name="net_amount"]').val(net_amount);
			    				$('input[name="dicount_amount"]').val(d_amount); 
			    				$('.percent_error').hide();
					    	}else{
					    		$('input[name="dicount_amount"]').val(''); 
			    				$('input[name="net_amount"]').val('');
		    					alert('Oops, you are over 100%');
		    				}

		    			}else{
		    				$('.percent_error').show();
		    			}
		    		}else{
		    			$('.percent_error').show();
		    		}
					
				}else{
		    		$('input[name="dicount_amount"]').val(''); 
		    		$('input[name="net_amount"]').val('');
					$('.percent_error').hide();
				}
				
			}else{
				alert('First select package');
			}
		}


		function dateFormat(date) {
			var day = date.getDate();
		    var month = date.getMonth() + 1;
		    var year = date.getFullYear();
		    if (day < 10) {
		        day = "0" + day;
		    }
		    if (month < 10) {
		        month = "0" + month;
		    }

			var c_date = year + "-" + month  + "-" + day;
			return c_date; 
		}

    });
	

</script>
@endsection