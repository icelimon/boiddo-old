<?php
  //include_once("php_includes/check_login_status.php");
include_once("check-login-status.php");
  // Initialize any variables that the page might echo
$u = "";
$email = "";
$profile_pic = "";
$profile_pic_btn = "";
$avatar_form = "";
$country = "";
$joindate = "";
$lastsession = "";

if($user_ok == true && $log_username != "" && $log_category == "hospital"){
	$u = $log_username;
}else{
	header("Location: index.php");
	exit(); 
}
  // Select the member from the users table
$sql = "SELECT * FROM hospitals WHERE hospital_username='$u' AND activated='1' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
  // Now make sure that user exists in the table
$numrows = mysqli_num_rows($user_query);
if($numrows < 1){
	echo "That user does not exist or does not activate yet, press back";
	exit(); 
}
$publish = "";
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
	$publish = $row['published'];
}
  // Select the member from the users table
$sql_option = "SELECT * FROM hospitals_options WHERE hospital_username='$u' LIMIT 1";
$user_query_option = mysqli_query($db_conx, $sql_option);
  // Now make sure that user exists in the table
$numrows_option = mysqli_num_rows($user_query_option);
if($numrows_option < 1){
	echo "That user does not exist or is not activated yet, press back";
	exit(); 
}

    // Check to see if the viewer is the account owner
$isOwner = "no";
if($u == $log_username && $user_ok == true){
	$isOwner = "yes";
	
	$avatar_form  = '<form id="avatar_form" enctype="multipart/form-data" method="post" action="php_parsers/photo_system.php">';
	$avatar_form .=   '<input type="file" name="avatar" required>';
	$avatar_form .=   '<p><input type="submit" value="Upload"></p>';
	$avatar_form .= '</form>';
}
  // Fetch the user row from the query above
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
	$profile_id = $row["hospital_id"];
	$gender = $row["hospital_sex"];
	$country = $row["hospital_country"];
	$email = $row["hospital_email"];
    //$avatar = $row["image"];
	$signup = $row["joindate"];
	$lastlogin = $row["lastlogin"];
	$joindate = strftime("%b %d, %Y", strtotime($signup));
	$lastsession = strftime("%b %d, %Y", strtotime($lastlogin));
}

  // Fetch the doctors_options row from the query above
while ($row = mysqli_fetch_array($user_query_option, MYSQLI_ASSOC)) {
	$profile_id = $row["hospital_id"];
	$avatar = $row["image"];
	$avatar_name = $row["img_name"];
	$question = $row["hospital_question"];
	$answer = $row["hospital_answer"];
}

  // if($gender == "f"){
  //  $sex = "Female";
  // }
  //$profile_pic = $avatar;
  //$profile_pic = file_get_contents($profile_pic);
  //$profile_pic = '<img src="data:image/jpeg;base64,'.base64_encode( $avatar).'"/>';
  //file_put_contents("rofile_pic", $avatar);
$profile_pic = '<img class="img-circle" src="user_hos/'.$avatar_name.'" alt="'.$u.'" height="60px" width="60px">';
if($avatar == NULL){
	$profile_pic = '<img class="img-circle" src="images/hos-default.png" alt="'.$u.'" height="60px" width="60px">';
}

/****************************************************************************************************/
/**************************************                                 *****************************/
/************************************** Professional Section Start Here *****************************/
/**************************************                                 *****************************/
/****************************************************************************************************/
$hos_name="";
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

$sql_pro = "SELECT * FROM hospitals_info WHERE hospital_id='$log_id' LIMIT 1";
$query_pro = mysqli_query($db_conx, $sql_pro);
while($rowpro = mysqli_fetch_assoc($query_pro)){
	$hos_name=$rowpro['fullname'];      
	$hos_streetno = $rowpro['street_no'];
	$hos_streetname = $rowpro['street_name'];
	$hos_town = $rowpro['town'];
	$hos_city = $rowpro['city'];
	$hos_postcode = $rowpro['postcode'];
	$hos_service = $rowpro['services'];
	$hos_capacity = $rowpro['capacity'];
	$hos_phone = $rowpro['phone'];
	$hos_email = $rowpro['email'];
	$hos_web = $rowpro['web'];
}
if(!empty($hos_streetname) && !empty($hos_town) && !empty($hos_postcode) )
	$hos_address =$hos_streetno."-".$hos_streetname."/ ".$hos_town."-".$hos_postcode;

