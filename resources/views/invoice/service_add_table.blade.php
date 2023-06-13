<table class="table table-bordered">
	<thead>
	<tr>
		<th></th>
		<th>Service Name</th>
		<th>Service Rate</th>
		<th>Service Discount</th>
		<th>Service Quantity</th>
		<th>Unit</th>
		<th>Total</th>
	</tr>
	</thead>
	@if(session('invoice_services') !=null)
	<tbody class="tableBody">
			@foreach(session('invoice_services') as $invoice_service)	
			<tr>
				<td><a href="javascript:void(0)" class="service_delete" data-id="{{$invoice_service['client_service_id']}}"><i class="fa fa-trash text-danger"></i></a></td>
				<td>{{$invoice_service['service_name']}}</td>
				<td><i class="fa fa-rupee"></i> {{$invoice_service['service_rate']}}</td>
				<td><i class="fa fa-rupee"></i> {{$invoice_service['service_discount']}}</td>
				<td>
					<input type="number" value ="{{$invoice_service['quantity']}}" name="quantity" class="quantity" data-id="{{$invoice_service['client_service_id']}}" style="width: 100px" min="1" onkeyup="if(this.value<0){this.value= this.value * -1}">
				</td>
				<td></td>
				<td><i class="fa fa-rupee"></i> {{$invoice_service['service_total']}}


				</td>
			</tr>
			@endforeach
				
	</tbody>
	<tfoot>
		<tr>			
			<th colspan="5"></th>
			<th>
				Sub Total
			</th>
			<th><i class="fa fa-rupee"></i> {{session('service_amnt')}}</th>
		</tr>
		<tr>					
			<th colspan="5"></th>			
			<th>
				GST Tax
			</th>
			<th><input type="text" name="gst" class="gst" value="{{session('gst')}}" style="width: 105px"> %</th>
		</tr>
		<tr>					
			<th colspan="5"></th>			
			<th>
				GST Tax Amount
			</th>
			<th><i class="fa fa-rupee"></i> {{session('gst_rate')}} </th>
		</tr>
		<tr>			
			<th colspan="5"></th>			
			<th>
				Discount
			</th>
			<th><i class="fa fa-rupee"></i> <input type="text" name="discount" class="discount" value ="{{session('discount')}}" style="width: 105px"></th>
		</tr>
		<tr>			
			<th colspan="5"></th>			
			<th>
				Total
			</th>
			<th><i class="fa fa-rupee"></i> {{session('invc_amnt')}} 
				<input type="hidden" name="invc_amnt" value="{{session('invc_amnt')}}" id="invc_amnt">
			</th>
		</tr>
	</tfoot>
	@else
		<table>

			<tr class="">

				<td colspan="5" class="text-center">Records Not found
<input type="hidden" name="invc_amnt" value="0" id="invc_amnt">
				</td>
			</tr>
		</table>
	@endif
</table>
