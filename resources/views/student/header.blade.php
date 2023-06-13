
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/additional-methods.min.js')}}"></script>
<script src="{{asset('js/jquery.steps.min.js')}}"></script>
<div class="row">
	<div class="col-md-12 m-auto " >
		<div class="card card-primary">
			<div class="card-header with-border">
				<div class="text-center ">
					<a href="{{route('student.index')}}">
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(1) == 'student' ? 'active-li' : ''}}" >
							<i class="fa fa-cubes"></i>
							<h5>Dashboard</h5>
						</div>
					</a>
					<a href="{{route('student_detail.index')}}" >
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(1) == 'student_detail' ? 'active-li' : ''}}" >
						<i class="fa fa-graduation-cap"></i>
						<h5>Student Details</h5>
						</div>
					</a>
					<a href="{{route('student_manage.index')}}"><div class="col-md-2 col-sm-6 col-xs-11   col-div-mar col-div-nav {{Request()->segment(1) == 'student_manage' ? 'active-li' : ''}}" >
						<i class="fa fa-gear"></i>
						<h5>Arrange Student</h5>
					</div></a>
					<a href="{{route('upload_student')}}" ><div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(1) == 'upload_student' ? 'active-li' : ''}}" >
						<i class="fa fa-cube"></i>
						<h5>Upload Student</h5>
					</div></a>
					<a href="{{route('student_record')}}" ><div class="col-md-2 col-sm-6 col-xs-11   col-div-mar col-div-nav {{Request()->segment(1) == 'student_record' ? 'active-li' : ''}}" >
						<i class="fa fa-cube"></i>
						<h5>Records</h5>
					</div></a>
					
				</div>
			</div>
		</div>
	</div>
</div>