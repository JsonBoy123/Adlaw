<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Subcription Email</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-11 m-auto">
				<div class="card shadow-lg">
					<div class="card-header bg-white">
						<h5 class="text-center">
								<a class="navbar-brand p-2" href="http://adlaw.laxyo.org/login"><img src="http://adlaw.laxyo.org/images/adlaw-logo.png" alt="Adlaw" style="width: 120px;"></a>
						</h5>
					</div>
					<div class="card-body">	
						<div class="row">
							<div class="col-md-6 form-group">
								<label>User Name</label> 
								<h4 class="form-control">{{$data['name']}}</h4>
							</div>
							<div class="col-md-6 form-group">
								<label>User Mobile Number</label> 
								<h4 class="form-control">{{$data['mobile']}}</h4>
							</div>
							<div class="col-md-6 form-group">
								<label>User Email Address</label> 
								<h4 class="form-control">{{$data['email']}}</h4>
							</div>
							<div class="col-md-6 form-group">
								<label>Number of Members</label> 
								<h4 class="form-control">{{$data['no_of_members']}}</h4>
							</div>
							<div class="col-md-6 form-group">
								<label>Number of Clients</label> 
								<h4 class="form-control">{{$data['no_of_clients']}}</h4>
							</div>
							<div class="col-md-6 form-group">
								<label>User Type</label> 
								<h4 class="form-control">{{$data['user_catg_name']}}</h4>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>