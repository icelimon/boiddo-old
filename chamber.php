<?php
include_once("check-login-status.php");
if($user_ok != true || $log_category != 'doctor'){
	header("Location: http://boiddo.com");
	exit();
}
if(isset($_POST['type'])){
	$types = $_POST['type'];
}else{
	$types = "wrong entry..";
	exit();
}
if($types == "addChamber"){
	$name = $_POST['name'];
	$houseno = $_POST['houseno'];
	$housename = $_POST['housename'];
	$streetno = $_POST['streetno'];
	$streetname = $_POST['streetname'];
	$town = $_POST['town'];
	$city = $_POST['city'];
	$postcode = $_POST['postcode'];
	$country = $_POST['country'];
	$phone = $_POST['phone'];
	$circle =$_POST['circle'];

	$name = ucwords($name);
	$housename = ucwords($housename);
	$streetname = ucwords($streetname);
	$town = ucwords($town);
	$city = ucwords($city);

	$personal_query = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE doctor_id='$log_id' AND category='doctor' LIMIT 1");
	while($per_row=mysqli_fetch_assoc($personal_query)){
		$speciality=$per_row['speciality'];
	}
	if(!empty($name) && !empty($streetname) && !empty($town) && !empty($postcode) && !empty($city) && !empty($country) && !empty($phone)){
		if($circle == "weekly"){
			$chamber_query = mysqli_query($db_conx,"INSERT INTO doctors_chambers (doctor_id,speciality,isweek_circle,chamber_name,house_no,house_name,street_no,street_name,town,city,postcode,country,contact)
				VALUES('$log_id','$speciality','1','$name','$houseno','$housename','$streetno','$streetname','$town','$city','$postcode','$country','$phone')");
		}else if($circle == "monthly"){
			$chamber_query = mysqli_query($db_conx,"INSERT INTO doctors_chambers (doctor_id,speciality,ismonth_circle,chamber_name,house_no,house_name,street_no,street_name,town,city,postcode,country,contact)
			VALUES('$log_id','$speciality','1','$name','$houseno','$housename','$streetno','$streetname','$town','$city','$postcode','$country','$phone')");
		}else{
			$chamber_query = mysqli_query($db_conx,"INSERT INTO doctors_chambers (doctor_id,speciality,chamber_name,house_no,house_name,street_no,street_name,town,city,postcode,country,contact)
			VALUES('$log_id','$speciality','$name','$houseno','$housename','$streetno','$streetname','$town','$city','$postcode','$country','$phone')");
		}
		
		if($chamber_query){
			$select_chamber = mysqli_query($db_conx,"SELECT chamber_id FROM doctors_chambers WHERE doctor_id='$log_id' ORDER BY chamber_id DESC LIMIT 1");
			while($rows = mysqli_fetch_assoc($select_chamber)){
				$ch_id = $rows['chamber_id'];
			}
			$region_query = mysqli_query($db_conx,"INSERT INTO regions (id,category,speciality,name,apt_no,apt_name,street_no,street_name,town,city,postcode,country,contact)
				VALUES('$ch_id','chamber','$speciality','$name','$houseno','$housename','$streetno','$streetname','$town','$city','$postcode','$country','$phone')");
			echo "SuccessFuLly AddeD...!!";
			exit();
		}else{
			echo "FailEd tO INSerT..";
			exit();
		}
	}else{
		echo "ReQuired aLL field is noT Field";
		exit();
	}
}
?>