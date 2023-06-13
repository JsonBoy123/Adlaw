@extends('partials.main')
@section('content')
<section class="content">
	<style type="text/css">
		.tfoot-child{
			border: 0px solid #f4f4f4;
		}
		.select2-selection__choice__remove{
			display: none !important;
		}
	</style>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"> 
					<h5 class="card-title">Invoice Add
						<a href="{{route('invoice.index')}}" class="btn btn-sm btn-primary pull-right">Back</a>
					</h5>
				</div>
				<div class="card-body table-responsive"> 
					@if($message = Session::get('error'))
						<div class="row">
						<div class="col-md-12">
							<p class="text-danger">{{$message}}</p>
						</div>
					</div>
					@endif
					<form method="post" action="{{route('invoice.store')}}" autocomplete="off" autofocus="off">
						@csrf
						<div class="row form-group">
							<div class="col-md-12" style="margin-top:10px;">
								<label for="client_name">Select Client  <span class="text-danger">*</span> <a href="{{route('clients.create')}}" target="_blank">(<i class="fa fa-plus"></i> Add Client)</a></label>
								
								<select class="form-control" name="cust_id" id="cust_select">
									<option value=""> Select Client Name</option>
									@foreach($clients as $client)
										<option value="{{$client->cust_id}}" {{old('cust_id') == $client->cust_id ? 'selected' : ''}}>{{$client->cust_name}}</option>
									@endforeach
									<option value="0">Other</option>
								</select>
							
								@error('cust_id')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ "The selected customer name is invalid." }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-12 d-none" style="margin-top:10px;" id="cust_name_div">
								<label for="client_name" class="required">Client Name </label>

								<input type="text" class="form-control" name="cust_name" value="{{old('cust_name')}}" placeholder="Client Name">				
								
								@error('cust_name')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ "The selected customer name is invalid." }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-6">
								<label class="required">Service Category Name</label>
								<select class="form-control" name="service_catg_code" id="service_catg" >
									<option value="">Select Service Category</option>
									@foreach($service_catgs as $service_catg)
									<option value="{{$service_catg->service_catg_code}}" {{(old('service_catg_code') == $service_catg->service_catg_code ? 'selected="selected"' :'')}}>{{$service_catg->service_catg_desc}}</option>

									@endforeach
								</select>
								@error('service_catg_code')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-6">
								<label class="required">Service Name</label>
								<select class="form-control  " name="service_code" id="service_mast">
									
								</select>
								@error('service_code')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12 table-responsive" id="tableServiceAdd">
								@include('invoice.service_add_table')
							</div>
						</div>
							<hr>

							<div class="row form-group mt-5" id="pay_mode">
								<div class="col-md-6">
									<label >Payment Mode</label>
									<select class="form-control" name="payment_mode" id="payment_mode">
										<option value="0">Please Select</option>
										@foreach(PAYMENTMODE as $key => $payment)
											<option value="{{$key}}" {{$key == old('payment_mode') ? 'selected' : ''}}>{{$payment}}</option>
										@endforeach
									</select>
									@error('payment_mode')
										<span class="invalid-feedback text-danger" role="alert">
										<strong>{{ "The selected customer name is invalid." }}</strong>
										</span>
									@enderror
								</div>							
							</div>
							<div class="row form-group mt-5" id="cash_trans">
								<div class="col-md-6" id="cash_detl">
									<label for="cash_amnt" >Cash Amount</label>
									<input type="text" name="cash_amnt" class="form-control" placeholder="Cash Amount" value="" readonly="readonly" id="cash_amnt">
								</div>
								<div class="col-md-6 d-none" id="trans_id">
									<label for="trans_id" >Payment/Transcation Id</label>
									<input type="text" name="trans_id" class="form-control">
								</div>
							</div>

							<div class="row form-group d-none" id="cheq_detl" >
								<div class="col-md-6">
									<label for="bank_name" >Bank Name</label>
									<input type="text" name="bank_name" value="" class="form-control" placeholder="Bank Name">
								</div>
								<div class="col-md-6">
									<label for="cheque_no" >Cheque Number</label>
									<input type="text" name="cheque_no" value="" class="form-control" placeholder="Cheque Number">
								</div>
								<div class="col-md-6">
									<label for="cheque_amnt" >Amount</label>
									<input type="text" name="cheque_amnt" value="" class="form-control" placeholder="Amount" id="cheque_amnt">
								</div>
								<div class="col-md-6">
									<label for="cheque_date" >Date</label>
									<input type="text" name="cheque_date" value="" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="{{date('Y-m-d')}}">
								</div>
								<div class="col-md-6">
									<label for="payee_name" >Payee Name</label>
									<input type="text" class="form-control" name="payee_name" placeholder="Payee Name">
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<label for="invc_rem">Invoice Remark</label>
									<textarea name="invc_rem" class="form-control
									" placeholder="Invoice Remark">{{old('invc_rem')}}</textarea>
								</div>
							</div>
							

						{{-- 	<div class="col-md-6">
								<label class="required">Service Rate</label>
								<input type="text" name="service_rate" value="{{old('service_rate')}}" class="form-control"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
								@error('service_rate')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-6">
								<label class="required">Service Discount (In rupees)</label>
								<input type="text" name="service_discount" value="{{old('servive_discount') !='' ? old('service_discount') : '0'}}" class="form-control"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
								@error('service_discount')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div> --}}
							{{-- <div class="col-md-6">
								<label class="required">Invoice Status</label>
								<select name="status" class="form-control">	
									<option value="A" {{(old('status') =='A' ? 'selected="selected"' : '')}}>Active</option>
									<option value="P" {{(old('status') =='P' ? 'selected="selected"' : '')}}>Pending</option>
								</select>
								@error('status')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div> --}}
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-success">Submit</button>
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
		$(function () {
			$(".datepicker").datepicker({ 
				setDate: new Date(),

				singleDatePicker: true,
				showDropdowns: true,
			});
		});


		$('.required').append("<span class='text-danger'>*</span>");

		var service_catg_code ="{{old('service_catg_code')}}";
		var service_code ={!! collect(old('service_code')) !!};
		// console.log(service_code)
		
		if(service_catg_code.length != '0'){
			service_client_mast_fetch('#service_mast',service_catg_code,service_code);
		
		}
		$('#cust_select').on('change',function(e){
			e.preventDefault();
			var cust_id = $(this).val();
			if(cust_id == '0'){
				$('#cust_name_div').removeClass('d-none');
			}else{
				$('#cust_name_div').addClass('d-none');
			}
		})


		$('#service_catg').on('change',function(e){
			e.preventDefault();
			var service_catg_code = $(this).val();
			// console.log(service_catg_code);
			var service_mast_id = '#service_mast';
			if(service_catg_code.length == 0){
				$('#pay_mode').addClass('d-none');
				$('#cash_trans').addClass('d-none');
				
			}else{
				$('#pay_mode').removeClass('d-none');
				$('#cash_trans').removeClass('d-none');
			}

			service_client_mast_fetch(service_mast_id,service_catg_code);
		});

		$('.select2').select2();
	
		$('#service_mast').on('change',function(e){
			e.preventDefault();
			var service_code = $(this).val();
			// console.log(service_code);
			$.ajax({
				type:'post',
				url: '{{route('invoice.service_add')}}',
				data:{service_code:service_code},
				success:function(res){
					$('#tableServiceAdd').empty().html(res);
					fn_payment_mode_update();
				}
			})
			// console.log(service_code);
		});

		$(document).on('click','.service_delete',function(e){
			e.preventDefault();
			var client_service_id = $(this).data('id');
			$.ajax({
				type:'GET',
				url:'{{url('invoice_service_delete')}}/'+client_service_id,
				success:function(res){
					$('#tableServiceAdd').empty().html(res);
					fn_payment_mode_update();
				}
			})
		})


		$(document).on('blur','.quantity,.gst,.discount',function(e){
			e.preventDefault();

			var flag = $(this).attr('class');
			var client_service_id = '';
			var quantity = '';
			var gst = '';
			var discount = '';				

			if(flag == 'quantity'){
				client_service_id = $(this).data('id');
				quantity = $(this).val();
			}else if(flag == 'gst'){
				gst = $(this).val();

			}else if(flag == 'discount'){
				discount = $(this).val();
			}
		
			$.ajax({
				type:'POST',
				url:'{{route('invoice.service_update')}}',
				data:{quantity:quantity,client_service_id:client_service_id,flag:flag,gst:gst,discount:discount},
				success:function(res){
					// console.log(res);
					$('#tableServiceAdd').empty().html(res);
					fn_payment_mode_update();
				}
			})
		});


		

		$(document).on('click','#payment_mode',function(e){
			e.preventDefault();
			var mode = $(this).val();
			fn_payment_mode(mode);
		});

		var payment_mode = "{{old("payment_mode")}}";

		if(payment_mode !=null){
			fn_payment_mode(payment_mode);
		}

		

	});
	function fn_payment_mode(mode){
		var invc_amnt = $('#invc_amnt').val();
		console.log(invc_amnt);
		if(mode == '1'){
			$('#cash_detl').removeClass('d-none');
			$('#cheq_detl').addClass('d-none');
			$('#trans_id').addClass('d-none');
			$('#cash_amnt').val(invc_amnt);
			$('#cash_amnt').attr("readonly","true");

		}else if(mode == '2'){
			$('#cash_detl').addClass('d-none');
			$('#cheq_detl').removeClass('d-none');
			$('#trans_id').addClass('d-none');
			$('#cash_amnt').val("0");
			$('#cheque_amnt').val(invc_amnt);

		}else if(mode == '3' || mode == '5'){
			$('#cash_detl').addClass('d-none');
			$('#cheq_detl').addClass('d-none');
			$('#trans_id').removeClass('d-none');
		
		}else if(mode == '4'){
			$('#cash_detl').removeClass('d-none');
			$('#cheq_detl').removeClass('d-none');
			$('#trans_id').addClass('d-none');
			$('#cash_amnt').val(invc_amnt);
			$('#cash_amnt').removeAttr("readonly");
			$('#cheque_amnt').val("0");
		}else{
			$('#cash_detl').addClass('d-none');
			$('#cheq_detl').addClass('d-none');
			$('#trans_id').addClass('d-none');
		}
	}

	function fn_payment_mode_update(){
		var mode = $('#payment_mode').val();
		fn_payment_mode(mode);
	}
</script>
@endsection