<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title font-weight-bold" style="font-weight:700 !important"><span id="module_name">{{$module->name}}</span> Module Deatils</h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
			<label>Module Link</label>
			<h5 class="">{{$module->link}} </h5>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
			<label>Module Icon</label>
			<h5 class="">{{$module->icon}} </h5>
		</div>
	</div>
	@if($module->is_active !=1)
	<div class="row">
		<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
			<label>From</label>
			<h5 class="">{{$module->from}} </h5>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
			<label>To</label>
			<h5 class="">{{$module->to}} </h5>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-md-12">
			<label class="">Who Can View This Module</label>
			<h5>@foreach ($roles as $role) 
	           @if(in_array($role->id, json_decode($module->permissions)->can_view))
	            	<span class="btn btn-sm btn-default text-uppercase"> {{$role->name}} </span>
	           @endif
		 	@endforeach</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label>Show Team Member</label>
			<h5>{{$module->show_team == '1' ? 'Yes' : 'No'}}</h5>
		</div>
		<div class="col-md-6">
			<label>Status</label>
			<h5>{{$module->is_active == '1' ? 'Active' : 'Pending'}}</h5>
		</div>
	</div> 
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>