$hos_contacts="";

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


if(!empty($hos_name) && !empty($hos_streetname) && !empty($hos_town) && !empty($hos_city) && !empty($hos_postcode) && !empty($hos_phone)){
	$sqlupdate = "UPDATE hospitals_info SET updated='1' WHERE hospital_id='$log_id' LIMIT 1";
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
	<title><?php echo $hos_name;?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="description" content="Online doctor and hospitals whats you need while trubling.">
	<meta name="keywords" content="online doctor, boiddo, healthcare, online hospitals, medical information">
	
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <link href="css/styles.fb.css" rel="stylesheet">
      <link href="css/img.form.css" rel="stylesheet">
      <link href="css/styles.css" rel="stylesheet">

      <script src="js/main.js"></script>
  </head>
  <body>
  	<div class="container-fluid">
  		<div class="box">
  			<div class="row row-offcanvas row-offcanvas-left">
  				<?php include_once("hos-header.php");?>
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
  										<p id="altr-text"><strong>Not completed!</strong>. required all fields are not filled yet. Please change photo, fill up hospital name, address, city, service, patient capacity and emergency phone number. Once fill up all required fields you need to press publish now button to publish yourself.</p>
  									</div>
  								</div>
  								<?php } ?>





  								<!--******************************************************************************************************-->
  								<!--***************************                                   ****************************************-->
  								<!--***************************  Profile Setting Start Here       ********************************************-->
  								<!--***************************                                   ****************************************-->
  								<!--******************************************************************************************************-->

  								<div id="gen" class="panel panel-default">
  									<div class="panel-heading"><h4>General Settings <span id="published-info" style="color:green;"></span><?php if($publish==1){?><span class="pull-right" style="color:green;">Published</span><?php }?></h4>
  									</div>
  									<div class="list-group">

  										<div class="row">
  											<div class="col-sm-3 col-sx-5 paddingfive">
  												<?php echo $profile_pic; ?>
  											</div>
  											<div class="col-sm-3 col-xs-6 paddingfive">
  												<?php echo $avatar_form; ?>
  											</div>
  										</div>
  										<button id="hospitaledit" class="list-group-item">
  											<div class="row">
  												<div class="col-xs-3 col-sm-3 col-md-3"><strong>Hospital Name</strong></div> 
  												<div id="dr-hos-name" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_name;?></div> 
  												<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
  											</div>
  										</button>

  										<form id="hospital" class="form-horizontal form-group-sm" role="form">
  											<p style="margin:16px 0px 0px 32px"><strong>Hospital Name</strong></p>
  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current Hospital </div>
  												<span style="color: blue;" id="hos-name-view"><?php echo $hos_name;?></span>
  											</div>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Hospital Name</div>
  												<div class="col-xs-8 col-sm-6 col-md-4">
  													<input id="hospital-name" type="text" class="form-control">
  												</div>
  												<div class="col-xs-offset-5"><span id="hos-name-span"></span></div>
  											</div>

  											<p></p>
  											<div class="row">
  												<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
  													<button id="hospitalBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
  													<button id="hospitalBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
  												</div>
  											</div>

  											<p></p>
  										</form>

  										<button id="hosaddressedit" class="list-group-item">
  											<div class="row">
  												<div class="col-xs-3 col-sm-3 col-md-3"><strong>Address</strong></div> 
  												<div id="dr-hos-add" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_address;?></div> 
  												<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
  											</div>
  										</button>
  										<form id="hospitaladdress" class="form-horizontal form-group-sm" role="form">
  											<p style="margin:16px 0px 0px 32px;"><strong>Address</strong></p>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current Address </div>
  												<span style="color: blue;" id="hos-add-view"><?php echo $hos_address;?></span>
  											</div>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Street no.</div>
  												<div class="col-xs-8 col-sm-6 col-md-4">
  													<input id="hos-streetno" type="text" class="form-control" placeholder="optional">
  												</div>
  											</div>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Street name</div>
  												<div class="col-xs-8 col-sm-6 col-md-4">
  													<input id="hos-streetname" type="text" class="form-control">
  												</div>
  												<div class="col-xs-offset-5"><span id="hos-streetname-span"></span></div>
  											</div>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Town</div>
  												<div class="col-xs-8 col-sm-6 col-md-4">
  													<input id="hos-town" type="text" class="form-control">
  												</div>
  												<div class="col-xs-offset-5"><span id="hos-town-span"></span></div>
  											</div>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Postcode</div>
  												<div class="col-xs-8 col-sm-6 col-md-4">
  													<input id="hos-postcode" type="text" class="form-control">
  												</div>
  												<div class="col-xs-offset-5"><span id="hos-postcode-span"></span></div>
  											</div>

  											<p></p>
  											<div class="row">
  												<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
  													<button id="hosaddressBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
  													<button id="hosaddressBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
  												</div>
  											</div>
  											<p></p>
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

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current City: </div>
  												<span style="color: blue;" id="hoscity-view"><?php echo $hos_city;?></span>
  											</div>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">City</div>
  												<div class="col-xs-8 col-sm-6 col-md-4">
  													<input id="hosnewcity" type="text" class="form-control">
  												</div>
  												<div class="col-xs-offset-5"><span id="hoscity-span"><?php ?></span></div>
  											</div>

  											<p></p>
  											<div class="row">
  												<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
  													<button id="hoscityBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
  													<button id="hoscityBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
  												</div>
  											</div>
  											<p></p>
  										</form>

  										<button id="hosserviceedit" class="list-group-item">
  											<div class="row">
  												<div class="col-xs-3 col-sm-3 col-md-3"><strong>Services</strong></div> 
  												<div id="stored-services" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_serv;?></div> 
  												<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
  											</div>
  										</button>
  										<form id="hosservice" class="form-horizontal form-group-sm" role="form">
  											<p style="margin:16px 0px 0px 32px;"><strong>Services</strong></p>
  											<p></p>

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
  														<div id="addservice"></div>


  													</p>
  												</div>

  												<p></p>
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


  											<p></p>
  											<div class="row">
  												<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
  													<button id="hosserviceBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
  													<button id="hosserviceBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
  												</div>
  											</div>
  											<p></p>

  										</form>

  										<button id="hoscapacityedit" class="list-group-item">
  											<div class="row">
  												<div class="col-xs-3 col-sm-3 col-md-3"><strong>Patient Capacity</strong></div> 
  												<div id="dr-hoscapacity" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_capacity;?></div> 
  												<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
  											</div>
  										</button>
  										<form id="hoscapacity" class="form-horizontal form-group-sm" role="form">
  											<p style="margin:16px 0px 0px 32px;"><strong>Patient Capacty</strong></p>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current Capacity: </div>
  												<span style="color: blue;" id="hoscapacity-view"><?php echo $hos_capacity;?></span>
  											</div>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Capacity</div>
  												<div class="col-xs-8 col-sm-6 col-md-4">
  													<input id="hos-capacity" type="text" class="form-control">
  												</div>
  												<div class="col-xs-offset-5"><span id="capacity-span"></span></div>
  											</div>

  											<p></p>
  											<div class="row">
  												<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
  													<button id="capacityBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
  													<button id="capacityBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
  												</div>
  											</div>
  											<p></p>
  										</form>

  										<button id="hoscontactsedit"class="list-group-item">
  											<div class="row">
  												<div class="col-xs-3 col-sm-3 col-md-3"><strong>Emergency Contacts</strong></div> 
  												<div id="dr-hoscontacts" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_contacts;?></div> 
  												<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
  											</div>
  										</button>

  										<form id="hospitalcontacts" class="form-horizontal form-group-sm" role="form">
  											<p style="margin:16px 0px 0px 32px;"><strong>Emergency Contacts</strong></p>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Existing contacts: </div>
  												<span style="color: blue;" id="hoscontacts-view"><?php echo $hos_contacts;?></span>
  											</div>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Phone</div>
  												<div class="col-xs-8 col-sm-6 col-md-4">
  													<input id="hosphone" type="text" class="form-control">
  												</div>
  												<div class="col-xs-offset-5"><span id="hosphone-span"></span></div>
  											</div>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Email</div>
  												<div class="col-xs-4 col-sm-4 col-md-4">
  													<input id="hosemail" type="text" class="form-control" placeholder="Optional">
  												</div>
  												<div class="col-xs-offset-5"><span id="hosemail-span"></span></div>
  											</div>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Web</div>
  												<div class="col-xs-4 col-sm-4 col-md-4">
  													<input id="hosweb" type="text" class="form-control" placeholder="Optional">
  												</div>
  												<div class="col-xs-offset-5"><span id="hosweb-span"></span></div>
  											</div>

  											<p></p>
  											<div class="row">
  												<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
  													<button id="hoscontactBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
  													<button id="hoscontactBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
  												</div>
  											</div>
  											<p></p>
  										</form>
  									</div>
  								</div>
  								<?php if($publish != 1){?>
  								<button id="btn-publish" class="btn btn-success btn-md pull-right" style="margin-top:-10px;margin-bottom:15px;">Publish Now</button>
  								<?php } ?>



  								<!--Profile Setting End Here-->

  								<div id="acc" class="panel panel-default">
  									<div class="panel-heading">
  										<h4>Account Settings <span id="published-info" style="color:green;"></span><?php if($publish==1){?><span class="pull-right" style="color:green;">Published</span><?php }?></h4>
  									</div>
  									<div class="list-group">
  										<button id="hospitaledit" class="list-group-item">
  											<div class="row">
  												<div class="col-xs-3 col-sm-3 col-md-3"><strong>Hospital Name</strong></div> 
  												<div id="dr-hos-name" class="col-xs-7 col-sm-7 col-md-8"><?php echo $hos_name;?></div> 
  												<div class="col-xs-2 col-sm-2 col-md-1 pull-right">Edit</div>
  											</div>
  										</button>

  										<form id="hospital" class="form-horizontal form-group-sm" role="form">
  											<p style="margin:16px 0px 0px 32px"><strong>Hospital Name</strong></p>
  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Current Hospital </div>
  												<span style="color: blue;" id="hos-name-view"><?php echo $hos_name;?></span>
  											</div>

  											<p></p>
  											<div class="row">
  												<div style="text-align: right;" class="col-xs-4 col-sm-4 col-md-4">Hospital Name</div>
  												<div class="col-xs-8 col-sm-6 col-md-4">
  													<input id="hospital-name" type="text" class="form-control">
  												</div>
  												<div class="col-xs-offset-5"><span id="hos-name-span"></span></div>
  											</div>

  											<p></p>
  											<div class="row">
  												<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
  													<button id="hospitalBtnCancel" style="margin-left: 10px" class="btn btn-warning pull-right" type="button" value="Reset Form" onclick="this.form.reset();">Cancel</button>
  													<button id="hospitalBtnSave" class="btn btn-primary pull-right" type="button">Save</button>
  												</div>
  											</div>

  											<p></p>
  										</form>
  									</div>
  								</div>



  							</div><!--/row-->
  						</div> 
  					</div><!-- /col-9 -->
  				</div><!-- /padding -->
  			</div>
  			<!-- /main -->

  		</div>
  	</div>


  	<!--post modal-->
  	<div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  		<div class="modal-dialog">
  			<div class="modal-content">
  				<div class="modal-header">
  					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  					Update Status
  				</div>
  				<div class="modal-body">
  					<form class="form center-block">
  						<div class="form-group">
  							<textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
  						</div>
  					</form>
  				</div>
  				<div class="modal-footer">
  					<div>
  						<button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Post</button>
  						<ul class="pull-left list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
  					</div>  
  				</div>
  			</div>
  		</div>
  	</div>
  	
  	<script src="js/jquery.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/scripts.fb.js"></script>
  	<script src="js/setting.expand.js"></script>
  	<script type="text/javascript">

  		/*********************Right icon section start here****************************/
  		$("#profileactive").addClass("glyphicon glyphicon-chevron-right");
  		$("#planetactive").removeClass("glyphicon glyphicon-chevron-right");
  		$("#messageactive").removeClass("glyphicon glyphicon-chevron-right");
  		$("#doctorsactive").removeClass("glyphicon glyphicon-chevron-right");
  		$("#sub-items").css("display","block");

  		$("#click-pro").click(function(){
  			$("#profileactive").addClass("glyphicon glyphicon-chevron-right");
  			$("#settingsactive").removeClass("glyphicon glyphicon-chevron-right");
  		});
  		$("#click-set").click(function(){
  			$("#settingsactive").addClass("glyphicon glyphicon-chevron-right");
  			$("#profileactive").removeClass("glyphicon glyphicon-chevron-right");
  		});

  		/****************************************************************************************************/
  		/****************************************************************************************************/
  		/************************************** General Setting Start Here *****************************/
  		/****************************************************************************************************/
  		/****************************************************************************************************/

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

  			$.post("hospitals-edit.php",{selectaction: selectAction},function(data){
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
    newspan.className = "glyphicon glyphicon-remove lineh";
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
        //alert(new_id[index]);
        new_service.splice(index, 1);
        $("#"+new_id[index]).css("display","block");
        hiddenids.splice(index, 1);
        new_id_text.splice(index, 1);
        new_id.splice(index, 1);
        
    }
    count++;
}


