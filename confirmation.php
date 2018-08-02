<?php
include_once('check-login-status.php');
if($user_ok==true &&  $log_username!="" && $log_category!=""){
	header("location: edit-profile-dr.php");
}
$com_key = $_GET['user-conf'];
$com_cat = $_GET['com-cat'];

if($com_cat=='doctor'){
	$query = mysqli_query($db_conx,"SELECT doctor_id FROM doctors WHERE com_code='$com_key' LIMIT 1");
	while($row=mysqli_fetch_assoc($query)){
		$doc_id = $row['doctor_id'];
	}
	$sql = "UPDATE doctors SET com_code=NULL, activated='1' WHERE com_code='$com_key'";
	$chamber_query = mysqli_query($db_conx,"INSERT INTO doctors_chambers(doctor_id,main_hospital)VALUES('$doc_id','1')");
}else if($com_cat=='hospital'){
	$sql = "UPDATE hospitals SET com_code=NULL, activated='1' WHERE com_code='$com_key'";
}else if($com_cat=='diagnostic'){
	$sql = "UPDATE diagnostics SET com_code=NULL, activated='1' WHERE com_code='$com_key'";
}else if($com_cat=='medicine'){
	$sql = "UPDATE companies SET com_code=NULL, activated='1' WHERE com_code='$com_key'";
}else{
	$sql = "UPDATE ambulances SET com_code=NULL, activated='1' WHERE com_code='$com_key'";
}

//$pathdir = "/bootstrap/images/".$log_username;
//mkdir($pathdir, 0700);

$result = mysqli_query($db_conx,$sql) or die(mysqli_error());

setcookie('regconfname', "", strtotime('-5 days'));
setcookie('regconfemail', "", strtotime('-5 days'));
setcookie('regconfcat', "", strtotime('-5 days'));
setcookie('comcode', "", strtotime('-5 days'));

if($result)
{

	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<link rel="shortcut icon" href="images/boiddo-band.png" />
		<title>Boiddo | Registration Conformation</title>
		<meta charset="utf-8">
		<meta name="description" content="Online doctor and hospitals whats you need while trubling. Find your nearest hospital, get information about doctors and hospitals. Get serial of them... and many more option what you need.">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styles.css">
	</head>

	<body>
		<!--1st Container Start here -->
		<div class="container no-padding">

			<!--Page Header End-->
			<div id="top" class="page-header no-margin">

				<span><h1 style="margin-left: 12px"><strong>MEDIC AID</strong> <small>health service station</small></h1></span>
			</div>
			<!--Page Header End here-->

		</div>
		<!--1st Container End here -->

		<!--2nd Container Start here -->
		<div class="container">
			<div class="panel panel-default bgc" style="height: 314px">
				<div class="panel-title">
					<h2 class="center">Activation Successful</h2>
				</div>
				<div class="well">
					<h4 class="center">
						<div>Your account is now active. You may now <a href="login.php">Log in</a></div>

						<span><strong></strong></span> and activate your account by using activation link</h4>
						<p>If you dont receive activation email, please use the resend email button of this page. After 6 hours your activation link does not work, so i must recomend you please active your account as soon as possible. If you face further problem please contact us. Thanks you for comming with us and hope you will being with us.</p>

					</div>

				</div>
			</div>
			<!--2nd Container End here -->

			<!--Start if the Footer-->
			<?php include_once('boiddo-footer.php');?>
			<!--End if the Footer-->

			<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script-->
			<script src="js/jquery.js"></script>
			<script src="js/bootstrap.min.js"></script>

		</body>
		</html>
		<?php
	}
	else
	{
		echo "Some error occur.";
	}
	?>