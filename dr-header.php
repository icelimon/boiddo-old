<?php 
if($log_category == 'doctor'){
	$sql_pro = "SELECT hospital_name FROM doctors_professional WHERE doctor_id='$log_id' LIMIT 1";
	$query_pro = mysqli_query($db_conx, $sql_pro);
	while($rowpro = mysqli_fetch_assoc($query_pro)){
		$hos_name_header=$rowpro['hospital_name'];
	}
	$query_per = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE doctor_id='$log_id' LIMIT 1");
	while($row = mysqli_fetch_assoc($query_per)){
		$fullname_header = $row['full_name'];
	}
	$sql = mysqli_query($db_conx,"SELECT image, img_name FROM doctors_options WHERE doctor_username='$log_username'
		LIMIT 1") or die('Invalid query: ' . mysqli_error());
                  //$query = mysqli_query($db_conx, $sql);
	while($rows=mysqli_fetch_assoc($sql)){
		$image_header=$rows['image'];
		$img_name_header=$rows['img_name'];
	}
}

$profile_pic_header = '<img class="img-rounded img-responsive" src="user_doc/'.$img_name_header.'" alt="'.$image_header.'" height="100px" width="100px">';
if($image_header == NULL){
	$profile_pic_header = '<img class="img-rounded img-responsive" src="images/default-dr.png" alt="'.$image_header.'" height="100px" width="100px">';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/boiddo-band.png" />
	<title>Boiddo</title>
	<meta name="generator" content="Boiddo" />
	<meta name="description" content="Online doctor and hospitals whats you need while trubling. Find your nearest hospital, get information about doctors and hospitals. Get serial of them... and many more option what you need.">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/stylesnewfb.css" rel="stylesheet">
</head>
<body>
	<!-- sidebar -->
	<div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
		<ul class="nav">
			<li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
		</ul>

		<ul class="nav hidden-xs" id="lg-menu">
			<li style="margin-bottom:5px;"><center><?php echo $profile_pic_header;?></center></li>
			<li><center><?php echo $fullname_header;?></center></li>
			<li class="active"><a href="dr-planet.php"><i class="glyphicon glyphicon-globe"></i> Planet<i id="planetactive" style="float:right;"></i></a></li>
			<li><a href="visits.php"><i class="glyphicon glyphicon-pencil"></i> Chambers<i id="visitsactive" style="float:right;"></i></a></li>
			<li><a href="#"><i class="glyphicon glyphicon-envelope"></i> Messages<i id="messageactive" style="float:right;"></i></a></li>
			<li><a href="#"><i class="glyphicon glyphicon-tent"></i> Doctors<i id="doctorsactive" style="float:right;"></i></a></li>
			<li><a href="requests.php"><i class="glyphicon glyphicon-user"></i> Requests</a></li>
			<li><a href="#"><i class="glyphicon glyphicon-refresh"></i> Notifications</a></li>
			<li><a href="edit-profile-dr.php"><i class="glyphicon glyphicon-cog"></i> Settings</a></li>
			<ul id="sub-items" class="sublist">
				<li><button class="btn btn-link no-margin" id="click-per" style="text-decoration:none;color:#FFF">Personal Details</button><i id="settingsactive" style="float:right;"></i></li>
				<li><button class="btn btn-link no-margin" id="click-pro" style="text-decoration:none;color:#FFF">Professional Details</button><i id="settingsproactive" style="float:right;"></i></li>
				<li><button class="btn btn-link no-margin" id="click-set" style="text-decoration:none;color:#FFF">Account Setting</button><i id="settingssetactive" style="float:right;"></i></li>
			</ul> 
		</ul>
		<ul class="list-unstyled hidden-xs" id="sidebar-footer">
			<li style="margin-bottom:-10px">
				<a href="http://www.boiddo.com/terms.php#contact"><h3>Contact us</h3></a>
			</li>
			<li>info@boiddo.com</li>
			<li><span style="font-size:11px;">&copyCopyright boiddo corporation 2015</span></li>
		</ul>

		<!-- tiny only nav-->
		<ul class="nav visible-xs" id="xs-menu">
			<li><a href="#featured" class="text-center"><i class="glyphicon glyphicon-globe"></i></a></li>
			<li><a href="#stories" class="text-center"><i class="glyphicon glyphicon-list"></i></a></li>
			<li><a href="#" class="text-center"><i class="glyphicon glyphicon-envelope"></i></a></li>
			<li><a href="#" class="text-center"><i class="glyphicon glyphicon-paperclip"></i></a></li>
			<li><a href="requests.php" class="text-center"><i class="glyphicon glyphicon-user"></i></a></li>
			<li><a href="#" class="text-center"><i class="glyphicon glyphicon-refresh"></i></a></li>
			<li><a href="http://www.boiddo.com/terms.php#contact" class="text-center"><i class="glyphicon glyphicon-phone"></i></a></li>
		</ul>

	</div>
	<!-- /sidebar -->

	<!-- main right col -->
	<div class="column col-sm-10 col-xs-11" id="main">

		<!-- top nav -->
		<div class="navbar navbar-blue navbar-static-top">  
			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<img href="http://boiddo.com" class="logo" src="images/boiddo-nav.png">
			</div>

			<nav class="collapse navbar-collapse" role="navigation">
				<form class="navbar-form navbar-left">
					<div class="input-group input-group-sm" style="max-width:360px;">
						<input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
				</form>
				<ul class="nav navbar-nav">
					<li>
						<a href="dr-planet.php"><i class="glyphicon glyphicon-globe"></i> Planet</a>
					</li>
					<li>
						<a href="doctor.php"><i class="glyphicon glyphicon-user"></i> Profile</a>
					</li>
					<li>
						<a href="#addChamber" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Chamber</a>
					</li>
					<li>
						<a href="logout.php"><i class="glyphicon glyphicon-off"></i> Log out</a>
					</li>

				</ul>
				<ul class="nav navbar-nav navbar-right">

				</ul>
			</nav>
		</div>
		<!-- /top nav -->

		<!--post modal-->
		<div id="addChamber" class="modal fade" tabindex="0" role="dialog" aria-hidden="false">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<center><h4 style="margin-bottom:20px"><b>Add New Chamber</b></h4></center>
					</div>
					<div class="modal-body">
						<form class="form center-block">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-3 right set-mod-text">Chamber Name*</div>
									<div class="col-sm-8 right"><input id="name_ch" class="form-control input-sm" autofocus="" placeholder="Fullname of new chamber" required></div>
									<div class="col-sm-3 right set-mod-text">Map Address</div>
									<div class="col-sm-8 right"><input id="map_ch" class="form-control input-sm" autofocus="" placeholder="Chamber Name, City, Country"></div>
									<div class="col-sm-3 right set-mod-text">House No</div>
									<div class="col-sm-2 right"><input id="houseno_ch" class="form-control input-sm" autofocus="" placeholder="House No"></div>
									<div class="col-sm-3 right set-mod-text">House Name</div>
									<div class="col-sm-3 right"><input id="housename_ch" class="form-control input-sm" autofocus="" placeholder="House Name"></div>
									<div class="col-sm-3 right set-mod-text">Street No</div>
									<div class="col-sm-2 right"><input id="streetno_ch" class="form-control input-sm" autofocus="" placeholder="Street No"></div>
									<div class="col-sm-3 right set-mod-text">Street Name*</div>
									<div class="col-sm-3 right"><input id="streetname_ch" class="form-control input-sm" autofocus="" placeholder="Street Name" required></div>
									<div class="col-sm-3 right set-mod-text">Town*</div>
									<div class="col-sm-3 right"><input id="town_ch" class="form-control input-sm" autofocus="" placeholder="Town/Locality" required></div>
									<div class="col-sm-2 right set-mod-text">Postcode*</div>
									<div class="col-sm-3 right"><input id="postcode_ch" class="form-control input-sm" autofocus="" placeholder="Postcode/Zip code" required></div>
									<div class="col-sm-3 right set-mod-text">City*</div>
									<div class="col-sm-3 right"><input id="city_ch" class="form-control input-sm" autofocus="" placeholder="City"required></div>
									<div class="col-sm-2 right set-mod-text">Country*</div>
									<div class="col-sm-3 right">
										<select id="country_ch" class="form-control">
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
									<div class="col-sm-3 right set-mod-text">Phone*</div>
									<div class="col-sm-4 right"><input id="phoneone_ch" class="form-control input-sm" autofocus="" placeholder="Contact no"required></div>
									<div class="col-sm-4 right"><input id="phonetwo_ch" class="form-control input-sm" autofocus="" placeholder="Optional Contact no"></div>
									<div class="col-sm-3 right"><b>Visit Circle</b></div>
									<div class="col-sm-2 mg-top-18"><input value="weekly" name="circle" autofocus="" type="radio"> Week</div>
									<div class="col-sm-2 mg-top-18"><input value="monthly" name="circle" autofocus="" type="radio"> Month</div>
									<div class="col-sm-2 mg-top-18"><input value="irregularly" name="circle" autofocus="" type="radio"> Custom</div>
								</div>
								
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<div>
							<button id="saveBtn-ch" class="btn btn-primary btn-md" data-dismiss="modal" aria-hidden="true">Add Now</button>
							<ul class="pull-left list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
						</div>  
					</div>
				</div>
			</div>
		</div>

		<a id="close-mod" href="#success" class="hidden" role="button" data-toggle="modal"></a>
		<div id="success" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<center><h4 style="margin-bottom:20px"><b>Congratulation</b></h4></center>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12"><center><h4>You have Successfully added a new chamber</h4></center></div>
						</div>
					</div>
					<div class="modal-footer">
						<div>
							<button id="closeBtn-ch" class="btn btn-primary btn-md" data-dismiss="modal" aria-hidden="true">Close</button>
							
						</div>  
					</div>
				</div>
			</div>
		</div>

		<a id="failed-mod" href="#failed" class="hidden" role="button" data-toggle="modal"></a>
		<div id="failed" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog danger-modal">
				<div class="modal-content">
					<div class="modal-header danger-modal">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<center><h4><b>We are sorry</b></h4></center>

						<div class="row">
							<div class="col-sm-12"><center><h4>You have kept empty field/s</h4></center></div>
							
						</div>
						
					</div>
					

				</div>
			</div>
		</div>

		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#saveBtn-ch").click(function(){
					var name = $("#name_ch").val();
					var houseno = $("#houseno_ch").val();
					var housename = $("#housename_ch").val();
					var streetno = $("#streetno_ch").val();
					var streetname = $("#streetname_ch").val();
					var town = $("#town_ch").val();
					var postcode = $("#postcode_ch").val();
					var city = $("#city_ch").val();
					var phone = $("#phoneone_ch").val();
					var country = $("#country_ch option:selected").text();
					var circle = $("input[name=circle]:checked").val();
					$.post("chamber.php",{
						type: "addChamber",
						name: name,
						houseno: houseno,
						housename: housename,
						streetno: streetno,
						streetname: streetname,
						town: town,
						postcode: postcode,
						city: city,
						phone: phone,
						country: country,
						circle: circle
					},function(data){
						var success = data.indexOf("SuccessFuLly AddeD...!!");
						var failed = data.indexOf("FailEd tO INSerT..");
						if(success >= 0){
							$("#close-mod").click();
						}else if(failed >= 0){
							alert("Failed to insert...");
						}else{
							$("#failed-mod").click();
						}
					});
				});
});
</script>
</body>
</html>