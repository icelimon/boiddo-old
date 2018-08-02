<?php
	include_once("check-login-status.php");
	if($user_ok!=true || $log_username==""){
		header("location: logout.php");
		exit();
	}
?>
<?php
	if($log_category == 'doctor'){ 
		$sql="SELECT * FROM doctors_options WHERE doctor_username='$log_username' AND doctor_id='$log_id' LIMIT 1";
	}else if($log_category == 'hospital'){
		$sql="SELECT * FROM hospitals_options WHERE hospital_username='$log_username' AND hospital_id='$log_id' LIMIT 1";
	}
	$query = mysqli_query($db_conx, $sql);
	$row = mysqli_fetch_assoc($query);
	$image = $row['image'];

	header("Content-type: image/jpeg");
	echo $image;
?>