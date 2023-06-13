<table class="table table-striped table-bordered" id="myTable">
	<thead>
		<tr>
			<th>#</th>
			<th>User Name</th>
			<th>Email Address</th>
			<th>Mobile Number</th>
			<th>City</th>
			<th>State</th>
			<th>User Type</th>
			<th>Registration Date</th>
			<th>Status</th>
			<th>Package Active</th>
			<th style="width: 30%">Action</th>
		</tr>
	</thead>
	<tbody>
		@php $count = 0; @endphp
		@foreach($users as $user)
			<tr>
				<td>{{++$count}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->mobile}} {{$user->mobile_no1 == '' ? '' : '|'}} {{$user->mobile_no1}}</td>
				<td>{{$user->city !=null ? $user->city->city_name : ''}}</td>
				<td>{{$user->state !=null ? $user->state->state_name : ''}}</td>
				<td>{{$user->role != null ? $user->role['display_name']  : '-'}}</td>
				<td>{{date('d-m-y', strtotime($user->created_at))}}</td>

				<td>{{$user->email_verified_at != null ? 'Email Verified' : 'Pending For Email Verifying'}}
					<br>
					<br>
					{{$user->mobile_verified_at != null ? 'Mobile Verified' : 'Pending For Mobile Verifying'}}

				</td>

				<td>
					@if($user->user_package_id !='')
						<a href="#" class="btn btn-sm bg-orange mb-3"  id="activeModalBtn" data-id="{{$user->id}}" btn_id="renew">Renew</a>

						<a href="#" class="btn btn-sm bg-info"  id="oldPackageModel" data-id="{{$user->id}}" >Old Package</a>
					@else								
						<a href="#" class="btn btn-sm btn-success"  id="activeModalBtn" data-id="{{$user->id}}" btn_id="new">Active</a>
					@endif
				</td>
				<td>
				 	<form action="{{route('users.destroy', ['id' =>  $user->id ])}}" method="POST" id="delform_{{ $user->id }}">
					@method('DELETE')

				 	<a href="{{route('users.edit',$user->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

				 	<a href="javascript:void(0)" onclick="loginhistory('{{ $user->id }}')" title="user login history" data-id="modal" id="loginbtn"><i class="fa fa-clock-o btn btn-sm" style="font-size: 16px"></i></a>

				 	<a href="javascript:$('#delform_{{ $user->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>
				 	<ul class="dropdown " style="float: left;" >
				 		<a class="btn bg-info dropdown-toggle" data-toggle="dropdown">
				 			<i class="fa fa-gear" ></i>
				 		</a>
				 		<div class="dropdown-menu" style="left: -90px;color:black">
				 			<li class=dropdown-item>
				 				<a href="{{route('assign_role',$user->id)}}" style="">Assign Role</a>
				 			</li>
				 			<li class=dropdown-item>
				 				<a href="{{route('assign_permission',$user->id)}}"  style="">Assign Permission</a>
				 			</li>
				 		</div>
				 	</ul>

				 	@csrf
					</form>

				 </td>
			</tr>
		@endforeach
	</tbody>
</table>
{{$users->links()}}