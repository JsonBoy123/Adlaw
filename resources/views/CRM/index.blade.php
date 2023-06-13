@extends('partials.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body" style="min-height:450px; ">
				<div class="row">
					@foreach($modules as $module)
						@if(in_array(Auth::user()->user_catg_id, json_decode($module->permissions)->can_view))
						 	@if(Auth::user()->parent_id !=null )  
								@if($module->show_team == '1')
									<a  href="{{ $module->link != null ? (in_array($module->id, $packageModules) ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('crm_dashboard.index')) : route('package.index')}}">
										<div class="col-md-2 col-sm-6 col-xs-11 col-div-mar col-div-nav text-center ml-5">
										<i class="fa {{$module->icon}}"></i>
										<h5>{{$module->name}}</h5>
										</div>
									</a>
								@endif
							@else
								<a  href="{{ $module->link != null ? (in_array($module->id, $packageModules) ? ($moduleShow ? route($module->link) : route('crm_dashboard.index')) : route('crm_dashboard.index')) : route('package.index')}}" >
									<div class="col-md-2 col-sm-6 col-xs-11 col-div-mar col-div-nav text-center ml-5">
									<i class="fa {{$module->icon}}"></i>
									<h5>{{$module->name}}</h5>
									</div>
								</a>
							@endif
						@endif
					@endforeach
				</div>
				<div class="row m-auto">
					@if($message = Session::get('success'))
						<div class="alert bg-success">
							{{$message}}
						</div>
					@endif
					<div class="col-md-12 mt-5">
					@if(Auth::user()->parent_id ==null)		
						@if(!empty($user_package))	

							<div class="card  p-0 col-centered">
								<div class="card-header p-4" style="background-color: #3c8dbc; color:white">
									<h4 class="card-title">Your Current Package Details:
										@if(!empty($oldpackages)) 
											<button class="btn btn-sm btn-default pull-right ml-4" id="oldPackageBtn">Old Package Details</button> 
										@endif
										
									 	@if(strtotime($beforeDate) <= strtotime(date('Y-m-d')))
									 		<button class="btn btn-sm btn-warning pull-right " id="renewBtn">Renewal Package</button>
									 	@endif
									</h4>
								</div>
								<div class="card-body " style="background-color: #f7f6f6; ">
								<div class="row">
									<div class="card col-md-6 p-0">
										<div class="card-header with-border p-3"  style="background-color: rgb(234, 239, 255); ">
											<h3>{{$user_package->package->name}}</h3>
										</div>
										<div class="card-body p-4" >
											<div class="row">
												<div class="col-md-6">
												
													@if($user_package->discount_perc !='')
														<h4 class="text-blue"><i class="fa fa-rupee"></i> {{substr($user_package->net_amount, 0, strpos($user_package->net_amount, '.'))}}</h4>
														<h4 class="text-blue">{{$user_package->discount_perc}} %
													@endif
														<h4 class=""><i class="fa fa-rupee"></i>
														@if($user_package->discount_perc !='')
															<del>{{$user_package->package->price}}<del>
														@else
															{{$user_package->package->price}}
													 	@endif
													 </h4>
												</div>
												<div class="col-md-6">
													<h4 class="">Start Date: {{date('Y-m-d',strtotime(Auth::user()->package_start))}}</h4>
													<h4 class="">End Date: {{date('Y-m-d',strtotime(Auth::user()->package_end))}}</h4>
												</div>
												<div class="col-md-12">
													@php echo $user_package->package->description; @endphp
												</div>
											</div>	
										</div>
										@if(strtotime($beforeDate) <= strtotime(date('Y-m-d')))
											<div class="card-footer "  style="background-color: rgb(255, 236, 207); ">
												@php  
													$date_diff =  \App\Helpers\Helpers::date_diff(Auth::user()->package_end); 

												@endphp
												<h4>
													@php
														echo $date_diff['difference']. " your subscription package ". ($date_diff['difference'] != 'Today' ? ($date_diff['str_arr'][2] == 'after' ? 'expire' : 'expired' )  : 'expire')
													@endphp
												</h4>
												
											</div>
										@endif		
									</div>
								@if(Auth::user()->id == '119287')
								@if($user_package->package_id =='4')
								<div class="card col-md-6 p-0" >
									<div class="card-header with-border p-3"  style="background-color: rgb(234, 239, 255); ">
										<h3>{{$package_premium->name}}
										{{-- @if(strtotime($beforeDate) <= strtotime(date('Y-m-d'))) --}}
									 		<button class="btn btn-sm btn-warning pull-right " id="upgradeBtn" data-id="{{$package_premium->id}}">Upgrade Package</button>

									 	</h3>

									 	{{-- @endif --}}
									</div>
									<div class="card-body p-4">
										<h4 class=""><i class="fa fa-rupee"></i>
											{{$package_premium->price}}
									 	</h4>
									 	<div class="col-md-12">
											@php echo $package_premium->description; @endphp
										</div>
										
									</div>
								</div>
								@endif
								@endif
								</div>
							</div>
							

						@else
							@if(!$moduleShow)		
								<div class="card  p-0 col-centered">
									<div class="card-header p-4" style="background-color: #3c8dbc; color:white">
										<h4>Buy Profile or CRM Dashboard Contact Our Team <button class="btn btn-sm btn-warning pull-right" id="buyBtn">Buy Package</button></h4>
									</div>
								</div>
							@endif
						@endif
					
					@endif

					</div>						
				</div>
			</div>
		</div>
	</div>
	@include('models.buy_renewal')
	<div class="modal fade" id="oldSubsModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-titles">Old Subscription Package Details</h4>
				</div>
				<div class="modal-body" id="oldSubsBody"  style="overflow-y: scroll; height: 300px;">
					
				</div>
			</div>
		</div>
	</div>
</div>

</section>
<script >
$(document).ready(function(){
	$('#buyBtn, #renewBtn,#upgradeBtn').on('click',function(e){
		e.preventDefault();
		var btnName = $(this).attr('id');
		if(btnName == 'buyBtn'){
				var title = "Buy Profile or CRM Dashboard - Contact Our Team";
				$('#user_status').val('new');
				$('.modal-title').empty().html(title);
		}
		else if(btnName  == 'renewBtn'){
			var title = "Renewal CRM Dashboard - Contact Our Team";
			$('#user_status').val('renew');
			$('.modal-title').empty().html(title);
		}else{
			var title = "Upgrade Package - Contact Our Team";
			$('#user_status').val('upgrade');
			$('.modal-title').empty().html(title);

			$('select[name="package_id"]').val($(this).data('id'));
		}

		$('#contactModal').modal('show');
	});
	$('#oldPackageBtn').on('click',function(e){
		// e.preventDefault();
		var id = "{{Auth::user()->id}}";
			$.ajax({
				type:'GET',
				url:"{{route('old_subscription_package')}}?id="+id,
				success:function(res){
				if(res.length != '0'){
					$('#oldSubsBody').empty();
					$.each(res,function(i,v){
						$('#oldSubsBody').append('<a href=""><div class="panel panel-default"><div class="panel-body " style="padding: 8px;"><h4 class="text-primary">'+v.package.name+' <span class="pull-right"> '+(v.discount_perc != "" ? '<span class="text-primary mr-4"><i class="fa fa-rupee"></i> '+(v.net_amount.substring(0,(v.net_amount.indexOf("."))))+' </span> <span class="text-primary mr-5">'+v.discount_perc +'%</span><span class="" style="color:black; font-size:17px;"><del><i class="fa fa-rupee"></i> '+v.package.price+'</del> </span>' : '<span class="text-primary" ><i class="fa fa-rupee"></i> '+v.package.price+'  </span>')+'  </span> </h4><span>Start Date: '+ (moment(new Date(v.package_start)).format('DD-MM-YYYY'))+' </span><span class="pull-right">End Date: '+ (moment(new Date(v.package_end)).format('DD-MM-YYYY'))+' </span></div></div></a>');
					});
				}else{
					$('#oldSubsBody').empty();
					$('#oldSubsBody').html('<h4 class="text-center">No Records Found</h4>')		
				}
			}
			});
		$('#oldSubsModal').modal('show');
		});

	// $('#upgradeBtn').on('click',function(){
	// 	var id = $(this).data('id');
	// 	console.log(id)
	// })

});

</script>
@endsection





