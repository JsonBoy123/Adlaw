{{-- @extends(Auth::user()->user_catg_id == '5' ? 'customer.main' : (Auth::user()->user_catg_id == '2' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '3' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '4' ? 'lawschools.main' : (Auth::user()->user_catg_id == '6' ? 'lawschools.main' : (Auth::user()->user_catg_id == '7' ? 'lawschools.main' : 'admin.main')))))) --}}
@extends('partials.main')
@section('content')
<style type="text/css">
	
.comment {
    overflow: hidden;
    padding: 0 0 1em;
    /*border-bottom: 1px solid #ddd;*/
    margin: 0 0 1em;
    *zoom: 1;
}

.comment-img {
    float: left;
    margin-right: 33px;
    border-radius: 5px;
    overflow: hidden;
}

.comment-img img {
    display: block;
}

.comment-body {
    overflow: hidden;
}

.comment .text {
    padding: 10px;
    border: 1px solid #e5e5e5;
    border-radius: 5px;
    background: #fff;
}

.comment .text p:last-child {
    margin: 0;
}

.comment .attribution {
    margin: 0.5em 0 0;
    font-size: 14px;
    color: #666;
}

/* Decoration */

.comments,
.comment {
    position: relative;
}

.comments:before,
.comment:before,
.comment .text:before {
    content: "";
    position: absolute;
    top: 0;
    left: 65px;
}

.comments:before {
    width: 3px;
    top: -20px;
    bottom: -20px;
    background: rgba(0,0,0,0.1);
}

.comment:before {
    width: 9px;
    height: 9px;
    border: 3px solid #fff;
    border-radius: 100px;
    margin: 16px 0 0 -6px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.2), inset 0 1px 1px rgba(0,0,0,0.1);
    background: #ccc;
}

.comment:hover:before {
    background: orange;
}

