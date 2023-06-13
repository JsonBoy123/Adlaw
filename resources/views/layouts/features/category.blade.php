<style >
.card-hover.card{
    transition: all .2s cubic-bezier(.02,.54,.58,1);
    box-shadow: none;
    border-radius: 8px;
    padding: 30px 0;
    height: 100%;
    transform: translateY(0);
    font-size: small;
}
.card.has-shadow{
    box-shadow: 0 10px 55px 5px rgba(137,173,255,.35) !important;   
}


.card-hover.card:hover{
    box-shadow: 0 10px 55px 5px rgba(137,173,255,.35);
    transform: translateY(-20px);
}
.card-h3{
	font-size: 18px !important;
}

</style>
<section class="py-5 features-icons bg-light text-center">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-4 col-md-4 col-sm-12 mb-3 mb-md-0"> 
				<a href="{{route('lawfirms')}}" style="text-decoration: none !important">
					<div class="card card-hover has-shadow  no-border py-0 ">
						<div  class="card-body">
							<img class="media-object" src="images/lawyers-law firm1.png" alt="Image">							
					        <h3 class="font-weight-bold card-h3">Lawyer / Law Firms</h3>
					        <p class="mb-0">Feature Rich CRM Solution</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-12 col-lg-4 col-md-4 col-sm-12 mb-3 mb-md-0">
				<a href="{{route('search')}}" style="text-decoration: none !important">
					<div class="card card-hover has-shadow  no-border py-0 ">
						<div  class="card-body">
							<img class="media-object" src="images/lawyers-law firm1.png" alt="Image">							
					        <h3 class="font-weight-bold card-h3">Company / Other Law Users</h3>
					        <p class="mb-0">Easily Search to Find Lawyer and Law Firms!</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-12 col-lg-4 col-md-4 col-sm-12 mb-3 mb-md-0">
				<a href="{{route('lawschools')}}" style="text-decoration: none !important">
					<div class="card card-hover has-shadow  no-border py-0 ">
						<div  class="card-body">
							<img class="media-object" src="images/lawyers-law firm1.png" alt="Image">							
					        <h3 class="font-weight-bold card-h3">Law Schools / Students</h3>
					        <p class="mb-0">Locate Suitable Lawschools!</p>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>