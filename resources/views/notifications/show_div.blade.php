@forelse(Auth::user()->unreadNotifications as $notification)
<div class="col-md-12 mb-2" >
	<div class=" p-2" style="background-color:  #f2f2f2 !important">
		<a href="{{route('notification_read',$notification['id'])}}">
			<h4><i class="fa fa-tasks "></i> {{str_limit($notification['data']['title'], $limit = 50, $end = '...') }}
				<a href="javascript:void(0)" class="pull-right removeBtn " data-id="{{$notification['id']}}" ><i class="fa fa-close btn btn-sm"></i></a>
			</h4>

		 	<span>{{$notification['data']['message']}}</span>
                   
        	 <br> <span>{{$notification['created_at']->diffForHumans()}}</span>
     	</a>
	</div>
</div>
@empty
<div class="col-md-12 mb-3 card " >
	<h4>Records not found</h4>
</div>                  
@endforelse	