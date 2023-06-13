@extends("layouts.default")
@section('title','Top Law Schools India | College for Law Student, Law Colleges | Adlaw')
@section('description','Find the best law school among the top law Schools in India. Adlaw provides the list of all law schools which is the best for you to get education. See the latest College of Law updates and developments.')
@section('keywords', 'best law colleges in India, list of law schools India, top law schools India, college for law student, top 5 law schools in India, best law schools in India')
@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'LAW SCHOOLS / STUDENTS','description' => 'Locate Suitable Lawschools!'])

<div class="container container-div">
	
	<div class="row">
		<div class="col-md-12 pt-5">
			<h3 class="font-weight-bold mb-2">Locate Perfect Law schools! </h3>
			<p class="p-text">				
				Adlaw offers an interactive online CRM solution for Law colleges through a secure way to manage their administration. With Adlaw one can perform effective administration, academic management and e-learning program of Law Schools. It allows keeping record of students, teachers, team members, documents, DSR, Courses and batches etc. Through CRM you can includes college profile filled with all the details of college, agenda, schedule for a particular event, Exams, Viva, team members detail and To-dos etc. Course and Batch Management feature offered by Adlaw is designed for law colleges where you can manage batch of students and courses what you are providing. 
			</p>
			<p class="p-text">
				Apart of features for Law Schools, Adlaw has a lot for the students of Law schools. Student can keep the record of their school’s study program. The alumni group of students with the current students can make the real time difference through Adlaw. 
			</p>
			<p class="p-text">
				Students can access it from anywhere, share information and extract historical information into analytics records which helps in improvised study environment and smooth functioning of the Law institute. 
			</p>
			<p class="p-text">
				We make your work more easy and efficient with our professional approach that too with ECO FRIENDLY TECHNIQUES SAVING PAPER AND TREES.
			</p>
			<hr>
		</div>
		<div class="col-md-12 text-center mt-2">
			<h3 class="font-weight-bold">Find Law Schools</h3>
		</div>
		<div class="col-md-4 form-group">
			<label>Enter College Name</label>
			<input type="text" name="user_name" class="form-control" placeholder="Search name here">
		</div>
		<div class="col-md-4 form-group">
			<label>Select State</label>
			<select class="form-control select2" name="state_code" id="state">
				<option value="0">Select State</option>	
				@foreach($states as $state)
					<option value="{{$state->state_code}}">{{$state->state_name}}</option>
				@endforeach 
			</select>	
		</div>
		<div class="col-md-4 form-group">
			<label>Select City</label>
			<select class="form-control select2" name="city_code" id="city"></select>	
		</div>
		<div class="col-md-12 form-group text-center">
			<button class="btn btn-md btn-round filteBtn">Search</button>
		</div>
	</div>	
	<div class="row "  id="withoutsearchDiv">
		<div class="col-md-12 col-sm-12 col-xm-12" id="tablediv">
			{{-- @include('pages.subpages.search.lawschools_table') --}}
		</div>
	</div>
</div>
@include('models.login_model')
<script >
	$(document).ready(function(){
		$('.select2').select2();
		$('#state').on('change',function(){
			var state_code = $(this).val();	
			var city_code = "";
			state(state_code,city_code);
		});

		$(".filteBtn").on('click',function(e){
			e.preventDefault();
			@if(!Auth::user())
				$('.login_modal').modal({"backdrop": "static"});
			@else
				var user_name = $("input[name='user_name']").val();
				var state_code = $('#state').val();
				var city_code = $('#city').val();
			
					$.ajax({
					    type:"get",
					    url:"{{ route('lawschools.search') }}?state_code="+state_code+'&city_code='+city_code+'&user_name='+user_name,
				        }).done(function(data){
				            $("#tablediv").empty().html(data);
				             console.log(data);
				        }).fail(function(jqXHR, ajaxOptions, thrownError){
				            alert('No response from server');
					});
			@endif
		});

		$(document).on('click', '.pagination a',function(event)
			{
			    event.preventDefault();

			    $('li').removeClass('active');
			    $(this).parent('li').addClass('active');
			    var myurl = $(this).attr('href');
                var page=$(this).attr('href').split('page=')[1];

				var user_name = $("input[name='user_name']").val();
				var state_code = $('#state').val();
				var city_code = $('#city').val();


			    getData(page,user_name,state_code,city_code);
			});


			function getData(page,user_name,state_code,city_code){

			    $.ajax({
			        url:"{{ route('lawschools.search') }}?state_code="+state_code+'&city_code='+city_code+'&user_name='+user_name+'&page='+page,
			        type: "get",
			        datatype: "html",
			    }).done(function(data){
			        $("#tablediv").empty().html(data);
			        location.hash = page;
			    }).fail(function(jqXHR, ajaxOptions, thrownError){
			          alert('No response from server');
			    });
			}



	});
</script>
@endsection