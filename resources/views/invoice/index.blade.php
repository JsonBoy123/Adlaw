@extends('partials.main')
@section('content')
	<section class="content">
	  <div class="row">
	    <div class="col-md-12 m-auto"  >
	      <div class="box" >
	      	<div class="card-header">	      	
  				<h4>Invoice
  					<a href="{{route('invoice.create')}}" class="pull-right btn btn-sm btn-info ml-2">Add Invoice</a>	

  					{{-- <a href="{{route('invoice_service.index')}}" class="pull-right btn btn-sm btn-info">Invoice Services</a> --}}
  				</h4>
	      		
	      	</div>
	      	<div class="card-body">
	      		<div class="row">
	      			<div class="col-md-12 mb-5">
	      				{{-- <a href="{{route('invoice.index')}}" class="btn btn-sm btn-primary active">Service Related Invoice</a> --}}
	      				{{-- <a href="{{route('invoice.case_related')}}" class="btn btn-sm btn-default active">Case Related Invoice</a> --}}
	      			</div>
	      		</div>
	      		<div class="row">
	      			<div class="col-md-12 table-responsive">
	      				<table class="table table-striped table-bordered myTable">
	      					<thead>
	      						<tr>
	      							<th>S.No.</th>
	      							<th>Invoice Number</th>
	      							<th>Client Name</th>
	      							<th>Total (<i class="fa fa-rupee"></i>)</th>
	      							<th>Paid (<i class="fa fa-rupee"></i>)</th>
	      							<th>Due</th>
	      							<th>Status</th>
	      							<th>Action</th>
	      						</tr>
	      					</thead>
	      					<tbody>
	      						@php $count =1; @endphp
	      						@foreach($invoices as $invoice)
	      							<tr>
		      							<td>{{$count++}}</td>
		      							<td>INV-{{$invoice->invc_numb}}</td>
		      							<td>{{$invoice->cust_name}}</td>
		      							<td>{{$invoice->invc_amnt}}</td>
		      							<td>{{$invoice->invc_paid_amnt}}
		      							</td>
		      							<td><i class="fa fa-rupee"></i> {{$invoice->invc_due_amnt}}
		      								<br>
		      								<span><i class="fa fa-calendar-times-o"></i> {{date('d-m-Y',strtotime($invoice->invc_due_dt))}}</span>
		      							</td>
		      							<td>{{Arr::get(INVOICE_STATUS,$invoice->status)}}</td>
		      							<td>
		      								<div class="dropdown">
											  <button class="dropdown-toggle" type="button" data-toggle="dropdown">
											  	<img src="{{asset('images/icons/menu-icon.png')}}" style="width: 17px;">
											  </button>
											  <ul class="dropdown-menu" style="left: -95px !important">
											    <li><a href="{{route('invoice.show',$invoice->invc_numb)}}"><i class="fa fa-eye text-primary"></i> View</a></li>

											    <li><a href="{{url('invoice/'.$invoice->invc_numb.'?print=yes')}}" target="__blank"><i class="fa fa-print text-info"></i> Print</a></li>

											    <li><a href="{{route('invoice.download',$invoice->invc_numb)}}" target="__blank"><i class="fa fa-download text-primary"></i> Download</a></li>

											    <li><a href="javascript:void(0)" id="{{$invoice->invc_id}}" data-id="{{$invoice->invc_due_amnt}}" class="{{$invoice->status =='1' ? '' : 'payment_pay'}}"><i class="fa fa-rupee"></i> Payment Receive</a></li>

											    <li><a href="javascript:void(0)" id="{{$invoice->invc_id}}" class="payment_history" ><i class="fa fa-undo"></i> Payment History</a></li>
											    <li><br/></li>
											  </ul>
											</div>	
		      							</td>
		      						</tr>
	      						@endforeach
	      					</tbody>
	      					<tfoot>
	      						<tr>
	      							<th>S.No.</th>
	      							<th>Invoice Number</th>
	      							<th>Client Name</th>
	      							<th>Total (<i class="fa fa-rupee"></i>)</th>
	      							<th>Paid (<i class="fa fa-rupee"></i>)</th>
	      							<th>Due</th>
	      							<th>Status</th>
	      							<th>Action</th>
	      						</tr>
	      					</tfoot>
	      					
	      				</table>
	      			</div>
	      		</div>
				<div class="modal" id="paymentModal">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Add Payment</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				      </div>
				      <div class="modal-body">
				       		<form action="{{route('payment_receive')}}" method="post" autocomplete="off" id="example-form">
				       			@csrf
				       			<div class="row">
				       				<div class="col-md-12 form-group error-div">
				       					<label for="amnt" class="required">Amount</label>
				       					<input type="text" name="amount" class="form-control required" value="" onchange="validateFloatKeyPress(this);">
				       				</div>
				       				<div class="col-md-12 form-group error-div">
				       					<label for="rece_date" class="required">Receiving Date</label>
				       					<input type="text" name="rece_date" class="form-control datepicker required" data-date-format="yyyy-mm-dd"  value="">
				       				</div>
				       				<div class="col-md-12 form-group error-div">
				       					<label for="payment_mode" class="required"> Payment Method</label>
				       					<select class="form-control required" name="payment_mode" id="payment_mode">
											<option value="">Please Select</option>
											@foreach(PAYMENTMODE as $key => $payment)
												<option value="{{$key}}" {{$key == old('payment_mode') ? 'selected' : ''}}>{{$payment}}</option>
											@endforeach
										</select>
				       				</div>
				       				<div class="col-md-12 form-group " id="ref_div">
				       					<label for="ref_number" class="">Reference Number <span class="text-danger" id="ref_number_label"></span></label>
				       					<input type="text" name="ref_number" class="form-control" id="ref_number_input" >
				       				</div>
				       				<div class="col-md-12 form-group d-none" id="cheque_no" >
				       					<label for="cheque_no" class="required">Cheque Number</label>
				       					<input type="text" name="cheque_no" class="form-control cheque_no_input">
				       				</div>
				       				<div class="col-md-12 form-group">
				       					<label for="remark" >Remark</label>
				       					<textarea name="remark" class="form-control" cols="3" rows="5"></textarea>
				       				</div>
				       				<div class="col-md-12 form-group">
				       					<input type="hidden" name="invc_id" value="">
				       					<input type="hidden" name="invc_due_amnt" value="">
				       					<input type="submit" name="submit" value="Submit" class="btn btn-sm btn-success">
				       				</div>
				       			</div>
				       		</form>
				       		
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				      </div>
				    </div>
				  </div>
				</div>

				<div class="modal" id="paymentHistoryModal">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Payment History</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				      </div>
				      <div class="modal-body table-responsive" id="paymentTable">
				       		
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				      </div>
				    </div>
				  </div>
				</div>
	      	</div>
	      </div>
	  </div>
	</div>
