<?php 
include_once("config.inc.php");
if(isset($_GET['roll_number']) && isset($_GET['section_number'])){
	$doctor_id = $_GET['roll_number'];
	$chamber_id = $_GET['section_number'];
	$hos_city = 0;
	$hos_country = 0;
	$hos_postcode = 0;
	$hos_name = "";
	$num_doc_ch = 0;
}else{
	echo "You are on the wrong way.";
	exit;
}
$total_hos = 0;
$total_doc = 0;
$total_cham = 0;
if(is_numeric($doctor_id)){
	$sql_dr = "SELECT * FROM doctors WHERE doctor_id='$doctor_id' LIMIT 1";
	$user_query_dr = mysqli_query($db_conx, $sql_dr);
	while ($row_dr = mysqli_fetch_array($user_query_dr, MYSQLI_ASSOC)) {
		$tz = $row_dr["tz"];
	}
	$sql_option = "SELECT * FROM doctors_options WHERE doctor_id='$doctor_id' LIMIT 1";
	$user_query_option = mysqli_query($db_conx, $sql_option);
	while ($row = mysqli_fetch_array($user_query_option, MYSQLI_ASSOC)) {
		$avatar = $row["image"];
		$avatar_name = $row["img_name"];
	}

	$dr_query = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE doctor_id='$doctor_id' LIMIT 1");
	while($dr_rows = mysqli_fetch_assoc($dr_query)){
		$dr_name = $dr_rows['full_name'];
		$dr_sex = $dr_rows['sex'];
		$dr_speciality = $dr_rows['speciality'];
		$dr_birhtyear = $dr_rows['birth_year'];
		$dr_city = $dr_rows['city'];
		$dr_country = $dr_rows['country'];
	}
	$now_year = date("Y");
	$dr_age = $now_year - $dr_birhtyear;
	$dr_age .=" Years Old";

	if($chamber_id == 'Dochos'){
		$category = "dochos";
		$pro_query = mysqli_query($db_conx,"SELECT * FROM doctors_professional WHERE doctor_id='$doctor_id' LIMIT 1");
		while($pro_row = mysqli_fetch_assoc($pro_query)){
			$ch_name = $pro_row['hospital_name'];
			$ch_houseno = $pro_row['room_no'];
			$ch_housename = "";
			$ch_streetno = $pro_row['street_no'];
			$ch_streetname = $pro_row['street_name'];
			$ch_town = $pro_row['town'];
			$ch_city = $pro_row['city'];
			$ch_postcode = $pro_row['postcode'];
			$ch_country = $pro_row['hos_country'];
			$ch_lat = $pro_row['lat'];
			$ch_lng = $pro_row['lng'];
			$ch_contact = $pro_row['phone'];
			$ch_speciality = $pro_row['email'];
			if(!empty($ch_streetno))
				$ch_streetno = $ch_streetno." | ";
			if(!empty($ch_houseno))
				$ch_houseno = "Room No : ".$ch_houseno;
		}
		$num_rows = mysqli_num_rows($pro_query);
		if($num_rows<1){
			echo "<h4>Opps, its wrong way..!</h4>";
			exit;
		}
	}else{
		$category = "chamber";
		$ch_query = mysqli_query($db_conx,"SELECT * FROM doctors_chambers WHERE chamber_id='$chamber_id' AND doctor_id='$doctor_id' LIMIT 1");
		while($op_rows = mysqli_fetch_assoc($ch_query)){
			$ch_name = $op_rows['chamber_name'];
			$ch_houseno = $op_rows['house_no'];
			$ch_housename = $op_rows['house_name'];
			$ch_streetno = $op_rows['street_no'];
			$ch_streetname = $op_rows['street_name'];
			$ch_town = $op_rows['town'];
			$ch_city = $op_rows['city'];
			$ch_postcode = $op_rows['postcode'];
			$ch_country = $op_rows['country'];
			$ch_lat = $op_rows['lat'];
			$ch_lng = $op_rows['lng'];
			$ch_isweek = $op_rows['isweek_circle'];
			$ch_ismonth = $op_rows['ismonth_circle'];
			$ch_contact = $op_rows['contact'];
			$ch_speciality = $op_rows['speciality'];
			if(!empty($ch_streetno))
				$ch_streetno = $ch_streetno." | ";
			if(!empty($ch_houseno))
				$ch_houseno = $ch_houseno." | ";
		}
		$num_rows = mysqli_num_rows($ch_query);
		if($num_rows<1){
			echo "<h4>Opps, its wrong way..!</h4>";
			exit;
		}
	}
	$profile_pic = '<img class="img-rounded" src="user_doc/'.$avatar_name.'" alt="'.$dr_name.'" height="100px" width="90px">';
}else if(!is_numeric($doctor_id) && is_numeric($chamber_id)){
	$category = "hospital";
	$info_query = mysqli_query($db_conx,"SELECT * FROM hospitals_info WHERE hospital_id='$chamber_id' LIMIT 1");
	while($info_row = mysqli_fetch_assoc($info_query)){
		$hos_name = $info_row['fullname'];
		$hos_estd = $info_row['estd'];
		$hos_services = $info_row['services'];
		$hos_streetno = $info_row['street_no'];
		$hos_streetname = $info_row['street_name'];
		$hos_town = $info_row['town'];
		$hos_city = $info_row['city'];
		$hos_postcode = $info_row['postcode'];
		$hos_country = $info_row['country'];
		$hos_lat = $info_row['lat'];
		$hos_lng = $info_row['lng'];
		$hos_capacity = $info_row['capacity'];
		$hos_phone = $info_row['phone'];
		$hos_email = $info_row['email'];
		$hos_web = $info_row['web'];
		if(!empty($hos_streetno)){
			$hos_streetno = $hos_streetno." | ";
		}
		$op_query= mysqli_query($db_conx,"SELECT img_name FROM hospitals_options WHERE hospital_id='$chamber_id' LIMIT 1");
		while($op_row = mysqli_fetch_assoc($op_query)){
			$image_name = $op_row['img_name'];
		}
		$profile_pic = '<img class="img-rounded" src="user_hos/'.$image_name.'" alt="'.$hos_name.'" height="100px" width="90px">';
	}
}
$month = array("January","February","March","April","May","June","July","August","September","October","November","December");

