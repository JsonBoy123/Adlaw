@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary box-shadow">
				<div class="box-header"><h3 class="box-title"><b>Invoice Create</b></h3></div>
				<div class="box-body p-5">
					{{-- <div class="row">
						<div class="col-md-6 form-group">
							<label for="invc_type">Invoice Type</label>
							<select name="invc_type" class="form-control">
								<option value="sr">Service Related</option>
								<option value="cr">Case Related</option>
							</select>
						</div>
					</div> --}}
					<form action="{{route('invoice_store')}}" method="post" id="example-form" autocomplete="off">
						@csrf
						<div class="row">
							<div class="form-group col-md-6">
								<div class="row">
									<div class="col-md-8 mb-5">
										<label for="client" class="required">Select Client</label>
										<select class="form-control required" name="cust_id" id="cust_select" autocomplete="off">
											<option value=""> Select Client Name</option>
											@foreach($clients as $client)
												<option value="{{$client->cust_id}}" {{old('cust_id') == $client->cust_id ? 'selected' : ''}}>{{$client->cust_name}}</option>
											@endforeach
											<option value="0">Other</option>
										</select>
									</div>
									<div class="col-md-12 mt-2">
										<h4 class="mb-2 pl-2"><b>Billed To : </b></h4>
										<div class="row form-group">
											<label class="col-md-3 ml-2 pt-2 required ">Name :</label>
											<div class="col-md-7 ">										<input type="text" class="form-control required" name="cust_name" value="{{old('cust_name')}}" placeholder="Name" id="cust_name">
											</div>
										</div>
										<div class="row form-group">
											<label class="col-md-3 ml-2 pt-2 required">Email :</label>
											<div class="col-md-7">
												<input type="email" class="form-control required" name="cust_email" value="{{old('cust_email')}}" placeholder="Email" id="cust_email">
											</div>
										</div>
										<div class="row form-group">
											<label class="col-md-3 ml-2 pt-2 required">Mobile :</label>
											<div class="col-md-7">
												<input type="text" class="form-control required" name="cust_mobile" value="{{old('cust_mobile')}}" placeholder="Mobile" id="cust_mobile">
											</div>
										</div>
										<div class="row form-group">
											<label class="col-md-3 ml-2 pt-2">Address :</label>
											<div class="col-md-7">
												<input type="text" class="form-control" name="cust_addr" value="{{old('cust_addr')}}" placeholder="Address" id="cust_addr">
											</div>
										</div>
									</div>
								</div>

							</div>		
							
							<div class="col-md-6">
								<div class="row form-group">
									<label class="col-md-4 required">Invoice No : </label>
									<div class="col-md-6">
										<h5>INV-{{$last_invc_no}}</h5>
										<input type="hidden" name="invc_num" value="{{$last_invc_no}}">
									</div>
								</div>
								<div class="row form-group">
									<label class="col-md-4 required">Invoice Date : </label>
									<div class="col-md-6">
										<input type="text" name="invc_date" class="form-control datepicker required" data-date-format="yyyy-mm-dd" placeholder="">
									</div>
								</div>
								<div class="row form-group">
									<label class="col-md-4 required">Invoice Due Date : </label>
									<div class="col-md-6">
										<input type="text" name="invc_due_date" class="form-control datepicker required" data-date-format="yyyy-mm-dd" placeholder="">
									</div>
								</div>
								<hr style="border-top:1px dotted #000;">
								<div class="row">
									<div class="col-md-12"><h5><b>Tax</b></h5></div>
								</div>							
								<div class="row form-group">
									<label class="col-md-4">Tax Type : </label>
									<div class="col-md-6">
										<select name="tax_type" class="form-control" id="tax_type">
											<option value="">Out of Tax</option>
											<option value="GST">GST</option>
											<option value="IGST">IGST</option>
										</select>
									</div>
								</div>
								{{-- <div class="row form-group">
									<label class="col-md-4">Rate(%) : </label>
									<div class="col-md-4">
										<input type="number" id="tax_rate" name="tax_rate"  value="0" min="0.00" max="30.00" step=1.00  autocomplete="off" class="form-control">
									</div>
								</div> --}}

							</div>				
						</div>					
						
						<hr style="border-top:1px dotted #000;" />
						<div class="row mb-4">
							<div class="col-md-12 table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>		
											<th style="width: 30%">Description</th>
											<th >Rate <i class="fa fa-rupee"></i></th>

											<th style="width: 10%" class="d-none tax">Tax Type</th>
											<th style="width: 10%" class="d-none tax">Tax(%)</th>
											<th class="d-none tax">Tax Rate <i class="fa fa-rupee"></i></th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="tBody">
										<tr id="row1">			
											<td  >
												<span class="error-di">
													<input type="text" name="desc_title[]" placeholder="Enter title here" class="form-control " autocomplete="off">
												</span>
												<br>		
												<textarea style="min-height: 60px; height: 63px;  resize: none;" placeholder="Additional details" name="description[]" class="form-control" autocomplete="off"></textarea>
											</td>
											<td >
												<span class="error-di">
													<input type="text" name="desc_amount[]" placeholder="Enter Amount" class="form-control desc_amount" data-id="1" onchange="validateFloatKeyPress(this);"  autocomplete="off" value="0.00" >
												</span>
											</td>
											<td class="d-none tax" >
												<input type="text" class="tax_t form-control tax_t1" readonly="readonly" name="tax_t[]" value="">
											</td>
											<td class="d-none tax " >
												<input type="number" name="tax_per[]"  value="0" min="0.00" max="30.00" step=1.00  autocomplete="off" class="form-control tax_per tax_p1">
											</td>
											<td class="d-none tax" >
												<input type="text" readonly="" name="tax_rate[]" value="0" autocomplete="off" class="form-control tax_rate tax_r1">
											</td>											
											<td >-</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="5">
												<a href="javasctipt:void(0)" class="btn btn-sm btn-primary btn-circle addMore"><i class="fa fa-plus"></i></a>
											</td>
										</tr>
										
									</tfoot>					
								</table>
							</div>						
						</div>
						<div class="row mt-5">
							<div class="col-md-6">
								<label class="">Invoice Note</label>
								<textarea name="invc_rem" class="form-control" placeholder="Invoice Remark" col='3' rows="5">{{old('invc_rem')}}</textarea>
							</div>
							<div class="col-md-2"></div>
							<div class="col-md-4 p-5">
								<table class="table row-border no-footer">
									<tbody>
										<tr>
											<th>SubTotal</th>
											<td  class="text-right"><i class="fa fa-rupee"></i> <span id="subtotal">0.00</span> <input type="hidden" name="subtotal"></td>
										</tr>
									</tbody>
								</table>
								<table class="table row-border no-footer d-none" id="tax_table">
									<tbody id="tax_table_body">
										
									</tbody>
								</table>	
								<table class="table row-border no-footer">
									<tbody>
										<tr class="total_amnt_row">
											<th>Total</th>
											<td  class="text-right"><i class="fa fa-rupee"></i> <span id="total_amnt">0.00</span> <input type="hidden" name="total"><input type="hidden" name="tax_amount"></td>
										</tr>
									{{-- 	<tr class="balance_row">
											<th>Balance Due</th>
											<td class="text-right"><i class="fa fa-rupee"></i> <span id="balance_due">0.00</span></td>
										</tr> --}}
									</tbody>
								</table>
							</div>
						</div>
						<div class="row mt-5">
							<div class="col-md-12 text-right">
								<button class="btn btn-sm btn-danger">Cancel</button>
								<button class="btn btn-sm btn-success">Submit</button>
							</div>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</section>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script>
	$(document).ready(function(){
		$(function () {
			$(".datepicker").datepicker({ 
				startDate: new Date(),
			});
		});
		$('label.required').append("<span class='text-danger'> * </span>");
		var i = 2;
		$('.addMore').on('click',function(e){
			e.preventDefault();
			var html = '<tr id="row'+i+'"><td><span class="error-di"><input type="text" name="desc_title[]" placeholder="Enter title here" class="form-control" autocomplete="off"></span><br><textarea style="min-height: 60px; height: 63px;  resize: none;" placeholder="Additional details" name="description[]" class="form-control" autocomplete="off"></textarea></td><td><span class="error-di"><input type="text" name="desc_amount[]" value="0.00" placeholder="Enter Amount" class="form-control desc_amount" data-id="'+i+'" onchange="validateFloatKeyPress(this);" autocomplete="off"></span></td><td class="d-none tax"><input  type="text" class="tax_t form-control tax_t'+i+'" readonly="readonly" name="tax_t[]" value=""></td><td class="d-none tax"><input type="number" name="tax_per[]"  value="0" min="0.00" max="30.00" step=1.00  autocomplete="off" class="form-control tax_per tax_p'+i+'"></td><td class="d-none tax" ><input type="text" readonly="" name="tax_rate[]" value="0" autocomplete="off" class="form-control tax_rate tax_r'+i+'"></td><td><a href="javasctipt:void(0)" class="btn btn-sm btn-circle btn-danger removeBtn" id="'+i+'"><i class="fa fa-trash"></i></a></td></tr>';

			
			$('#tBody').append(html);
			amount_change();
			i++;
		});

		$(document).on('click','.removeBtn',function(e){
			e.preventDefault();
			var row_id = $(this).attr('id');
			$('#row'+row_id).remove();
			amount_change();
		});

		$(document).on('blur','.desc_amount',function(e){
			e.preventDefault();
			amount_change();
		});
		$(document).on('change','#tax_type',function(e){
			e.preventDefault();
			
			amount_change();
		});
		$(document).on('change','.tax_per',function(e){
			e.preventDefault();
			amount_change();
		});



		$('#cust_select').on('change',function(e){
			e.preventDefault();
			var cust_id = $(this).val();
			if(cust_id == '0'){
				$('#cust_name, #cust_email, #cust_mobile, #cust_addr').removeAttr('readonly');
			$('#cust_name, #cust_email, #cust_mobile, #cust_addr').val('');
			}else{
				$.ajax({
					type:'GET',
					url:'{{url('client_fetch')}}/'+cust_id,
					success:function(res){
						$('#cust_name').val(res.cust_name);
						$('#cust_email').val(res.email);
						$('#cust_mobile').val(res.mobile1);
						$('#cust_addr').val(res.custaddr);

						$('#cust_name, #cust_email, #cust_mobile, #cust_addr').attr('readonly',true);
					}

				});
			}
		});




		var form = $("#example-form");

		form.validate({   
		    rules: {		    
		    	'desc_title[]':{
					desc:true,
				},
				'desc_amount[]':{
					desc:true,
				},
		    },
			errorElement: "em",
			errorPlacement: function errorPlacement(error, element) { 
				element.after(error);
				error.addClass( "help-block" );

			 },
			highlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".error-div" ).addClass( "has-error" ).removeClass( "has-success" );
			},
			unhighlight: function (element, errorClass, validClass) {
				$( element ).parents( ".error-div" ).addClass( "has-success" ).removeClass( "has-error" );
			},
		});
		
		$.validator.addMethod("desc", function (value, element) {
       		var flag = true;
			$('[name^=desc_title]').each(function(i,j){
				$(this).parent('.error-di').find('em.error').remove();
	      		$(this).parent('.error-di').removeClass("has-error");
				var name = $.trim($(this).val());
				
				if (name.length == '0') {
	                flag = false;           
	               	$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
	               	$(this).parent('.error-di').append('<em class="error help-block">This field is required.</em>');             
	            }
				else if ($.trim($(this).val()) != '') {
					if(name.length > 100){				
						flag = false;           
		               	$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
		               	$(this).parent('.error-di').append('<em class="error help-block">Please enter no more than 100 characters.</em>');             
					}else{
						$(this).parent('.error-di').addClass( "has-success" ).removeClass( "has-error" );
					}
				}
			});

			$('[name^=desc_amount]').each(function(i,j){
				$(this).parent('.error-di').find('em.error').remove();
	      		$(this).parent('.error-di').removeClass("has-error");
				var amount = $.trim($(this).val());
				
				if (amount.length == '0') {
	                flag = false;           
	               	$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
	               	$(this).parent('.error-di').append('<em class="error help-block">This field is required.</em>');             
	            }
				else if ($.trim($(this).val()) != '') {
					if(amount == '0.00'){				
						flag = false;           
		               	$(this).parent('.error-di').addClass('has-error').removeClass('has-success');
		               	$(this).parent('.error-di').append('<em class="error help-block">Please enter some amount.</em>');             
					}else{
						$(this).parent('.error-di').addClass( "has-success" ).removeClass( "has-error" );
					}
				}
			});
			return flag;
    	}, "");

		
	});
	function validateFloatKeyPress(el) {
	    var v = parseFloat(el.value);
	    el.value = (isNaN(v)) ? '0' : v.toFixed(2);
	}

	function amount_change(){
		var amount = 0.00; 
		var tax_amount = 0.00;
		var total_amnt = 0.00;
		var balance_due = 0.00;
		
		var tax_type = $('#tax_type').val();
		fn_tax_type(tax_type);
		var tax_arr = [];

		$('.desc_amount').each(function(){
			var amnt = parseFloat($(this).val());
			amount += parseFloat($(this).val());
			var amnt_id = $(this).data('id');
			if('.tax_t'+amnt_id !=''){
				// console.log(amnt_id)
				var amnt_per = $('.tax_p'+amnt_id).val();
				$('.tax_r'+amnt_id).val(((amnt * parseFloat(amnt_per) ) / 100));
				
				if(tax_type !=''){
					if(amnt_per != 0){					
						if(tax_arr[amnt_per]){
							tax_arr[amnt_per] += amnt
							
						}
						else{
							tax_arr[amnt_per] = amnt
						}
					}
				}
			}
		});

		if(tax_arr.length !=0){
			if(tax_type != ''){	
				$('#tax_table').removeClass('d-none');
				$('#tax_table_body').empty();
				$.each(tax_arr,function(i,v){
					if(v != undefined){
						var per = i;
						var am = v;
						var tx_am = ((parseFloat(am)*parseInt(per)/100));
						if(tax_type == 'GST'){
							$('#tax_table_body').append('<tr class="tax_gst"><td><b>CGST @ '+(per / 2 )+' % on '+am+'</td><td class="text-right"><i class="fa fa-rupee"></i> '+(tx_am / 2)+'</td></tr><tr class="tax_gst"><td><b>SGST @ '+(per /2)+' % on '+am+' </td><td class="text-right"><i class="fa fa-rupee"></i> '+(tx_am / 2)+'</td></tr>');
							tax_amount += tx_am;

						}else if(tax_type == 'IGST'){
							$('#tax_table_body').append('<tr class="tax_gst"><td><b>IGST @ '+per+' % on '+am+'</td><td class="text-right"><i class="fa fa-rupee"></i> '+(tx_am)+'</td></tr>');
							tax_amount += tx_am;
						}						
					}
				});			
			}
		}else{
			$('#tax_table').addClass('d-none');
			$('#tax_table_body').empty();
		}
		// console.log(gst_arr);
		$('#subtotal').empty().html(amount.toFixed(2));
		$('input[name="subtotal"]').val(parseFloat(amount));
		$('input[name="tax_amount"]').val(parseFloat(tax_amount));
		$('input[name="total"]').val(parseFloat(amount) + parseFloat(tax_amount));

		$('#total_amnt').empty().html((parseFloat(amount) + parseFloat(tax_amount)));
		// $('#balance_due').empty().html((parseFloat(amount) + parseFloat(tax_amount)));
	}

	function fn_tax_type(tax_type) {
		if(tax_type == ''){
			$('.tax_t').val('');
			$('.tax_p').val(0);
			$('.tax_rate').val(0);
			$('.tax').addClass('d-none')
			
		}else{
			$('.tax').removeClass('d-none');			
			$('.tax_t').val(tax_type);
		}
	}
	function fn_cgst_sgst(){
		var total_amnt = [];
		var totalTaxPer = [];
		$('.desc_amount').each(function(){
			total_amnt.push($(this).val());
		});

		$('.tax_per').each(function(){
			totalTaxPer.push($(this).val());
		});

		console.log(total_amnt);
		console.log(totalTaxPer);
	}
</script>
@endsection

