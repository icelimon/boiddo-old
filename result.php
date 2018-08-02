<?php
include_once("config.inc.php")
?>

<?php 
	$name = $_GET['name'];
	$category = $_GET['category'];
	$country = $_GET['country'];
	$postcode = $_GET['postcode'];
	$city = $_GET['city'];

	if($category == 'Doctor'){
		$sex = $_GET['gender'];
		$speciality = $_GET['speciality'];
		if($speciality == 'Any'){
			$speciality = "";
		}
		if($sex == 'Any'){
			$sex = "";
		}
		if(empty($name) && empty($postcode) && empty($speciality)){
			$sql = "SELECT id FROM regions WHERE country='$country' AND category='doctor'";
		}else if(empty($name) && empty($postcode) && !empty($speciality)){
			$sql = "SELECT id FROM regions WHERE country='$country' AND speciality='$speciality' AND category='doctor'";
		}else if(empty($name) && !empty($postcode) && empty($speciality)){
			$sql = "SELECT id FROM regions WHERE country='$country' AND category='doctor' AND postcode LIKE '%$postcode%'";
		}else if(empty($name) && !empty($postcode) && !empty($speciality)){
			$sql = "SELECT id FROM regions WHERE country='$country' AND speciality='$speciality' AND category='doctor' AND postcode LIKE '%$postcode%'";
		}else if(!empty($name) && empty($postcode) && empty($speciality)){
			$sql = "SELECT id FROM regions WHERE country='$country' AND category='doctor' AND name LIKE '%$name%'";
		}else if(!empty($name) && empty($postcode) && !empty($speciality)){
			$sql = "SELECT id FROM regions WHERE country='$country' AND speciality='$speciality' AND category='doctor' AND name LIKE '%$name%'";
		}else if(!empty($name) && !empty($postcode) && empty($speciality)){
			$sql = "SELECT id FROM regions WHERE country='$country' AND category='doctor' AND name LIKE '%$name%'";
		}else{
			$sql = "SELECT id FROM regions WHERE country='$country' AND speciality='$speciality' AND category='doctor' AND name LIKE '%$name%' AND postcode LIKE '%$postcode%'";
		}
		
		$query = mysqli_query($db_conx,$sql);
		$num=mysqli_num_rows($query);
		$i=0;
		$newnum = 0;
		while ($row = mysqli_fetch_assoc($query)) {
			$id = $row['id'];
			if(empty($sex) && empty($city)){
				$newsql = "SELECT * FROM doctors_personal WHERE doctor_id='$id' LIMIT 1";
			}else if(empty($sex) && !empty($city)){
				$newsql = "SELECT * FROM doctors_personal WHERE doctor_id='$id' AND city='$city' LIMIT 1";
			}else if(!empty($sex) && empty($city)){
				$newsql = "SELECT * FROM doctors_personal WHERE doctor_id='$id' AND sex='$sex' LIMIT 1";
			}else{
				$newsql = "SELECT * FROM doctors_personal WHERE doctor_id='$id' AND city='$city' AND sex='$sex' LIMIT 1";
			}
			
			$newquery = mysqli_query($db_conx,$newsql);
			$numquery = mysqli_num_rows($newquery);
			
			if($numquery > 0){
				$newnum += 1;
				while($newrow = mysqli_fetch_assoc($newquery)){
					$doc_ids[$i] = $newrow['doctor_id'];
					$doc_name[$i] = $newrow['full_name'];
					$doc_speciality[$i] = $newrow['speciality'];
					$doc_degrees[$i] = $newrow['degrees'];
					$doc_sex[$i] = $newrow['sex'];
					$birth_year[$i] = $newrow['birth_year'];
					$doc_apt_no[$i] = $newrow['apt_no'];
					$doc_apt_name[$i] = $newrow['apt_name'];
					$doc_str_no[$i] = $newrow['street_no'];
					$doc_str_name[$i] = $newrow['street_name'];
					$doc_town[$i] = $newrow['town'];
					$doc_city[$i] = $newrow['city'];
					$doc_postcode[$i] = $newrow['postcode'];
					$doc_country[$i] = $newrow['country'];
					$doc_age[$i] = date("Y") - $birth_year[$i];
				}
				$doc_id = $doc_ids[$i];
				$sql_option = "SELECT * FROM doctors_options WHERE doctor_id='$doc_id' LIMIT 1";
				$query_option = mysqli_query($db_conx, $sql_option);
				while ($oprow = mysqli_fetch_array($query_option, MYSQLI_ASSOC)) {
					$avatar = $oprow["image"];
					$avatar_name = $oprow["img_name"];
					$profile_pic[$i] = '<img class="img-rounded" src="user_doc/'.$avatar_name.'" alt="'.$doc_name[$i].'" height="100px" width="100px">';
				}
				$sql_pro = "SELECT * FROM doctors_professional WHERE doctor_id='$doc_id' LIMIT 1";
				$query_pro = mysqli_query($db_conx, $sql_pro);
				while($rowpro = mysqli_fetch_assoc($query_pro)){
					$hos_name[$i] = $rowpro['hospital_name'];
					$hos_str_no[$i] = $rowpro['street_no'];
					$hos_str_name[$i] = $rowpro['street_name'];
					$hos_town[$i] = $rowpro['town'];
					$hos_city[$i] = $rowpro['city'];
					$hos_postcode[$i] = $rowpro['postcode'];
					$hos_country[$i] = $rowpro['country'];
					$hos_service[$i] = $rowpro['hospital_services'];
				}
				$cham_query = mysqli_query($db_conx,"SELECT chamber_id FROM doctors_chambers WHERE doctor_id='$doc_id' AND main_hospital='1' LIMIT 1");
				while($cham_rows = mysqli_fetch_assoc($cham_query)){
					$cham_ids[$i] = $cham_rows['chamber_id'];
				}
				$i++;
			}
	    }

	}else if($category == 'Hospital'){
		$sql_pro = "";
		$sql_info = "";
		$main = 0;
		$service = $_GET['service'];
		if($service == 'Any'){
			$service = "";
		}

		if(empty($service)){
			if(empty($name) && empty($postcode)){
				$sql_info = "SELECT hospital_id FROM hospitals_info WHERE country='$country'";
				$sql_pro = "SELECT doctor_id FROM doctors_professional WHERE hos_country='$country'";
			}else if(empty($name) && !empty($postcode)){
				$sql_info = "SELECT hospital_id FROM hospitals_info WHERE country='$country' AND postcode LIKE '%$postcode%'";
				$sql_pro = "SELECT doctor_id FROM doctors_professional WHERE hos_country='$country' AND postcode LIKE '%$postcode%'";
			}else if(!empty($name) && empty($postcode)){
				$sql_info = "SELECT hospital_id FROM hospitals_info WHERE country='$country' AND fullname LIKE '%$name%'";
				$sql_pro = "SELECT doctor_id FROM doctors_professional WHERE hos_country='$country' AND hospital_name LIKE '%$name%'";
			}else{
				$sql_info = "SELECT hospital_id FROM hospitals_info WHERE country='$country' AND fullname LIKE '%$name%' AND postcode LIKE '%$postcode%'";
				$sql_pro = "SELECT doctor_id FROM doctors_professional WHERE hos_country='$country' AND hospital_name LIKE '%$name%' AND postcode LIKE '%$postcode%'";
			}

		}else{
			if(empty($name) && empty($postcode)){
				$sql_info = "SELECT hospital_id FROM hospitals_info WHERE country='$country' AND services LIKE '%$service%'";
				$sql_pro = "SELECT doctor_id FROM doctors_professional WHERE hos_country='$country' AND hospital_services LIKE '%$service%'";
			}else if(empty($name) && !empty($postcode)){
				$sql_info = "SELECT hospital_id FROM hospitals_info WHERE country='$country' AND services LIKE '%$service%'AND postcode LIKE '%$postcode%'";
				$sql_pro = "SELECT doctor_id FROM doctors_professional WHERE hos_country='$country' AND hospital_services LIKE '%$service%'AND postcode LIKE '%$postcode%'";
			}
			else if(!empty($name) && empty($postcode)){
				$sql_info = "SELECT hospital_id FROM hospitals_info WHERE country='$country' AND services LIKE '%$service%'AND fullname LIKE '%$name%'";
				$sql_pro = "SELECT doctor_id FROM doctors_professional WHERE hos_country='$country' AND hospital_services LIKE '%$service%'AND hospital_name LIKE '%$name%'";
			}else{
				$sql_info = "SELECT hospital_id FROM hospitals_info WHERE country='$country' AND fullname LIKE '%$name%' AND services LIKE '%$service%' AND postcode LIKE '%$postcode%'";
				$sql_pro = "SELECT doctor_id FROM doctors_professional WHERE hos_country='$country' AND hospital_name LIKE '%$name%' AND hospital_services LIKE '%$service%' AND postcode LIKE '%$postcode%'";
			}
		}

		$query_info = mysqli_query($db_conx,$sql_info);
		$hos_info = mysqli_num_rows($query_info);

		$num_hos = $hos_info;
		$i = 0;
		$newnum = 0;
		if($hos_info > 0){
			while ($row = mysqli_fetch_assoc($query_info)) {
				$id = $row['hospital_id'];
				if(empty($city)){
					$sql = "SELECT * FROM hospitals_info WHERE hospital_id='$id' LIMIT 1";
				}else{
					$sql = "SELECT * FROM hospitals_info WHERE hospital_id='$id' AND city LIKE '%$city%' LIMIT 1";
				}
				
				$query = mysqli_query($db_conx,$sql);
				while ($rowinfo = mysqli_fetch_assoc($query)) {
					$newnum += 1;
					$hos_ids[$i] = $rowinfo['hospital_id'];
					$hos_name[$i] = $rowinfo['fullname'];
					$hos_service[$i] = $rowinfo['services'];
					$hos_str_no[$i] = $rowinfo['street_no'];
					$hos_str_name[$i] = $rowinfo['street_name'];
					$hos_town[$i] = $rowinfo['town'];
					$hos_city[$i] = $rowinfo['city'];
					$hos_postcode[$i] = $rowinfo['postcode'];
					$hos_country[$i] = $rowinfo['country'];
					$hos_capacity[$i] = $rowinfo['capacity'];

				$sql_option = "SELECT * FROM hospitals_options WHERE hospital_id='$id' LIMIT 1";
				$query_option = mysqli_query($db_conx, $sql_option);
				while ($oprow = mysqli_fetch_array($query_option, MYSQLI_ASSOC)) {
					$avatar = $oprow["image"];
					$avatar_name = $oprow["img_name"];
					$profile_pic[$i] = '<img class="img-rounded" src="user_hos/'.$avatar_name.'" alt="'.$hos_name[$i].'" height="100px" width="100px">';
				}
				$i++;
			}
		    }
		    $main = 1;
		}
		if($newnum == 0){
			$pro_query = mysqli_query($db_conx,$sql_pro);
			$num_hos = mysqli_num_rows($pro_query);
			$newnum = 0;
			$main = 0;
			$i=0;
			while($row = mysqli_fetch_assoc($pro_query)){
				$id = $row['doctor_id'];
				if(empty($city)){
					$sql = "SELECT * FROM doctors_professional WHERE doctor_id='$id' LIMIT 1";
				}else{
					$sql = "SELECT * FROM doctors_professional WHERE doctor_id='$id' AND city LIKE '%$city%' LIMIT 1";
				}
				$per_query = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE doctor_id='$id' LIMIT 1");
				$query_pro = mysqli_query($db_conx, $sql);
				while($rowpro = mysqli_fetch_assoc($query_pro)){
					$newnum += 1;
					$hos_name[$i] = $rowpro['hospital_name'];
					$hos_service[$i] = $rowpro['hospital_services'];
					$hos_str_no[$i] = $rowpro['street_no'];
					$hos_str_name[$i] = $rowpro['street_name'];
					$hos_town[$i] = $rowpro['town'];
					$hos_city[$i] = $rowpro['city'];
					$hos_postcode[$i] = $rowpro['postcode'];
					$hos_country[$i] = $rowpro['hos_country'];
					$hos_capacity[$i] = $rowpro['hospital_capacity'];
					
					$profile_pic[$i] = '<img class="img-rounded" src="images/hos-default.png" alt="hospital" height="100px" width="90px">';
					while($rowper = mysqli_fetch_assoc($per_query)){
						$dr_ids[$i] = $rowper['doctor_id'];
						$dr_name[$i] = $rowper['full_name'];
						$dr_speciality[$i] = $rowper['speciality'];
						$dr_sex[$i] = $rowper['sex'];
						$birthyear =  $rowper['birth_year'];
						$dr_age[$i] = date("Y")-$birthyear;
						$dr_city[$i] =  $rowper['city'];
						$dr_country[$i] =  $rowper['country'];
					}
					$img_query = mysqli_query($db_conx,"SELECT * FROM doctors_options WHERE doctor_id='$id' LIMIT 1");
					while($img_row = mysqli_fetch_assoc($img_query)){
						$img_name = $img_row['img_name'];
						$dr_pics[$i] = '<img class="img-rounded" src="user_doc/'.$img_name.'" alt="'.$dr_name[$i].'" height="80px" width="55px">';
					}
					$i++;
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="images/boiddo-band.png" />
	<title>Boiddo</title>
	<meta name="description" content="Online doctor and hospitals whats you need while trubling. Find your nearest hospital, get information about doctors and hospitals. Get serial of them... and many more options, what people need.">
	<meta name="keywords" content="online doctor, boiddo, healthcare, online hospitals, medical information">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/temp.css">
</head>

<body>
<!--1st Container Start here -->
<?php include_once('index-header.php');?>
	<div class="container">
			<!--Navbar Start here-->
		<div class="navbar navbar-inverse">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<span >
					<img href="http://www.boiddo.com" class="logo pull-left" src="images/boiddo-nav.png">
				</span>

			</div> 

			<nav class="collapse navbar-collapse" id="navbar-collapse-about" role="navigation">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="index.php#reg">Registration</a></li>
					<li><a href="about.php#contact">Contact us</a></li>
				</ul> 

			</nav>
		</div>
	</div>


	<div class="container" style="margin-top:-18px;">
		<!--Navbar End here-->
		<div class="row">
		<div class="col-xs-12 col-sm-5">
			<div class="panel panel-default bgc">
				<div class="panel-title">
					<h2 class="center"><strong>Search</strong></h2>
				</div>
				<div class="well"> 
					<form id="search" class="form-horizontal" method="post" role="form">

						<div class="form-group">
							<div class="list-inline">
								<label for="searchname" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-10">

									<input id="searchname" class="form-control" placeholder="Search by name..">

								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="list-inline">

								<label for="searchcategory" class="col-sm-2 control-label">Category</label>
								<div class="col-sm-4">
									<select id="searchcategory" class="form-control">
										<option value="ser-doc">Doctor</option>
										<option value="ser-hos">Hospital</option>
									</select>
								</div>


								<label for="searchcountry" class="col-sm-2 control-label">Country</label>
								<div class="col-sm-4">
									<select id="searchcountry" class="form-control">
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

								<!--li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li-->
							</div>
						</div>

						<div id="searchspecial" class="form-group">
							<div class="list-inline">
								<label for="searchspeciality" class="col-sm-2 control-label">Specialist</label>
								<div class="col-sm-4">

									<select id="searchspeciality" class="form-control"> 
										<option>Any</option>
                                    	<option>Addiction psychiatrist</option>
										<option>Allergist (immunologist)</option>
										<option>Anesthesiologist</option>
										<option>Cardiac electrophysiologist</option>
										<option>Cardiologist</option>
										<option>Cardiovascular surgeon</option>
										<option>Colon and rectal surgeon</option>
										<option>Critical care medicine specialist</option>       
										<option>Dermatologist</option>       
										<option>Developmental pediatrician</option>       
										<option>Emergency medicine specialist</option>       
										<option>Endocrinologist</option>
										<option>Family medicine physician</option>       
										<option>Forensic pathologist</option>       
										<option>Gastroenterologist</option>       
										<option>Geriatric medicine specialist</option>       
										<option>Gynecologist</option>       
										<option>Gynecologic oncologist</option> 
										<option>Hand surgeon</option>       
										<option>Hematologist</option>       
										<option>Hepatologist</option>       
										<option>Hospitalist</option>       
										<option>Hyperbaric physician</option> 
										<option>Infectious disease specialist</option>       
										<option>Internist</option>       
										<option>Interventional cardiologist</option>       
										<option>Medical examiner</option>       
										<option>Medical geneticist</option>
										<option>Medicine specialist</option>       
										<option>Neonatologist</option>
										<option>Nephrologist</option> 
										<option>Neurological surgeon</option>       
										<option>Neurologist</option>       
										<option>Nuclear medicine specialist</option>       
										<option>Obstetrician</option>       
										<option>Occupational medicine specialist</option>       
										<option>Oncologist</option>
										<option>Ophthalmologist</option> 
										<option>Oral surgeon</option>       
										<option>Orthopedic surgeon</option>       
										<option>Otolaryngologist (ENT specialist)</option>       
										<option>Pain management specialist</option>       
										<option>Pathologist</option>       
										<option>Pediatrician</option>
										<option>Perinatologist</option> 
										<option>Physiatrist</option>       
										<option>Plastic surgeon</option>       
										<option>Psychiatrist</option>       
										<option>Pulmonologist</option>       
										<option>Radiation oncologist</option>       
										<option>Radiologist</option>
										<option>Reproductive endocrinologist</option>       
										<option>Rheumatologist</option>       
										<option>Sleep disorders specialist</option>       
										<option>Spinal cord injury specialist</option>       
										<option>Sports medicine specialist</option>
										<option>Surgeon</option>       
										<option>Thoracic surgeon</option>
										<option>Urologist</option>       
										<option>Vascular surgeon</option>
                            		</select>

								</div>
								<div id="ser-sex">
							<div class="col-sm-4" style="float:right">
								<select id="searchsex" class="form-control">
									<option value="ser-any">Any</option>
									<option value="ser-male">Male</option>
									<option value="ser-female">Female</option>
								</select>
							</div>
							<label for="searchsex" style="float:right" class="col-sm-2 control-label">Gender</label>
						</div>
							</div>
						</div>
						
						<div id="searchservice" class="form-group">
							<div class="list-inline">
								<label for="searchservices" class="col-sm-2 control-label">Service</label>
								<div class="col-sm-4">

									<select id="searchservices" class="form-control"> 
										<option id="zero" value="zero">Any</option>
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
						</div>
						

						<div class="form-group">
							<div class="list-inline">

								<label for="searchcity" class="col-sm-2 control-label">City</label>
								<div class="col-sm-4">
									<input id="searchcity" class="form-control" placeholder="City">
								</div>
								<label for="searchpostcode" class="col-sm-2 control-label">Postcode</label>
								<div class="col-sm-4">
									<input id="searchpostcode" class="form-control" placeholder="postcode/zipcode">
								</div>
								<div class="col-sm-4">
									<p></p>
									<span id="searchpostcodeisvalid"></span>
								</div>
								
							</div>
						</div>

						<div class="form-group">
							<div class="list-inline">

								
								<div style="padding-right:5px;">
									<button id="searchbtn" class="btn btn-primary pull-right" type="button">Search</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		
			<div class="panel panel-default bgc">
				<div class="panel-title">
					<h2 class="center"><strong>Looking for <?php echo $category; ?></strong></h2>
				</div>
				<div style="background-color:#d4c2A6;color:#222" class="well">
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<h4><b>Name :</b> <?php if(empty($name)){ echo "Any";}else echo "<button class='btn btn-info disabled'>".$name."</button>"; ?></h4>
						</div>
						<div class="col-sm-6 col-xs-12">
							<h4><b>City : </b><?php if(!empty($city)){ echo "<button class='btn btn-info disabled'>".$city."</button>";}else{ echo "Any";} ?></h4>
						</div>
						<div class="col-sm-6 col-xs-12">
							<h4><?php if($category == "Doctor"){ 
								echo "<b>Speciality : </b>";
								if(empty($speciality)){echo "Any";}else{echo "<button class='btn btn-info disabled'>".$speciality."</button>";} 
								}else{
									echo "<b>Service : </b>";
									if(empty($service)){echo "Any";}else{echo "<button class='btn btn-info disabled'>".$service."</button>";} 
								} ?></h4>
						</div>
						<div class="col-sm-6 col-xs-12">
							<h4><b>Postcode : </b><?php if(empty($postcode)){ echo "Any";}else echo "<button class='btn btn-info disabled'>".$postcode."</button>";?></h4>
						</div>
						<div class="col-sm-6 col-xs-12">
							<?php if($category=='Doctor'){
							 if(!empty($sex)){echo "<h4><b>Gender : </b><button class='btn btn-info disabled'>".$sex."</button></h4>";}else{echo "<h4><b>Gender : </b>Any</h4>";}}?>
						</div>
						<div class="col-sm-6 col-xs-12">
							<h4><b>Country : </b><?php echo "<button class='btn btn-info disabled'>".$country."</button>"; ?></h4>
						</div>
						
						

					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-7">
			<div class="panel panel-default bgc">
				<div class="panel-title">
					<h2 class="center"><strong>Found - </strong><b><?php echo $newnum;?></b></h2>
				</div>

				<?php 
					if($category == "Doctor"){
						$j=0; 
						while($newnum > $j ){?>
						 <div class="well">
							<div class="row">
								<div class="col-sm-2 col-xs-4">
									<?php echo $profile_pic[$j]; ?>
								</div>
								<div class="col-sm-5 col-xs-8">
									 <?php echo 
									 "<h4 style='margin-top:0px;margin-bottom:0px'>".$doc_name[$j]."</h4>
									 <h5 style='margin-top:0px;margin-bottom:0px'>".$doc_speciality[$j]."</h5>
									 <h5 style='margin-top:0px;margin-bottom:0px'>".$doc_degrees[$j]."</h5><h5 style='margin-top:10px;margin-bottom:0px'>".$doc_sex[$j]."</h5><h5 style='margin-top:0px;margin-bottom:0px'>Age ".$doc_age[$j]." year</h5>"; ?>
									 <?php echo '<button class="btn btn-link" onclick="viewDocModal(\''.$doc_ids[$j].'\',\''.$cham_ids[$j].'\')"href="#viewdocmodal" role="button" data-toggle="modal">Details</button>'; ?>
								</div>
								<div class="col-sm-5 col-xs-9">
									 <?php echo 
									 "<h4 style='margin-top:0px;margin-bottom:0px'>".$hos_name[$j]."</h4>
									 <h5 style='margin-top:0px;margin-bottom:0px'>".$hos_city[$j]."-".$hos_postcode[$j]."</h5>
									 <h5 style='margin-top:0px;margin-bottom:0px'>".$hos_country[$j]."</h5>
									 <h5 style='margin-top:10px;margin-bottom:0px'>".$hos_service[$j]."</h5>"; ?>
								</div>
								
							</div>
						</div>
						<?php
						$j++;
						} 

					}
				?>

				<?php
				if($category == "Hospital"){
					$j = 0; 
					while($newnum > $j){?>
						<div class="well">
							<div class="row">
								<div class="col-sm-2 col-xs-4">
									<?php echo $profile_pic[$j]; ?>
								</div>
								<div class="col-sm-5 col-xs-8">
									 <?php echo 
									 "<h4 style='margin-top:0px;margin-bottom:0px'>".$hos_name[$j]."</h4><h5 style='margin-top:10px;margin-bottom:0px'>".$hos_city[$j]." - ".$hos_postcode[$j]."</h5> <h5 style='margin-top:0px;margin-bottom:0px'>".$hos_country[$j]."</h5>"; ?>
									 <?php if($main == 0){ echo '<button onclick="viewDocModal(\''.$dr_ids[$j].'\',\'Dochos\')" class="btn btn-link" href="#viewdocmodal" role="button" data-toggle="modal">Details</button>';}else{
									 	echo '<button onclick="viewHosModal(\''.$hos_ids[$j].'\')" class="btn btn-link" href="#viewhosmodal" role="button" data-toggle="modal">Details</button>';
									 	} ?>
								</div>
								<?php if($main){ echo 
								"<div class='col-sm-5 col-xs-9'>
									 	<h4 style='margin-top:0px;margin-bottom:0px'>Capacity : ".$hos_capacity[$j]."</h4>
									 	<h5 style='margin-top:10px;margin-bottom:10px'>".$hos_service[$j]."</h5></div>"; }else{
								echo 
								'<div class="col-sm-1 col-xs-2">'.$dr_pics[$j].'</div>
								<div class="col-sm-4">
								<h4>'.$dr_name[$j].'</h4>
								<i>'.$dr_speciality[$j].'</i>
								<p>'.$dr_sex[$j].' | '.$dr_age[$j].' Years Old</p>
								<p>'.$dr_city[$j].' - '.$dr_country[$j].'</p>
								</div>';
									 	}?>
								
								
							</div>
						</div>
							<?php
							$j++;
						} 

					}
				?>
				</div>
			</div>
		</div><!--row end-->
	</div><!--container end-->

<!--modal-->

	<div id="viewdocmodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div style="text-align:center;background-color:#5BC0DE;" class="modal-header">
					<span style="font-size: 18px;" id="doc-name"></span>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
					<p style="font-style:italic;"><span id="doc-spe"></span></p>
				</div>
				<div class="modal-body">
					<form class="form center-block">
						<div class="form-group">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4"><span id="doc-pic"></span></div>
								<div class="col-xs-1 col-sm-1 col-md-1"></div>
								<div class="col-xs-11 col-sm-7 col-md-7">
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="doc-deg"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="doc-sex"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="doc-age"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:8px;"><span id="doc-apt"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="doc-str"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="doc-tow"></span></div>
									<div class="col-xs-12 col-sm-12 col-md-12"><span id="doc-cit"></span></div>
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
				<div  style="background-color:#5BC0DE;padding-bottom:15px;" class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	<!--Modal End Here-->

	<!--hosmodal-->

	<div id="viewhosmodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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

<?php include_once("boiddo-footer.php");?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">

function viewDocModal(id,cham){
	var doc_id = id;
	var cham_id = cham;
	//alert(cham);
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
	
	$.post("modals.php",{hos_id: hos_id,  category: "hospitals"},function(data){
		var ndata = $.parseJSON(data);
		//alert(data);
		var emer = ndata.hos_ser.indexOf('Emergency');
		$.each(ndata, function(index, item) {
	    	//alert(index + " : " + item);
		});
		$("#hos-fullname").html(ndata.hos_name);
		$("#hos-add").html(ndata.hos_city+"&nbsp-&nbsp"+ndata.hos_country);
		$("#hos-photo").html(ndata.pro_pic);
		//alert(ndata.hos_name);
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
$(document).ready(function() {

	$("#searchbtn").click(function(){

		var name = $("#searchname").val();
		var postcode = $("#searchpostcode").val();
		var city = $("#searchcity").val();
		var category = $("#searchcategory option:selected").text();
		var country = $("#searchcountry option:selected").text();
		var sex = $("#searchsex option:selected").text();
		var speciality = $("#searchspeciality option:selected").text();
		var service = $("#searchservices option:selected").text();
		$.get("result.php",{
			name: name,
			postcode: postcode,
			category: category,
			city: city,
			country: country,
			gender: sex,
			specility: speciality,
			service: service
		},function(data){
			if(category == 'Doctor'){
				window.location.href = "result.php?name="+name+"&category="+category+"&city="+city+"&postcode="+postcode+"&country="+country+"&speciality="+speciality+"&gender="+sex;
			}else{
				window.location.href = "result.php?name="+name+"&category="+category+"&city="+city+"&postcode="+postcode+"&country="+country+"&service="+service;
			}
			
		});
	});


$('#searchcategory').change(function () {
	var optionSelected = $(this).find("option:selected").text();
	if(optionSelected == 'Doctor'){
		$('#searchspecial').show();
		$('#ser-sex').show();
		$('#searchservice').hide();
	}else if(optionSelected == 'Hospital' || optionSelected == 'Diagnostic' || optionSelected == 'Ambulance' || optionSelected == 'Medicine'){
		$('#searchspecial').hide();
		$('#ser-sex').hide();
		$('#searchservice').show();
	}
});

});
</script>
	</body>
	</html>

	