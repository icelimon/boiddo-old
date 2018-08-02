<?php 
include_once("check-login-status.php");
if($user_ok != true || $log_category != "doctor"){
	header("Location: http://boiddo.com");
}
$tz_query = mysqli_query($db_conx,"SELECT tz FROM doctors WHERE doctor_id='$log_id'LIMIT 1");
while($tz_row = mysqli_fetch_assoc($tz_query)){
	$tz = $tz_row['tz'];
}
date_default_timezone_set($tz);

$professionals_query = mysqli_query($db_conx,"SELECT * FROM doctors_professional WHERE doctor_id='$log_id' LIMIT 1");
while($professionals = mysqli_fetch_assoc($professionals_query)){
	$hospital_name = $professionals['hospital_name'];
	$hos_str_no = $professionals['street_no'];
	$hos_str_name = $professionals['street_name'];
	$hos_room = $professionals['room_no'];
	$hos_town = $professionals['town'];
	$hos_city = $professionals['city'];
	$hos_postcode = $professionals['postcode'];
	$hos_country = $professionals['country'];
	$hos_services = $professionals['hospital_services'];
	$hos_capacity = $professionals['hospital_capacity'];
	$hos_phone = $professionals['phone'];
	$hos_email = $professionals['email'];
	$hos_web = $professionals['web'];
}
function mondatereturn($date){
	$strday = strtotime($date);
	$newday = date('l',$strday);
	return $newday;
}
function dayreturn($date){
	$next_week = strtotime('this week');
	$newdate = date("l", strtotime($date, $next_week));
	return $newdate;
}
function dateformatreturn($date){
	$next_week = strtotime('this week');
	$newdate = date("Y-m-d", strtotime($date, $next_week));
	return $newdate;
}
function datereturn($date){
	$this_week = strtotime('this week');
	$newdate = date("d M Y", strtotime($date, $this_week));
	return $newdate;
}
function hourreturn($date){
	$strdate = strtotime($date);
	$newhr = date('h',$strdate);
	return $newhr;
}
function minreturn($date){
	$strdate = strtotime($date);
	$newmin = date('i',$strdate);
	return $newmin;
}
function apreturn($date){
	$strdate = strtotime($date);
	$newap = date('A',$strdate);
	return $newap;
}

$today = date("l");
$todayNumber = date("N");
$todate = date("d M Y");
$todayNumber = $todayNumber%7;
//$todayNumber = ($todayNumber+2)%7;