/***********************************************************************************************************/
/************************************* OTHERS DOCTORS INFORMATION ******************************************/
/***********************************************************************************************************/
if(is_numeric($doctor_id)){
	$doc_query = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE speciality = '$dr_speciality' AND country = '$dr_country' AND doctor_id != '$doctor_id' LIMIT 4");
	$total_doc = mysqli_num_rows($doc_query);
	$i = 0;
	while($doc_rows = mysqli_fetch_assoc($doc_query)){
		$doc_ids[$i] = $doc_rows['doctor_id'];
		$doc_names[$i] = $doc_rows['full_name'];
		$doc_towns[$i] = $doc_rows['town'];
		$doc_postcodes[$i] = $doc_rows['postcode'];
		$doc_citis[$i] = $doc_rows['city'];
		$doc_countris[$i] = $doc_rows['country'];

		$doc_op_id = $doc_ids[$i];
		$option_query = mysqli_query($db_conx,"SELECT * FROM doctors_options WHERE doctor_id='$doc_op_id' LIMIT 1");
		
		while ($row = mysqli_fetch_array($option_query, MYSQLI_ASSOC)) {
			$images = $row["image"];
			$images_name = $row["img_name"];
		}
		$chamber_query = mysqli_query($db_conx,"SELECT * FROM doctors_chambers WHERE doctor_id='$doc_op_id'AND main_hospital='1' LIMIT 1");
		while($cham_rows = mysqli_fetch_assoc($chamber_query)){
			$ch_ids[$i] = $cham_rows['chamber_id'];
		}
		$doc_pics[$i] = '<img class="img-rounded" src="user_doc/'.$images_name.'" alt="'.$doc_names[$i].'" height="90px" width="60px">';
		$i++;
	}

	/***********************************************************************************************************/
	/************************************* OTHERS CHAMBERS INFORMATION *****************************************/
	/***********************************************************************************************************/
	$cham_query = mysqli_query($db_conx,"SELECT * FROM doctors_chambers WHERE doctor_id='$doctor_id' AND chamber_id != '$chamber_id'");
	$total_cham = mysqli_num_rows($cham_query);
	$i = 0;
	while($cham_rows = mysqli_fetch_assoc($cham_query)){
		$cham_ids[$i] = $cham_rows['chamber_id'];
		$cham_names[$i] = $cham_rows['chamber_name'];
		$cham_towns[$i] = $cham_rows['town'];
		$cham_postcodes[$i] = $cham_rows['postcode'];
		$cham_citis[$i] = $cham_rows['city'];
		$cham_countris[$i] = $cham_rows['country'];
		$names = $cham_names[$i];
		$strpos_h = strpos($names, "Hospital");
		$strpos_d = strpos($names, "Diagnostic");
		$strpos_p = strpos($names, "Pharmecy");
		$strpos_pa = strpos($names, "Pharma");
		$strpos_m = strpos($names, "Medical");
		//echo "hospital word in ".$strpos_h."<br>";
		if($strpos_h > 0){
			$cham_pics[$i] = 'H';
		}else if($strpos_d > 0){
			$cham_pics[$i] = 'D';
		}else if($strpos_p > 0 || $strpos_pa > 0){
			$cham_pics[$i] = 'P';
		}else if($strpos_m > 0){
			$cham_pics[$i] = 'M';
		}else{
			$cham_pics[$i] = 'C';
		}
		$i++;
	}
	/***********************************************************************************************************/
	/************************************* OTHERS HOSPITALS INFORMATION ****************************************/
	/***********************************************************************************************************/
}else if($doctor_id == "hospital"){
	$i=0;
	$total_doc = 0;
	$total_cham = 0;
	$total_hos = 0;
	$hos_query = mysqli_query($db_conx,"SELECT * FROM regions WHERE city='$hos_city' AND country='$hos_country' AND category='hospital' AND id != '$chamber_id'");
	$newhosnum = mysqli_num_rows($hos_query);
	while($hos_row = mysqli_fetch_assoc($hos_query)){
		$total_hos += 1;
		$region_ids[$i] = $hos_row['region_id'];
		$rhos_ids[$i] = $hos_row['id'];
		$rhos_name[$i] = $hos_row['name'];
		$rhos_town[$i] = $hos_row['town'];
		$rhos_postcode[$i] = $hos_row['postcode'];
		$rhos_city[$i] = $hos_row['city'];
		$rhos_country[$i] = $hos_row['country'];
		$r_id = $rhos_ids[$i];
		$info = mysqli_query($db_conx,"SELECT estd FROM hospitals_info WHERE hospital_id='$r_id' LIMIT 1");
		while($info_row = mysqli_fetch_assoc($info)){
			$estd[$i] = $info_row['estd'];
		}
		$option = mysqli_query($db_conx,"SELECT img_name FROM hospitals_options WHERE hospital_id='$r_id' LIMIT 1");
		while($option_row = mysqli_fetch_assoc($option)){
			$hosimage = $option_row['img_name'];
		}
		$hos_pics[$i] = '<img class="img-rounded" src="user_hos/'.$hosimage.'" alt="'.$rhos_name[$i].'" height="90px" width="60px">';
		$i++;
	}
	// if($newhosnum == 0){
	// 	echo "Opps, Wrong entry..!!";
	// 	exit;
	// }
	//FIND THE DOCTOR OF SAME CITY AND SAME HOSPITAL............
	//echo $hos_name." ".$hos_city." ".$hos_postcode." ".$hos_country;
	$doc_ch_query = mysqli_query($db_conx,"SELECT * FROM doctors_chambers WHERE city='$hos_city' AND country='$hos_country' AND postcode='$hos_postcode' AND main_hospital='1' AND chamber_name LIKE '%$hos_name%' LIMIT 5");
	$num_doc_ch = mysqli_num_rows($doc_ch_query);
	$i = 0;
	while($doc_ch_row = mysqli_fetch_assoc($doc_ch_query)){
		$doc_ch_id = $doc_ch_row['doctor_id'];
		$ch_ids[$i] = $doc_ch_row['chamber_id'];
		$doc_per_query = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE doctor_id='$doc_ch_id' LIMIT 1");
		while($doc_per_row = mysqli_fetch_assoc($doc_per_query)){
			$doc_ids[$i] = $doc_per_row['doctor_id'];
			$doc_names[$i] = $doc_per_row['full_name'];
			$doc_speciality[$i] = $doc_per_row['speciality'];
			$doc_sex[$i] = $doc_per_row['sex'];
			$birthyear = $doc_per_row['birth_year'];
			$doc_age[$i] = date("Y")-$birthyear." Years Old";
			$doc_towns[$i] = $doc_per_row['town'];
			$doc_postcodes[$i] = $doc_per_row['postcode'];
			$doc_citis[$i] = $doc_per_row['city'];
			$doc_countris[$i] = $doc_per_row['country'];

			$doc_op_id = $doc_ids[$i];
			$option_query = mysqli_query($db_conx,"SELECT * FROM doctors_options WHERE doctor_id='$doc_op_id' LIMIT 1");
			while ($row = mysqli_fetch_array($option_query, MYSQLI_ASSOC)) {
				$images_name = $row["img_name"];
			}
			$doc_pics[$i] = '<img class="img-rounded" src="user_doc/'.$images_name.'" alt="'.$doc_names[$i].'" height="60px" width="60px">';
			$i++;
		}
	}
}else{
	echo "Opps, Wrong entry..!!";
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="images/boiddo-band.png"/>
	<title>Boiddo | Serial Request</title>
	<meta name="description" content="Online doctor and hospitals whats you need while trubling. Find your nearest hospital, get information about doctors and hospitals. Get serial of them... and many more options, which people need.">
	<meta name="keywords" content="online doctor, boiddo, healthcare, online hospitals, medical information">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/stylesnewfb.css">
</head>
<body>
	<div class="container">
		<hr>
<?php if($category != "hospital"){?>
		<div class="row">
			<div class="col-sm-8 no-margin">
				<div class="panel panel-primary ">
				<h4 style="padding: 10px" class="bg-blue text-center"><strong><?php echo $ch_name;?></strong></h4>
				<div class="row">
					<div class="col-sm-6">
						<center><?php echo '<p><strong>'.$ch_houseno."".$ch_housename.'</strong></p>';
						echo '<p>Contact : '.$ch_contact.'</p>';
						echo '<p>Time Zone : '.$tz.'</p>';
						?></center>
					</div>
					<div class="col-sm-6 no-margin">
						<center><?php echo '<p>'.$ch_streetno.''.$ch_streetname.'</p>';
						echo '<p>'.$ch_town.' | '.$ch_postcode.'</p>';
						echo '<p>'.$ch_city.' | '.$ch_country.'</p>';
						?></center>
					</div>
				</div>
				</div>
			</div>
			<div class="col-sm-1">
				<?php echo $profile_pic; ?>
			</div>
			<div class="col-sm-3 no-margin">
				<?php echo '<h4><strong>'.$dr_name.'</strong></h4>';
				echo '<i>'.$dr_speciality.'</i>';
				echo '<p>'.$dr_sex.' | '.$dr_age.'</p>';
				echo '<p>'.$dr_city.' | '.$dr_country.'</p>';
				echo '<button onclick="viewmodal(\''.$doctor_id.'\',\''.$chamber_id.'\')" class="btn btn-link" href="#viewModal" role="button" data-toggle="modal">Details</button>';?>
			</div>
		</div>
<?php }else{ //Hospital Heading Information..........
	?>
		<div class="row">
			<div class="col-sm-8 no-margin">
				<div class="panel panel-primary ">
				<h4 style="padding: 10px" class="bg-blue text-center"><strong><?php echo $hos_name;?></strong></h4>
				<div class="row">
					<div class="col-sm-6">
						<center><?php 
						echo '<p>'.$hos_streetno.''.$hos_streetname.'</p>';
						echo '<p>'.$hos_town.' - '.$hos_postcode.'</p>';
						echo '<p>'.$hos_city.' - '.$hos_country.'</p>';
						echo '<p><strong>Contact No : '.$hos_phone.'</strong></p>';?></center>
					</div>
					<div class="col-sm-6 no-margin">
						<center><?php 
						echo '<p><strong>Capacity : </strong>'.$hos_capacity.'</p>';
						echo '<p><strong>Services : </strong>'.$hos_services.'</p>';?></center>
					</div>
				</div>
				</div>
			</div>
			<div class="col-sm-1">
				<?php echo $profile_pic; ?>
			</div>
			<div class="col-sm-3 no-margin">
				<?php echo '<h4>'.$hos_name.'</h4>';
				echo '<i>Established : '.$hos_estd.'</i>';
				echo '<p>Email : '.$hos_email.'</p>';
				echo '<p>Web : '.$hos_web.'</p>';
				echo '<button onclick="viewHosModal(\''.$chamber_id.'\')" class="btn btn-link" href="#viewHosModal" role="button" data-toggle="modal">Details</button>';?>
			</div>
		</div>
		<?php } ?>
		<hr>


			<div class="row">
				<div class="col-sm-8">
					<div class="panel panel-default">
						<div class="panel-heading">
							<center><h3><b>Requestor Form</b></h3></center>
							<?php echo '<input class="hidden" id="doctorid" value="'.$doctor_id.'">';
							echo '<input class="hidden" id="chamberid" value="'.$chamber_id.'">';?>
						</div>
						<div class="panel-body bgc">
							<div class="row">
								<div class="col-xs-3 col-sm-2 form-text">
									<p>Name*</p>
								</div>
								<div class="col-xs-9 col-sm-4">
									<input id="requestor" class="form-control" placeholder="Requestor Name" required>
								</div>
								
								<div class="col-xs-3 col-sm-2 form-text">
									<p>Patient is* </p>
								</div>
								<div class="col-xs-9 col-sm-3">
									<select id="relation" class="form-control">
										<option>Myself</option>
										<option>Brother</option>
										<option>Father</option>
										<option>Mother</option>
										<option>Sister</option>
										<option>Husband</option>
										<option>Wife</option>
										<option>Son</option>
										<option>Doughter</option>
										<option>Friend</option>
										<option>Neighbour</option>
										<option>Others</option>
									</select>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-2 form-text">
									<p>Age*</p>
								</div>
								<div class="col-sm-4">
									<input id="rqage" type="number" class="form-control" placeholder="Years" required>
								</div>
								<div class="col-sm-2 form-text">
									<p>Gender*</p>
								</div>
								<div class="col-sm-3">
									<select id="rqgender" class="form-control">
										<option>Male</option>
										<option>Female</option>
									</select>
								</div>
							</div>

							<br>
							<div class="row">
								<div class="col-sm-2 form-text">
									<p>House Name</p>
								</div>
								<div class="col-sm-4">
									<input id="rqhousename" class="form-control" placeholder="House Name">
								</div>
								<div class="col-sm-2 form-text">
									<p>House No</p>
								</div>
								<div class="col-sm-3">
									<input id="rqhouseno" class="form-control" placeholder="House No">
								</div>
							</div>

							<br>
							<div class="row">
								<div class="col-sm-2 form-text">
									<p>Locality*</p>
								</div>
								<div class="col-sm-4">
									<input id="rqtown" class="form-control" placeholder="Locality / Town" required>
								</div>
								<div class="col-sm-2 form-text">
									<p>Police station</p>
								</div>
								<div class="col-sm-3">
									<input id="rqpolicestation" class="form-control" placeholder="Police station">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-2 form-text">
									<p>City*</p>
								</div>
								<div class="col-sm-4">
									<input id="rqcity" class="form-control" placeholder="City" required>
								</div>
								<div class="col-sm-2 form-text">
									<p>Country*</p>
								</div>
								<div class="col-sm-3">
									<input id="rqcountry" class="form-control" placeholder="Country" required>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-2 form-text">
									<p>Phone*</p>
								</div>
								<div class="col-sm-4">
									<input id="rqphone" class="form-control" placeholder="Phone no" required>
								</div>
								<div class="col-sm-2 form-text">
									<p>Email</p>
								</div>
								<div class="col-sm-3">
									<input id="rqemail" class="form-control" placeholder="Email">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-2 form-text">
									<p>Expected date*</p>
								</div>
								<div class="col-sm-1">
									<select style="padding:0px" id="rqdate" class="form-control">
										<?php for($i=1; $i<32; $i++){ echo '<option>'.$i.'</option>';}?>
									</select>
								</div>
								<div class="col-sm-1">
									<select style="padding:0px" id="rqmonth" class="form-control">
										<?php for($i=0; $i<12; $i++){ $k = $i+1; if($k<10){ $k = "0".$k;} echo '<option value="'.$k.'">'.$month[$i].'</option>';}?>
									</select>
								</div>
								<div class="col-sm-2">
									<select class="form-control" id="rqyear">
										<?php for($i=2016;$i<2020;$i++){ echo "<option>".$i."</option>";}?>
									</select>
								</div>

								<div class="col-sm-2 form-text">
									<p>Expected Time*</p>
								</div>
								
								<div class="col-sm-1">
									<select id="rqhour" style="padding:0" class="form-control">
										<?php for($i=0; $i<12; $i++){ $k = $i+1; if($k<10){ $k = "0".$k;} echo '<option>'.$k.'</option>';}?>
									</select>
								</div>
								<div class="col-sm-1">
									<select id="rqminute" style="padding:0" class="form-control">
										<?php for($i=0; $i<60; $i+=5){ echo '<option>'.$i.'</option>';}?>
									</select>
								</div>
								<div class="col-sm-1">
									<select id="rqampm" style="padding:0" class="form-control">
										<option>AM</option>
										<option>PM</option>
									</select>
								</div>
							</div>
						</div>
					</div>

					<br>
					<div class="panel panel-info">
						<div class="panel-heading">
							<center><h3><b>Patient Form</b></h3></center>
						</div>
						<div class="panel-body bgc">
							<div class="row">
								<div class="col-sm-2 form-text">
									<p>Name*</p>
								</div>
								<div class="col-sm-4">
									<input id="patient" class="form-control" placeholder="Patient name" required>
								</div>
								<div class="col-sm-2 form-text">
									<p>Age*</p>
								</div>
								<div class="col-sm-3">
									<input id="age" class="form-control" placeholder="Age">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-2 form-text">
									<p>Blood Group</p>
								</div>
								<div class="col-sm-4">
									<input id="bloodgroup" class="form-control" placeholder="Blood Group e.g. A+">
								</div>
								<div class="col-sm-2 form-text">
									<p>Gender*</p>
								</div>
								<div class="col-sm-3">
									<select id="patientsex" class="form-control">
										<option>Male</option>
										<option>Female</option>
									</select>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-2 form-text">
									<p>Weight</p>
								</div>
								<div class="col-sm-4">
									<input id="weight" type="number" class="form-control" placeholder="Kgs">
								</div> 
								
								<div class="col-sm-2 form-text">
									<p>Height</p>
								</div>
								<div class="col-sm-3">
									<input id="height" type="number" class="form-control" placeholder="c.m.">
								</div>
							</div>
							<br>
							
							<div class="row">
								<div class="col-sm-2 form-text">
									<p>Suffering From*</p>
								</div>
								<div class="col-sm-1">
									<select id="suffer-day" style="padding:0px" class="form-control">
										<?php for($i=1;$i<32;$i++){ echo "<option>".$i."</option>";}?>
									</select>
								</div>
								<div class="col-sm-1">
									<select id="suffer-month" style="padding:0px" class="form-control">
										<?php for($i=0;$i<12;$i++){ $k = $i+1; if($k<10){ $k = "0".$k;} echo '<option value="'.$k.'">'.$month[$i].'</option>';}?>
									</select>
								</div>
								<div class="col-sm-2">
									<select id="suffer-year" class="form-control">
										<?php for($i=2016;$i>1950;$i--){ echo "<option>".$i."</option>";}?>
									</select>
								</div>

								<div class="col-sm-2 form-text">
									<p>Occupation</p>
								</div>
								<div class="col-sm-3">
									<input id="occupation" type="text" class="form-control" placeholder="Occupation of the patient">
								</div> 
							</div>
						</div>
					</div>
					
					<br>
					<button onclick="submitForm()" class="btn btn-primary pull-right">Send Request</button>
				</div>
				<div class="col-xs-12 col-sm-4">

<?php if($total_cham){?>
					<div class="panel panel-primary ">
						<h4 style="text-align: center; padding: 10px" class="bg-blue"><strong>Chambers of <?php echo $dr_name;?></strong></h4>
	<?php for($i=0;$i<$total_cham;$i++){?>
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-3 col-sm-3">
									<span class="logo"><?php echo $cham_pics[$i]; ?></span>
								</div>
								<div class="col-xs-9">
									<?php echo "<h4>".$cham_names[$i]."</h4>" ?>
									
									<?php echo "<p>".$cham_towns[$i]." | ".$cham_postcodes[$i]."</p>" ?>
									<span> <?php echo "<p>".$cham_citis[$i]." | ".$cham_countris[$i]."</p>" ?></span>
									<?php echo '<a class="btn btn-link" href="request.php?roll_number='.$doctor_id.'&section_number='.$cham_ids[$i].'">Appointment</a>'; ?>	
								</div>	
							</div>
							<hr class="no-margin">
						</div>
	<?php }?>
					</div>
<?php } ?>

<?php if($total_doc){?>
					<div class="panel panel-primary ">
						<h4 style="text-align: center; padding: 10px" class="bg-blue"><strong><?php echo $dr_speciality;?></strong></h4>
	<?php for($i=0;$i<$total_doc;$i++){?>
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-3 col-sm-3">
									<span><?php echo $doc_pics[$i]; ?></span>
								</div>
								<div class="col-xs-9">
									<?php echo "<h4>".$doc_names[$i]."</h4>" ?>
									<?php echo "<i>".$dr_speciality."</i>" ?>
										
									<?php echo "<p>".$doc_towns[$i]." - ".$doc_postcodes[$i]."</p>" ?>
									<span> <?php echo "<p>".$doc_citis[$i]."-".$doc_countris[$i]."</p>" ?></span>
									<?php echo '<button onclick="viewmodal(\''.$doc_ids[$i].'\',\''.$ch_ids[$i].'\')" class="btn btn-link" href="#viewModal" role="button" data-toggle="modal">Details</button>'; ?>
								</div>	
							</div>
							<hr class="no-margin">
						</div>
	<?php }?>
					</div>
<?php } ?>

<?php if($total_hos){?>
					<div class="panel panel-primary ">
						<h4 style="text-align: center; padding: 10px" class="bg-blue"><strong><?php echo "Hospitals in ".$hos_city;?></strong></h4>
	<?php for($i=0;$i<$total_hos;$i++){?>
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-3 col-sm-3">
									<span><?php echo $hos_pics[$i]; ?></span>
								</div>
								<div class="col-xs-9">
									<?php echo "<h4>".$rhos_name[$i]."</h4>" ?>
									<?php echo "<i>Established : ".$estd[$i]."</i>" ?>
									
									<?php echo "<p>".$rhos_town[$i]." - ".$rhos_postcode[$i]."</p>" ?>
									<span> <?php echo "<p>".$rhos_city[$i]." - ".$rhos_country[$i]."</p>" ?></span>
									<?php echo '<button onclick="viewHosModal(\''.$rhos_ids[$i].'\')" class="btn btn-link" href="#viewHosModal" role="button" data-toggle="modal">Details</button>'; ?>
								</div>
							</div>
							<hr class="no-margin">
						</div>
	<?php }?>
					</div>
<?php } ?>

<?php if($num_doc_ch){?>
					<div class="panel panel-primary ">
						<h4 style="text-align: center; padding: 10px" class="bg-blue"><strong><?php echo "Doctors of ".$hos_name;?></strong></h4>
	<?php for($i=0; $i<$num_doc_ch; $i++){?>
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-3 col-sm-3">
									<span><?php echo $doc_pics[$i]; ?></span>
								</div>
								<div class="col-xs-9">
									<?php echo '<h4>'.$doc_names[$i].'<button onclick="viewmodal(\''.$doc_ids[$i].'\',\''.$ch_ids[$i].'\')" class="btn btn-link pull-right" href="#viewModal" role="button" data-toggle="modal">Details</button></h4>'; ?>
									<?php echo "<i>".$doc_speciality[$i]."</i>"; ?>
										
									<?php echo "<p>".$doc_sex[$i]." | ".$doc_age[$i]."</p>" ?>
									<span> <?php echo "<p>".$doc_citis[$i]."-".$doc_countris[$i]."</p>" ?></span>
									
								</div>	
							</div>
							<hr class="no-margin">
						</div>
	<?php }?>
					</div>
<?php } ?>
				</div>
			</div>
	</div>
	<!--modal-->

	<div id="viewModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div style="text-align:center;background-color:#5BC0DE;" class="modal-header">
					
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
					<h4 id="doc-name"></h4>
					<i id="doc-spe"></i>
				</div>
				<div class="modal-body">
					<form class="form center-block">
						<div class="form-group">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4"><span id="doc-pic"></span></div>
								<div class="col-xs-1 col-sm-1 col-md-1"></div>
								<div class="col-xs-11 col-sm-7 col-md-7">
									<div class="col-xs-12"><span id="doc-deg"></span></div>
									<div class="col-xs-12"><span id="doc-sex"></span></div>
									<div class="col-xs-12"><span id="doc-age"></span></div>
									<div class="col-xs-12" style="margin-top:8px;"><span id="doc-apt"></span></div>
									<div class="col-xs-12"><span id="doc-str"></span></div>
									<div class="col-xs-12"><span id="doc-tow"></span></div>
									<div class="col-xs-12"><span id="doc-cit"></span></div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div style="background-color:#3B5999;color:white;padding:10px;">
					<span style="font-size:18px;" id="hos-name"></span>
				</div>
				<div style="background-color:#5C7BBB;color:#EEE;" class="modal-body">
					
					<form class="form center-block">
						<div class="form-group">
							<div class="row">

								<div style="text-align:left;line-height:16px;" class="col-xs-12 col-sm-4 col-md-4">
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-str"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-tow"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-cit"></span></div>

									<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:10px;"><span id="hos-pho"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-ema"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-web"></span></div>

									<div class="col-xs-12 col-sm-12 col-md-12" style="margin:10px;"></div>

									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-my-roo"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-my-ent"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-my-exi"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-my-roo"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-my-wst"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-my-wen"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-my-sin"></span></div>

								</div>

								<div style="line-height:16px;" class="col-xs-12 col-sm-8 col-md-8">	
								<div style="margin-bottom:10px;" class="col-xs-12 col-sm-12 col-md-12"><span style="font-size:18px;">Emergency services : </span><span id="hos-eme"></span></div>
									<div style="margin-bottom:10px;" class="col-xs-12 col-sm-12 col-md-12"><span style="font-size:18px;">Available services : </span><span id="hos-ser"></span></div>
									<div style="margin-bottom:10px;" class="col-xs-12 col-sm-12 col-md-12"><span style="font-size:18px;">Patient capacity : </span><span style="font-size:20px;" id="hos-cap"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12  pull-left list-inline"><button id="serial-request" data-dismiss="modal" class="btn btn-success btn-sm">Serial Request</button></div>
								</div>
								
							</div>
							
						</div>
					</form>
				</div>
				<div style="background-color:#5BC0DE;padding-bottom:15px;" class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!--Modal End Here-->

	<!--hosmodal-->

	<div id="viewHosModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div style="text-align:center;background-color:#5BC0DE;" class="modal-header">
					<span style="font-size: 18px;" id="hos-fullname"></span>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
					<p style="font-style:italic;"><span id="hos-add"></span></p>
				</div>
				<div class="modal-body">
					<form class="form center-block">
						<div class="form-group">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4"><span id="hos-photo"></span></div>
								<div class="col-xs-12 col-sm-8 col-md-8"><span style="font-size:16px;">Emergency Service : </span><span id="hos-emergency"></span></div>
								<div class="col-xs-12 col-sm-8 col-md-8" style="margin-top:8px;"><span style="font-size:16px;">Available Services : </span><span id="hos-service"></span></div>
							</div>
						</div>
					</form>
				</div>
				<div style="background-color:#3B5999;color:white;padding:10px;">
				</div>
				<div style="background-color:#5C7BBB;color:#EEE;" class="modal-body">
					
					<form class="form center-block">
						<div class="form-group">
							<div class="row">

								<div style="text-align:left;line-height:16px;" class="col-xs-12 col-sm-6 col-md-6">
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-street"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-town"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-city"></span></div>
									
									<div style="margin-top:12px;" class="col-xs-12 col-sm-12 col-md-12"><span id="hos-phone"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-email"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="hos-website"></span></div>

								</div>

								<div style="line-height:16px;" class="col-xs-12 col-sm-6 col-md-6">	
									<div style="margin-bottom:10px;" class="col-xs-12 col-sm-12 col-md-12"><span style="font-size:20px;">Patient capacity : </span><span style="font-size:20px;" id="hos-capacity"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12  pull-left list-inline"><button id="hos-serial-request" class="btn btn-success btn-md" data-dismiss="modal">Serial Request</button></div>
								</div>
								
							</div>
							
						</div>
					</form>
				</div>
				<div  style="background-color:#5BC0DE;padding-bottom:15px;" class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	<!--Hospital Modal End Here-->

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">

function submitForm(){
	var category = "Take patient";
	var requestor = $("#requestor").val();
	var doctor_id = $("#doctorid").val();
	var chamber_id = $("#chamberid").val();
	var relation = $("#relation option:selected").text();
	var rqage =$("#rqage").val();
	var rqgender = $("#rqgender option:selected").text();
	var house_name = $("#rqhousename").val();
	var house_no = $("#rqhouseno").val();
	var town = $("#rqtown").val();
	var policestation = $("#rqpolicestation").val();
	var city = $("#rqcity").val();
	var country = $("#rqcountry").val();
	var phone = $("#rqphone").val();
	var email = $("#rqemail").val();
	var exp_date = $("#rqdate option:selected").text();
	var exp_month = $("#rqmonth option:selected").val();
	var exp_year = $("#rqyear option:selected").text();
	var exp_hour = $("#rqhour option:selected").text();
	var exp_minute = $("#rqminute option:selected").text();
	var rqampm = $("#rqampm option:selected").text();

	var patient = $("#patient").val();
	var age = $("#age").val();
	var blood_group = $("#bloodgroup").val();
	var sex = $("#patientsex option:selected").text();
	var weight = $("#weight").val();
	var height = $("#height").val();
	var occupation = $("#occupation").val();
	var suffer_day = $("#suffer-day option:selected").text();
	var suffer_month = $("#suffer-month option:selected").val();
	var suffer_year = $("#suffer-year option:selected").text();

	$.post("modals.php",{
		category: category,
		requestor: requestor,
		doctor_id: doctor_id,
		chamber_id: chamber_id,
		relation: relation,
		rqage: rqage,
		rqgender: rqgender,
		house_name: house_name,
		house_no: house_no,
		town: town,
		policestation: policestation,
		city: city,
		country: country,
		phone: phone,
		email: email,
		exp_date: exp_date,
		exp_month: exp_month,
		exp_year: exp_year,
		exp_hour: exp_hour,
		exp_minute: exp_minute,
		rqampm: rqampm,
		patient: patient,
		age: age,
		blood_group: blood_group,
		sex: sex,
		weight: weight,
		height: height,
		occupation: occupation,
		suffer_day: suffer_day,
		suffer_month: suffer_month,
		suffer_year: suffer_year
	}, function(data){
		if(data>10000){
			alert(data);
			window.location.href = "serial.php?req_number="+data+"&doc_number="+doctor_id+"&cham_number="+chamber_id;
		}else{
			alert("failed to request.");
		}
	});
}


	function viewmodal(id,cham){
	var doc_id = id;
	var cham_id = cham;
	var modal_data = {};

	$.post("modals.php",{doctors_id: doc_id, category: "doctors"},function(data){
		var ndata = $.parseJSON(data);
		var eme = ndata.hos_ser.indexOf('Emergency');
		
		$("#doc-name").html(ndata.name);
		$("#doc-pic").html(ndata.pro_pic);
		$("#doc-spe").html(ndata.speciality);
		$("#doc-deg").html(ndata.degree);
		$("#doc-sex").html(ndata.gender+"&nbsp-&nbsp"+ndata.age);
		$("#doc-apt").html(ndata.aptno+ndata.aptname);
		$("#doc-str").html(ndata.stno+ndata.stname);
		$("#doc-tow").html(ndata.town+ndata.doc_post);
		$("#doc-cit").html(ndata.city+", "+ndata.doc_country);
		$("#hos-name").html(ndata.hos_name);
		$("#hos-str").html(ndata.hos_st_no+ndata.hos_st_name);
		$("#hos-tow").html(ndata.hos_town+"&nbsp-&nbsp"+ndata.hos_post);
		$("#hos-cit").html(ndata.hos_city+",&nbsp"+ndata.doc_country);
		$("#hos-ser").html(ndata.hos_ser);
		$("#hos-cap").html(ndata.hos_cap);
		$("#hos-pho").html(ndata.hos_phone);
		$("#hos-ema").html(ndata.hos_email);
		$("#hos-web").html(ndata.hos_web);
		
		$("#hos-my-roo").html(ndata.hos_room_no);
		if(eme>=0){
			$("#hos-eme").html("Yes");
		}else{
			$("#hos-eme").html("No");
		}
	});
	$("#serial-request").click(function(){
		//alert(cham_id);
		window.location.href = "request.php?roll_number="+doc_id+"&section_number="+cham_id;
	});
}
function viewHosModal(id){
	var hos_id = id;
	var cham_id = "hospital";
	//alert("alert box");
	$.post("modals.php",{hos_id: hos_id,  category: "hospitals"},function(data){
		var ndata = $.parseJSON(data);
		var emer = ndata.hos_ser.indexOf('Emergency');
		$.each(ndata, function(index, item) {
	    	//alert(index + " : " + item);
		});
		$("#hos-fullname").html(ndata.hos_name);
		$("#hos-add").html(ndata.hos_city+"&nbsp-&nbsp"+ndata.hos_country);
		$("#hos-photo").html(ndata.pro_pic);
		//alert(ndata.name);
		$("#hos-street").html(ndata.hos_st_no+ndata.hos_st_name);
		$("#hos-town").html(ndata.hos_town+"&nbsp-&nbsp"+ndata.hos_post);
		$("#hos-city").html(ndata.hos_city+",&nbsp"+ndata.hos_country);
		$("#hos-service").html(ndata.hos_ser);
		$("#hos-capacity").html(ndata.hos_cap);
		$("#hos-phone").html(ndata.hos_phone);
		$("#hos-website").html(ndata.hos_web);
		$("#hos-email").html(ndata.hos_email);
		if(emer>=0){
			$("#hos-emergency").html("Yes");
		}else{
			$("#hos-emergency").html("No");
		}
		$("#hos-serial-request").click(function(){
		//alert(cham_id);
		window.location.href = "request.php?roll_number="+cham_id+"&section_number="+hos_id;
	});
	});
}
</script>
</body>
</html>