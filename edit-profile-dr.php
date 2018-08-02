<?php
  //include_once("php_includes/check_login_status.php");
include_once("check-login-status.php");
  // Initialize any variables that the page might echo
$u = "";
$gender = "Male";
$email = "";
$profile_pic = "";
$profile_pic_btn = "";
$avatar_form = "";
$country = "";
$joindate = "";
$lastsession = "";

if($user_ok == true && $log_username != "" && $log_category == "doctor"){
	$u = $log_username;
}else{
	header("location: http://www.boiddo.com");
	exit(); 
}
  // Select the member from the users table
$sql = "SELECT * FROM doctors WHERE doctor_username='$u' AND activated='1' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
  // Now make sure that user exists in the table
$numrows = mysqli_num_rows($user_query);
if($numrows < 1){
	echo "That user does not exist or is not yet activated, press back";
	exit(); 
}

$publish = 0;
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
	$publish = $row['updated'];
}

  // Select the member from the users table
$sql_option = "SELECT * FROM doctors_options WHERE doctor_username='$u' LIMIT 1";
$user_query_option = mysqli_query($db_conx, $sql_option);
  // Now make sure that user exists in the table
$numrows_option = mysqli_num_rows($user_query_option);
if($numrows_option < 1){
	echo "That user does not exist or is not yet activated, press back";
	exit(); 
}

  // Check to see if the viewer is the account owner
$isOwner = "no";
if($u == $log_username && $user_ok == true){
	$isOwner = "yes";
	$profile_pic_btn = '<a href="#" onclick="return false;" onmousedown="toggleElement(\'avatar_form\')"></a>';
	$avatar_form  = '<form id="avatar_form" enctype="multipart/form-data" method="post" action="php_parsers/photo_system.php">';
	
	$avatar_form .=   '<input type="file" name="avatar" required>';
	$avatar_form .=   '<p><input type="submit" value="Upload"></p>';
	$avatar_form .= '</form>';
}
  // Fetch the user row from the query above
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
	$profile_id = $row["doctor_id"];
	$gender = $row["doctor_sex"];
	$country = $row["doctor_country"];
	$email = $row["doctor_email"];
	$signup = $row["joindate"];
	$lastlogin = $row["lastlogin"];
	$joindate = strftime("%b %d, %Y", strtotime($signup));
	$lastsession = strftime("%b %d, %Y", strtotime($lastlogin));
}

  // Fetch the doctors_options row from the query above
while ($row = mysqli_fetch_array($user_query_option, MYSQLI_ASSOC)) {
	$profile_id = $row["doctor_id"];
	$avatar = $row["image"];
	$avatar_name = $row["img_name"];
	$question = $row["doctor_question"];
	$answer = $row["doctor_answer"];
}

$profile_pic = '<img class="img-circle" src="user_doc/'.$avatar_name.'" alt="'.$u.'" height="60px" width="60px">';
if($avatar == NULL){
	$profile_pic = '<img class="img-circle" src="images/default-dr.png" alt="'.$u.'" height="60px" width="60px">';
}
/****************************************************************************************************/
/**************************************                                 *****************************/
/**************************************    Personal Section Start Here  *****************************/
/**************************************                                 *****************************/
/****************************************************************************************************/
$fullname = "";
$specialist = "";
$olddegree = "";
$oldemail = "";
$aptno = "";
$aptname = "";
$streetno = "";
$streetname = "";
$town = "";
$city = "";
$postcode = "";
$phone = "";

