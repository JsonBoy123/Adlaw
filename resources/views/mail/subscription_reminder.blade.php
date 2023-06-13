<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Adlaw Subcription Renewal Reminder </title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-11 m-auto">
				<div class="card shadow-lg">
					<div class="card-header">
						<h3 class="card-title">
							<a class="navbar-brand p-2" href="http://adlaw.laxyo.org/login"><img src="http://adlaw.laxyo.org/images/adlaw-logo.png" alt="Adlaw" style="width: 120px;"></a>
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h3>Please renewal your current package </h3>
							</div>
							<div class="col-md-12">
								<h3h4>{{$data['message']}}</h4>
							</div>
							<div class="col-md-12">
								<a href="http://adlaw.laxyo.org/login" class="btn btn-sm btn-primary">
									Renewal Package Now
								</a>
							</div>
						</div>		
					</div> 
				</div>
			</div>
		</div>
	</div>
</body>

</html>