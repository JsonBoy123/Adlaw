@extends("layouts.default")
@section('title',$content['title'])
@section('description',$content['description'])
@section('keywords',$content['keywords'])
@section('content')
@include('layouts.hero_section')
<style type="text/css">
	.text-captialize{
		font-family: inherit;
	}
</style>
@include('layouts.page_head',['title' => 'COMPANY / OTHER LAW USERS','description' => 'Easily Search Lawyer and Law Firms!'])

<div class="container mb-5 container-div">
	{{-- <div class="row">
        <div class="col-md-12">            
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search</li>
              </ol>
            </nav>
        </div>
    </div> --}}
    <div class="row ">
    	<div class="col-sm-12 col-md-12 col-xl-12 ">
		   <h3 class="text-center font-weight-bold">Search / Book an Appointment From Web's Largest Lawyers Directory.</h3>
		   <p class="p-text text-center"><i>Easily Find Top Rated Lawyer / Law Firms ! </i></p>
		</div>		
    </div>
	<div class="row m-0 pt-4" id="search_field">
		<div class="col-md-8 col-sm-8 col-xs-8 d-inline-flex radio-group m-auto" style=" padding:0;background-color: #efefef;"> 
			<div class="col-md-6  text-center btn big {{ $searchfield == 'lawyer' ? 'activebtn' : 'bg-color' }}" id="lawyer">
			Lawyer
			<input id="chb1" type="radio" name="searchfield" style="visibility: hidden" value="lawyer" {{ $searchfield=='lawyer' ? 'checked="checked"' : ''}}/>
			</div>
			<div class="col-md-6 text-center btn big {{ $searchfield == 'lawcompany' ? 'activebtn' : 'bg-color'}} " id="lawcompany">
			Law Company
			<input id="chb2" type="radio" name="searchfield" style="visibility: hidden" value="lawcompany" {{ $searchfield == 'lawcompany' ? 'checked="checked"' : ''}} />
			</div>
		</div>
	</div>
	<div class="row mb-1 mt-2" >
		<div class="col-md-8 col-xm-12 col-sm-12">
			<p class="mb-1" style="font-size: 18px; font-weight: 550">FIND LAWYER</p>
			
		</div>

		<div class="col-md-4 col-xm-12 col-sm-12 text-right "  id="genderBox">
			{{-- <p class="mb-1" style="font-size: 18px; font-weight: 550"></p> --}}
			<br>
			<label class="radio-inline mr-3"><input type="radio" name="gender" value="all" {{$gender == null ? "checked='checked'" : ''}}> Any</label>
			<label class="radio-inline mr-3"><input type="radio" name="gender" value="m"  {{$gender == 'm' ? "checked='checked'" : ''}}> Male</label>
			<label class="radio-inline mr-3"><input type="radio" name="gender" value="f" {{$gender == 'f' ? "checked='checked'" : ''}}> Female</label>
			<label class="radio-inline "><input type="radio" name="gender" value="t" {{$gender == 't' ? "checked='checked'" : ''}}> Other</label>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-6 col-xm-12 col-sm-12" >
			<input type="text" class="form-control" name="user_name" value="{{$name}}" placeholder="Search name here" id="user_name">
		</div>
		<div class="col-md-6 col-xm-12 col-sm-12" id="spect1">
			
			<select class="form-control select2 input-sm" id='specialist_lawyer' >
			<option value="0" data-id="0">Select Specialization</option>
				@foreach($specialities as $speciality)
					<option value="{{ $speciality->catg_code }}" data-id="{{$speciality->catg_desc}}" {{$catg_code == $speciality->catg_code ? 'selected="selected"' :'' }}>{{$speciality->catg_desc}}</option>
				@endforeach
			</select>
		
		</div>
	</div>			
	<div class="row">
		{{-- <div class="col-md-12"> 
			<h5 class="font-weight-bold">Search By Practicing Courts</h5>
		</div> --}}
		<div class="col-md-3 col-xm-12 col-sm-12">
			<select class="form-control select2 input-sm" id="state" name="state_code">
			<option value="0">Choose a state</option>
				@foreach($states as $state)
					<option value="{{ $state->state_code }}" {{$state_code == $state->state_code ? 'selected="selected"' :'' }}>{{$state->state_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-3 col-xm-12 col-sm-12">
			<select class="form-control select2 input-sm" id="city" name="city_code">
				<option value="0" data-id="0">Select City</option>
			</select>
		</div>	
		<div class="col-md-3 col-xm-12 col-sm-1" id="court1">
			<select class="form-control select2 input-sm" id='court_id'>
			<option value="0">Select Practicing Courts</option>
				
			</select>
		</div>
		{{-- <div class="col-md-3 col-xm-12 col-sm-12"  id="spect1">
			<select class="form-control select2" id='specialist_lawyer'>
			<option value="0">Select Specialization</option>
				@foreach($specialities as $speciality)
					<option value="{{ $speciality->catg_code }}">{{$speciality->catg_desc}}</option>
				@endforeach
			</select>
		</div>		 --}}
	</div>
	<div class="row mt-4" id="btnshowLawyer">
		<div class="col-md-12 col-xm-12 col-sm-12 text-center">
			<button class="btn btn-lg btn-round filteBtn">Search</button>
		</div>
	</div>	
	<div class="row">
		{{-- @include('pages.subpages.search.lawfirms_table') --}}
	</div>

	<div class="row mt-2"  id="withoutsearchDiv">
		<div class="col-md-12 col-sm-12 col-xm-12" id="tablediv">
			@include('pages.subpages.search.lawfirms_table')
		</div>
	</div>
	<div class="row">
    	
        <div class="col-md-12 col-sm-12 col-xl-12 pt-5" id="content_dynamic">
			<span class="halfText">
				@php 
					echo substr($content['content'],0, strpos($content['content'],'</p>'));
				@endphp
			</span>

			  </p>
			  <span class="full-text" style="display: none">
				@php 
					echo substr($content['content'],strpos($content['content'],'</p>'),strlen($content['content']));
				@endphp
			</span>
			</p>

			<a href="javascript:void(0)" class="readmore"><b> >> Read More</b></a>
			<a href="javascript:void(0)" class="readless" style="display: none"><b> << Read Less</b></a>  
        </div>
		
	</div>

</div>
@include('models.login_model')
@include('models.booking_model')

<script type="text/javascript">
	@php
		if(Session::has('errors')){
	@endphp
		$(document).ready(function(){
		  	$('.login_modal').modal({show: true});
		});
    @php 
		}
	@endphp
  
	@php
		 if($message = Session::get('success')) {
	@endphp
		alert("{{$message}}");
	@php 
		}
		if($message = Session::get('warning')) {
	@endphp
		alert("{{$message}}");
	@php 
		}
	@endphp
</script>
<script >
function loginChecked($user_id){
	var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
	if(AuthUser){
		var checkUser = "{{(Auth::user()) ? Auth::user()->id : null}}";
		if(checkUser != $user_id){
			let url = "{{ route('message.create', 'id=:id') }}";
		    url = url.replace(':id', $user_id);
		    document.location.href=url;
		}
		else{
			alert("You can't send message on your own profile")
		}
	}
	else{
		 $('.login_modal').modal({show: true});
  	}
}	

</script>

<script>	
$(document).ready(function(){
	 $('.readmore, .readless').on('click',function(e){
       e.preventDefault();
           
       $('.full-text').toggle();
       $('.readmore').toggle();
       $('.readless').toggle();
    });



	$('.radio-inline').click(function() {

		$(this).find('input').prop('checked', true) ;   
	});
	$('.select2').select2();

	@if($searchfield == 'lawcompany')	
     	$('#spect1').hide();
        $('#genderBox').hide();      
    @else
    	$('#spect1').show();
     	$('#genderBox').show();
	@endif



	$('.big').click(function() {
        $('.activebtn').addClass('bg-color').removeClass('activebtn');

         $(this).removeClass('bg-color').addClass('activebtn').find('input').prop('checked', true) ;   
         var searchfield = $(this).find('input').val();


         if(searchfield == 'lawyer'){
         	$('#spect1').show();
         	$('#genderBox').show();

         }
         else if(searchfield == 'lawcompany'){
         	$('#spect1').hide();
         	$('#genderBox').hide();
         }
         $('#tablediv').empty();
    });

   @if($state_code !='0')
		var court_id = '#court_id';
		state("{{$state_code}}","{{$city_code}}");
		state_city_court("{{$city_code}}","{{$state_code}}",court_id,"{{$court_code}}");
   @endif
	
	$('#state').on('change',function(){
		var state_code = $(this).val();	
		var city_code = "";
	
		state(state_code,city_code);
	});

	$(document).on('click','.right-button', function() {
		event.preventDefault();
		$('.center,.center1').animate({
		scrollLeft: "+=100px"
		}, "slow");
	});

	$(document).on('click','.left-button', function() {
	// $('.left-button').click(function() {
		event.preventDefault();
		$('.center,.center1').animate({
		scrollLeft: "-=100px"
		}, "slow");
	});


	$('body').on('click', '.right-button1', function() {
		event.preventDefault();
		$('.center,.center1').animate({
		scrollLeft: "+=100px"
		}, "slow");
	});

	$('body').on('click', '.left-button1', function() {
		event.preventDefault();
		$('.center,.center1').animate({
		scrollLeft: "-=100px"
		}, "slow");
	});


	$('body').on('click','.bookingBtn' ,function(){
		
		var today = new Date(); 		
		var b_date = $(this).find("input[name='b_date']").val();
		var slot_time = $(this).find("input[name='slot_t']").val();
		var slot_id = $(this).attr('id');			
		var user_id = $(this).find("input[name='user_id']").val();

		var appoint_status = $(this).data('id');			
		console.log(appoint_status);

		b_date = new Date(b_date);
		var current_time = today.getHours() + ":" + (today.getMinutes() < 10 ? '0' : '' ) + today.getMinutes() + ":" + (today.getSeconds() < 10 ? '0' : '' ) + today.getSeconds();
		if(appoint_status){	
			if(today.getDate() == b_date.getDate()){
				var b_date = $(this).find("input[name='b_date']").val();
				if(current_time < slot_time){
					booking(b_date,slot_id,user_id)
				}else{
					swal({
						text : "You have not selected previous time booking.",
						type : 'warning',
						
					});
				}

			}else{
				var b_date = $(this).find("input[name='b_date']").val();
				booking(b_date,slot_id,user_id)
			}
		}else{
			swal({
				text : "You have only booked Appointment schedule time.",
				type : 'warning',
				
			});
		}
	
	});
	function booking(b_date,slot_id,user_id){
		var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
		if(AuthUser){		
			$('#bookingDate').val(b_date);
			$('#booking_plan_id').val(slot_id);			
			$('#booking_user_id').val(user_id);
			$('#BtnViewModal').modal('show');
		}
		else{
			$('.login_modal').modal({"backdrop": "static"});
		}
	}

	$('body').on('click','.bookBtn' ,function(){	
		$user_id = $(this).attr('id');
		var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
		if(AuthUser){
			$('#BtnViewModal .modal-body ').find("input[name='user_id']").val($user_id);
			$('#BtnViewModal').modal('show');
		}
		else{
			$('.login_modal').modal({"backdrop": "static"});
		}
	});

	$.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	});

	$('#user_name').on('blur',function(e){
		var user_name_s = $(this).val(); 
		$('#model_user_name').val(user_name_s);
	})

$(".filteBtn").on('click',function(e){
	
	e.preventDefault();
	var specialist =  $('#specialist_lawyer option:selected').attr('data-id');
	var state_code = $('#state').val();
	var city = $('#city option:selected').attr('data-id');
	// var city_code = $('#city option:selected').attr('data-id');
	var gender = $("input[name='gender']:checked").val();
	var searchfield = $("input[name='searchfield']:checked").val();
	var court_id = $('#court_id').val();
	var user_name = $("input[name='user_name']").val();
	// console.log(specialist);
	// console.log(city);
// alert(searchfield);
	var url1 = '';
	if(specialist !='0'){
		if(city !='0'){
			url1 = "{{url('search')}}/"+slug_name(specialist)+'/'+slug_name(city); 
		}else{
			url1 = "{{url('search')}}/"+slug_name(specialist); 
		}
	}else if(city !='0'){
		url1 = "{{url('search')}}/"+slug_name(city); 

	}else{
		url1 = "{{url('search')}}";
	}
	window.location.href = url1 + '?' + 'gender='+gender+'&searchfield='+searchfield+'&court_id='+court_id+'&user_name='+user_name;
	
});

$(document).on('click', '.pagination a',function(event)
{
    event.preventDefault();
    $('li').removeClass('active');
    $(this).parent('li').addClass('active');

    var myurl = $(this).attr('href');
    var page=$(this).attr('href').split('page=')[1];

	var specialist =  $('#specialist_lawyer option:selected').attr('data-id');
	var state_code = $('#state').val();
	var city = $('#city option:selected').attr('data-id');
	// var city_code = $('#city option:selected').attr('data-id');
	var gender = $("input[name='gender']:checked").val();
	var searchfield = $("input[name='searchfield']:checked").val();
	var court_id = $('#court_id').val();
	var user_name = $("input[name='user_name']").val();
	var url = window.location.href;

	window.location.href = url + '?' + 'gender='+gender+'&searchfield='+searchfield+'&court_id='+court_id+'&user_name='+user_name+'&page='+page;	
});


// function getData(page,specialist,state_code,city,gender,searchfield,court_id,user_name){

// 	var url1 = '';
// 	if(specialist !='0'){
// 		if(city !='0'){
// 			url1 = "{{url('search')}}/"+slug_name(specialist)+'/'+slug_name(city); 
// 		}else{
// 			url1 = "{{url('search')}}/"+slug_name(specialist); 
// 		}
// 	}else if(city !='0'){
// 		url1 = "{{url('search')}}/"+slug_name(city); 

// 	}else{
// 		url1 = "{{url('search')}}";
// 	}


//     // $.ajax({
//     //     url:url1 + '?' + 'gender='+gender+'&searchfield='+searchfield+'&court_id='+court_id+'&user_name='+user_name,
//     //     type: "get",
//     //     datatype: "html"
//     // }).done(function(data){
    
//     //     $("#tablediv").empty().html(data);
//     //     location.hash = page;
//     // }).fail(function(jqXHR, ajaxOptions, thrownError){
//     //       alert('No response from server');
//     // });
// }

$(document).on('change','#specialist_lawyer',function(e){
	e.preventDefault();
	var city = $('#city option:selected').attr('data-id');
	var catg = $('#specialist_lawyer option:selected').attr('data-id');	
	if(catg !='0' ){
		if(city !='0'){
	      window.location.href = "{{url('search')}}/"+slug_name(catg)+'/'+slug_name(city); 
		}else{
	     	window.location.href = "{{url('search')}}/"+slug_name(catg); 
		}
	}

});

$(document).on('change','#city',function(e){
	e.preventDefault();

	var city = $('#city option:selected').attr('data-id');
	var catg = $('#specialist_lawyer option:selected').attr('data-id');

	  var searchfield = $('input[name="searchfield"]:checked').val();
	  
	if(searchfield != 'lawcompany'){	  
		if(city !='0' ){
			if(catg !='0'){

		      window.location.href = "{{url('search')}}/"+slug_name(catg)+'/'+slug_name(city); 
			}else{
		     	window.location.href = "{{url('search')}}/"+slug_name(city); 
			}
		}
	}else{
		var city_code = $(this).val();
		var state_code = '';
		var court_id = '#court_id';
		state_city_court(city_code,state_code,court_id);
	}
	

});
});
</script>
@endsection