<?php
include_once("check-login-status.php");
if($user_ok != true || $log_category !='doctor'){
	header("Location: http://boiddo.com");
}
$tz_query = mysqli_query($db_conx,"SELECT tz FROM doctors WHERE doctor_id='$log_id'LIMIT 1");
while($tz_row = mysqli_fetch_assoc($tz_query)){
	$tz = $tz_row['tz'];
}
date_default_timezone_set($tz);
function dateformatreturn($date){
	$next_week = strtotime('this week');
	$newdate = date("Y-m-d", strtotime($date, $next_week));
	return $newdate;
}

if($_POST['visit'] == "savedata"){
	$chamber_id = $_POST['chamber_id'];
	$start_hr = $_POST['start_hr'];
	$start_min = $_POST['start_min'];
	$start_ap = $_POST['start_ap'];
	$end_hr = $_POST['end_hr'];
	$end_min = $_POST['end_min'];
	$end_ap = $_POST['end_ap'];
	$day = $_POST['day'];
	$date = $_POST['date'];
	if($start_ap == "PM" && $start_hr != 12){
		$start_hr = $start_hr+12;
	}
	if($end_ap == "PM" && $end_hr != 12){
		$end_hr = $end_hr+12;
	}
	if($end_ap == "AM" && $end_hr == 12){
		$end_hr = 0;
	}
	if($start_ap == "AM" && $start_hr == 12){
		$start_hr = 0;
	}
	$date = dateformatreturn($day);
	$start_date = $date." ".$start_hr.":".$start_min.":00";
	$end_date = $date." ".$end_hr.":".$end_min.":00";

	if($day == "Saturday"){
		$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET sat_start='$start_date',
			sat_end='$end_date' WHERE chamber_id='$chamber_id' LIMIT 1");
		if($chamber_query){
			echo "operation successfull..!..";
			exit();
		}else{
			echo "database error.!..";
			exit();
		}
	}else if($day == "Sunday"){
		$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET sun_start='$start_date',
			sun_end='$end_date' WHERE chamber_id='$chamber_id' LIMIT 1");
		if($chamber_query){
			echo "operation successfull..!..";
			exit();
		}else{
			echo "database error.!..";
			exit();
		}
	}else if($day == "Monday"){
		$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET mon_start='$start_date',
			mon_end='$end_date' WHERE chamber_id='$chamber_id' LIMIT 1");
		if($chamber_query){
			echo "operation successfull..!..";
			exit();
		}else{
			echo "database error.!..";
			exit();
		}
	}else if($day == "Tuesday"){
		$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET tue_start='$start_date',
			tue_end='$end_date' WHERE chamber_id='$chamber_id' LIMIT 1");
		if($chamber_query){
			echo "operation successfull..!..";
			exit();
		}else{
			echo "database error.!..";
			exit();
		}
	}else if($day == "Wednesday"){
		$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET wed_start='$start_date',
			wed_end='$end_date' WHERE chamber_id='$chamber_id' LIMIT 1");
		if($chamber_query){
			echo "operation successfull..!..";
			exit();
		}else{
			echo "database error.!..";
			exit();
		}
	}else if($day == "Thursday"){
		$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET thu_start='$start_date',
			thu_end='$end_date' WHERE chamber_id='$chamber_id' LIMIT 1");
		if($chamber_query){
			echo "operation successfull..!..";
			exit();
		}else{
			echo "database error.!..";
			exit();
		}
	}else if($day == "Friday"){
		$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET fri_start='$start_date',
			fri_end='$end_date' WHERE chamber_id='$chamber_id' LIMIT 1");
		if($chamber_query){
			echo "operation successfull..!..";
			exit();
		}else{
			echo "database error.!..";
			exit();
		}
	}else{
		echo "operation failed..!.";
		exit();
	}
}else if($_POST['visit'] == "mainMap"){
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$ch_id = $_POST['chamber_id'];
	$latlng_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET lat='$lat',lng='$lng' WHERE chamber_id='$ch_id' LIMIT 1");
	if($latlng_query){
		echo "Successfully added...";
		exit;
	}else{
		echo "Failed to add...";
		exit;
	}
}
?>