$sql = "SELECT * FROM doctors_personal WHERE doctor_id='$log_id' LIMIT 1";
$query = mysqli_query($db_conx, $sql);
while($row = mysqli_fetch_assoc($query)){
	$fullname = $row['full_name'];
	$specialist = $row['speciality'];
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

if(empty($fullname)){
	$title = "Boiddo";
}else{
	$title = $fullname;
}
if(!empty($postcode)){
	$city = $city."-".$postcode;
}else{
	$sqlcode = "SELECT doctor_postcode FROM doctors WHERE doctor_username='$log_username' LIMIT 1";
	$querycode = mysqli_query($db_conx, $sqlcode);
	$rowcode = mysqli_fetch_assoc($querycode);
	$code = $rowcode['doctor_postcode'];
	$city = $city."-".$code;
}

$address = $aptno."-".$aptname."/ ".$streetno."-".$streetname."/ ".$town;

if(!empty($fullname) && !empty($specialist) && !empty($olddegree) && !empty($streetname) && !empty($town) && !empty($city)){
	$sqlupdate = "UPDATE doctors_personal SET updated='1' WHERE doctor_id='$log_id' LIMIT 1";
	$queryupdate = mysqli_query($db_conx, $sqlupdate);
}
/****************************************************************************************************/
/**************************************                                 *****************************/
/************************************** Professional Section Start Here *****************************/
/**************************************                                 *****************************/
/****************************************************************************************************/
$hos_name="";
$room_no="";
$hos_streetno = "";
$hos_streetname = "";
$hos_town = "";
$hos_city = "";
$hos_postcode = "";
$hos_capacity = "";
$hos_service = "";
$hos_serv = "";
$hos_phone = "";
$hos_email = "";
$hos_web = "";
$hos_address="";
$isComplete="";
$isCom="";
$sql_pro = "SELECT * FROM doctors_professional WHERE doctor_id='$log_id' LIMIT 1";
$query_pro = mysqli_query($db_conx, $sql_pro);
while($rowpro = mysqli_fetch_assoc($query_pro)){
	$hos_name=$rowpro['hospital_name'];
	$room_no=$rowpro['room_no'];
	$hos_streetno = $rowpro['street_no'];
	$hos_streetname = $rowpro['street_name'];
	$hos_town = $rowpro['town'];
	$hos_city = $rowpro['city'];
	$hos_postcode = $rowpro['postcode'];
	$hos_service = $rowpro['hospital_services'];
	$hos_capacity = $rowpro['hospital_capacity'];
	$hos_phone = $rowpro['phone'];
	$hos_email = $rowpro['email'];
	$hos_web = $rowpro['web'];
	$isCom = $rowpro['published'];
}

if(!empty($hos_streetname) && !empty($hos_town) && !empty($hos_postcode) )
	$hos_address =$hos_streetno."-".$hos_streetname."/ ".$hos_town."-".$hos_postcode;

$hos_contacts="";
$hos_map ="";
$lat = "";
$lng ="";
if(empty($hos_email) && empty($hos_web)){
	$hos_contacts = $hos_phone;
}else if(empty($hos_email)){
	$hos_contacts = $hos_phone." | ".$hos_web;
}else if(empty($hos_web)){
	$hos_contacts = $hos_phone." | ".$hos_email;
}else{
	$hos_contacts = $hos_phone." | ".$hos_email." | ".$hos_web;
}
$hos_serv = $hos_service;
$latlng_query = mysqli_query($db_conx,"SELECT * FROM doctors_chambers WHERE doctor_id='$log_id' AND main_hospital='1' LIMIT 1");
while($latlng_row = mysqli_fetch_assoc($latlng_query)){
	$lat = $latlng_row['lat'];
	$lng = $latlng_row['lng'];
}
if($lat == 0 && $lng == 0){
	$hos_map = "Not set";
}else{
	$hos_map = "Lat:".$lat." Lng:".$lng;
}

if(!empty($hos_name) && !empty($hos_streetname) && !empty($hos_town) && !empty($hos_city) && !empty($hos_postcode) && !empty($hos_phone)){
	$sqlupdate = "UPDATE doctors_professional SET updated='1' WHERE doctor_id='$log_id' LIMIT 1";
	$queryupdate = mysqli_query($db_conx, $sqlupdate);
}
/****************************************************************************************************/
/**************************************                                 *****************************/
/************************************** Professional Section End Here   *****************************/
/**************************************                                 *****************************/
/****************************************************************************************************/

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="images/boiddo-band.png" />
	<title><?php echo $title;?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="description" content="Online doctor and hospitals whats you need while trubling. Find your nearest hospital, get information about doctors and hospitals. Get serial of them... and many more option what you need.">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/styles.fb.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script src="js/main.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="box">
			<div class="row row-offcanvas row-offcanvas-left">
				<?php include_once("dr-header.php");?>
				<div class="padding">
					<div class="full col-sm-9 col-xs-12">
						<!-- content -->                      
						<div class="row">
							<!-- main col right -->
							<div class="col-sm-7 col-xs-12">

								<?php if($publish != 1) { ?>

								<div id="war-alert">
									<div class="alert alert-danger" role="alert">
										<button id="alt-bton" type="button" class="close" aria-label="Close"></button>
										<p id="altr-text"><h4><strong>Not completed !</strong></h4>Required all fields are not filled yet. Please change photo, fill up hospital name, address, city, service, patient capacity and emergency phone number. Once fill up all required fields you need to press publish now button to publish yourself.</p>
									</div>
								</div>

								<?php } ?>

								<!--Personal Details Start Here-->
								<div id="per" class="panel panel-default">
									<div>
										<div class="panel-heading"><h4>Personal Details<span id="published-infodr"></span><?php if($publish==1){?><span class="pull-right" style="color:green;">Published</span><?php }?></h4></div>
										<div class="list-group">

											<div class="row">
												<div class="col-sm-3 col-sx-5 paddingfive">
													<?php echo $profile_pic; ?>
												</div>
												<div class="col-sm-3 col-xs-6 paddingfive">
													<?php echo $avatar_form; ?><?php echo  $profile_pic_btn; ?>
												</div>
											</div>

											<button id="nameedit" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>Name</strong></div> 
													<div id="dr-name" class="col-xs-7 col-sm-7 col-md-8"><?php echo $fullname; ?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>

											<form id="name" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px"><strong>Name</strong></p>
												<p></p>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">First name</div>
													<div class="col-xs-6 col-sm-5 input-group">
														
														<span class="input-group-addon" id="basic-addon1">Dr.</span>
														<input id="firstname" type="text" class="form-control" aria-describedby="basic-addon1" required>
														
														
													</div>
													<div class="col-sm-offset-5">
														<span id="firstnamespan"></span>
													</div>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Middle name</div>
													<div class="col-xs-6 col-sm-5">
														<input id="middlename" type="text" class="form-control" placeholder="Optional">
													</div>
													<div class="col-sm-offset-5">
														<span id="middlenamespan"></span>
													</div>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Last name</div>
													<div class="col-xs-6 col-sm-5">
														<input id="lastname" type="text" class="form-control" required>
													</div>
													<div class="col-sm-offset-5">
														<span id="lastnamespan"></span>
													</div>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="nameBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="nameBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>
											</form>

											<button id="degreeedit" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>Degrees & Courses</strong></div> 
													<div id="dr-degree" class="col-xs-7 col-sm-7 col-md-8"><?php echo $olddegree;?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>

											<form id="degree" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px"><strong>Degrees & Courses</strong></p>
												<br>
												<div class="row">
													<div class="col-xs-4 col-sm-4 col-md-4">
														<br>
														<button id="rmv-degree-btn" class="btn btn-danger pull-right btn-xs" type="button">Remove</button>
													</div>
													<div class="col-xs-8 col-sm-8 col-md-8">
														<br>
														<p id="old-degree"><?php echo $olddegree;?></p>

													</div>
													
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Degree</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="degreesncourse" type="text" class="form-control">
													</div>
													<div class="col-xs-offset-5"><span id="degreespan"></span></div>
												</div>
												<br>
												<div class="row">
													<div class="col-xs-offset-4 col-xs-8 col-sm-offset-4 col-sm-6 col-md-offset-4 col-md-4">
														<select id="selectyear" class="form-control"> 
															<option>Passing Year</option>
															<option>2015</option>       
															<option>2014</option>       
															<option>2013</option>       
															<option>2012</option>       
															<option>2011</option>       
															<option>2010</option>
															<option>2009</option>       
															<option>2008</option>       
															<option>2007</option>       
															<option>2006</option>       
															<option>2005</option>       
															<option>2004</option>
															<option>2003</option>       
															<option>2002</option>       
															<option>2001</option>       
															<option>2000</option>
															<option>1999</option>
															<option>1998</option>
															<option>1997</option>
															<option>1996</option>
															<option>1995</option>
															<option>1994</option>
															<option>1993</option>
															<option>1992</option>
															<option>1991</option>
															<option>1990</option>
															<option>1989</option>
															<option>1988</option>
															<option>1987</option>
															<option>1986</option>
															<option>1985</option>
															<option>1984</option>
															<option>1983</option>
															<option>1982</option>
															<option>1981</option>
															<option>1980</option>
															<option>1979</option>
															<option>1978</option>
															<option>1977</option>
															<option>1976</option>
															<option>1975</option>
															<option>1974</option>
															<option>1973</option>
															<option>1972</option>
															<option>1971</option>
															<option>1970</option>
															<option>1969</option>
															<option>1968</option>
															<option>1967</option>
															<option>1966</option>
															<option>1965</option>
															<option>1964</option>
															<option>1963</option>
															<option>1962</option>
															<option>1961</option>
															<option>1960</option>
															<option>1959</option>
															<option>1958</option>
															<option>1957</option>
															<option>1956</option>
															<option>1955</option>
															<option>1954</option>
															<option>1953</option>
															<option>1952</option>
															<option>1951</option>
															<option>1950</option>    
														</select> 
													</div>
													<div class="col-xs-offset-5"><span id="yearspan"></span></div>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="degreeBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="degreeBtnSave" class="btn btn-primary pull-right" type="button">Add</button>
													</div>
												</div>
												<br>
											</form>

											<button id="emailedit" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>Email</strong></div> 
													<div id="dr-email" class="col-xs-7 col-sm-7 col-md-8"><?php echo $oldemail;?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>
											<form id="email" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px;"><strong>Email</strong></p>
												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Email</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="newemail" type="text" class="form-control">
													</div>
													<span id="email-span"></span>
												</div>
												<br>

												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current Email</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<span style="color: blue" id="emailview"><?php echo $oldemail;?></span>
													</div>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="emailBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="emailBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>
											</form>

											<button id="addressedit" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>Address</strong></div> 
													<div id="dr-address" class="col-xs-7 col-sm-7 col-md-8"><?php echo $address;?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>

											<form id="address" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px"><strong>Address</strong></p>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current Address</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<span style="color: blue" id="addview"><?php echo $address;?></span>
													</div>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">House No.</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="houseno" type="text" class="form-control" placeholder="Optional">
													</div>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">House Name</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="housename" type="text" class="form-control" placeholder="Optional">
													</div>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Street No.</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="streetno" type="text" class="form-control" placeholder="Optional">
													</div>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Street Name</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="streetname" type="text" class="form-control" required>
													</div>
													<span id="streetname-span"></span>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Town/Locality</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="town" type="text" class="form-control" required>
													</div>
													<span id="town-span"></span>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="addressBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="addressBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>

											</form>

											<button id="cityedit" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>City</strong></div> 
													<div id="dr-city" class="col-xs-7 col-sm-7 col-md-8"><?php echo $city;?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>
											<form id="city" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px;"><strong>City</strong></p>

												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current City</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<span style="color: blue" id="cityview"><?php echo $city;?></span>
													</div>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Change City</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="newcity" type="text" class="form-control" required>
													</div>
													<span id="city-span"></span>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Change Postcode</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="newpost" type="text" class="form-control" placeholder="Optional">
													</div>
													<span id="post-span"></span>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="cityBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="cityBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>
											</form>

											<button id="phoneedit" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>Phone</strong></div> 
													<div id="dr-phone" class="col-xs-7 col-sm-7 col-md-8"><?php echo $phone; ?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>
											<form id="phone" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px;"><strong>Phone</strong> (Optional)</p>

												<br>
												<div class="row">
													<div id="phone-span" class="col-xs-offset-4 col-sm-offset-4 col-md-offset-4 col-xs-8 col-sm-6 col-md-4"></div>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">add new</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="newphone" type="text" class="form-control" placeholder="Optional">
													</div>
												</div>
												<div class="row">
													<p></p>
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current Phone no.</div>

													<div class="col-xs-8 col-sm-6 col-md-4">
														<p style="color: blue" id="phoneview"><?php echo $phone; ?></p>
													</div>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="phoneBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="phoneBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>
											</form>

										</div>
									</div>
								</div>
								<!--Personal Details End Here-->

								<!--******************************************************************************************************-->
								<!--***************************                                   ****************************************-->
								<!--***************************  Professional Details Start Here  ********************************************-->
								<!--***************************                                   ****************************************-->
								<!--******************************************************************************************************-->

								<div id="pro" class="panel panel-default">
									<div>
										<div class="panel-heading"><h4>Professional Details<?php if($publish==1){?><span class="pull-right" style="color:green;">Published</span><?php }?></h4></div>
										<div class="list-group">

											<button id="hospitaledit" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>Hospital</strong></div> 
													<div id="dr-hos-name" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_name;?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>

											<form id="hospital" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px"><strong>Hospital</strong></p>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current Hospital </div>
													<span style="color: blue;" id="hos-name-view"><?php echo $hos_name;?></span>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-4 col-sm-4 col-md-4 text-right">Hospital Name</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="hospital-name" type="text" class="form-control">
													</div>
													<div class="col-xs-offset-5"><span id="hos-name-span"></span></div>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-4 col-sm-4 col-md-4 text-right">My Room no.</div>
													<span style="color: blue;" id="hos-room-view"><?php echo $room_no;?></span>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Change Room no.</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="hospital-room" type="text" class="form-control" placeholder="Optional">
													</div>

												</div>

												<br>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="hospitalBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="hospitalBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>
											</form>

											<button id="hosaddressedit" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>Hospital Address</strong></div> 
													<div id="dr-hos-add" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_address;?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>
											<form id="hospitaladdress" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px;"><strong>Hospital Address</strong></p>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current Hospital Address </div>
													<span style="color: blue;" id="hos-add-view"><?php echo $hos_address;?></span>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-4 col-sm-4 col-md-4 text-right">Street no.</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="hos-streetno" type="text" class="form-control" placeholder="optional">
													</div>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-4 col-sm-4 col-md-4 text-right">Street name</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="hos-streetname" type="text" class="form-control">
													</div>
													<div class="col-xs-offset-5"><span id="hos-streetname-span"></span></div>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-4 col-sm-4 col-md-4 text-right">Town</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="hos-town" type="text" class="form-control">
													</div>
													<div class="col-xs-offset-5"><span id="hos-town-span"></span></div>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-4 col-sm-4 col-md-4 text-right">Postcode</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="hos-postcode" type="text" class="form-control">
													</div>
													<div class="col-xs-offset-5"><span id="hos-postcode-span"></span></div>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="hosaddressBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="hosaddressBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>
											</form>

											<button id="hoscityedit" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>City</strong></div> 
													<div id="hos-city-pro" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_city;?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>
											<form id="hoscity" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px;"><strong>City</strong></p>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current City: </div>
													<span style="color: blue;" id="hoscity-view"><?php echo $hos_city;?></span>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-4 col-sm-4 col-md-4 text-right">City</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="hosnewcity" type="text" class="form-control">
													</div>
													<div class="col-xs-offset-5"><span id="hoscity-span"><?php ?></span></div>
												</div>
												<br>
												<div class="row">
													<div class="col-xs-4 col-sm-4 col-md-4 text-right">Country</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<select id="hosnewcountry" class="form-control">
															<option value="failed">Country of this hospital</option>
															<option value="AF">Afghanistan</option>
															<option value="AX">Åland Islands</option>
															<option value="AL">Albania</option>
															<option value="DZ">Algeria</option>
															<option value="AS">American Samoa</option>
															<option value="AD">Andorra</option>
															<option value="AO">Angola</option>
															<option value="AI">Anguilla</option>
															<option value="AQ">Antarctica</option>
															<option value="AG">Antigua and Barbuda</option>
															<option value="AR">Argentina</option>
															<option value="AM">Armenia</option>
															<option value="AW">Aruba</option>
															<option value="AU">Australia</option>
															<option value="AT">Austria</option>
															<option value="AZ">Azerbaijan</option>
															<option value="BS">Bahamas</option>
															<option value="BH">Bahrain</option>
															<option value="BD">Bangladesh</option>
															<option value="BB">Barbados</option>
															<option value="BY">Belarus</option>
															<option value="BE">Belgium</option>
															<option value="BZ">Belize</option>
															<option value="BJ">Benin</option>
															<option value="BM">Bermuda</option>
															<option value="BT">Bhutan</option>
															<option value="BO">Bolivia</option>
															<option value="BQ">Bonaire</option>
															<option value="BA">Bosnia and Herzegovina</option>
															<option value="BW">Botswana</option>
															<option value="BV">Bouvet Island</option>
															<option value="BR">Brazil</option>
															<option value="BN">Brunei Darussalam</option>
															<option value="BG">Bulgaria</option>
															<option value="BF">Burkina Faso</option>
															<option value="BI">Burundi</option>
															<option value="KH">Cambodia</option>
															<option value="CM">Cameroon</option>
															<option value="CA">Canada</option>
															<option value="CV">Cape Verde</option>
															<option value="KY">Cayman Islands</option>
															<option value="CF">Central African Republic</option>
															<option value="TD">Chad</option>
															<option value="CL">Chile</option>
															<option value="CN">China</option>
															<option value="CX">Christmas Island</option>
															<option value="CC">Cocos (Keeling) Islands</option>
															<option value="CO">Colombia</option>
															<option value="KM">Comoros</option>
															<option value="CG">Congo</option>
															<option value="CK">Cook Islands</option>
															<option value="CR">Costa Rica</option>
															<option value="CI">Côte d'Ivoire</option>
															<option value="HR">Croatia</option>
															<option value="CU">Cuba</option>
															<option value="CW">Curaçao</option>
															<option value="CY">Cyprus</option>
															<option value="CZ">Czech Republic</option>
															<option value="DK">Denmark</option>
															<option value="DJ">Djibouti</option>
															<option value="DM">Dominica</option>
															<option value="DO">Dominican Republic</option>
															<option value="EC">Ecuador</option>
															<option value="EG">Egypt</option>
															<option value="SV">El Salvador</option>
															<option value="GQ">Equatorial Guinea</option>
															<option value="ER">Eritrea</option>
															<option value="EE">Estonia</option>
															<option value="ET">Ethiopia</option>
															<option value="FK">Falkland Islands</option>
															<option value="FO">Faroe Islands</option>
															<option value="FJ">Fiji</option>
															<option value="FI">Finland</option>
															<option value="FR">France</option>
															<option value="GA">Gabon</option>
															<option value="GM">Gambia</option>
															<option value="GE">Georgia</option>
															<option value="DE">Germany</option>
															<option value="GH">Ghana</option>
															<option value="GI">Gibraltar</option>
															<option value="GR">Greece</option>
															<option value="GL">Greenland</option>
															<option value="GD">Grenada</option>
															<option value="GP">Guadeloupe</option>
															<option value="GU">Guam</option>
															<option value="GT">Guatemala</option>
															<option value="GG">Guernsey</option>
															<option value="GN">Guinea</option>
															<option value="GW">Guinea-Bissau</option>
															<option value="GY">Guyana</option>
															<option value="HT">Haiti</option>
															<option value="HN">Honduras</option>
															<option value="HK">Hong Kong</option>
															<option value="HU">Hungary</option>
															<option value="IS">Iceland</option>
															<option value="IN">India</option>
															<option value="ID">Indonesia</option>
															<option value="IR">Iran</option>
															<option value="IQ">Iraq</option>
															<option value="IE">Ireland</option>
															<option value="IM">Isle of Man</option>
															<option value="IL">Israel</option>
															<option value="IT">Italy</option>
															<option value="JM">Jamaica</option>
															<option value="JP">Japan</option>
															<option value="JE">Jersey</option>
															<option value="JO">Jordan</option>
															<option value="KZ">Kazakhstan</option>
															<option value="KE">Kenya</option>
															<option value="KI">Kiribati</option>
															<option value="KR">Korea</option>
															<option value="KW">Kuwait</option>
															<option value="KG">Kyrgyzstan</option>
															<option value="LV">Latvia</option>
															<option value="LB">Lebanon</option>
															<option value="LS">Lesotho</option>
															<option value="LR">Liberia</option>
															<option value="LY">Libya</option>
															<option value="LI">Liechtenstein</option>
															<option value="LT">Lithuania</option>
															<option value="LU">Luxembourg</option>
															<option value="MO">Macao</option>
															<option value="MK">Macedonia</option>
															<option value="MG">Madagascar</option>
															<option value="MW">Malawi</option>
															<option value="MY">Malaysia</option>
															<option value="MV">Maldives</option>
															<option value="ML">Mali</option>
															<option value="MT">Malta</option>
															<option value="MH">Marshall Islands</option>
															<option value="MQ">Martinique</option>
															<option value="MR">Mauritania</option>
															<option value="MU">Mauritius</option>
															<option value="YT">Mayotte</option>
															<option value="MX">Mexico</option>
															<option value="FM">Micronesia</option>
															<option value="MD">Moldova</option>
															<option value="MC">Monaco</option>
															<option value="MN">Mongolia</option>
															<option value="ME">Montenegro</option>
															<option value="MS">Montserrat</option>
															<option value="MA">Morocco</option>
															<option value="MZ">Mozambique</option>
															<option value="MM">Myanmar</option>
															<option value="NA">Namibia</option>
															<option value="NR">Nauru</option>
															<option value="NP">Nepal</option>
															<option value="NL">Netherlands</option>
															<option value="NC">New Caledonia</option>
															<option value="NZ">New Zealand</option>
															<option value="NI">Nicaragua</option>
															<option value="NE">Niger</option>
															<option value="NG">Nigeria</option>
															<option value="NU">Niue</option>
															<option value="NF">Norfolk Island</option>
															<option value="MP">Northern Mariana Islands</option>
															<option value="NO">Norway</option>
															<option value="OM">Oman</option>
															<option value="PK">Pakistan</option>
															<option value="PW">Palau</option>
															<option value="PS">Palestinian</option>
															<option value="PA">Panama</option>
															<option value="PG">Papua New Guinea</option>
															<option value="PY">Paraguay</option>
															<option value="PE">Peru</option>
															<option value="PH">Philippines</option>
															<option value="PN">Pitcairn</option>
															<option value="PL">Poland</option>
															<option value="PT">Portugal</option>
															<option value="PR">Puerto Rico</option>
															<option value="QA">Qatar</option>
															<option value="RO">Romania</option>
															<option value="RU">Russian Federation</option>
															<option value="RW">Rwanda</option>
															<option value="BL">Saint Barthélemy</option>
															<option value="KN">Saint Kitts and Nevis</option>
															<option value="LC">Saint Lucia</option>
															<option value="WS">Samoa</option>
															<option value="SM">San Marino</option>
															<option value="SA">Saudi Arabia</option>
															<option value="SN">Senegal</option>
															<option value="RS">Serbia</option>
															<option value="SC">Seychelles</option>
															<option value="SL">Sierra Leone</option>
															<option value="SG">Singapore</option>
															<option value="SK">Slovakia</option>
															<option value="SI">Slovenia</option>
															<option value="SB">Solomon Islands</option>
															<option value="SO">Somalia</option>
															<option value="ZA">South Africa</option>
															<option value="SS">South Sudan</option>
															<option value="ES">Spain</option>
															<option value="LK">Sri Lanka</option>
															<option value="SD">Sudan</option>
															<option value="SR">Suriname</option>
															<option value="SZ">Swaziland</option>
															<option value="SE">Sweden</option>
															<option value="CH">Switzerland</option>
															<option value="SY">Syrian</option>
															<option value="TW">Taiwan</option>
															<option value="TJ">Tajikistan</option>
															<option value="TZ">Tanzania</option>
															<option value="TH">Thailand</option>
															<option value="TL">Timor-Leste</option>
															<option value="TG">Togo</option>
															<option value="TK">Tokelau</option>
															<option value="TO">Tonga</option>
															<option value="TT">Trinidad and Tobago</option>
															<option value="TN">Tunisia</option>
															<option value="TR">Turkey</option>
															<option value="TM">Turkmenistan</option>
															<option value="TV">Tuvalu</option>
															<option value="UG">Uganda</option>
															<option value="UA">Ukraine</option>
															<option value="AE">United Arab Emirates</option>
															<option value="GB">United Kingdom</option>
															<option value="US">United States</option>
															<option value="UY">Uruguay</option>
															<option value="UZ">Uzbekistan</option>
															<option value="VU">Vanuatu</option>
															<option value="VE">Venezuela</option>
															<option value="VN">Viet Nam</option>
															<option value="WF">Wallis and Futuna</option>
															<option value="EH">Western Sahara</option>
															<option value="YE">Yemen</option>
															<option value="ZM">Zambia</option>
															<option value="ZW">Zimbabwe</option>
														</select>
													</div>
													<div class="col-xs-offset-5"><span id="hoscountry-span"><?php ?></span></div>
												</div>
												<p></p>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="hoscityBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="hoscityBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>
											</form>

											<button id="hosmapedit" onclick="initMap()" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>Map</strong></div> 
													<div id="hos-city-pro" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_map; ?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>
											<form id="hosmap" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px;"><strong>Map</strong></p>

												<?php echo '<p id="lat" class="hidden">'.$lat.'</p>';
												echo '<p id="lng" class="hidden">'.$lng.'</p>';?>
												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Find Location: </div>
													<div class="col-xs-8 col-sm-6 col-md-6">
														<?php echo '<input id="hosmap-input" type="text" class="form-control" placeholder="'."Name, City, Country".'">';?>
													</div>
												</div>

												<br>
												<div class="row">
													<div style="margin-left:28px" class="col-sm-2"><b>Map</b></div>
													<div id="hosmap-canvas" class="col-sm-offset-2 col-sm-8" style="height: 250px;"></div>
													<div style="width:500px" id="hosmap-view" class="col-sm-12"></div>
													<div class="col-sm-offset-2 col-sm-4">
														<button id="hosmapBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="hosmapBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>
											</form>

											<button id="hosserviceedit" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>Hospital Services</strong></div> 
													<div id="stored-services" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_serv;?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>
											<form id="hosservice" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px;"><strong>Hospital Services</strong></p>
												<br>

												<div style="margin: 2px;" class="row">
													<div class="col-xs-4 col-sm-4 col-md-4">
														<p></p>
														<button id="rmv-service-btn" class="btn btn-danger pull-right btn-xs" type="button">Remove all</button>
													</div>
													<div class="col-xs-8 col-sm-8 col-md-8">
														<p id="old-services"><?php echo $hos_serv;?></p>
													</div>
												</div>

												<div class="row">


													<div id="newservices" class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
														<p id="newservice" value="1">
															<div id="addservice">
															</div>

														</p>
													</div>

													<br>
													<div style="text-align: right;" class="col-xs-3 col-sm-3 col-md-4">Add New</div>
													<div class="col-xs-6 col-sm-6 col-md-4">
														<select id="selectservice" class="form-control"> 
															<option id="zero" value="zero">add services</option>
															<option id="a-one" value="a-one">Anaesthetics</option>
															<option id="a-two" value="a-two">Breast screening</option>
															<option id="a-three" value="a-three">Cardiology</option>
															<option id="a-four" value="a-four">Chaplaincy</option>
															<option id="a-five" value="a-five">Critical care</option>
															<option id="a-six" value="a-six">Diagnostic imaging</option>
															<option id="a-seven" value="a-seven">Discharge lounge</option>
															<option id="a-eight" value="a-eight">Ear nose and throat (ENT)</option>
															<option id="a-nine" value="a-nine">Elderly services department</option>
															<option id="a-ten" value="a-ten">Emergency</option>
															<option id="b-one" value="b-one">Gastroenterology</option>
															<option id="b-two" value="b-two">General surgery</option>
															<option id="b-three" value="b-three">Gynaecology</option>
															<option id="b-four" value="b-four">Haematology</option>
															<option id="b-five" value="b-five">Maternity departments</option>
															<option id="b-six" value="b-six">Microbiology</option>
															<option id="b-seven" value="b-seven">Neonatal unit</option>
															<option id="b-eight" value="b-eight">Nephrology</option>
															<option id="b-nine" value="b-nine">Neurology</option>
															<option id="b-ten" value="b-ten">Nutrition and dietetics</option>
															<option id="c-one" value="c-one">Obstetrics and gynaecology</option>
															<option id="c-two" value="c-two">Occupational therapy</option>
															<option id="c-three" value="c-three">Oncology</option>
															<option id="c-four" value="c-four">Ophthalmology</option>
															<option id="c-five" value="c-five">Orthopaedics</option>
															<option id="c-six" value="c-six">Pin management clinics</option>
															<option id="c-seven" value="c-seven">Pharmacy</option>
															<option id="c-eight" value="c-eight">Physiotherapy</option>
															<option id="c-nine" value="c-nine">Radiotherapy</option>
															<option id="c-ten" value="c-ten">Renal unit</option>
															<option id="d-one" value="d-one">Rheumatology</option>
															<option id="d-two" value="d-two">Sexual health</option>
															<option id="d-three" value="d-three">Urology</option>
														</select>
													</div>


												</div>


												<br>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="hosserviceBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="hosserviceBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>

											</form>

											<button id="hoscapacityedit" class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>Hospital Capacity</strong></div> 
													<div id="dr-hoscapacity" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_capacity;?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>
											<form id="hoscapacity" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px;"><strong>Hospital Capacty</strong></p>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current Capacity: </div>
													<span style="color: blue;" id="hoscapacity-view"><?php echo $hos_capacity;?></span>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Capacity</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="hos-capacity" type="text" class="form-control">
													</div>
													<div class="col-xs-offset-5"><span id="capacity-span"></span></div>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="capacityBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="capacityBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>
											</form>

											<button id="hoscontactsedit"class="list-group-item">
												<div class="row">
													<div class="col-xs-3 col-sm-3 col-md-3"><strong>Hospital Contacts</strong></div> 
													<div id="dr-hoscontacts" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_contacts;?></div> 
													<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
												</div>
											</button>

											<form id="hospitalcontacts" class="form-horizontal form-group-sm" role="form">
												<p style="margin:16px 0px 0px 32px;"><strong>Hospital Contacts</strong></p>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current Capacity: </div>
													<span style="color: blue;" id="hoscontacts-view"><?php echo $hos_contacts;?></span>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Phone</div>
													<div class="col-xs-8 col-sm-6 col-md-4">
														<input id="hosphone" type="text" class="form-control">
													</div>
													<div class="col-xs-offset-5"><span id="hosphone-span"></span></div>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Email</div>
													<div class="col-xs-4 col-sm-4 col-md-4">
														<input id="hosemail" type="text" class="form-control" placeholder="Optional">
													</div>
													<div class="col-xs-offset-5"><span id="hosemail-span"></span></div>
												</div>

												<br>
												<div class="row">
													<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Web</div>
													<div class="col-xs-4 col-sm-4 col-md-4">
														<input id="hosweb" type="text" class="form-control" placeholder="Optional">
													</div>
													<div class="col-xs-offset-5"><span id="hosweb-span"></span></div>
												</div>

												<br>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
														<button id="hoscontactBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
														<button id="hoscontactBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
													</div>
												</div>
												<br>
											</form>

										</div>
									</div>
								</div>

								<?php if($publish != 1){?>
								<button id="bton-publish" class="btn btn-success btn-md pull-right" style="margin-top:-10px;margin-bottom:15px;">Publish Now</button>
								<?php }?>                              <!--Professional Details End Here-->

							</div>
						</div><!--/row-->

					</div><!-- /col-9 -->
				</div><!-- /padding -->


			</div>

			<!-- /main -->
		</div>

		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script> -->
		<script src="js/scripts.fb.js"></script>
		<script src="js/setting.expand.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js?sensor=false&signed_in=true&libraries=places"></script>
		<!-- <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAyGxHm8crHWJjggCtuj4dKnFwBJ0nxzYY"></script> -->
		<script type="text/javascript">

			/*********************Right icon section start here****************************/
			$("#settingsactive").addClass("glyphicon glyphicon-chevron-right");
			$("#planetactive").removeClass("glyphicon glyphicon-chevron-right");
			$("#messageactive").removeClass("glyphicon glyphicon-chevron-right");
			$("#doctorsactive").removeClass("glyphicon glyphicon-chevron-right");
			$("#sub-items").css("display","block");

			$("#click-per").click(function(){
				$("#settingsactive").addClass("glyphicon glyphicon-chevron-right");
				$("#settingsproactive").removeClass("glyphicon glyphicon-chevron-right");
				$("#settingssetactive").removeClass("glyphicon glyphicon-chevron-right");
			});
			$("#click-pro").click(function(){
				$("#settingsproactive").addClass("glyphicon glyphicon-chevron-right");
				$("#settingsactive").removeClass("glyphicon glyphicon-chevron-right");
				$("#settingssetactive").removeClass("glyphicon glyphicon-chevron-right");
			});
			$("#click-set").click(function(){
				$("#settingssetactive").addClass("glyphicon glyphicon-chevron-right");
				$("#settingsproactive").removeClass("glyphicon glyphicon-chevron-right");
				$("#settingsactive").removeClass("glyphicon glyphicon-chevron-right");
			});


			/*********************************** Hospital Service Section Start Here *********************************/



			var hiddenids = [];
			var temp_service = [];
			var ids_text = [];
			var new_service = [];
			var new_id_text = [];
			var new_id = [];
			var count = 0;
			var newpin = document.getElementById("newservice");

			$('#hosserviceedit').click(function(){
				var selectAction = "hos_ser";
				
				hiddenids.length = 0;
				temp_service.length = 0;
				ids_text.length = 0;
				new_service.length = 0;
				new_id_text.length = 0;
				new_id.length = 0;

				$.post("doctors-personal.php",{selectaction: selectAction},function(data){
					var ndata = $.parseJSON(data);
					var len =  ndata.length;
					var k = 0;
					while(k < len){
						$('#'+ndata[k]).css('display','none');
						hiddenids.push(ndata[k]);
						temp_service.push(" "+ndata[k+1]);
						ids_text.push(ndata[k]+"/"+ndata[k+1]);
						k+=2;
					}
        //$("#old-services").text("");
        $("#old-services").text(temp_service).css('color','blue');
        $("#rmv-service-btn").css('display','block');
    });
				
			});

			$("#rmv-service-btn").click(function(){

				var l = hiddenids.length;
				while(l>=0){
					$("#"+hiddenids[l]).css('display','block');
					l--;
				}
				$("#old-services").text("");
				$("#rmv-service-btn").css('display','none');

				hiddenids.length = 0;
				temp_service.length = 0;
				ids_text.length = 0;
				count = 0;
			});


			$('#selectservice').change(function () {

				var selected = $("#selectservice option:selected").text();
				var ids = $("#selectservice option:selected").val();

				if(selected != "add services"){
					new_id_text.push(ids+"/"+selected);
					new_service.push(" "+selected);
					new_id.push(ids);
					hiddenids.push(ids);
					addnew('button',selected);
					$("#selectservice option:selected").css("display","none");
				}
			});

			function addnew(type,value) {
    //Create an input type dynamically.   
    
    var div = document.createElement("div");
    div.className = "btn-group";

    var newbutton = document.createElement("button");
    newbutton.className = "btn btn-primary btn-xs";

    var newclosebutton = document.createElement("button");
    //newclosebutton.classList.add('btn btn-danger btn-xs marginright');
    newclosebutton.className = "btn btn-primary btn-xs marginright";

    newbutton.innerHTML = value;

    var newspan = document.createElement("span");
    newspan.className = "glyphicon glyphicon-remove";

    newbutton.type = type;
    newclosebutton.appendChild(newspan);
    newclosebutton.value = count;

    //Append the element in page (in span).  
    div.appendChild(newbutton);
    div.appendChild(newclosebutton);
    newpin.appendChild(div);
    //alert(value);
    newclosebutton.onclick = function() {
    	newpin.removeChild(div);
    	count--;

    	var index = new_service.indexOf(" "+value);
        //var index = count;
        alert(new_id[index]);
        new_service.splice(index, 1);
        $("#"+new_id[index]).css("display","block");
        hiddenids.splice(index, 1);
        new_id_text.splice(index, 1);
        new_id.splice(index, 1);
        
    }
    count++;
}


$('#hosserviceBtnSave').click(function(){
	var selectAction = "hos_ser_save";
	var m = 0;
	while(m < new_service.length){
		temp_service.push(new_service[m]);
		ids_text.push(new_id_text[m]);
		m++;
	}

	$("#old-services").text("");
	if(temp_service[0] == " empty"){
		ids_text.splice(0, 1);
		temp_service.splice(0, 1);
	}
	$.post("doctors-personal.php",{
		selectaction: selectAction,
		idntext: ids_text,
		service: temp_service
	},function(data){
        //alert(data);
        if(data == "error"){
        	alert(data);
        }else{
        	$('#stored-services').html("");
        	$('#stored-services').html(data);
        	
        }
    });
	hiddenids.length = 0;
	temp_service.length = 0;
	ids_text.length = 0;
	new_service.length = 0;
	new_id_text.length = 0;
	new_id.length = 0;
});

$('#hosserviceBtnCancel').click(function(){
	count = 0;
	var i = (hiddenids.length)-1;
	while (newpin.firstChild) {
		newpin.removeChild(newpin.firstChild);
		$("#"+hiddenids[i]).css("display","block");
		hiddenids.splice(i, 1);
		i--;
	}
	hiddenids.length = 0;
	new_service.length = 0;
	new_id_text.length = 0;
	new_id.length = 0;
	temp_service.length = 0;
	ids_text.length = 0;
});

/*********************************** Hospital Service Section End Here************************************/

/*********************************** Hospital Maps Partial Section Start Here************************************/
// var map;
// var geocoder;
// function initialize(){
//     var mylatlng = new google.maps.LatLng(24.011644,89.346654);
//     var myOptions = {
//         zoom: 10,
//         center: mylatlng,
//         mapTypeId: google.maps.MapTypeId.ROADMAP
//     };
//     map = new google.maps.Map(document.getElementById("hosmap-canvas"),myOptions);
//     geocoder = new google.maps.Geocoder();
// }
var lat = $("#lat").text();
var lng = $("#lng").text();
var newaddress = "";
// function initialize(){
//     var autocomplete = new google.maps.places.Autocomplete(document.getElementById('hosmap-input'));
//     google.maps.event.addListener(autocomplete,'place_changed',function(){
//         var places=autocomplete.getplace();
//         var location = "<b>Location</b>"+places.formatted_address+"<br>";
//         location+ = "<b>Latitude</b>"+places.geometry.location.A+"<br>";
//         location+ = "<b>Longitude</b>"+places.geometry.location.F+"<br>";
//         document.getElementById('hosmap-view').innerHTML = location
//     });
// };

function initMap() {
	alert("Lat:"+lat+" Lng:"+lng);
	var map = new google.maps.Map(document.getElementById('hosmap-canvas'), {
		center: {lat: -33.8688, lng: 151.2195},
		zoom: 13
	});
	var input = /** @type {!HTMLInputElement} */(
		document.getElementById('hosmap-input'));

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


/************************************Hospital Maps Partial Section End Here*******************************/

/*************************************** Fullname Section Start Here *************************************/
$(document).ready(function() {

	$('#nameBtnSave').click(function(){
		var selectAction = "savename";
		var firstnam = $('#firstname').val();
		var middlenam = $('#middlename').val();
		var lastnam = $('#lastname').val();

		if((firstnam.length)<2 || (lastnam.length)<2){
			$('#namespan').html('firstname or lastname is too short!');
			alert('short length');
		}else{

			$.post("doctors-personal.php", {
				selectaction: selectAction,
				firstname: firstnam,
				middlename: middlenam,
				lastname: lastnam
			},function(data) {
              //alert(data);
              var iserror = data.indexOf("error occured");
              var tooshort = data.indexOf("first too short");
              var lasttooshort = data.indexOf("last too short");
              var firstwrong = data.indexOf("first wrong input!");
              var middlewrong = data.indexOf("middle wrong input!");
              var lastwrong = data.indexOf("last wrong input!");
              var firstnumber = data.indexOf("number on first start!");
              var middlenumber = data.indexOf("number on middle start!");
              var lastnumber = data.indexOf("number on last start!");

              if(firstwrong>=0 || firstnumber>=0){
              	$('#firstnamespan').html("wrong input!").css('color','red');
              }else if(middlewrong>=0 || middlenumber>=0){
              	$('#middlenamespan').html("wrong input!").css('color','red');
              }else if(lastwrong>=0 || lastnumber>=0){
              	$('#lastnamespan').html("wrong input!").css('color','red');
              }else if(tooshort>=0){
              	$('#firstnamespan').html("too short!").css('color','red');
              }else if(lasttooshort>=0){
              	$('#lastnamespan').html("too short!").css('color','red');
              }else if(iserror>=0){
              	$('#lastnamespan').html("error occured!").css('color','red');
              }else{
              	$('#firstnamespan').html("");
              	$('#middlenamespan').html("");
              	$('#lastnamespan').html("");

              	$("firstname").val("");
              	$('#dr-name').html(data);
              	$('#big-name').html(data);
              	invdivhide("name");
              	selectAction = "";
              }
              
              
          });
}    
});
$('#nameBtnCancel').click(function(){
	invdivhide("name");
	$('#firstnamespan').html("");
	$('#middlenamespan').html("");
	$('#lastnamespan').html("");
});
/*************************************** Fullname Section End Here ***************************************/


/************************************** Degree Section Start Here **************************************/
$('#degreeBtnSave').click(function(){
	var selectAction = "savedegree";
	var newdegree = $("#degreesncourse").val();
	var olddegre = $("#old-degree").val();
	var passyear = $("#selectyear option:selected").text();

	if(newdegree==''){
		$('#degreespan').html("required!").css('color','red');
	}else{
		$.post("doctors-personal.php",{
			selectaction: selectAction,
			degree: newdegree,
			year: passyear
		},function(data){
			var isok = data.indexOf('error');
			var isvalid = data.indexOf('required!');
			if(isvalid>=0){
				$('#degreespan').html(data).css('color','red');
			}else if(isok>=0){
				$('#yearspan').html(data).css('color','red');
			}else{
				$("#dr-degree").html(data);
				$("#old-degree").html(data);
				$('#degreespan').html("");
				$('#yearspan').html("");
				passyear.selectedIndex=-1;
				invdivhide("degree");
				selectAction="";
			}
			document.getElementById('degreesncourse').reset();;
            //onclick="this.form.reset();"
            //alert(data);
        });
	}
});
$('#rmv-degree-btn').click(function(){
	var selectAction = "rmvdegree";
	var olddegree = $("#old-degree").val();
	var passyear = $("#selectyear option:selected").text();
	
	$.post("doctors-personal.php",{
		selectaction: selectAction,
		degree: olddegree
	},function(data){
		var isok = data.indexOf('error');
		if(isok>=0){
			$('#degreespan').html(data).css('color','red');
		}else{
			$("#dr-degree").html(data);
			$("#old-degree").html(data);
			$('#degreespan').html("");
			$('#yearspan').html("");
			passyear.selectedIndex=-1;
			selectAction="";
		}
        //alert(data);
    });
});
$('#degreeBtnCancel').click(function(){
	invdivhide('degree');
	$('#degreespan').html("");
	$('#yearspan').html("");
	$('#degreesncourse').value="";
});
/************************************** Degree Section End Here **************************************/

/************************************** Email Section Start Here **************************************/
$('#emailBtnSave').click(function(){
	var selectAction = "saveemail";
	var newemail = $("#newemail").val();
	var oldemail = $("#old-email").val();

	$.post("doctors-personal.php",{
		selectaction: selectAction,
		email: newemail
	},function(data){
		var isok = data.indexOf('error');
		var isvalid = data.indexOf('invalid format!');
		if(isok>=0){
			$('#email-span').html(data).css('color','red');
		}else if(isvalid>=0){
			$('#email-span').html(data).css('color','red');
		}else{
			$("#dr-email").html(data);
			$("#emailview").html(data);
			$("#old-email").html(data);
			$('#email-span').html("");
			invdivhide("email");
			selectAction="";
		}
	});
});

$('#emailBtnCancel').click(function(){
	invdivhide('email');
	$('#email-span').html("");
	$('#newemail').value="";
});
/************************************** Email Section End Here **************************************/

/************************************** Address Section Start Here **************************************/
$('#addressBtnSave').click(function(){
	var selectAction = "saveaddress";
	var houseno = $("#houseno").val();
	var housename = $("#housename").val();
	var streetno = $("#streetno").val();
	var streetname = $("#streetname").val();
	var town = $("#town").val();

	if(streetname.length<3){
		$("#streetname-span").html("required").css('color','red');
	}else if(town.length<3){
		$("#town-span").html("required").css('color','red');
	}else {
		$.post("doctors-personal.php",{
			selectaction: selectAction,
			houseno: houseno,
			housename: housename,
			streetno: streetno,
			streetname: streetname,
			town: town
		},function(data){
			var isok = data.indexOf('error');
			var isvalidstreet = data.indexOf('required streetname');
			var isvalidtown = data.indexOf('requireds town');
			if(isok>=0){
				$('#add-span').html(data).css('color','red');
			}else if(isvalidstreet>=0){
				$('#streetname-span').html("required!").css('color','red');
				$('#town-span').html("");
			}else if(isvalidtown>=0){
				$('#town-span').html("required!").css('color','red');
				$('#streetname-span').html("");
			}else{
				$("#dr-address").html(data);
				$("#addview").html(data);
				$('#add-span').html("");
				$('#streetname-span').html("");
				$('#town-span').html("");
				invdivhide("address");
				selectAction="";
			}
		});
	}
});

$('#addressBtnCancel').click(function(){
	invdivhide('address');
	$('#add-span').html("");
	$('#streetname-span').html("");
	$('#town-span').html("");
	$('#town').value="";
});
/************************************** Address Section End Here **************************************/


/************************************** City Section Start Here **************************************/
$('#cityBtnSave').click(function(){
	var selectAction = "savecity";
	var city = $("#newcity").val();
	var postcode = $("#newpost").val();
	if(city.length<3){
		$('#city-span').html("required").css('color','red');
	}else{
		$.post("doctors-personal.php",{
			selectaction: selectAction,
			city: city,
			postcode: postcode
		},function(data){
			var isok = data.indexOf('error');
			var isvalid = data.indexOf('invalid format!');
			if(isok>=0){
				$('#city-span').html(data).css('color','red');
			}else if(isvalid>=0){
				$('#post-span').html(data).css('color','red');
			}else{
				$("#dr-city").html(data);
				$("#cityview").html(data);
				$('#city-span').html("");
				$('#post-span').html("");
				invdivhide("city");
				selectAction="";
			}
		});
	}
});

$('#cityBtnCancel').click(function(){
	invdivhide('city');
	$('#city-span').html("");
	$('#post-span').html("");
	$('#newcity').value="";
});
/************************************** City Section End Here **************************************/


/************************************** Phone Section Start Here **************************************/
$('#phoneBtnSave').click(function(){
	var selectAction = "savephone";
	var phone = $("#newphone").val();

	$.post("doctors-personal.php",{
		selectaction: selectAction,
		phone: phone
	},function(data){
		var isok = data.indexOf('error');
		var isvalid = data.indexOf('invalid format!');
		if(isok>=0){
			$('#phone-span').html(data).css('color','red');
		}else if(isvalid>=0){
			$('#phone-span').html(data).css('color','red');
		}else{
			$("#dr-phone").html(data);
			$("#phoneview").html(data);
			$('#phone-span').html("");
			invdivhide("phone");
			selectAction="";
		}
	});
});

$('#phoneBtnCancel').click(function(){
	invdivhide('phone');
	$('#phone-span').html("");
	$('#newphone').value="";
});
/************************************** Phone Section End Here **************************************/

/****************************************************************************************************/
/****************************************************************************************************/
/************************************** Professional Section Start Here *****************************/
/****************************************************************************************************/
/****************************************************************************************************/
/****************************** Main Section Start Here ************************************/
$("#click-pro").click(function(){
	$("#pro").css("display","block");
	$("#per").css("display","none");
	$("#set").css("display","none");
});

$("#click-per").click(function(){
	$("#per").css("display","block");
	$("#pro").css("display","none");
	$("#set").css("display","none");
});

$("#click-set").click(function(){
	$("#set").css("display","block");
	$("#pro").css("display","none");
	$("#per").css("display","none");
});

/****************************** Main Section End Here ************************************/

/*************************************** Hospital Name Section Start Here ***************************************/

$('#hospitalBtnSave').click(function(){
	var selectAction = "savehosname-pro";
	var hosname = $('#hospital-name').val();
	var roomno = $('#hospital-room').val();
	if((hosname.length)<2){
		$('#hos-name-span').html('required!').css('color','red');
	}else{
		$.post("doctors-personal.php", {
			selectaction: selectAction,
			hospitalname: hosname,
			room: roomno
		},function(data) {
              //alert(data);
              var iserror = data.indexOf("error");
              var isrequired = data.indexOf("required!");
              var isvalid = data.indexOf("too short!");
              
              if(isrequired>=0){
              	$('#hos-name-span').html(data).css('color','red');
              }else if(iserror>=0){
              	$('#hos-name-span').html(data).css('color','red');
              }else if(isvalid>=0){
              	$('#hos-name-span').html(data).css('color','red');
              }else{
              	$('#hos-name-span').html("");
              	$('#dr-hos-name').html(data);
              	$('#hos-name-view').html(data);
              	invdivhide("hospital");
              	selectAction = "";
              	if(roomno != ''){
              		$('#hos-room-view').html(roomno);
              	}
              }
              
              
          });
}    
});
$('#hospitalBtnCancel').click(function(){
	invdivhide("hospital");
	$('#hos-name-span').html("");
});
/*************************************** Hospital Name Section End Here ***************************************/


/************************************** Hospital Address Section Start Here **************************************/
$('#hosaddressBtnSave').click(function(){
	var selectAction = "savehos-add-pro";
	var hos_streetno = $("#hos-streetno").val();
	var hos_streetname = $("#hos-streetname").val();
	var hos_town = $("#hos-town").val();
	var hos_postcode = $("#hos-postcode").val();

	if(hos_streetname.length<3){
		$("#hos-streetname-span").html("required!").css('color','red');
	}else if(hos_town.length<3){
		$("#hos-town-span").html("required!").css('color','red');
	}else if(hos_postcode.length<3){
		$("#hos-postcode-span").html("required!").css('color','red');
	}else {
		$.post("doctors-personal.php",{
			selectaction: selectAction,
			hos_streetno: hos_streetno,
			hos_streetname: hos_streetname,
			hos_town: hos_town,
			hos_postcode: hos_postcode
		},function(data){
			
			var isok = data.indexOf('error');
			var isemptystreet = data.indexOf('required streetname!');
			var isemptytown = data.indexOf('required town!');
			var isemptypost = data.indexOf('required postcode!');
			var isvalidpost = data.indexOf('invalid format!');

			if(isok>=0){
				$('#hos-add-view').html(data).css('color','red');
			}else if(isemptystreet>=0){
				$('#hos-streetname-span').html("required!").css('color','red');
				$('#hos-town-span').html("");
				$('#hos-postcode-span').html("");
				$('#hos-add-view').html("");
			}else if(isemptytown>=0){
				$('#hos-town-span').html("required!").css('color','red');
				$('#hos-streetname-span').html("");
				$('#hos-postcode-span').html("");
				$('#hos-add-view').html("");
			}else if(isemptypost>=0){
				$('#hos-postcode-span').html("required!").css('color','red');
				$('#hos-streetname-span').html("");
				$('#hos-town-span').html("");
				$('#hos-add-view').html("");
			}else if(isvalidpost>=0){
				$('#hos-postcode-span').html(data).css('color','red');
				$('#hos-streetname-span').html("");
				$('#hos-town-span').html("");
				$('#hos-add-view').html("");
			}else{
				$("#dr-hos-add").html(data);
				$("#hos-add-view").html(data);
				$('#hos-streetname-span').html("");
				$('#hos-town-span').html("");
				$('#hos-postcode-span').html("");
				invdivhide("hospitaladdress");
				selectAction="";
			}
		});
}
});

$('#hosaddressBtnCancel').click(function(){
	invdivhide('hospitaladdress');
	$('#hos-streetname-span').html("");
	$('#hos-town-span').html("");
	$('#hos-postcode-span').html("");
});
/************************************** Hospital Address Section End Here **************************************/


/************************************** Hospital City Section Start Here **************************************/
$('#hoscityBtnSave').click(function(){
	var selectAction = "savehoscity-pro";
	var hoscity = $("#hosnewcity").val();
	var hoscountry = $("#hosnewcountry option:selected").text();
	var countryValue = $("#hosnewcountry option:selected").val();
	if(hoscity.length<1){
		$('#hoscity-span').html("required!").css('color','red');
	}else if(countryValue == 'failed'){
		$('#hoscountry-span').html("required!").css('color','red');
	}else{
		$.post("doctors-personal.php",{
			selectaction: selectAction,
			hoscity: hoscity,
			hoscountry: hoscountry
		},function(data){
			var isok = data.indexOf('error');
			var isempty = data.indexOf('required!');
			var isvalid = data.indexOf('invalid format!');
			if(isok>=0){
				$('#hoscity-span').html(data).css('color','red');
			}else if(isempty>=0){
				$('#hoscity-span').html(data).css('color','red');
			}else if(isvalid>=0){
				$('#hoscity-span').html(data).css('color','red');
			}else{
				$("#hos-city-pro").html(data);
				$("#hoscity-view").html(data+"-"+hoscountry);
				$('#hoscity-span').html("");
				$('#hoscountry-span').html("");
				invdivhide("hoscity");
				selectAction="";
			}
		});
	}
});

$('#hoscityBtnCancel').click(function(){
	invdivhide('hoscity');
	$('#hoscity-span').html("");
});
/************************************** Hospital City Section End Here **************************************/


/************************************** Hospital Map Section Start Here **************************************/
$('#hosmapBtnCancel').click(function(){
	invdivhide('hosmap');
});

// $('#hosmap-input').autocomplete({
//     source:function(request,response){

//         geocoder.geocode({'address':request.term},function(results){
//             response($.map(results,function(item){
//                 return{
//                     label: item.formatted_address,
//                     value: item.formatted_address,
//                     latitude: item.geometry.location.lat(),
//                     longitude: item.geometry.location.lng()
//                 }
//             }))
//         })

//     },
//     select:function(event,ui){
//         alert("working");
//         var location = new google.maps.LatLng(ui.item.latitude,ui.item.longitude)
//         marker = new google.maps.Marker({
//             map: map,
//             draggable: false
//         })
//         var stringvalue = 'Latitude: <input type="text" value="'+ui.item.latitude+'">Longitude: <input type="text" value="'+ui.item.longitude+'">';
//         $("#hosmap-view").append(stringvalue);
//         marker.setPosition(location);
//         map.setCenter(location);
//     }
// })



$('#hosmapBtnSave').click(function(){
	var selectAction = "savehosmap-pro";
	if(hoscity.length<1){
		$('#hoscity-span').html("required!").css('color','red');
	}else{
		$.post("doctors-personal.php",{
			selectaction: selectAction,
			address: newaddress,
			lat: lat,
			lng: lng
		},function(data){
			var isok = data.indexOf('error');
			var isempty = data.indexOf('required!');
			var isvalid = data.indexOf('invalid format!');
			if(isok>=0){
				$('#hoscity-span').html(data).css('color','red');
			}else if(isempty>=0){
				$('#hoscity-span').html(data).css('color','red');
			}else if(isvalid>=0){
				$('#hoscity-span').html(data).css('color','red');
			}else{
				$("#hos-city-pro").html(data);
				$("#hoscity-view").html(data);
				$('#hoscity-span').html("");
				invdivhide("hosmap");
				selectAction="";
			}
		});
	}
});


/************************************** Hospital Map Section End Here **************************************/


/************************************** Hospital Capacity Section Start Here **************************************/
$('#capacityBtnSave').click(function(){
	var selectAction = "savehoscapacity-pro";
	var hoscapacity = $("#hos-capacity").val();
	if(hoscapacity.length<1){
		$('#capacity-span').html("required!").css('color','red');
	}else{
		$.post("doctors-personal.php",{
			selectaction: selectAction,
			capacity: hoscapacity
		},function(data){
			var isok = data.indexOf('error');
			var isempty = data.indexOf('required!');
			var isvalid = data.indexOf('invalid format!');
			if(isok>=0){
				$('#capacity-span').html(data).css('color','red');
			}else if(isempty>=0){
				$('#capacity-span').html(data).css('color','red');
			}else if(isvalid>=0){
				$('#capacity-span').html(data).css('color','red');
			}else{
				$("#dr-hoscapacity").html(data);
				$("#hoscapacity-view").html(data);
				$('#capacity-span').html("");
				invdivhide("hoscapacity");
				selectAction="";
			}
		});
	}
});

$('#capacityBtnCancel').click(function(){
	invdivhide('hoscapacity');
	$('#capacity-span').html("");
});
/************************************** Hospital Capacity Section End Here **************************************/

/************************************** Hospital Contacts Section Start Here **************************************/
$('#hoscontactBtnSave').click(function(){
	var selectAction = "savehoscontacts-pro";
	var hosphone = $("#hosphone").val();
	var hosemail = $("#hosemail").val();
	var hosweb = $("#hosweb").val();

	if(hosphone.length<1){
		$('#hosphone-span').html("required!").css('color','red');
	}else{
		$.post("doctors-personal.php",{
			selectaction: selectAction,
			hosphone: hosphone,
			hosemail: hosemail,
			hosweb: hosweb
		},function(data){
			var iserror = data.indexOf('error!');
			var isempty = data.indexOf('required!');
			var isvalidphone = data.indexOf('invalid phone format!');
			var isvalidemail = data.indexOf('invalid email format!');
			var isvalidweb = data.indexOf('invalid web format!');
			if(iserror>=0){
				$('#hosphone-span').html(data).css('color','red');
				$('#hosemail-span').html(data).css('color','red');
				$('#hosweb-span').html(data).css('color','red');
			}else if(isempty>=0){
				$('#hosphone-span').html(data).css('color','red');
				$('#hosemail-span').html("");
				$('#hosweb-span').html("");
			}else if(isvalidphone>=0){
				$('#hosphone-span').html(data).css('color','red');
				$('#hosemail-span').html("");
				$('#hosweb-span').html("");
			}else if(isvalidemail>=0){
				$('#hosemail-span').html(data).css('color','red');
				$('#hosphone-span').html("");
				$('#hosweb-span').html("");
			}else if(isvalidweb>=0){
				$('#hosweb-span').html(data).css('color','red');
				$('#hosemail-span').html("");
				$('#hosphone-span').html("");
			}else{
				$("#dr-hoscontacts").html(data);
				$("#hoscontacts-view").html(data);
				$('#hosphone-span').html("");
				$('#hosemail-span').html("");
				$('#hosphone-span').html("");
				invdivhide("hospitalcontacts");
				
			}
			selectAction="";
		});
}
});

$('#hoscontactBtnCancel').click(function(){
	invdivhide('hospitalcontacts');
	$('#hosphone-span').html("");
	$('#hosemail-span').html("");
	$('#hosphone-span').html("");
});
/****************************** Hospital Contacts Section End Here ************************************/


/*********************************** Alert Service Dismissal Start Here *********************************/
$("#bton-publish").click(function(){
	selectAction = "publishButtondr";

	$.post("doctors-personal.php",{selectaction: selectAction},function(data){
		var updated = data.indexOf("all updated!!");
		if(updated>=0){
			$("#alt-bton").attr("data-dismiss","alert");
			var div = $("#alt-bton").closest('div');
			div.removeClass("alert");
			div.removeClass("alert-danger");

			$("#war-alert").css('display','none');
        //alert($("#published-info").text);
        //if($("#published-infodr").text == ""){
        	$("#published-infodr").html("");
        //}
        
        //$("#published-info").addClass('pull-right');
    }else{
    	alert('Publish Failed.!! At first fill up all required fields.');
        //alert(data);
    }
    selectAction="";
});
});

/*********************************** Alert Service Dismissal End Here *********************************/


/******************************  Section End Here ************************************/
});
</script>
</body>
</html>
<?php
?>