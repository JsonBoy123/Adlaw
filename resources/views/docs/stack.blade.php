{{-- @extends(Auth::user()->user_catg_id == '5' ? 'customer.main' : (Auth::user()->user_catg_id == '2' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '3' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '4' ? 'lawschools.main' : (Auth::user()->user_catg_id == '6' ? 'lawschools.main' : (Auth::user()->user_catg_id == '7' ? 'lawschools.main' : 'admin.main')))))) --}}
@extends('partials.main')

@section('content')
 <script src="{{ asset('js/app.js') }}" defer></script>
<section class="content" id="app" >
	<stack-component
    :docs_users="{{ json_encode($users) }}"
    :stack="{{ json_encode($stack) }}"
    :parent_folders="{{ json_encode($parent_folders) }}" 
    :logged_user="{{ json_encode(auth()->user()) }}"
    :meta="{{ json_encode($meta) }}"></stack-component>
</section>
@endsection