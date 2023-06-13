{{-- @extends(Auth::user()->user_catg_id == '5' ? 'customer.main' : (Auth::user()->user_catg_id == '2' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '3' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '4' ? 'lawschools.main' : (Auth::user()->user_catg_id == '6' ? 'lawschools.main' : (Auth::user()->user_catg_id == '7' ? 'lawschools.main' : 'admin.main')))))) --}}
@extends('partials.main')

@section('content')
<script src="{{ asset('js/app.js') }}" defer></script>
<section class="content" id="app" >
	{{-- <a href="{{url('/pms/display_reminder')}}">Click Me</a> --}}
  	<schedules :users = "{{ json_encode($users) }}"
  		:displays = "{{ json_encode($schedules) }}"
  		:logged_user = "{{ json_encode(auth()->user()) }}"
  		:create_schedule = "{{ $create_schedule }}"
		></schedules>
</section>
@endsection