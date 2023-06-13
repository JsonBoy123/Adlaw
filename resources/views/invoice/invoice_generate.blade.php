<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <title>Adlaw</title> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="yandex-verification" content="8f0c9478d0aaca4e" />
    <link rel="canonical" href="https://www.adlaw.in/"/>
    <meta name="google-site-verification" content="2iDNtR3LqBEDPUP45mwIXtE6a1XdOf7y9cz8TRGqxB0" />
    <title>@yield('title','ADLAW')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title','ADLAW')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:url" content="http://www.adlaw.in/" />
    <meta property="og:site_name" content="Adlaw" />
    <link rel = "icon" href ="{{asset('images/adlaw-logo.png')}}" alt="Adlaw" type = "image/x-icon" style="line-height: 40px;">

     <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/topbar.css') }}" />

    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/find_city_lawyer.css') }}" /> 
    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/find_research_platform.css') }}" />
    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/footer.css') }}" />
    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/lawyer_profile_backup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/star-rating-svg.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard/search_all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard/btn-social.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    {{-- <link rel="stylesheet" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"> --}}
    
    <link href="https://cdn.jsdelivr.net/sweetalert2/4.2.4/sweetalert2.min.css" rel="stylesheet"/>
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    	
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-48209472-2"></script>
<style type="text/css">
	body{
		font-size: 12px;
	}
	@page { size: auto;  margin: 0mm; }
</style>
</head>
<body>
	<div class="container">
	<div class="row">
		<div class="col-md-10 m-auto pt-5 print_hide">
			<a href="javascript:void(0)" class="btn btn-sm btn-success btnPrint  mr-3"> <i class="fa fa-print"></i> Print</a>
			
			<a href="{{route('invoice.index')}}" class="btn btn-sm btn-primary  pull-right">  Back</a>
		</div>
		<div class="col-md-10 m-auto pt-5 " id="print_remove">
			<div class="card ">
				<div class="card-header bg-white ">
					<div class="row">
						<div class="col-md-8 p-4">
							<h4 class="text-primary mt-4"><b>{{$invoice->user->name}}</b></h4>						
							<h6>{{$invoice->user->mobile}}</h6>
							<h6>{{$invoice->user->email}}</h6>
							<h6>{{$invoice->user->address}}</h6>
						</div>
						<div  class="col-md-4 p-4">
							<h2 class="text-primary font-weight-bold"><b>INVOICE</b></h2>
							<table class="table table-bordered mr-auto">								
								<tbody>
									<tr>
										<td>Date</td>
										<td>{{date('d-m-Y',strtotime($invoice->invc_dt))}}</td>
									</tr>
									<tr>
										<td>Invoice No</td>
										<td>{{$invoice->invc_numb}}</td>
									</tr>									
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 p-4">
							<h4 class="text-primary"><b>Bill To</b></h4>
							<h6>{{$invoice->cust_name}}</h6>
							@if($invoice->customer !=null)
								<h6>{{$invoice->customer->mobile1}}</h6>
								<h6>{{$invoice->customer->email}}</h6>
								<h6>{{$invoice->customer->company_name}}</h6>
								<h6>{{$invoice->customer->custaddr}}</h6>
							@endif
						</div>
					</div>
					
				</div>
				<div class="card-body ">
					<div class="row">
						<div class="col-md-12 table-responsive p-4">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>Service Name</th>
									<th>Service Rate</th>
									<th>Service Discount</th>
									<th>Service Quantity</th>
									<th>Unit</th>
									<th>Total Amount</th>
								</tr>
								</thead>
							
								<tbody class="tableBody">
									@php $quantity = '0'; @endphp
									@foreach($invoice->invoice_details as $invoice_detail)	
										
										@php $quantity = $quantity + $invoice_detail->quantity ; @endphp
									<tr>
										<td>{{$invoice_detail->service->service_desc}}</td>
										<td><i class="fa fa-rupee"></i> {{$invoice_detail->service_rate}}</td>
										<td><i class="fa fa-rupee"></i> {{$invoice_detail->service_discount}}</td>
										<td>
											{{$invoice_detail->quantity}}
										</td>
										<td></td>
										<td><i class="fa fa-rupee"></i> {{$invoice_detail->service_amnt}}</td>
									</tr>
									@endforeach
											
								</tbody>
								<tfoot>
									<tr>			
										<th colspan="4"></th>
										<th>
											Subtotal
										</th>
										<th><i class="fa fa-rupee"></i> {{$invoice->service_amnt}}</th>
									</tr>
									<tr>					
										<th colspan="4"></th>			
										<th>
											GST Tax
										</th>
										<th>{{$invoice->gst}} %</th>
									</tr>
									<tr>					
										<th colspan="4"></th>			
										<th>
											GST Tax Amount
										</th>
										<th><i class="fa fa-rupee"></i> {{$invoice->gst_rate}}</th>
									</tr>
									<tr>			
										<th colspan="4"></th>			
										<th>
											Discount
										</th>
										<th><i class="fa fa-rupee"> </i>{{$invoice->discount}}</th>
									</tr>
									<tr>			
										<th>
											Total
										</th>
										<th colspan="2"></th>			
										<th >{{$quantity}}</th>
										<th></th>
										<th><i class="fa fa-rupee"></i> {{$invoice->invc_amnt}} </th>
									</tr>
									<tr>			
										<th>
											Amount in words:
										</th>
												
										
										<th colspan="5" class="text-right text-capitalize">{{displaywords($invoice->invc_amnt)}}</th>
									</tr>

								</tfoot>
							</table>
						</div>

					</div>	
					<div class="row mb-2">
						<div class="col-md-12 p-4">
							@if($invoice->payment_mode == '1')
								<p><b>Payment Mode : </b> {{Arr::get(PAYMENTMODE,$invoice->payment_mode)}}</p>
							@endif
						</div>
					</div>

					
					<div class="row mb-2">
						<div class="col-md-4 m-auto card text-center p-4 mb-5" style="height: 100px;"> 
							<p class="mb-4">Signature</p>
							
							______________________
						</div>

						<div class="col-md-4 m-auto card text-center p-4 mb-5" style="height: 100px;"> 
							<p class="mb-4">Customer Signature</p>
							
							______________________

						</div>						
					</div>
					<div class="row">
						@if($invoice->invc_rem !=null)
						<div class="col-md-12 p-4" style="min-height: 100px; background-color: #e8e8e8">
							<h6>Terms and Remarks</h6>
							{{$invoice->invc_rem}}
						</div>
						@endif
					</div>
				</div>
				
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$('.btnPrint').on('click',function(){
			$('.print_hide').hide();
			// $('.print_remove').removeClass('pt-5');
			var prtContent = document.getElementById("print_remove");
	        var WinPrint = window.open();
	        WinPrint.document.write(prtContent.innerHTML);
	        WinPrint.document.close();
	        WinPrint.focus();
	        WinPrint.print();
	        WinPrint.close();
			// window.print();
			// location.reload();
		});
	})
</script>

 </footer> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  {{-- <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/sweetalert2/4.2.4/sweetalert2.min.js"></script>
  <script src="{{asset('js/jquery.star-rating-svg.js')}}"></script>
  <script src="{{asset('js/all_category.js')}}"></script>
 </i>
</div>
</body>
{{-- @endsection --}}