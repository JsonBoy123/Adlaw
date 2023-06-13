<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Reciept Number</th>
			<th>Amount</th>
			<th>Payment Mode</th>
			<th>Reference Number</th>
			<th>Cheque Number</th>
			<th>Remark</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@forelse($invoice_paids as $invoice_paid)
			<tr>
				<td>{{$invoice_paid->invc_numb.'-'.$invoice_paid->receipt_no}}</td>
				<td>{{$invoice_paid->amount}}</td>
				<td>{{Arr::get(PAYMENTMODE,$invoice_paid->payment_mode)}}</td>
				<td>{{$invoice_paid->reference_number}}</td>
				<td>{{$invoice_paid->cheque_no}}</td>
				<td>{{$invoice_paid->remark}}</td>
				<td style="width: 20%;">

					<a href="{{url('/invoice/receipt/'.$invoice_paid->invc_numb.'/'.$invoice_paid->receipt_no)}}" class="text-primary" target="__blank" title="View"><i class="fa fa-eye"></i></a>
					<a href="{{url('/invoice/receipt/'.$invoice_paid->invc_numb.'/'.$invoice_paid->receipt_no.'?print=yes')}}" class="text-primary ml-2" target="__blank" title="Print"><i class="fa fa-print"></i></a>
					<a href="{{url('payment_receipt_download/'.$invoice_paid->invc_numb.'/'.$invoice_paid->receipt_no)}}" class="text-primary ml-2" target="__blank" title="Download"><i class="fa fa-download"></i></a>

				</td>
			</tr>
		@empty
			<tr>
				<td colspan="7" class="text-center">Result Not found</td>
			</tr>
		@endforelse
	</tbody>
</table>