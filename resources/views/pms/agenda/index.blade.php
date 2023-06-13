{{-- @extends(Auth::user()->user_catg_id == '5' ? 'customer.main' : (Auth::user()->user_catg_id == '2' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '3' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '4' ? 'lawschools.main' : (Auth::user()->user_catg_id == '6' ? 'lawschools.main' : (Auth::user()->user_catg_id == '7' ? 'lawschools.main' : 'admin.main')))))) --}}
@extends('partials.main')
@section('content')
<script src="{{ asset('js/app.js') }}" defer></script>
<section class="content" id="app">
  	<agenda 
  		:team="{{ json_encode($team)}}"
  		:agendas="{{ json_encode($agendas)}}"
  		:focus-agenda="{{ $focusAgenda}}"
  		:users="{{ json_encode($users)}}"
  		:can_create_agenda="{{ json_encode($can_create_agenda)}}"
  		:logged_user="{{ json_encode(auth()->user())}}"
		></agenda>
</section>

@endsection