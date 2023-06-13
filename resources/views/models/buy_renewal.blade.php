<div class="modal fade" id="contactModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="{{route('buy_crm_dashboard')}}" method="post">
				@csrf
				<div class="row">
					<div class="col-md-6 form-group">
						<label>Your Name</label>
						<input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" required="required">
					</div>
					
					<div class="col-md-6 form-group">
						<label>Alternate Mobile Number</label>
						<input type="text" name="mobile" value="{{Auth::user()->mobile}}" class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required="required">
					</div>
					<div class="col-md-6 form-group">
						<label>Alternate Email Address</label>
						<input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" required="required">
					</div>

					<div class="col-md-6 form-group">
						<label>Package </label>
						<select name="package_id" class="form-control">
							<option value="">Select Package</option>
							@foreach($packages as $package)
								<option value="{{$package->id}}">{{$package->name}}</option>
							@endforeach
						</select>
					</div> 
					<div class="col-md-6 form-group">
						<label>Number of Team Members</label>
						<input type="text" name="members" value="" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required="required">
					</div>

					@if(Auth::user()->user_catg_id !='5')
						<div class="col-md-6 form-group">
							<label>Number of {{Auth::user()->user_catg_id == '4' ? 'Students' : 'Clients'}}</label>
							<input type="text" name="clients" value="" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required="required">
						</div>
					@endif
					<div class="col-md-12 form-group">
						<label>Message</label>
						<textarea class="form-control" rows="5" cols="5" required="required" name="message"></textarea>
					</div>
					<div class="col-md-12">
						<input type="hidden" name="user_status" value="" id="user_status">
						<button type="submit" class="btn btn-sm btn-primary">Submit</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
