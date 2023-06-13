@extends('partials.main')
@section('content')
	<section class="content">
	  <div class="row">
	    <div class="col-md-12 m-auto"  >
	      <div class="box" >
	      	<div class="card-header">	      	
  				<h4>Invoice
  					<a href="{{route('invoice.create')}}" class="pull-right btn btn-sm btn-primary ml-2">Invoice Create</a>	

  					<a href="{{route('invoice_service.index')}}" class="pull-right btn btn-sm btn-info">Invoice Services</a>
  				</h4>
	      		
	      	</div>
	      	<div class="card-body">
	      		<div class="row">
	      			<div class="col-md-12 mb-5">
	      				<a href="{{route('invoice.index')}}" class="btn btn-sm btn-default active">Service Related Invoice</a>
	      				<a href="{{route('invoice.case_related')}}" class="btn btn-sm btn-primary active">Case Related Invoice</a>
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
	      							<th>Case Number</th>
	      							<th>GST</th>
	      							<th>GST Rate</th>
	      							<th>Discount</th>
	      							<th>Invoice Amount</th>
	      							<th>Invoice Date</th>
	      							<th>Action</th>
	      						</tr>
	      					</thead>
	      					<tbody>
	      						@php $count =1; @endphp
	      						@foreach($invoices as $invoice)
	      							<tr>
		      							<td>{{$count++}}</td>
		      							<td>{{$invoice->invc_numb}}</td>
		      							<td>{{$invoice->cust_name}}</td>
		      							<td>{{$invoice->service_amnt}}</td>
		      							<td>{{$invoice->gst}}</td>
		      							<td>{{$invoice->gst_rate}}</td>
		      							<td>{{$invoice->discount}}</td>
		      							<td>{{$invoice->invc_amnt}}</td>
		      							<td>{{date('d-m-Y',$invoice->incv_dt)}}</td>
		      							<td>
		      								<a href="{{route('invoice.show',$invoice->invc_numb)}}" ><i class="fa fa-eye btn  text-primary"></i></a>
		      							</td>
		      							
		      						</tr>
	      						@endforeach
	      					</tbody>
	      					
	      				</table>
	      			</div>
	      		</div>
	      	</div>
	      </div>
	  </div>
	</div>
</section>
<script >
  $('.myTable').DataTable({
          searching:true,
          scrolling:true,
          
    });
  
</script>
@endsection