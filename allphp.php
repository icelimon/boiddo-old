<?php
if($_POST['category'] == "Take patient"){

	$doctor_id = $_POST['doctor_id'];
	$chamber_id = $_POST['chamber_id'];
	$requestor = $_POST['requestor'];
	$requestor = ucwords($requestor);
	$relation = $_POST['relation'];
	$rq_age = $_POST['rqage'];
	$rq_sex = $_POST['rqgender'];
	$rq_housename = $_POST['house_name'];
	$rq_houseno = $_POST['house_no'];
	$rq_town = $_POST['town'];
	$rq_policestation = $_POST['policestation'];
	$rq_city = $_POST['city'];
	$rq_city = ucwords($rq_city);
	$rq_country = $_POST['country'];
	$rq_country = ucwords($rq_country);
	$rq_phone = $_POST['phone'];
	$rq_email = $_POST['email'];
	$rq_date = $_POST['exp_date'];
	$rq_month = $_POST['exp_month'];
	$rq_year = $_POST['exp_year'];
	$rq_hour = $_POST['exp_hour'];
	$rq_minute = $_POST['exp_minute'];
	$rq_ampm = $_POST['rqampm'];
	if($rq_ampm == "PM"){
		$rq_hour = $rq_hour+12;
		if($rq_hour == 24){
			$rq_hour = 12;
		}
	}
	$times = $rq_hour.":".$rq_minute.":00";
	$date = $rq_year."-".$rq_month."-".$rq_date." ".$times;
	$patient = $_POST['patient'];
	$patient = ucwords($patient);
	$age = $_POST['age'];
	$sex = $_POST['sex'];
	$blood_group = $_POST['blood_group'];
	$weight = $_POST['weight'];
	$height = $_POST['height'];
	$occupation = $_POST['occupation'];
	$suffer_day = $_POST['suffer_day'];
	$suffer_month = $_POST['suffer_month'];
	$suffer_year = $_POST['suffer_year'];
	$suffer = $suffer_year."-".$suffer_month."-".$suffer_day;

	if(is_numeric($doctor_id) && is_numeric($chamber_id)){
		$tz_query = mysqli_query($db_conx,"SELECT tz FROM doctors WHERE doctor_id='$doctor_id' LIMIT 1");
		while($tz_row = mysqli_fetch_assoc($tz_query)){
			$tz = $tz_row['tz'];
			date_default_timezone_set($tz);
		}
		$request_query = mysqli_query($db_conx,"INSERT INTO doctors_visit(doctor_id,chamber_id,type,requestor,rq_relation,rq_age,rq_sex,rq_phone,rq_email,rq_housename,rq_houseno,rq_town,rq_city,rq_policestation,rq_country,patient,sex,age,occupation,suffering,blood_group,weight,height,date,expt_date) 
			VALUES('$doctor_id','$chamber_id','chamber','$requestor','$relation','$rq_age','$rq_sex','$rq_phone','$rq_email','$rq_housename','$rq_houseno','$rq_town','$rq_city','$rq_policestation','$rq_country','$patient','$sex','$age','$occupation','$suffer','$blood_group','$weight','$height',NOW(),'$date')");
		
		$request_update = mysqli_query($db_conx,"SELECT * FROM doctors_visit WHERE doctor_id='$doctor_id' AND chamber_id='$chamber_id' ORDER BY request_id DESC LIMIT 1");

	}else if($doctor_id == "hospital" && is_numeric($chamber_id)){
		$request_query = mysqli_query($db_conx,"INSERT INTO doctors_visit(chamber_id,type,requestor,rq_relation,rq_age,rq_sex,rq_phone,rq_email,rq_housename,rq_houseno,rq_town,rq_city,rq_policestation,rq_country,patient,sex,age,occupation,suffering,blood_group,weight,height,date,expt_date) 
			VALUES('$chamber_id','hospital','$requestor','$relation','$rq_age','$rq_sex','$rq_phone','$rq_email','$rq_housename','$rq_houseno','$rq_town','$rq_city','$rq_policestation','$rq_country','$patient','$sex','$age','$occupation','$suffer','$blood_group','$weight','$height',NOW(),'$date')");
		
		$request_update = mysqli_query($db_conx,"SELECT * FROM doctors_visit WHERE chamber_id='$chamber_id' ORDER BY request_id DESC LIMIT 1");
	}else if(is_numeric($doctor_id) && $chamber_id == "Dochos"){
		$tz_query = mysqli_query($db_conx,"SELECT tz FROM doctors WHERE doctor_id='$doctor_id' LIMIT 1");
		while($tz_row = mysqli_fetch_assoc($tz_query)){
			$tz = $tz_row['tz'];
			date_default_timezone_set($tz);
		}
		$request_query = mysqli_query($db_conx,"INSERT INTO doctors_visit(doctor_id,type,requestor,rq_relation,rq_age,rq_sex,rq_phone,rq_email,rq_housename,rq_houseno,rq_town,rq_city,rq_policestation,rq_country,patient,sex,age,occupation,suffering,blood_group,weight,height,date,expt_date) 
			VALUES('$doctor_id','dochos','$requestor','$relation','$rq_age','$rq_sex','$rq_phone','$rq_email','$rq_housename','$rq_houseno','$rq_town','$rq_city','$rq_policestation','$rq_country','$patient','$sex','$age','$occupation','$suffer','$blood_group','$weight','$height',NOW(),'$date')");
		
		$request_update = mysqli_query($db_conx,"SELECT * FROM doctors_visit WHERE doctor_id='$doctor_id' ORDER BY request_id DESC LIMIT 1");
	}
	while($newrow= mysqli_fetch_assoc($request_update)){
		$request_id = $newrow['request_id'];
		$request_profile = $request_id + 10000;
		$updated_query = mysqli_query($db_conx,"UPDATE doctors_visit SET request_profile='$request_profile' WHERE request_id='$request_id' LIMIT 1");
		if($updated_query){
			echo $request_profile;
			exit;
		}else{
			echo "failed to add.";
			exit;
		}
	}
}
?>