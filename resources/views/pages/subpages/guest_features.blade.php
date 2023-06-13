@extends("layouts.default")
@section('title','Best Lawyers for Consulting | Top 10 Criminal Lawyers | Lawyers Association India')
@section('description','Get best lawyers for consulting, whether you are finding criminal lawyers, family lawyers, corporate lawyers for free law advice, legal answer or any Law Association in India.')
@section('keywords','lawyers association India, top 100 lawyers in India, top 10 criminal lawyers in India, top 50 lawyers in India, best lawyers for consulting, free Legal advice, legal advice, consult with best lawyer, legal help, legal issues, law questions, law advice, ask a lawyer, legal question, law answers, free law advice, legal answers, law advisers, free legal help')
@section('content')
@include('layouts.hero_section')
@include('layouts.page_head',['title' => 'COMPANY / OTHER LAW USERS','description' => 'Easily Search Lawyer and Law Firms!'])

<div class="container container-div">
    <div class="row ">
    	
         <div class="col-md-12 col-sm-12 col-xl-12 pt-5">
        	<h3 class="font-weight-bold text-captialize mb-3">Consult Best Lawyer / Law Firms in India</h3>
			<p class="p-text">
			    Seeing the demand of various Legal problems we allow you to hire the professional experts having good experience in Civil Law, Corporate Law, Start-up Solutions, Criminal Law, Consumer Law, Family Law and much more in all over India.
			<br><br>
			We help you to consult with the well experienced team of lawyers, researchers & experts carry daily research on all latest current & new law, judgments & Court decisions and allows to hire the best lawyers in India for District Courts, High Court & Supreme Court matters. Our services includes to provide the best legal advisor for legal consultancy services, taxation services, corporate legal services, recovery solutions, financial legal services, bad debt recovery solutions, back office operation services, data entry service, documentation services, passport related services, fiscal documentation etc. 
			<br><br>

			</p>
		{{-- 	<p class="p-text">
				The following details provided by us have been gathered and prepared for Users' convenience, and remarkably for informative purposes; they are in no way legal advice. More precisely, nothing on the adlaw website should be interpreted as being a legal opinion, a recommendation on how to act, or an answer that applies directly to a specific circumstance. Adlaw is no way, directly or indirectly responsible for the advice and assistance provided by the Lawyers. 

				Adlaw will not be responsible for any issues/discrepancies created by the Lawyers about gathering their details.
			</p> --}}

        </div>
		<div class="col-sm-12 col-md-12 col-xl-12 ">
		   <h3 class="text-center font-weight-bold">Search / Book an Appointment From Web's Largest Lawyers Directory.</h3>
		   <p class="p-text text-center"><i>Easily Find Top Rated Lawyer / Law Firms ! </i></p>
		</div>		
	</div>
	<div class="row" id="search_field">
		<div class="col-md-8 col-sm-8 col-xs-8 d-inline-flex radio-group m-auto" style=" padding:0;background-color: #efefef; "> 
			<div class="col-md-6  text-center btn big {{ $searchfield=='lawyer' ? 'activebtn' : '' }} " id="lawyer">
			Lawyer
			<input id="chb1" type="radio" name="searchfield" style="visibility: hidden" value="lawyer" {{ $searchfield=='lawyer' ? 'checked' : ''}}   />
			</div>
			<div class="col-md-6 text-center btn big {{ $searchfield == 'lawcompany' ? 'activebtn' : ''}} bg-color" id="lawcompany">
			Law Company
			<input id="chb2" type="radio" name="searchfield" style="visibility: hidden" value="lawcompany" {{ $searchfield == 'lawcompany' ? 'checked' : ''}} />
			</div>
		</div>
	</div>
	<div class="row mb-1" >
		<div class="col-md-8 col-xm-12 col-sm-12">
			<p class="mb-1" style="font-size: 18px; font-weight: 550">FIND LAWYER </p>
			
		</div>

		<div class="col-md-4 col-xm-12 col-sm-12 text-right "  id="genderBox">
			{{-- <p class="mb-1" style="font-size: 18px; font-weight: 550"></p> --}}
			<br>
			<label class="radio-inline mr-3"><input type="radio" name="gender" value="all" checked> Any</label>
			<label class="radio-inline mr-3"><input type="radio" name="gender" value="m" > Male</label>
			<label class="radio-inline mr-3"><input type="radio" name="gender" value="f"> Female</label>
			<label class="radio-inline "><input type="radio" name="gender" value="t"> Other</label>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-6 col-xm-12 col-sm-12" >
			<input type="text" class="form-control" name="user_name" value="{{$name}}" placeholder="Search name here">
		</div>
		<div class="col-md-6 col-xm-12 col-sm-12" id="spect1" >
			
			<select class="form-control select2" id='specialist_lawyer' >
			<option value="0">Select Specialization</option>
				@foreach($specialities as $speciality)
					<option value="{{ $speciality->catg_code }}">{{$speciality->catg_desc}}</option>
				@endforeach
			</select>
		
		</div>
	</div>			
	<div class="row">
		{{-- <div class="col-md-12"> 
			<h5 class="font-weight-bold">Search By Practicing Courts</h5>
		</div> --}}
		<div class="col-md-3 col-xm-12 col-sm-12">
			<select class="form-control select2" id="state" name="state_code">
			<option value="0">Choose a state</option>
				@foreach($states as $state)
					<option value="{{ $state->state_code }}" >{{$state->state_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-3 col-xm-12 col-sm-12">
			<select class="form-control select2" id="city" name="city_code">
				<option value="0">Select City</option>
			</select>
		</div>	
		<div class="col-md-3 col-xm-12 col-sm-1" id="court1">
			<select class="form-control select2" id='court_id' >
			<option value="0">Select Practicing Courts</option>
				
			</select>
		</div>
		{{-- <div class="col-md-3 col-xm-12 col-sm-12"  id="spect1">
			<select class="form-control select2" id='specialist_lawyer' >
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
		
	</div>

	<div class="row mt-2"  id="withoutsearchDiv">
		<div class="col-md-12 col-sm-12 col-xm-12" id="tablediv">
			@include('pages.subpages.search.lawfirms_table')
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

	$('.radio-inline').click(function() {

		$(this).find('input').prop('checked', true) ;   
	});
	$('.select2').select2();

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
	
	$('#state').on('change',function(){
		var state_code = $(this).val();	
		var city_code = "";
		state(state_code,city_code);
	
	});

	$('#city').on('change',function(){
		var city_code = $(this).val();
		var state_code = '';
		var court_id = '#court_id';
		state_city_court(city_code,state_code,court_id);
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
		var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
		var today = new Date(); 
		today.setDate(today.getDate() - 1);
		var b_date = $(this).find("input[name='b_date']").val();
		b_date = new Date(b_date);
		if(today < new Date(b_date)){
			if(AuthUser){
				$client_id = "{{(Auth::user()) ? Auth::user()->id : null }}";
				$slot_id = $(this).attr('id');
				$slot_time = $(this).text();
				$user_id = $(this).find("input[name='user_id']").val();
				$b_date = $(this).find("input[name='b_date']").val();
				 console.log($b_date);
				$('#BtnViewModal .modal-body ').find("input[name='b_date']").val($b_date);
				$('#BtnViewModal .modal-body ').find("input[name='plan_id']").val($slot_id);
				$('#BtnViewModal .modal-body ').find("input[name='slot_time']").val($slot_time);
				$('#BtnViewModal .modal-body ').find("input[name='user_id']").val($user_id);
				$('#BtnViewModal .modal-body ').find("input[name='client_id']").val($client_id);

				$('#BtnViewModal').modal('show');
			}
			else{
				$('.login_modal').modal({"backdrop": "static"});
			}
		}
		else{
			swal({
				text : "You have not selected previous date booking.",
				type : 'warning',
				
			});
		}
	});

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

$(".filteBtn").on('click',function(e){
	
	e.preventDefault();
	var specialist =  $('#specialist_lawyer').val();
	var state_code = $('#state').val();
	var city_code = $('#city').val();
	var gender = $("input[name='gender']:checked").val();
	var searchfield = $("input[name='searchfield']:checked").val();
	var court_id = $('#court_id').val();
	var user_name = $("input[name='user_name']").val();
	// console.log(user_name);
// alert(searchfield);

	$.ajax({
	    type:"get",
	    url:"{{ route('lawfirms.search') }}?speciality="+specialist+'&state_code='+state_code+'&city_code='+city_code+'&gender='+gender+'&searchfield='+searchfield+'&court_id='+court_id+'&user_name='+user_name,
		   // success:function(data){ 
		   // 		$("#tablediv").empty().html(data);
		   // }
        }).done(function(data){
        	
            $("#tablediv").empty().html(data);
            // console.log(data);
          
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
		});
	
});

$(document).on('click', '.pagination a',function(event)
{
    event.preventDefault();
    $('li').removeClass('active');
    $(this).parent('li').addClass('active');

    var myurl = $(this).attr('href');
    var page=$(this).attr('href').split('page=')[1];

	var specialist =  $('#specialist_lawyer').val();
	var state_code = $('#state').val();
	var city_code = $('#city').val();
	var gender = $("input[name='gender']:checked").val();
	var searchfield = $("input[name='searchfield']:checked").val();
	var court_id = $('#court_id').val();
	var user_name = $("input[name='user_name']").val();
    getData(page,specialist,state_code,city_code,gender,searchfield,court_id,user_name);
});


function getData(page,specialist,state_code,city_code,gender,searchfield,court_id,user_name){

    $.ajax({
        url:"{{route('lawfirms.search')}}?speciality="+specialist+'&state_code='+state_code+'&city_code='+city_code+'&gender='+gender+'&searchfield='+searchfield+'&page='+page+'&court_id='+court_id+'&user_name='+user_name,
        type: "get",
        datatype: "html"
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