{{-- @extends(Auth::user()->user_catg_id == 2 ? 'lawfirm.main' : (Auth::user()->user_catg_id == 3 ? 'lawfirm.main' : (Auth::user()->user_catg_id == 4 ? 'lawschools.main' : (Auth::user()->user_catg_id == 6 ? 'lawschools.main' : (Auth::user()->user_catg_id == 7 ? 'lawschools.main' : (Auth::use()->user_catg_id == 5 ? 'customer.main' : 'admin.main')))))) --}}
@extends('partials.main')
@section('content')
<section class="content">
	
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				
			</div>
		</div>
	</div>
</div>
</section>
@endsection