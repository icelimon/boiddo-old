<?php
include_once("check-login-status.php");
if($user_ok == true && $log_category == "doctor"){
	header("Location: dr-planet.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="images/boiddo-band.png" />
	<title>Boiddo</title>
	<meta name="description" content="Online doctor and hospitals whats you need while trubling. Find your nearest hospital, get information about doctors and hospitals. Get serial of them... and many more options, what people need.">
	<meta name="keywords" content="online doctor, boiddo, healthcare, online hospitals, medical information">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/temp.css">

</head>
<body>
	<!--1st Container Start here -->
<?php 
	include_once("index-header.php");
?>
	<div class="container">
	<!--Navbar Start here-->
		<div class="navbar navbar-inverse">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<span >
					<img href="http://www.boiddo.com" class="logo pull-left" src="images/boiddo-nav.png">
				</span>

			</div> 

			<nav class="collapse navbar-collapse" id="navbar-collapse-about" role="navigation">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li class="active"><a href="myrequest.php">Check Request</a></li>
					<li><a href="about.php#contact">Contact us</a></li>
				</ul> 

			</nav>
		</div>
		<!--Navbar End here-->
</div>

<div class="container" style="margin-top:-22px;">

	<!--First Content Start here-->
	<div class="row">
		<!--Left Column Start here-->
		<br/>
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="panel panel-default bgc">
				<div class="panel-title">
					<h2 class="center"><strong>Check Request</strong></h2>
				</div>
				<div class="well"> 

						<div class="form-group">
							<div class="list-inline">
								<label for="searchid" class="col-sm-4">Request ID</label>
								<div class="col-sm-8">

									<input id="searchid" class="form-control" placeholder="Request ID.. e.g 123456">

								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="list-inline">
								<label for="searchname" class="col-sm-4">Name</label>
								<div class="col-sm-8">

									<input id="searchname" class="form-control" placeholder="Patient Name/ Doctor Name..">

								</div>
							</div>
						</div>
						<div class="form-group">
							<button onclick="checkNow()" class="btn btn-info pull-right" style="margin-right:6px">Check Now</button>
						</div>
			
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-8">
			<div class="panel panel-default bgc">
				<div class="panel-title">
					<h2 class="center">Request Details</h2>
				</div>
				<div class="well">
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="col-xs-4">Patient Name : </div>
							<div class="col-xs-8"><span id="patient-name"></span></div>
							<div class="col-xs-4">Gender : </div>
							<div class="col-xs-8"><span id="patient-sex"></span></div>
							<div class="col-xs-4">Age : </div>
							<div class="col-xs-8"><span id="patient-age"></span></div>
							<div class="col-xs-4">Blood Group : </div>
							<div class="col-xs-8"><span id="blood-group"></span></div>
							<div class="col-xs-4">Weight : </div>
							<div class="col-xs-8"><span id="weight"></span></div>
							<div class="col-xs-4">Height : </div>
							<div class="col-xs-8"><span id="height"></span></div>
							<div class="col-xs-4">Occupation : </div>
							<div class="col-xs-8"><span id="occupation"></span></div>
							<div class="col-xs-4">Suffer from : </div>
							<div class="col-xs-8"><span id="suffer"></span></div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="col-xs-5">Requestor Name : </div>
							<div class="col-xs-7"><span id="requestor"></span></div>
							<div class="col-xs-5">Gender : </div>
							<div class="col-xs-7"><span id="rq-sex"></span></div>
							<div class="col-xs-5">Age : </div>
							<div class="col-xs-7"><span id="rq-age"></span></div>
							<div class="col-xs-5">House Name : </div>
							<div class="col-xs-7"><span id="rq-housename"></span></div>
							<div class="col-xs-5">House No : </div>
							<div class="col-xs-7"><span id="rq-houseno"></span></div>
							<div class="col-xs-5">Locality/Town : </div>
							<div class="col-xs-7"><span id="rq-town"></span></div>
							<div class="col-xs-5">Police Station</div>
							<div class="col-xs-7"><span id="rq-ploicestation"></span></div>
							<div class="col-xs-5">City : </div>
							<div class="col-xs-7"><span id="rq-city"></span></div>
							<div class="col-xs-5">Country : </div>
							<div class="col-xs-7"><span id="rq-country"></span></div>
							<div class="col-xs-5">Phone : </div>
							<div class="col-xs-7"><span id="rq-phone"></span></div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	function checkNow(){
		var category = "checkRequest";
		var req_id = $("#searchid").val();
		var req_name = $("#searchname").val();

		$.post("modals.php",{
			category: category,
			req_id: req_id,
			req_name: req_name
		},function(data){
			var pdata = $.parseJSON(data);
			alert(pdata.rq_houseno);
			if(data != "not permission to enter!!"){
				$("#patient-name").html(pdata.patient);
				$("#patient-sex").html(pdata.sex);
				$("#patient-age").html(pdata.age);
				$("#blood-group").html(pdata.blood_group);
				$("#weight").html(pdata.weight);
				$("#height").html(pdata.height);
				$("#suffer").html(pdata.suffer);
				$("#occupation").html(pdata.occupation);

				$("#requestor").html(pdata.requestor);
				$("#rq-age").html(pdata.rq_age);
				$("#rq-sex").html(pdata.rq_sex);
				$("#rq-housename").html(pdata.rq_housename);
				$("#rq-houseno").html(pdata.rq_houseno);
				$("#rq-town").html(pdata.rq_town);
				$("#rq-ploicestation").html(pdata.rq_policestation);
				$("#rq-city").html(pdata.rq_city);
				$("#rq-country").html(pdata.rq_country);
				$("#rq-phone").html(pdata.rq_phone);
			}
		});
	}
</script>
</body>
</html>