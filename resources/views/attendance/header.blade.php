<div class="row">
	<div class="col-md-12 m-auto " >
		<div class="card card-primary">
			<div class="card-header with-border">
				<div class="text-center ">
					<a href="{{route('attendance.index')}}">
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'dashboard' ? 'active-li' : ''}}" >
							<i class="fa fa-cubes"></i>
							<h5>Dashboard</h5>
						</div>
					</a>
					<a href="{{route('attendance.student')}}">
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'student' ? 'active-li' : ''}}" >
							<i class="fa fa-cubes"></i>
							<h5>Student Attendance</h5>
						</div>
					</a>
					<a href="{{route('attendance.staff')}}" >
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'staff' ? 'active-li' : ''}}" >
						<i class="fa fa-graduation-cap"></i>
						<h5>Staff Attendance</h5>
						</div>
					</a>
					<a href="{{route('attendance.upload')}}" >
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'upload' ? 'active-li' : ''}}" >
						<i class="fa fa-graduation-cap"></i>
						<h5>Upload Attendance</h5>
						</div>
					</a>
					<a href="{{route('attendance.manage_student')}}" >
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'manage' ? 'active-li' : ''}}" >
						<i class="fa fa-graduation-cap"></i>
						<h5>Manage Attendance</h5>
						</div>
					</a>
					<a href="{{route('attendance.student_report')}}" >
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'report' ? 'active-li' : ''}}" >
						<i class="fa fa-graduation-cap"></i>
						<h5>Report Attendance</h5>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>