$chamber_query = mysqli_query($db_conx,"SELECT * FROM doctors_chambers WHERE doctor_id='$log_id' AND main_hospital='1' LIMIT 1");
while($chamber_row = mysqli_fetch_assoc($chamber_query)){
	$chamber_id = $chamber_row['chamber_id'];
	$day_start_sat = $chamber_row['sat_start'];
	$day_end_sat = $chamber_row['sat_end'];
	$day_start_sun = $chamber_row['sun_start'];
	$day_end_sun = $chamber_row['sun_end'];
	$day_start_mon = $chamber_row['mon_start'];
	$day_end_mon = $chamber_row['mon_end'];
	$day_start_tue = $chamber_row['tue_start'];
	$day_end_tue = $chamber_row['tue_end'];
	$day_start_wed = $chamber_row['wed_start'];
	$day_end_wed = $chamber_row['wed_end'];
	$day_start_thu = $chamber_row['thu_start'];
	$day_end_thu = $chamber_row['thu_end'];
	$day_start_fri = $chamber_row['fri_start'];
	$day_end_fri = $chamber_row['fri_end'];
	$lat = $chamber_row['lat'];
	$lng = $chamber_row['lng'];

	$day[0] = dayreturn("Saturday");
	$day[1] = dayreturn("Sunday");
	$day[2] = dayreturn("Monday");
	$day[3] = dayreturn("Tuesday");
	$day[4] = dayreturn("Wednesday");
	$day[5] = dayreturn("Thursday");
	$day[6] = dayreturn("Friday");

	$date_start[0] = datereturn("Saturday");
	$date_start[1] = datereturn("Sunday");
	$date_start[2] = datereturn("Monday");
	$date_start[3] = datereturn("Tuesday");
	$date_start[4] = datereturn("Wednesday");
	$date_start[5] = datereturn("Thursday");
	$date_start[6] = datereturn("Friday");
	$date_sunday = date("d M Y");
	$date[0] = dateformatreturn("Saturday");
	$date[1] = dateformatreturn("Sunday");
	$date[2] = dateformatreturn("Monday");
	$date[3] = dateformatreturn("Tuesday");
	$date[4] = dateformatreturn("Wednesday");
	$date[5] = dateformatreturn("Thursday");
	$date[6] = dateformatreturn("Friday");

	$day_start_hr[0] = hourreturn($day_start_sat);
	$day_end_hr[0] = hourreturn($day_end_sat);
	$day_start_hr[1] = hourreturn($day_start_sun);
	$day_end_hr[1] = hourreturn($day_end_sun);
	$day_start_hr[2] = hourreturn($day_start_mon);
	$day_end_hr[2] = hourreturn($day_end_mon);
	$day_start_hr[3] = hourreturn($day_start_tue);
	$day_end_hr[3] = hourreturn($day_end_tue);
	$day_start_hr[4] = hourreturn($day_start_wed);
	$day_end_hr[4] = hourreturn($day_end_wed);
	$day_start_hr[5] = hourreturn($day_start_thu);
	$day_end_hr[5] = hourreturn($day_end_thu);
	$day_start_hr[6] = hourreturn($day_start_fri);
	$day_end_hr[6] = hourreturn($day_end_fri);

	$day_start_min[0] = minreturn($day_start_sat);
	$day_end_min[0] = minreturn($day_end_sat);
	$day_start_min[1] = minreturn($day_start_sun);
	$day_end_min[1] = minreturn($day_end_sun);
	$day_start_min[2] = minreturn($day_start_mon);
	$day_end_min[2] = minreturn($day_end_mon);
	$day_start_min[3] = minreturn($day_start_tue);
	$day_end_min[3] = minreturn($day_end_tue);
	$day_start_min[4] = minreturn($day_start_wed);
	$day_end_min[4] = minreturn($day_end_wed);
	$day_start_min[5] = minreturn($day_start_thu);
	$day_end_min[5] = minreturn($day_end_thu);
	$day_start_min[6] = minreturn($day_start_fri);
	$day_end_min[6] = minreturn($day_end_fri);

	$day_start_ap[0] = apreturn($day_start_sat);
	$day_end_ap[0] = apreturn($day_end_sat);
	$day_start_ap[1] = apreturn($day_start_sun);
	$day_end_ap[1] = apreturn($day_end_sun);
	$day_start_ap[2] = apreturn($day_start_mon);
	$day_end_ap[2] = apreturn($day_end_mon);
	$day_start_ap[3] = apreturn($day_start_tue);
	$day_end_ap[3] = apreturn($day_end_tue);
	$day_start_ap[4] = apreturn($day_start_wed);
	$day_end_ap[4] = apreturn($day_end_wed);
	$day_start_ap[5] = apreturn($day_start_thu);
	$day_end_ap[5] = apreturn($day_end_thu);
	$day_start_ap[6] = apreturn($day_start_fri);
	$day_end_ap[6] = apreturn($day_end_fri);
}
$i = 0;
$optional_ch_query = mysqli_query($db_conx,"SELECT * FROM doctors_chambers WHERE doctor_id='$log_id' AND main_hospital='0'");
while($op_rows = mysqli_fetch_assoc($optional_ch_query)){
	$ch_id[$i] = $op_rows['chamber_id'];
	$ch_name[$i] = $op_rows['chamber_name'];
	$ch_houseno[$i] = $op_rows['house_no'];
	$ch_housename[$i] = $op_rows['house_name'];
	$ch_streetno[$i] = $op_rows['street_no'];
	$ch_streetname[$i] = $op_rows['street_name'];
	$ch_town[$i] = $op_rows['town'];
	$ch_city[$i] = $op_rows['city'];
	$ch_postcode[$i] = $op_rows['postcode'];
	$ch_country[$i] = $op_rows['country'];
	$ch_lat[$i] = $op_rows['lat'];
	$ch_lng[$i] = $op_rows['lng'];
	$ch_isweek[$i] = $op_rows['isweek_circle'];
	$ch_ismonth[$i] = $op_rows['ismonth_circle'];
	$ch_contact[$i] = $op_rows['contact'];

	$sat_start[$i] = $op_rows['sat_start'];
	$sat_end[$i] = $op_rows['sat_end'];
	$sun_start[$i] = $op_rows['sun_start'];
	$sun_end[$i] = $op_rows['sun_end'];
	$mon_start[$i] = $op_rows['mon_start'];
	$mon_end[$i] = $op_rows['mon_end'];
	$tue_start[$i] = $op_rows['tue_start'];
	$tue_end[$i] = $op_rows['tue_end'];
	$wed_start[$i] = $op_rows['wed_start'];
	$wed_end[$i] = $op_rows['wed_end'];
	$thu_start[$i] = $op_rows['thu_start'];
	$thu_end[$i] = $op_rows['thu_end'];
	$fri_start[$i] = $op_rows['fri_start'];
	$fri_end[$i] = $op_rows['fri_end'];
	$active[$i] = $op_rows['active'];

	$sat_str = strtotime($sat_start[$i]);
	$sat = date("Y",$sat_str);
	$sun_str = strtotime($sun_start[$i]);
	$sun = date("Y",$sun_str);
	$mon_str = strtotime($mon_start[$i]);
	$mon = date("Y",$mon_str);
	$tue_str = strtotime($tue_start[$i]);
	$tue = date("Y",$tue_str);
	$wed_str = strtotime($wed_start[$i]);
	$wed = date("Y",$wed_str);
	$thu_str = strtotime($thu_start[$i]);
	$thu = date("Y",$thu_str);
	$fri_str = strtotime($fri_start[$i]);
	$fri = date("Y",$fri_str);
	$i++;
}
$chamberNumber = $i;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/boiddo-band.png">
	<title>Boiddo</title>
	<meta name="generator" content="Boiddo">
	<meta name="description" content="Online doctor and hospitals whats you need while trubling.">
	<meta name="keywords" content="online doctor, boiddo, healthcare, online hospitals, medical information">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/stylesnewfb.css" rel="stylesheet">
	<link href="css/visit.styles.css" rel="stylesheet">
