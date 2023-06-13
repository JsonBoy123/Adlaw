<div class="modal fade" id="activeModal" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">User Package Plan Active</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="activeForm">
			@csrf
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6 form-group">
						<label>Package Name</label>
						<select class="form-control package" name="package_id">
							<option value="0">Select Package</option>
							@foreach($packages as $package)
								<option value="{{$package->id}}">{{$package->name}}</option>
							@endforeach
						</select>

					</div>
					<div class="col-md-6 form-group">
						<label>Package Amount</label> <span class="text-nuted">(In Rupees)</span>
						<input type="text" name="package_amount" class="form-control" readonly="readonly" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group">
						<label>Dicount User</label>
						<select class="form-control discount_status" name="discount_status">
							<option value="1">Yes</option>
							<option value="0" selected="selected">No</option>
						</select>
					</div>								
				</div>
				<div class="row" style="display: none" id="discountDiv">
					<div class="col-md-6 form-group">
						<label>Dicount Percent</label>
						<input type="text" name="discount_perc" value="" class="form-control discount_perc">
						<span class="invalid-feedback text-danger percent_error" role="alert" style="display:none">
							<strong>{{ __('Only number and decimal allowed') }}</strong>
						</span>
					</div>
					<div class="col-md-6 form-group">
						<label>Dicount Amount</label> <span class="text-nuted">(In Rupees)</span>
						<input type="text" name="dicount_amount" readonly="readonly" class="form-control">
					</div>	
					<div class="col-md-6 form-group">
						<label>Discount Reference By</label>
						<input type="text" name="reference_by" class="form-control">
					</div>	
					<div class="form-group col-md-6">
						<label>After Discount Package Amount</label> <span class="text-nuted">(In Rupees)</span>
						<input type="text" name="net_amount" readonly="readonly" class="form-control">
					</div>	
					<div class="col-md-12 form-group">
						<input type="checkbox" name="checkDate" class="mr-2 checkDate">
						<label>If you want to customize the start date and end date click the checkbox</label>
					</div>					
				</div>
				<div class="row">
					
					<div class="col-md-6 form-group">
						<label>Package Start Date</label>
						<input type="text" name="start_date" class="form-control " data-date-format="yyyy-mm-dd" readonly="readonly">
					</div>
					<div class="col-md-6 form-group">
						<label>Package End Date</label>
						<input type="text" name="end_date" class="form-control " data-date-format="yyyy-mm-dd" readonly="readonly">
					</div>								
				</div>
			
			</div>
			<div class="modal-footer">
				<input type="hidden" name="subscription_id" value="" >
				<input type="hidden" name="btn_id" value="" >
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" value="Save changes" id="submit">
			</div>
			</form>
		</div>
	</div>
</div>