</section>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>

<script >
  $(document).ready(function(){
  	var form = $("#example-form");

	form.validate({   
	    rules: {		    
	    	'amount':{
				amount_compare:true,
			},
			'remark':{
				maxlength:500,
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

	$.validator.addMethod("amount_compare", function (value, element) {
   		var flag = true;
   		var invc_due_amnt = $('input[name="invc_due_amnt"]').val();
   		console.log(invc_due_amnt);
		if(parseFloat(value) <= parseFloat(invc_due_amnt)){
			return true;
		}else{
			return false;
		}
		
		// return flag;
	}, "Amount is not greater than invoice due amount.");


  	 $('.myTable').DataTable({
          searching:true,
          scrolling:true,
          
    });
	$(function () { 
		$(".datepicker").datepicker({ 
			startDate: new Date(),
		});
	});
  	$('label.required').append("<span class='text-danger'> * </span>");

  	$('.payment_pay').on('click',function(){
  		var invc_id = $(this).attr('id');
  		var invc_due_amnt = $(this).data('id');
  		$('input[name="invc_id"]').val(invc_id);
  		$('input[name="amount"]').val(invc_due_amnt);
  		$('input[name="invc_due_amnt"]').val(invc_due_amnt);
  		$('#paymentModal').modal('show');
  	});
  	$('.payment_history').on('click',function(){
  		var invc_id = $(this).attr('id');
  		console.log(invc_id)
 		$.ajax({
 			type:'post',
 			url:"{{route('payment_history')}}",
 			data:{invc_id:invc_id},
 			success:function(res){
 				$('#paymentTable').empty().html(res);
 				$('#paymentHistoryModal').modal('show');
 				
 			}
 		})
  	});

  	$('#payment_mode').on('change',function(e){
  		e.preventDefault();
  		var payment_mode = $(this).val();
  		if(payment_mode == 2){
  			$('#cheque_no').removeClass('d-none');
  			$('#cheque_no').addClass('error-div');
  			$('.cheque_no_input').addClass('required');
  		}else{
  			$('#cheque_no').addClass('d-none');
  			$('#cheque_no').removeClass('error-div');
  			$('.cheque_no_input').removeClass('required');
  		}

  		if(payment_mode == 1){
  			$('#ref_number_label').empty();
  			$('#ref_div').removeClass('error-div');
  			$('#ref_number_input').removeClass('required');
  		}else{
  			$('#ref_number_label').html('*');
  			$('#ref_div').addClass('error-div');
  			$('#ref_number_input').addClass('required');
  		}
  	})



  });
function validateFloatKeyPress(el) {
    var v = parseFloat(el.value);
    el.value = (isNaN(v)) ? '1' : v.toFixed(2);
}
  
</script>
@endsection