</head>
<body onload="startTime()">
	<div class="container-fluid">
		<div class="box">
			<div class="row row-offcanvas row-offcanvas-left">
			<?php echo '<p class="hidden" id="todate">'.$todate.'</p>';?>
			<?php echo '<p class="hidden" id="today">'.$today.'</p>';?>
				<?php include_once('dr-header.php');?>
				<div class="padding">
					<div class="full col-sm-9">
						<!-- content -->
<?php 	echo '<p id="lat" class="hidden">'.$lat.'</p>';
		echo '<p id="lng" class="hidden">'.$lng.'</p>';?>
						<div class="row">
							<div class="col-sm-8">
								<div class="panel panel-warning">
									<div class="panel-heading">
										<?php echo '<a href="#mainMap" onclick="initMap(\''.$lat.'\',\''.$lng.'\')" class="btn btn-danger pull-right" data-toggle="modal">Add Map</a>';?>
										<h4 id="hos-name"><b><?php echo $hospital_name;?></b></h4>
										<i><?php echo $hos_city."-".$hos_postcode;?></i>
										<p><?php echo $hos_country;?></p>
									</div>
									<div class="panel-body days" style="background-color:#ACE">
										<div class="row">
											<div class="col-sm-2">
												<center><p>Day</p></center>
											</div>
											<div class="col-sm-3">
												<center><p>Date</p></center>
											</div>
											<div class="col-sm-3">
												<center><p>Start Time</p></center>
											</div>
											<div class="col-sm-3">
												<center><p>End Time</p></center>
											</div>
											<div class="col-sm-1">
												<p>Status</p>
											</div>
										</div>
									</div>
									<hr style="margin:0px 0px;">
