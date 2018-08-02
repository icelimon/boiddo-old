<?php
include_once("config.inc.php");
if(!isset($_GET['req_number'])){
	echo "<h4>opps....wrong entry.</h4>";
	exit;
}
$doctor_id = $_GET['doc_number'];
$req_number = $_GET['req_number'];
$chamber_id = $_GET['cham_number'];
$newrequest = 0;
if(isset($doctor_id) || isset($chamber_id)){
	$newrequest = 1;
}
if(isset($name)){
	$newrequest = 0;
}
if(is_numeric($doctor_id) && is_numeric($chamber_id)){
	$check_query = mysqli_query($db_conx,"SELECT * FROM doctors_visit WHERE doctor_id='$doctor_id' AND request_profile='$req_number' LIMIT 1");
}else if($doctor_id == "hospital" && is_numeric($chamber_id)){
	$check_query = mysqli_query($db_conx,"SELECT * FROM doctors_visit WHERE chamber_id='$chamber_id' AND request_profile='$req_number' LIMIT 1");
}else if(is_numeric($doctor_id) && $chamber_id == "Dochos"){
	$check_query = mysqli_query($db_conx,"SELECT * FROM doctors_visit WHERE doctor_id='$doctor_id' AND request_profile='$req_number' LIMIT 1");
}
$num_rows = mysqli_num_rows($check_query);
if($num_rows<1){
	echo "Wrong way.!!";
	exit;
}

while($newrow = mysqli_fetch_assoc($check_query)){
	$patient = $newrow['patient'];
	$age = $newrow['age'];
	$sex = $newrow['sex'];
	$occupation = $newrow['occupation'];
	$suffering = $newrow['suffering'];
	$blood_group = $newrow['blood_group'];
	$weight = $newrow['weight'];
	$height = $newrow['height'];

	$requestor = $newrow['requestor'];
	$rq_sex = $newrow['rq_sex'];
	$rq_age = $newrow['rq_age'];
	$rq_relation = $newrow['rq_relation'];
	$rq_housename = $newrow['rq_housename'];
	$rq_houseno = $newrow['rq_houseno'];
	$rq_phone = $newrow['rq_phone'];
	$rq_email = $newrow['rq_email'];
	$rq_town = $newrow['rq_town'];
	$rq_policestation = $newrow['rq_policestation'];
	$rq_city = $newrow['rq_city'];
	$rq_country = $newrow['rq_country'];

	$suffer_time = $newrow['suffering'];
	$strone_time = strtotime($suffer_time);
	$suffer_date = date("d M Y",$strone_time);

	$making_time = $newrow['date'];
	$str_time = strtotime($making_time);
	$make_date = date("d M Y",$str_time);
	$make_time = date("h:i A",$str_time);

	$expted_times = $newrow['expt_date'];
	$strexp_time = strtotime($expted_times);
	$expted_date = date("d M Y",$strexp_time);
	$expted_time = date("h:i A",$strexp_time);

	$seen = $newrow['seen'];
	$approve = $newrow['approve'];
	if($seen == 1){
		$status = "Seen";
	}else{
		$status = "Unseen";
	}
	if($approve == 1){
		$status = "Approved";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="images/boiddo-band.png" />
	<title>Boiddo | Request Conformation</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<!--1st Container Start here -->
	<div class="container no-padding">

		<!--Page Header End-->
		<div id="top" class="page-header no-margin">

			<span><h1 style="margin-left: 12px"><strong>BOIDDO</strong> <small>Online Medical Information Sysytem</small></h1></span>
		</div>
		<!--Page Header End here-->

	</div>
	<!--1st Container End here -->

	<!--2nd Container Start here -->
	<div class="container">
	<?php if($newrequest){?>
		<div class="panel panel-default bgc">
			<div class="panel-title">
				<h2 class="center">Request Successful</h2>
			</div>
			<div class="well">
				<h4>Your serial request has been sent to your doctor. <span style="color: #655467"><strong>Your Serial Request ID: <?php echo $req_number;?></strong></span></h4>
				<p>Write down this request ID for further checking request status</p>
				<p>Probable status are Unseen, Seen, Approved and Rejected. Patients have to wait for their request approval.</p><br><p>Thanks you for comming with us and hope you will enjoy our service.</p>

			</div>

		</div>
<?php } ?>
		<div class="panel panel-default bgc">
			<div class="panel-title">
				<h2 class="center">Request Details</h2>
			</div>
			<div class="well">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="col-xs-4">Patient Name : </div>
						<div class="col-xs-8"><?php echo $patient;?></div>
						<div class="col-xs-4">Gender : </div>
						<div class="col-xs-8"><?php echo $sex;?></div>
						<div class="col-xs-4">Age : </div>
						<div class="col-xs-8"><?php echo $age." Years";?></div>
						<div class="col-xs-4">Blood Group : </div>
						<div class="col-xs-8"><?php if(empty($blood_group)){ echo "N/A";}else{echo $blood_group;}?></div>
						<div class="col-xs-4">Weight : </div>
						<div class="col-xs-8"><?php if(empty($weight)){ echo "N/A";}else{echo $weight." KG";}?></div>
						<div class="col-xs-4">Height : </div>
						<div class="col-xs-8"><?php if(empty($height)){ echo "N/A";}else{echo $height." cm";}?></div>
						<div class="col-xs-4">Suffer from : </div>
						<div class="col-xs-8"><?php echo $suffer_date;?></div>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="col-xs-4">Requestor Name : </div>
						<div class="col-xs-8"><?php echo $requestor;?></div>
						<div class="col-xs-4">Gender : </div>
						<div class="col-xs-8"><?php echo $rq_sex;?></div>
						<div class="col-xs-4">Age : </div>
						<div class="col-xs-8"><?php echo $rq_age." Years";?></div>
						<div class="col-xs-4">House Name : </div>
						<div class="col-xs-8"><?php if(empty($rq_housename)){ echo "N/A";}else{echo $rq_housename;}?></div>
						<div class="col-xs-4">House No : </div>
						<div class="col-xs-8"><?php if(empty($rq_houseno)){ echo "N/A";}else{echo $rq_houseno;}?></div>
						<div class="col-xs-4">Locality/Town : </div>
						<div class="col-xs-8"><?php echo $rq_town;?></div>
						<div class="col-xs-4">City : </div>
						<div class="col-xs-8"><?php echo $rq_city;?></div>
						<div class="col-xs-4">Country : </div>
						<div class="col-xs-8"><?php echo $rq_country;?></div>
						<div class="col-xs-4">Phone : </div>
						<div class="col-xs-8"><?php echo $rq_phone;?></div>
					</div>
				</div>
			</div>

		</div>
		<div class="panel panel-default bgc">
			<div class="panel-title">
				<center><h2>Request Status</h2></center>
			</div>
			<div class="well">
				<div class="row">
					<div class="col-xs-12 col-xs-4">
						<center><h4>Request Create Time</h4>
						<?php echo $make_time."<br>".$make_date;?></center>
					</div>
					<div class="col-xs-12 col-xs-4">
						<center><h4>Expected Time</h4>
						<?php echo $expted_time."<br>".$expted_date;?></center>
					</div>
					<div class="col-xs-12 col-xs-4">
						<center><h4>Status</h4>
						<?php echo $status;?></center>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once('boiddo-footer.php');?>

</body>
</html>
