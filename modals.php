<?php
	include_once('config.inc.php');
?>
<?php 

if($_POST['category'] == 'doctors'){
	if(isset($_POST["doctors_id"])){
		$doctors_id = $_POST['doctors_id'];

		$sql = "SELECT * FROM doctors_personal WHERE doctor_id='$doctors_id' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$array = array();
		while($row = mysqli_fetch_assoc($query)){
			
			$fullname = $row['full_name'];
			$speciality = $row['speciality'];
			$olddegree = $row['degrees'];
			$oldemail = $row['email'];
			$aptno = $row['apt_no'];
			$aptname = $row['apt_name'];
			$streetno = $row['street_no'];
			$streetname = $row['street_name'];
			$town = $row['town'];
			$city = $row['city'];
			$postcode = $row['postcode'];
			$phone = $row['phone'];
			
		}

	$sql = "SELECT * FROM doctors WHERE doctor_id='$doctors_id' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$array = array();
		while($row = mysqli_fetch_assoc($query)){
			$birth_day = $row['doctor_birthday'];
			$gender = $row['doctor_sex'];
			$doc_post = $row['doctor_postcode'];
			$doc_country = $row['doctor_country'];
		}
	$birth_day = strtotime($birth_day);
	$birth_year = date("Y",$birth_day);
	$birth_month = date("M",$birth_day);
	
	$age = date("Y") - $birth_year;
	$mon = date("M") - $birth_month;
	if($mon >= 6){
		$age = $age+1;
	}

	$sqls = mysqli_query($db_conx,"SELECT image, img_name FROM doctors_options WHERE doctor_id='$doctors_id' ORDER BY doctor_id DESC 
			LIMIT 1") or die('Invalid query: ' . mysqli_error());
	                                //$query = mysqli_query($db_conx, $sql);

	while($rows=mysqli_fetch_assoc($sqls)){
		$image=$rows['image'];
		$image_name=$rows['img_name'];
		$profile_pics = '<img class="img-responsive" src="user_doc/'.$rows['img_name'].'" alt="'.$rows['img_name'].'"height="160px" width="160px">';

	}

	$sql = "SELECT * FROM doctors_professional WHERE doctor_id='$doctors_id' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$array = array();
		while($row = mysqli_fetch_assoc($query)){
			$hos_name = $row['hospital_name'];
			$hos_room_no = $row['room_no'];
			$hos_st_no = $row['street_no'];
			$hos_st_name = $row['street_name'];
			$hos_town = $row['town'];
			$hos_city = $row['city'];
			$hos_post = $row['postcode'];
			$hos_ser = $row['hospital_services'];
			$hos_cap = $row['hospital_capacity'];
			$hos_phone = $row['phone'];
			$hos_email = $row['email'];
			$hos_web = $row['web'];
		}
		if(!empty($aptno)){
			$aptno = $aptno.", ";
		}
		if(!empty($streetno)){
			$streetno = $streetno." - ";
		}
		if(!empty($town)){
			$town = $town." - ";
		}
		if(empty($hos_email)){
			$hos_email = "Unavailable";
		}
		if(empty($hos_web)){
			$hos_web = "Unavailable";
		}
		if(!empty($hos_st_no)){
			$hos_st_no = $hos_st_no." - ";
		}
	$array = array(
		'name' => $fullname, 'speciality' => $speciality, 'degree' => $olddegree, 
		'email' => $oldemail,'aptno' => $aptno, 'aptname' => $aptname,'stno' => $streetno, 
		'stname' => $streetname, 'town' => $town, 'city' => $city,'postcode' => $postcode,
		'phone' => $phone, 'image' => $image, 'image_name' => $image_name, 'pro_pic' => $profile_pics,
		'age' => $age." years old.", 'gender' => $gender, 'doc_post' => $doc_post,
		'doc_country' => $doc_country, 'hos_name' => $hos_name, 'hos_room_no' => "My room no : ".$hos_room_no,
		'hos_st_no' => $hos_st_no, 'hos_st_name' => $hos_st_name, 'hos_town' => $hos_town,
		'hos_city' => $hos_city, 'hos_post' => $hos_post, 'hos_ser' =>$hos_ser, 'hos_cap' => $hos_cap,
		'hos_phone' => "Phone : ".$hos_phone, 'hos_email' => "Email : ".$hos_email, 'hos_web' => "Web : ".$hos_web
		);

	echo json_encode($array);
	exit();

	if(!empty($postcode)){
		$city = $city."-".$postcode;
	}

	$address = $aptno."-".$aptname."/ ".$streetno."-".$streetname."/ ".$town;

	}
}else if($_POST['category'] == 'hospitals'){
		if(isset($_POST["hos_id"])){
		$hos_id = $_POST['hos_id'];
		
	$sql = "SELECT * FROM hospitals WHERE hospital_id='$hos_id' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$array = array();
		while($row = mysqli_fetch_assoc($query)){
			$estd_year = $row['hospital_esyear'];
			$estd_month = $row['hospital_esmonth'];
			$hos_post = $row['hospital_postcode'];
			$hos_country = $row['hospital_country'];
		}
	$age = date("Y") - $estd_year;
	$mon = date("M") - $estd_month;
	if($mon >= 6){
		$age = $age+1;
	}

	$sqls = mysqli_query($db_conx,"SELECT image, img_name FROM hospitals_options WHERE hospital_id='$hos_id' ORDER BY hospital_id DESC 
			LIMIT 1") or die('Invalid query: ' . mysqli_error());
	                                //$query = mysqli_query($db_conx, $sql);

	while($rows=mysqli_fetch_assoc($sqls)){
		$image=$rows['image'];
		$image_name=$rows['img_name'];
		$profile_pics = '<img class="img-responsive" src="user_hos/'.$rows['img_name'].'" alt="'.$rows['img_name'].'"height="160px" width="160px">';

	}

	$sql = "SELECT * FROM hospitals_info WHERE hospital_id='$hos_id' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$array = array();
		while($row = mysqli_fetch_assoc($query)){
			$hos_name = $row['fullname'];
			$hos_st_no = $row['street_no'];
			$hos_st_name = $row['street_name'];
			$hos_town = $row['town'];
			$hos_city = $row['city'];
			$hos_post = $row['postcode'];
			$hos_ser = $row['services'];
			$hos_cap = $row['capacity'];
			$hos_phone = $row['phone'];
			$hos_email = $row['email'];
			$hos_web = $row['web'];
		}

		if(!empty($streetno)){
			$streetno = $streetno." - ";
		}
		if(!empty($town)){
			$town = $town." - ";
		}
		if(empty($hos_email)){
			$hos_email = "not set yet";
		}
		if(empty($hos_web)){
			$hos_web = "not set yet";
		}
		if(!empty($hos_st_no)){
			$hos_st_no = $hos_st_no."-";
		}
	$array = array(
		'hos_name' => $hos_name,
		'image' => $image, 'image_name' => $image_name, 'pro_pic' => $profile_pics,
		'age' => $age,'hos_country' => $hos_country,
		'hos_st_no' => $hos_st_no, 'hos_st_name' => $hos_st_name, 'hos_town' => $hos_town,
		'hos_city' => $hos_city, 'hos_post' => $hos_post, 'hos_ser' =>$hos_ser, 'hos_cap' => $hos_cap,
		'hos_phone' => "Phone : ".$hos_phone, 'hos_email' => "Email : ".$hos_email, 'hos_web' => "Web : ".$hos_web
		);

	echo json_encode($array);
	exit();

	if(!empty($postcode)){
		$city = $city."-".$postcode;
	}

	$address = $aptno."-".$aptname."/ ".$streetno."-".$streetname."/ ".$town;

	}
}else if($_POST['category'] == 'approvedate'){
	if(isset($_POST["request_id"]) && isset($_POST['chamber_id'])){
		$request_id = $_POST['request_id'];
		$chamber_id = $_POST['chamber_id'];

		$sql = "SELECT * FROM doctors_visit WHERE request_id='$request_id' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$array = array();

		while($row = mysqli_fetch_assoc($query)){
			$patient = $row['patient'];
			$sex = $row['sex'];
			$age = $row['age'];
			$blood_group = $row['blood_group'];
			$occupation = $row['occupation'];
			$weight = $row['weight'];
			$height = $row['height'];
			$expt_date = $row['expt_date'];
			$expt_date = strtotime($expt_date);
			$expt_date = date("d M",$expt_date);
			$approve_date = $row['approve_date'];
			$rq_name = $row['requestor'];
			$rq_email = $row['rq_email'];
			$rq_phone = $row['rq_phone'];
		}
		$chamber_query = mysqli_query($db_conx,"SELECT * FROM doctors_chambers WHERE chamber_id='$chamber_id' LIMIT 1");
		while($chamber_row = mysqli_fetch_assoc($chamber_query)){
			$chamber_name = $chamber_row['chamber_name'];
			$chamber_city = $chamber_row['city'];
			$chamber_country = $chamber_row['country'];
		}
		$array = array(
			'patient' => $patient,'age' => $age,'sex' => $sex,
			'chamber_name' => $chamber_name, 'chamber_city' => $chamber_city, 'chamber_country' => $chamber_country,
			'blood_group' => $blood_group, 'occupation' => $occupation, 'weight' => $weight,
			'height' => $height, 'expt_date' => $expt_date, 'approve_date' =>$approve_date, 
			'rq_name' => $rq_name, 'rq_phone' => $rq_phone, 'rq_email' => $rq_email);

		echo json_encode($array);
		exit();

	}
}else if($_POST['category'] == 'viewapprovedate'){
	if(isset($_POST["request_id"]) && isset($_POST['chamber_id'])){
		$request_id = $_POST['request_id'];
		$chamber_id = $_POST['chamber_id'];

		$sql = "SELECT * FROM doctors_visit WHERE request_id='$request_id' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$array = array();

		while($row = mysqli_fetch_assoc($query)){
			$patient = $row['patient'];
			$sex = $row['sex'];
			$age = $row['age'];
			$blood_group = $row['blood_group'];
			$occupation = $row['occupation'];
			$weight = $row['weight'];
			$height = $row['height'];
			$expt_date = $row['expt_date'];
			$expt_date = strtotime($expt_date);
			$expt_date = date("d M",$expt_date);
			$approve_date = $row['approve_date'];
			$str_date = strtotime($approve_date);
			$approve_date = date("d M",$str_date);
			$hr = date("h",$str_date);
			$min = date("i",$str_date);
			$amp = date("A",$str_date);
			if($hr == 0 && $amp == "AM"){
				$hr = 12;
			}
			$approve_time = $hr.":".$min." ".$amp;
			$rq_name = $row['requestor'];
			$rq_email = $row['rq_email'];
			$rq_phone = $row['rq_phone'];
		}
		$chamber_query = mysqli_query($db_conx,"SELECT * FROM doctors_chambers WHERE chamber_id='$chamber_id' LIMIT 1");
		while($chamber_row = mysqli_fetch_assoc($chamber_query)){
			$chamber_name = $chamber_row['chamber_name'];
			$chamber_city = $chamber_row['city'];
			$chamber_country = $chamber_row['country'];
		}
		$array = array(
			'patient' => $patient,'age' => $age,'sex' => $sex,
			'chamber_name' => $chamber_name, 'chamber_city' => $chamber_city, 'chamber_country' => $chamber_country,
			'blood_group' => $blood_group, 'occupation' => $occupation, 'weight' => $weight,
			'height' => $height, 'expt_date' => $expt_date, 'approve_date' =>$approve_date, 'approve_time' => $approve_time, 
			'rq_name' => $rq_name, 'rq_phone' => $rq_phone, 'rq_email' => $rq_email);

		echo json_encode($array);
		exit();

	}
}else if($_POST['category'] == "setapprovedate"){
	$chamber_id = $_POST['chamber_id'];
	$date = $_POST['date'];
	$month = $_POST['month'];
	$request_id = $_POST['request_id'];
	$hour = $_POST['hour'];
	$minute = $_POST['minute'];
	$ampm = $_POST['ampm'];
	if(empty($hour) || empty($minute) || !is_numeric($hour) || !is_numeric($minute)){
		echo "not set.";
		exit;
	}
	$hour = $hour % 12;
	$minute = $minute % 60;
	if($ampm == "PM"){
		if($hour < 12){
			$hour = $hour+12;
		}
	}
	if($hour == 12 && $ampm == "AM"){
		$hour = 0;
	}
	$time = $hour.":".$minute.":"."00 ".$ampm;
	$ch_query = mysqli_query($db_conx,"SELECT * FROM doctors_visit WHERE request_id='$request_id' LIMIT 1");
	while($ch_row = mysqli_fetch_assoc($ch_query)){
		$dbdate = $ch_row['expt_date'];
	}
	if($date != "0" && $month != "00"){
		$dbdate = strtotime($dbdate);
		$year = date("Y",$dbdate);
		$formatted_date = $year."-".$month."-".$date." ".$time;
		$update_query = mysqli_query($db_conx,"UPDATE doctors_visit SET approve='1',approve_date='$formatted_date' WHERE request_id='$request_id'LIMIT 1");
		if($update_query){
			echo "successfully updated.";
			exit;
		}
	}else{
		echo "not set.";
		exit;
	}
}else if($_POST['category'] == "deleteRequest"){
	$request_id = $_POST['request_id'];
	
	$dl_query = mysqli_query($db_conx,"DELETE FROM doctors_visit WHERE request_id='$request_id' LIMIT 1");
	
	if($dl_query){
		echo "successfully deleted.";
		exit;
	}else{
		echo "failed.";
		exit;
	}
}else if($_POST['category'] == "checkRequest"){
	$req_id = $_POST['req_id'];
	$req_name = $_POST['req_name'];
	$array = array();

	$req_query = mysqli_query($db_conx,"SELECT * FROM doctors_visit WHERE request_profile='$req_id' LIMIT 1");
	while($check_row = mysqli_fetch_assoc($req_query)){
		$doctor_id = $check_row['doctor_id'];
		$patient = $check_row['patient'];
		$age = $check_row['age'];
		$sex = $check_row['sex'];
		$occupation = $check_row['occupation'];
		if(empty($occupation)){
			$occupation = "N/A";
		}
		$suffering = $check_row['suffering'];
		$blood_group = $check_row['blood_group'];
		if(empty($blood_group)){
			$blood_group = "N/A";
		}
		$weight = $check_row['weight'];
		if(empty($weight)){
			$weight = "N/A";
		}else{
			$weight = $weight." KG";
		}
		$height = $check_row['height'];
		if(empty($height)){
			$height = "N/A";
		}else{
			$height = $height." c.m.";
		}
		$requestor = $check_row['requestor'];
		$rq_sex = $check_row['rq_sex'];
		$rq_age = $check_row['rq_age'];
		$rq_age = $rq_age." Years"
		$rq_relation = $check_row['rq_relation'];
		$rq_housename = $check_row['rq_housename'];
		if(empty($rq_housename)){
			$rq_housename = "N/A";
		}
		$rq_houseno = $check_row['rq_houseno'];
		if(empty($rq_houseno)){
			$rq_houseno = "N/A";
		}
		$rq_phone = $check_row['rq_phone'];
		$rq_email = $check_row['rq_email'];
		if(empty($rq_email)){
			$rq_email = "N/A";
		}
		$rq_town = $check_row['rq_town'];
		$rq_policestation = $check_row['rq_policestation'];
		$rq_city = $check_row['rq_city'];
		$rq_country = $check_row['rq_country'];

		$suffer_time = $check_row['suffering'];
		$strone_time = strtotime($suffer_time);
		$suffer_date = date("d M Y",$strone_time);

		$making_time = $check_row['date'];
		$str_time = strtotime($making_time);
		$make_date = date("d M Y",$str_time);
		$make_time = date("h:i A",$str_time);

		$expted_times = $check_row['expt_date'];
		$strexp_time = strtotime($expted_times);
		$expted_date = date("d M Y",$strexp_time);
		$expted_time = date("h:i A",$strexp_time);

		$seen = $check_row['seen'];
		$approve = $check_row['approve'];
		if($seen == 1){
			$status = "Seen";
		}else{
			$status = "Unseen";
		}
		if($approve == 1){
			$status = "Approved";
		}
	}
	if($patient != $req_name){
		$doc_query = mysqli_query($db_conx,"SELECT full_name FROM doctors_personal WHERE doctor_id='$doctor_id' AND full_name LIKE '%$req_name%' LIMIT 1");
		$num_docs = mysqli_num_rows($doc_query);
		if($num_docs < 1){
			echo "Result not found.";
			exit();
		}
	}
	
	$array = array(
		'patient' => $patient, 'age' => $age, 'sex' => $sex, 'blood_group' => $blood_group, 'suffer' => $suffer_date,
		'weight' => $weight, 'height' => $height, 'occupation' => $occupation, 'requestor' => $requestor, 'rq_age' => $rq_age,
		'rq_sex' =>$rq_sex, 'rq_relation' => $rq_relation, 'rq_housename' => $rq_housename, 'rq_houseno' => $rq_houseno,
		'rq_phone' => $rq_phone, 'rq_email' => $rq_email, 'rq_town' => $rq_town, 'rq_policestation' => $rq_policestation,
		'rq_city' => $rq_city, 'rq_country' => $rq_country, 'make_time' => $make_time, 'expt_date' => $expted_date, 'expt_time'=>$expted_time, 'status'=> $status);
	echo json_encode($array);
	exit();
}
	
echo "not permission to enter!!";
?>