<?php echo '<p class="hidden" id="chamber-id">'.$chamber_id.'</p>';?>
<?php for($i=0 ; $i<7; $i++){
	//$n=($i+5)%7; // Start FOR LOOP 
	$todayi = ($i+5)%7;
	//echo "today number = ".$todayNumber;
	//echo " today i = ".$todayi;
	$n = $i;
	
	if($today == $day[$i]){// today
		echo '<div class="panel-body days" style="background-color:#DEE;border:2px solid #AFE;">';
	}else if($todayNumber > $todayi){ // past dates...
		echo '<div class="panel-body days" style="background-color:#DEE;border:2px solid #AFE">';
	}else{
		echo '<div class="panel-body days" style="background-color:#AEF;border:2px solid #AFE">';
	}
?>
										<div class="row">
											<div class="col-sm-2">
												<center>
<?php if($today == $day[$i]){echo '<p>Today</p>';}else{echo '<p id="day-'.$i.'">'.$day[$i].'</p>';}?>
<?php echo '<p class="hidden" id="dates-'.$i.'">'.$date[$i].'</p><p class="hidden" id="datestart-'.$i.'">'.$date_start[$i].'</p>';?>
												</center>
											</div>
											<div class="col-sm-3">
												<center><p>
<?php if($today == "Sunday" && $day[$i] == "Sunday"){echo $date_sunday;}else{ echo $date_start[$i];}?>
												</p></center>
											</div>
											<div class="col-sm-3">
												<center>
<?php if(isset($day_start_hr[$n])){ echo '<b><span id="day-start-hour-'.$i.'">'.$day_start_hr[$n].':</span></b>';}?>

<?php if(isset($day_start_min[$n])){ echo '<b><span id="day-start-min-'.$i.'">'.$day_start_min[$n].'</span></b>';}?>

<?php if(isset($day_start_ap[$n])){ echo '<b><span id="day-start-ap-'.$i.'">'.$day_start_ap[$n].'</span></b>';}?>

												</center>
											</div>
											<div class="col-sm-3">
												<center>
<?php if(isset($day_end_hr[$n])){ echo '<b><span id="day-end-hour-'.$i.'">'.$day_end_hr[$n].':</span></b>';}?>

<?php if(isset($day_end_min[$n])){ echo '<b><span id="day-end-min-'.$i.'">'.$day_end_min[$n].'</span></b>';}?>

<?php if(isset($day_end_ap[$n])){ echo '<b><span id="day-end-ap-'.$i.'">'.$day_end_ap[$n].'</span></b>';}?>
												</center>
											</div>
											<div class="col-sm-1">
												<center><?php if($day[$i] != $today) {echo '<button onclick="saveData(\''.$i.'\')" class="btn btn-sm btn-link no-margin">Edit</button>';}
												else{echo '<span class="glyphicon glyphicon-ok"></span>';}?></center>
											</div>
											<?php echo '<a id="click-modal-'.$i.'" class="hidden" href="#hos-edit-modal" data-toggle="modal"></a>';?>
										</div>
									</div>
									<hr style="margin:0px 0px;">
<?php } //end FOR LOOP ?>
<hr>
<?php 