.comment .text:before {
    top: 18px;
    left: 78px;
    width: 9px;
    height: 9px;
    border-width: 0 0 1px 1px;
    border-style: solid;
    border-color: #e5e5e5;
    background: #fff;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
}​
</style>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4 class="">To-Dos Details						
						<a href="{{route('todos.index')}}" class="btn btn-sm btn-info pull-right">Back</a>
						@if($todo->user_id == Auth::user()->id)
						<a href="{{route('todos.edit',$todo->id)}}" class="pull-right btn btn-sm btn-success" style="margin-right: 10px;">Edit</a>
						@if($todo->status == 'A')
						<button class="pull-right btn btn-sm btn-primary btnChecked" style="margin-right: 10px;">Approve</button>
						@endif
						@endif

					</h4>

				</div>
				<div class="box-body">
					<div class="row" style="margin-top:10px; ">
						<div class="col-md-12">
							@if($message = Session::get('success'))
								<div class="alert bg-success">{{$message}}</div>
							@endif
						</div>
					</div>	
					<div class="row">
						<div class="col-md-3 col-xl-3 col-sm-3"> <h4><b >Title : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4 class="text-capitalize">{{$todo->title}}</h4> </div>
					</div>
					@if($todo->relate_to_case !=null)
						<div class="row">
							<div class="col-md-3 col-xl-3 col-sm-3"> <h4><b>Related Case Title : </b></h4> </div>
							<div class="col-md-6 col-xl-6 col-sm-6"> <h4 class="text-capitalize">{{$todo->relate_to_case->case_title}}</h4> </div>
						</div>
					@endif
					<div class="row">
						<div class="col-md-3 col-xl-3 col-sm-3"> <h4><b>Creator : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4 class="text-capitalize">{{$todo->created_user->name}}</h4> </div>
					</div>
					<div class="row">
						<div class="col-md-3 col-xl-3 col-sm-3"> <h4><b>Assignee : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4>{{$todo->assigned_user->name}}</h4> </div>
					</div>
					<div class="row">
						<div class="col-md-3 col-xl-3 col-sm-3"> <h4><b>Start Date : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4>{{date('d-m-Y', strtotime($todo->start_date))}}</h4> </div>
					</div>
					<div class="row">
						<div class="col-md-3 col-xl-3 col-sm-3"> <h4><b>End Date : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4>{{date('d-m-Y', strtotime($todo->end_date))}}</h4> </div>
					</div>
					<div class="row">
						<div class="col-md-3 col-xl-3 col-sm-3"> <h4><b>Status : </b></h4> </div>
						<div class="col-md-6 col-xl-6 col-sm-6"> <h4>{{ $todo->status == 'P' ? 'Pending' : ($todo->status == 'A' ? 'Awaiting' : ($todo->status == 'C' ? 'completed' : ($todo->status == 'M' ? 'Missed' : 'Closed')))}}</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-xl-12 col-sm-12"> <h4><b>Description : </b></h4> </div>
						<div class="col-md-12 col-xl-12 col-sm-12">
							@php 
								echo $todo->description;
							@endphp 
						</div>
					</div>	
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h1 class="panel-title ">All Comments
										<p class="pull-right">0 Comments</p>
									</h1>
								</div>
								<div class="panel-body">	
									<form action="{{route('todos_comments')}}"  method="post">
									@csrf

								  	<div class="input-group col-md-8">
								      <input type="text" class="form-control" name="comment" placeholder="Write a comment ">
								      <input type="hidden" name="todo_id" value="{{$todo->id}}">
								      <span class="input-group-addon p-0"><button type="submit" class="btn btn-sm btn-primary">Comment</button></span>
								      	@error('comment')
											<span class="invalid-feedback text-danger" role="alert">
												<strong>{{"The selected field is required."}}</strong>
											</span>
										@enderror	
								    </div>									
									</form>
									<div class="row">
											
										<div class="col-xl-12 col-md-12 col-sm-12 mt-5">
											@foreach($todo->todos_comments as $todos_comment)
											  <section class="comments">
											    <article class="comment">
											      <a class="comment-img" href="#non">

											      	@if($todos_comment->user->photo !=null)
														<img src="{{ asset('storage/profile_photo/'.$todos_comment->user->photo)}}" width="50" height="50" />
													@else
														<img src="{{asset('storage/profile_photo/default.png')}}"  width="50" height="50" /> 
													@endif
											      </a>
											      <div class="comment-body">
											        <div class="text">
											          <p>{{$todos_comment->comment}}</p>
											        </div>
											        <p class="attribution">by <a href="#non">{{$todos_comment->user->name}}</a> at {{date('H:iA, d M Y',strtotime($todos_comment->cmnt_dt))}}</p>
											      </div>
											    </article>											    
											  </section>										
											
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	



					@if(Auth::user()->id != $todo->user_id && $todo->status == 'M') 
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h1 class="panel-title ">Give a reason why todo missed .. </h1>
									</div>
									<div class="panel-body">	
										<div class="row">
											<div class="col-md-6 col-xl-12 col-sm-12 form-group">
												<textarea name="" class="form-control" rows="5" cols="5" placeholder="Type Here ..." id="reason"></textarea>
												<span class="text-danger error" style="display: none"><strong>This field is required</strong></span>	
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 form-group">
												<button  class="btn btn-sm btn-primary" id="btnSubmit">Submit</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	
					@endif	

					@if($todo->status == 'O') 
						<div class="panel panel-default">
							<div class="panel-heading">
								<h1 class="panel-title ">Todo Missed Reason</h1>
							</div>
							<div class="panel-body">	
								<div class="row">
									<div class="col-md-6 col-xl-12 col-sm-12 form-group">
										@php 
											echo $todo->missed_reason;
										@endphp	
									</div>
								</div>
								
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>
<script >
	$(document).ready(function(){
		// var noti_id = "";		
 	// 	if(noti_id !=''){
 	// 		$.ajax({
		// 		type:'GET',
		// 		url:"{{route('mark_as_read')}}",
		// 		data:{noti_id:noti_id},
		// 		success:function(res){
		// 			if(res == 'true'){
		// 				console.log(res);
						
		// 				location.reload();
		// 			}else{
		// 				console.log(res);
		// 			}
		   		
		// 		}
		// 	});
 	// 	}
		$('#btnSubmit').on('click',function(e){
			e.preventDefault();
			var reason = $('#reason').val();
			var id = "{{$todo->id}}";
			if(reason != ''){
				$('.error').hide();
				$('#reason').css("border-color","#d2d6de");
				swal({
				  title: "Are you sure?",
				  text: "Once Completed, you will be send this reason again you can't send another reason of this to-dos closed",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				}).then((isConfirm) => {
					if(isConfirm){
						$.ajax({
							type:'GET',
							url:"{{route('todos.todo_closed_reason')}}",
							data:{id:id,reason:reason},
							success:function(res){
								swal({
					   				icon:'success',
					   				title: res,
					   				button: true,
					   			}).then((ok)=> {
					   				if(ok){
					   					location.reload();
					   				}
					   			});
							}
						});
					}else{
						swal("To-dos not submit");
					}

				})
				

			}else{
				$('.error').show();
				$('#reason').css("border-color","#cc7777");
			}
		});
		$('#reason').keypress(function(e){
			
			$('.error').hide();
			$('#reason').css("border-color","#d2d6de");
		});

		$('.btnChecked').on('click',function(e){
			e.preventDefault();
			var id = "{{$todo->id}}";
			$.ajax({
				type:'GET',
				url:"{{route('todos.awaiting_todo_update')}}",
				data:{id:id},
				success:function(res){
					swal({
		   				icon:'success',
		   				title: res,
		   				button: true,
		   			}).then((ok)=> {
		   				if(ok){
		   					location.reload();
		   				}
		   			});
				}
			});
		});

	});
</script>
@endsection