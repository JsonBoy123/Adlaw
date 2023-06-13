{{-- @extends('lawfirm.main') --}}
@extends('partials.main')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
	  <div class="box box-primary">
	    <div class="box-header with-border">
	      <h3 class="box-title">All Notifications</h3>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
	   
			<div class="row" id="notficationShow">
				@forelse(Auth::user()->unreadNotifications as $notification)
					<div class="col-md-12 m-2" style="background-color:  #f2f2f2 !important" >
						{{-- <div class=" p-2" > --}}
							<a href="{{route('notification_read',$notification['id'])}}">
								<h4><i class="fa fa-tasks "></i> {{str_limit($notification['data']['title'], $limit = 50, $end = '...') }}
									<a href="javascript:void(0)" class="pull-right removeBtn " data-id="{{$notification['id']}}" ><i class="fa fa-close btn btn-sm"></i></a>
								</h4>

							 	<span>{{$notification['data']['message']}}</span>
					                   
					        	 <br> <span>{{$notification['created_at']->diffForHumans()}}</span>
					     	</a>
						{{-- </div> --}}
					</div>
				@empty
					<div class="col-md-12 p-2"  style="background-color:  #f2f2f2 !important">
						<h4>Records not found</h4>
					</div>                  
				@endforelse	
			</div>			
		</div>
	</div>
  </div>
</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
   		$(document).on('click','.removeBtn',function(e){
   			e.preventDefault();
   			var id = $(this).data('id');
   			$.ajax({
   				type:'GET',
   				url:'{{url('/notification_read')}}/'+id+'/'+'remove',
   				success:function(res){
   					location.reload();
   				}
   			});

   		});
   	});
</script>
@endsection