for($i=0; $i<$chamberNumber; $i++){?>
<div class="panel panel-warning">
	<div class="panel-heading">
		<?php echo '<a href="#optionalMap" onclick="initOptionalMap(\''.$ch_lat[$i].'\',\''.$ch_lng[$i].'\')" class="btn btn-warning pull-right" data-toggle="modal">Add Map</a>';?>
		<h4 id="ch-name"><b><?php echo $ch_name[$i];?></b></h4>
		<i><?php echo $ch_city[$i]."-".$ch_postcode[$i];?></i>
		<p><?php echo $ch_country[$i];?></p>
	</div>
	<div class="panel-body days">
		<div class="row">
			<div class="col-sm-3">

			</div>

			<div class="col-sm-3">
				<center><p>Start Time</p></center>
			</div>
			<div class="col-sm-3">
				<center><p>End Time</p></center>
			</div>
			<div class="col-sm-3">
				<center><p>Options</p></center>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<?php 
			if($sat != 1970){
				echo "Saturday";
			}
			if($sun != 1970){
				echo "Sunday";
			}
			if($mon != 1970){
				echo "Monday";
			}
			if($tue != 1970){
				echo "Tuesday";
			}
			if($wed != 1970){
				echo "Wednesday";
			}
			if($thu != 1970){
				echo "Thursday";
			}
			if($fri != 1970){
				echo "Friday";
			}
			?>
		</div>
		<div class="col-sm-3">
			<?php 
			if($sat != 1970){
				echo $sat_start[$i];
			}
			if($sun != 1970){
				echo $sun_start[$i];
			}
			if($mon != 1970){
				echo $mon_start[$i];
			}
			if($tue != 1970){
				echo $mon_start[$i];
			}
			if($wed != 1970){
				echo $wed_start[$i];
			}
			if($thu != 1970){
				echo $thu_start[$i];
			}
			if($fri != 1970){
				echo $fri_start[$i];
			}
			?>
		</div>
		<div class="col-sm-3">
			<?php 
			if($sat != 1970){
				echo $sat_end[$i];
			}
			if($sun != 1970){
				echo $sun_end[$i];
			}
			if($mon != 1970){
				echo $mon_end[$i];
			}
			if($tue != 1970){
				echo $mon_end[$i];
			}
			if($wed != 1970){
				echo $wed_end[$i];
			}
			if($thu != 1970){
				echo $thu_end[$i];
			}
			if($fri != 1970){
				echo $fri_end[$i];
			}
			?>
		</div>
		<div class="col-sm-3">
			<?php echo '<center><button class="btn btn-default btn-sm"><span class="glyphicon glyphicon-asterisk"></span></button></center>';
			if($sat != 1970){
				echo '<center><button><span class="glyphicon glyphicon-asterisk"></span></button></center>';
			}
			if($sun != 1970){
				echo $sun_end[$i];
			}
			if($mon != 1970){
				echo $mon_end[$i];
			}
			if($tue != 1970){
				echo $mon_end[$i];
			}
			if($wed != 1970){
				echo $wed_end[$i];
			}
			if($thu != 1970){
				echo $thu_end[$i];
			}
			if($fri != 1970){
				echo $fri_end[$i];
			}
			?>
		</div>
	</div>
</div>
<?php } ?>
								</div>
							</div>
							<!--Right Column Start-->
							<div class="col-sm-4">
								<h3 class="no-margin"><b id="right-column"></b></h3>
								<h4><b id="right-column-day"></b></h4>
								<h4><b id="right-column-date"></b></h4>
								<div id="googleMap" style="width:auto;height:380px;"></div>
								<h4><b id="right-column-ck"></b></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!-- Main Hospital edit Modal-->
	<div id="hos-edit-modal" class="modal fade" tab-index="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content" style="background-color:#AFE">
				<div class="modal-header"style="background-color:#FFF;">
					<ul class="list-inline">
						<li><center><h4 id="mod-hos-name"></h4></center></li>
						<li class="pull-right"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button></li>
					</ul>
					
					
				</div>
				<div class="modal-body"style="margin:10px 20px;padding-bottom:14px">
					<div class="row form-group">
						<div class="col-sm-offset-3 col-sm-9"><b id="mod-day"></b></div>
						<div id="mod-date" class="col-sm-offset-3 col-sm-3"></div>
						<div class="col-sm-offset-1 col-sm-5"><input id="mod-holiday" type="checkbox"> Holiday</div>
						<div class="col-sm-12"><br/></div>
						<div class="col-sm-offset-3 col-sm-3">Start Time</div>
						<div class="col-sm-offset-1 col-sm-5">End Time</div>

						<div class="col-sm-offset-2 col-sm-4 form-group"><select id="start-hr">
							<option>01</option>
							<option>02</option>
							<option>03</option>
							<option>04</option>
							<option>05</option>
							<option>06</option>
							<option>07</option>
							<option>08</option>
							<option>09</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
						</select>
						<select id="start-min">
							<option>00</option>
							<option>15</option>
							<option>30</option>
							<option>45</option>
						</select>
						<select id="start-ap">
							<option>AM</option>
							<option>PM</option>
						</select></div>

						<div class="col-sm-4"><select id="end-hr">
							<option>01</option>
							<option>02</option>
							<option>03</option>
							<option>04</option>
							<option>05</option>
							<option>06</option>
							<option>07</option>
							<option>08</option>
							<option>09</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
						</select>
						<select id="end-min">
							<option>00</option>
							<option>15</option>
							<option>30</option>
							<option>45</option>
						</select>
						<select id="end-ap">
							<option>AM</option>
							<option>PM</option>
						</select></div>
						<hr>
						<div class="col-sm-2"><button id="saveBtn" data-dismiss="modal" class="btn btn-success pull-right">Save</button></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--Main Hospital Map Address Modal-->

	<div id="mainMap" class="modal fade" tab-index="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md modal-warning">
			<div class="modal-content">
				<div class="modal-header"style="background-color:#AFF;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<center><h4 id="hos-name-map no-margin"><?php echo $hospital_name; ?></h4><i><?php echo $hos_city."-".$hos_postcode;?></i></center>
				</div>
				<div class="modal-body mg-top-18">
					<form class="form-group">
						<div class="row">
							<div class="col-sm-4"><h5 class="pull-right">Map Address</h5></div>
							<div class="col-sm-6"><input id="map-input" class="form-control" type="text" placeholder="Name, City, Country"></div>
							<div id="map-canvas" class="mg-top-18 col-sm-offset-2 col-sm-8" style="height:220px;"></div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary" data-dismiss="modal">Save</button>
				</div>
			</div>
		</div>
	</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&signed_in=true&libraries=places"></script>
