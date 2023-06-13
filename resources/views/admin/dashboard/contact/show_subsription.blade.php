{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header with-border">
					<h4 class="card-title">Subscription Contact List</h4>
					<div class="card-options" id="btngroup">
						<button class="btn btn-sm btn-info" id="btnAll">All Subscriptions</button>
						<button class="btn btn-sm btn-default" id="btnNew">New Subscriptions</button>
						<button class="btn btn-sm btn-default" id="bntRenew">Renew Subscriptions</button>
					</div>
				</div>

				<div class="card-body table-responsive" id="tableBody"> 
					@include('admin.dashboard.contact.table_subscription')
				</div>
			</div>
			@include('models.supscription_package_active')	
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('#myTable').DataTable();

		$('#btnAll,#btnNew,#bntRenew').on('click',function(e){
			e.preventDefault();

			var btnId =  $(this).attr('id');
			console.log(btnId);
			$('#btngroup').find('button').removeClass('btn-info').addClass('btn-default');
			$('#'+btnId).addClass('btn-info');

			$.ajax({
				type:'GET',
				url:"{{route('admin.find_subscriptions')}}?btnId="+btnId,
				success:function(res){
					$('#tableBody').empty().html(res);
				}

			})

		});


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
			$('#activeModal').modal('show');
			var id = $(this).attr('data-id');
			var package_id = $(this).attr('data-class');
			$('input[name="subscription_id"]').val(id);
			$('select[name="package_id"]').val(package_id);
			package_active(package_id);

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
					//console.log(response);
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
			package_active(id);
		});

		
		function package_active(id){

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
		}
		$(document).on('keyup', '.discount_perc', function(e){
			e.preventDefault();
			var package_id = $('select[name="package_id"] option:selected' ).val();	
			var package_amount = $('input[name="package_amount"]' ).val();	
			var percent = $.trim($(this).val());

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
		});

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
	})
</script>
@endsection