$('#hosserviceBtnSave').click(function(){
	var selectAction ="hos_ser_save";
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
	$.post("hospitals-edit.php",{
		selectaction: selectAction,
		idntext: ids_text,
		service: temp_service
	},function(data){
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

/*************************************** Hospital Name Section Start Here ***************************************/

$(document).ready(function() {

	$('#hospitalBtnSave').click(function(){
		var selectAction = "savehosname-pro";
		var hosname = $('#hospital-name').val();
		var roomno = $('#hospital-room').val();
		if((hosname.length)<2){
			$('#hos-name-span').html('required!').css('color','red');
		}else{
			$.post("hospitals-edit.php", {
				selectaction: selectAction,
				hospitalname: hosname
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
		$.post("hospitals-edit.php",{
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
	if(hoscity.length<1){
		$('#hoscity-span').html("required!").css('color','red');
	}else{
		$.post("hospitals-edit.php",{
			selectaction: selectAction,
			hoscity: hoscity
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

/************************************** Hospital Capacity Section Start Here **************************************/
$('#capacityBtnSave').click(function(){
	var selectAction = "savehoscapacity-pro";
	var hoscapacity = $("#hos-capacity").val();
    //alert(hoscapacity);
    if(hoscapacity.length<1){
    	$('#capacity-span').html("required!").css('color','red');
    }else{
    	$.post("hospitals-edit.php",{
    		selectaction: selectAction,
    		capacity: hoscapacity
    	},function(data){
            //alert(data);
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
            }
            selectAction="";
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
		$.post("hospitals-edit.php",{
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
				selectAction="";
			}
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

/****************************** Main Section Start Here ************************************/

$("#click-pro").click(function(){
	$("#gen").css("display","block");    
	$("#acc").css("display","none");
});

$("#click-set").click(function(){
	$("#acc").css("display","block");
	$("#gen").css("display","none");
});

/****************************** Main Section End Here ************************************/

/*********************************** Alert Service Dismissal Start Here *********************************/
$("#btn-publish").click(function(){
	selectAction = "publishButton";

	$.post("hospitals-edit.php",{
		selectaction: selectAction
	},function(data){
		var updated = data.indexOf("all updated!!");
		var failed = data.indexOf("failed to update..");
		if(updated>=0){
			$("#alt-bton").attr("data-dismiss","alert");
			var div = $("#alt-bton").closest('div');
			div.removeClass("alert");
			div.removeClass("alert-danger");
			$("#war-alert").css('display','none');

			$("#published-info").html("");
		}else if(failed >= 0){
			alert(data);
		}
		selectAction = "";
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