<!--script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAyGxHm8crHWJjggCtuj4dKnFwBJ0nxzYY"></script-->
<script type="text/javascript">

	function startTime() {
		var today = new Date();
		var h = today.getHours();
		var m = today.getMinutes();
		var s = today.getSeconds();
		var ap="AM";
		if(h>12){
			h=h%12;
			ap="PM";
		}else if(h==12){
			ap="PM";
		}
		if(h == 0){
			h=12;
		}
		m = checkTime(m);
		s = checkTime(s);
		$("#right-column").html(h+":"+m+":"+s+" "+ap).css("color","#8a6d3b");
		var t = setTimeout(startTime, 500);
	}
	function checkTime(i) {
    	if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    	return i;
	}

	var datestart = $("#todate").text();
	$("#right-column-date").html(datestart).css("color","#8a6d3b");;
	var daystart = $("#today").text();
	$("#right-column-day").html(" "+daystart).css("color","#8a6d3b");;

	// function initialize() {
	// 	var mapProp = {
	// 		center:new google.maps.LatLng(23.810332,90.412518),
	// 		zoom:15,
	// 		mapTypeId:google.maps.MapTypeId.ROADMAP
	// 	};
	// 	var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
	// }
	// google.maps.event.addDomListener(window, 'load', initialize);
		
function saveData(id){

	var hosname = $("#hos-name").text();
	var chamber_id = $("#chamber-id").text();
	var day = $("#day-"+id).text();
	var dates = $("#dates-"+id).text();
	var datestart = $("#datestart-"+id).text();
	$("#click-modal-"+id).click();

	$("#mod-hos-name").html(hosname);
	$("#mod-day").html(day);
	$("#mod-date").html(datestart);

	var visit = "savedata";
	$("#saveBtn").click(function(){
		var start_hr = $("#start-hr option:selected").text();
		var start_min = $("#start-min option:selected").text();
		var start_ap = $("#start-ap option:selected").text();
		var end_hr = $("#end-hr option:selected").text();
		var end_min = $("#end-min option:selected").text();
		var end_ap = $("#end-ap option:selected").text();
		ids=id;
		$.post("db-visits.php",{
			visit: visit,
			chamber_id: chamber_id,
			start_hr: start_hr,
			start_min: start_min,
			start_ap: start_ap,
			end_hr: end_hr,
			end_min: end_min,
			end_ap: end_ap,
			day: day,
			date: dates
		},function(data){
			
			var success = data.indexOf("operation successfull..!..");
			var dberror = data.indexOf("database error.!..");
			var failed = data.indexOf("operation failed..!.");
			if(success >= 0){
				$("#day-start-hour-"+id).html(start_hr+":");
				$("#day-start-min-"+id).html(start_min);
				$("#day-start-ap-"+id).html(start_ap);
				$("#day-end-hour-"+id).html(end_hr+":");
				$("#day-end-min-"+id).html(end_min);
				$("#day-end-ap-"+id).html(end_ap);
				window.location.href = "visits.php";

			}else if(dberror >= 0){
				alert("database error");
			}else if(failed >= 0){
				alert("Failed");
			}else{
				alert("Something happened");
			}
		});
		$("#right-column-ck").html("Updating...");
	});
	
	
}
// var lat = "";
// var lng = "";
// var newaddress = "";

function initMap(latitude,longitude) {
	//alert("Lat "+latitude+" Lng "+longitude);
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: {lat: -33.8688, lng: 151.2195},
        zoom: 13
    });
    var input = /** @type {!HTMLInputElement} */(
        document.getElementById('map-input'));

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(15);  // Why 17? Because it looks good.
        }
        newaddress = place.formatted_address;
        lat = place.geometry.location.lat();
        lng = place.geometry.location.lng();

        marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
          address = [
            (place.address_components[0] && place.address_components[0].short_name || ''),
            (place.address_components[1] && place.address_components[1].short_name || ''),
            (place.address_components[2] && place.address_components[2].short_name || '')
          ].join(' ');
        }

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
    });
}

function saveMap(id){
	var chamber_id = $("#chamber-id").text();
	var visit = "mainMap";
	$.post("db-visits.php",{
		visit: visit,
		chamber_id: chamber_id,
		lat: lat,
		lng: lng
	},function(data){
		var success = data.indexOf("Successfully added...");
		var failed = data.indexOf("Failed to add...");
		if(success>=0){
			alert(data);
		}else if(failed>=0){
			alert(data);
		}else{
			alert("Something wrong");
		}
	});
}
	$(document).ready(function(){

	});
</script>

</body>
</html>