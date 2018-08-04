<?php
include_once("check-login-status.php");
if($user_ok == true){
	header("Location: dr-planet.php");
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
<?php 
	include_once("index-header.php");
?>
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
					<li><a href="myrequest.php">Check Request</a></li>
					<li><a href="about.php#contact">Contact us</a></li>
				</ul> 

			</nav>
		</div>
		<!--Navbar End here-->
</div>


<div class="container" style="margin-top:-22px;">

	<!--First Content Start here-->
	<div class="row">
	<img class="img-responsive" style="margin:0px;padding:0 5px 0 5px" width="auto" src="images/boiddo-baner.jpg">
		<!--Left Column Start here-->
		<br/>
		<div class="col-xs-12 col-sm-12 col-md-6">
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
			<!--Get this app Start here-->
			<div class="panel panel-default">
				<h3 style="text-align: center; padding: 10px" class="bg-navi">Get this</h3>
				<div class="col-xs-12 col-sm-12 col-md-12">
				</div>
				<div class="panel-body no-bottom-margin-padding">

					<h4>OMI</h4>
				</div>
			</div>
		</div>

		<!--Right column Start here-->
		<div class="col-xs-12 col-sm-12 col-md-6">

			<!--Registration form Start here-->
			
				<?php 
				if($user_ok != true){
					include_once("registration.php");
				}
				?>
			
			<!--Registration End here-->
		</div>
		<!--1st Right Column End here-->
	</div>
	<!--First Row End here-->



	<!--Recently connected diagnostic start here-->
	<div class="divider">
		<p></p>
	</div>
	<!--2nd Row Start here-->
	<div class="row">

		<!--2nd Left Column Start here-->
		<div class="col-xs-12 col-sm-12 col-md-8">
			<!--Recently connected all start here-->
			<div class="divider">
				<p></p>
			</div>



			<?php
			$sql = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE published='1' ORDER BY doctor_id DESC 
					LIMIT 6") or die('Invalid query: doc per' . mysqli_error());
                                //$query = mysqli_query($db_conx, $sql);
				$k=0;
				while($rowpersonal=mysqli_fetch_assoc($sql)){
					$personalData[$k][0]=$rowpersonal['full_name'];
					$personalData[$k][1]=$rowpersonal['speciality'];
					$personalData[$k][2]=$rowpersonal['degrees'];
					$personalData[$k][3]=$rowpersonal['street_name'];
					$personalData[$k][4]=$rowpersonal['town'];
					$personalData[$k][5]=$rowpersonal['city'];
					$k++;
				}

			$result = mysqli_query($db_conx,"SELECT * FROM doctors WHERE updated='1'
				ORDER BY doctor_id DESC 
				LIMIT 6") or die('Invalid query: doc' . mysqli_error());
			$i=0;
			$numdr = mysqli_num_rows($result);
			
			while ($row = mysqli_fetch_assoc($result)) {
				$doc_id[$i] = $row['doctor_id'];
				$list[$i][0]= $row['doctor_sex'];
				$list[$i][1]= $row['doctor_country'];
				$list[$i][2]= $row['doctor_postcode'];
				$list[$i][3]= $row['joindate'];
				$doctorid = $doc_id[$i];
				$query = mysqli_query($db_conx,"SELECT chamber_id FROM doctors_chambers WHERE doctor_id='$doctorid' AND main_hospital='1' LIMIT 1");
				while($row_chamber = mysqli_fetch_assoc($query)){
					$chamber_id[$i] = $row_chamber['chamber_id'];
				}
				$i++;
			}

			if($numdr>0){
				$sql = mysqli_query($db_conx,"SELECT image, img_name FROM doctors_options WHERE published='1' ORDER BY doctor_id DESC 
					LIMIT 6") or die('Invalid query: doc img' . mysqli_error());
                                //$query = mysqli_query($db_conx, $sql);
				$j=0;
				while($rows=mysqli_fetch_assoc($sql)){
					$optionData[$j][0]=$rows['image'];
					$optionData[$j][1]=$rows['img_name'];
					$profile_pic[$j] = '<img class="img-responsive img-circle" src="user_doc/'.$rows['img_name'].'" alt="'.$personalData[$j][0].'"height="80px" width="80px">';
					$profile_pic_xs[$j] = '<img class="img-responsive img-circle" src="user_doc/'.$rows['img_name'].'" alt="'.$rows['img_name'].'"height="100px" width="100px">';
					$j++;
				}

				

				$sql = mysqli_query($db_conx,"SELECT * FROM doctors_professional WHERE published='1' ORDER BY doctor_id DESC 
					LIMIT 6") or die('Invalid query: ' . mysqli_error());
				//$query = mysqli_query($db_conx, $sql);
				
				$l=0;
				while($rowpro=mysqli_fetch_assoc($sql)){
					$proData[$l][0]=$rowpro['hospital_name'];
					$proData[$l][1]=$rowpro['street_name'];
					$proData[$l][2]=$rowpro['town'];
					$proData[$l][3]=$rowpro['city'];
					$proData[$l][4]=$rowpro['postcode'];
					$proData[$l][5]=$rowpro['phone'];
					$l++;
				}
			}
 
			?>

			<!--Recently connected doctors Start here-->
			<div class="panel panel-primary ">
				<h3 style="text-align: center; padding: 10px" class="bg-blue">Recently Connected Doctors</h3>

				<div class="panel-body">
					<div class="row">
					<?php 
					$limits = ($numdr>=3)?3:$numdr;
					for($i=0;$i<$limits;$i++){?>
						<div class="col-xs-12 col-sm-4 col-md-4">
							<div class="panel panel-info">
								<div class="hidden-xs">
									<span><?php echo $profile_pic[$i]; ?></span>
									<img src="images/blank.png" alt="doctor details" height="160px" width="160px">
								</div>
								<div class="visible-xs">
									<span><?php echo $profile_pic_xs[$i]; ?></span>
									<img src="images/blank.png" alt="doctor details" height="140px" width="140px">
								</div>
								<div class="connected"> 
									<?php echo "<h4>".$personalData[$i][0]."</h4>" ?>
									<?php echo "<span><strong>".$personalData[$i][1]."</strong></span>" ?>
									<?php echo "<p>".$personalData[$i][2]."</p>" ?>
									<span> <?php echo $proData[$i][0] ?></span>
									<span> <?php echo "<p>".$proData[$i][2].",".$proData[$i][3]."-".$proData[$i][4]."</p>" ?></span>
									<span> <?php echo $list[$i][1] ?></span>
									<?php echo "<p style='color: #173;'>Signup : ".$list[$i][3]."</p>"; ?>
									<?php echo '<button id="doc-modal-'.$i.'" value="'.$doc_id[$i].'" class="btn btn-link" href="#docModal" role="button" data-toggle="modal">Details</button>'; ?>
									<?php echo '<input id="cham-doc-modal-'.$i.'" value="'.$chamber_id[$i].'" class="hidden">';?>
								</div>
							</div>
						</div>
					<?php }?>
					<div class="col-xs-12">
						<button id="doc-more-click" class="btn btn-link" style="padding: 0px; margin-left: 15px;" role="btn">View more</button>
					</div>
						<div id="doc-view-more">
					<?php 
					$limits = ($numdr>=6)?6:$numdr;
					for($i=3;$i<$limits;$i++){?>
						<div class="col-xs-12 col-sm-4 col-md-4">
							<div class="panel panel-info">
								<div class="hidden-xs">
									<span><?php echo $profile_pic[$i]; ?></span>
									<img src="images/blank.png" alt="doctor details" height="160px" width="160px">
								</div>
								<div class="visible-xs">
									<span><?php echo $profile_pic_xs[$i]; ?></span>
									<img src="images/blank.png" alt="doctor details" height="140px" width="140px">
								</div>
								<div class="connected"> 
									<?php echo "<h4>".$personalData[$i][0]."</h4>" ?>
									<?php echo "<span><strong>".$personalData[$i][1]."</strong></span>" ?>
									<?php echo "<p>".$personalData[$i][2]."</p>" ?>
									<span> <?php echo $proData[$i][0] ?></span>
									<span> <?php echo "<p>".$proData[$i][2].",".$proData[$i][3]."-".$proData[$i][4]."</p>" ?></span>
									<span> <?php echo $list[$i][1] ?></span>
									<?php echo "<p style='color: #173;'>Signup : ".$list[$i][3]."</p>"; ?>
									<?php echo '<button id="doc-modal-'.$i.'" value="'.$doc_id[$i].'" class="btn btn-link" href="#docModal" role="button" data-toggle="modal">Details</button>'; ?>
									<?php echo '<input id="cham-doc-modal-'.$i.'" value="'.$chamber_id[$i].'" class="hidden">';?>
								</div>
							</div>
						</div>
					<?php }?>
							<button id="doc-less-click" class="btn btn-link" style="padding: 0px; margin-left: 15px;" role="btn">View less</button>
						</div>
					</div>
				</div>

			</div>

			<!--Recently connected doctors end here-->

			<!--/div-->
			<!--2nd Left Column end here-->
			<?php
			$result = mysqli_query($db_conx,"SELECT * FROM hospitals WHERE published='1'
				ORDER BY hospital_id DESC 
				LIMIT 6") or die('database error!!');
			$num_hos = mysqli_num_rows($result);
                        //print values to screen
			$i=0;
			while ($row = mysqli_fetch_assoc($result)) {
				$hos_id[$i] = $row['hospital_id'];
				$list[$i][0]= $row['hospital_username'];
				$list[$i][1]= $row['hospital_email'];
				$list[$i][2]= $row['hospital_country'];
				$list[$i][3]= $row['hospital_postcode'];
				$list[$i][4]= $row['joindate'];
				$i++;
			}

			$sql = mysqli_query($db_conx,"SELECT image, img_name FROM hospitals_options WHERE updated='1' ORDER BY hospital_id DESC LIMIT 6") or die('Invalid query: ' . mysqli_error());
            //$query = mysqli_query($db_conx, $sql);
			$j=0;
			while($rows=mysqli_fetch_assoc($sql)){
				$hosimg[$j][0]=$rows['image'];
				$hosimg[$j][1]=$rows['img_name'];
				$j++;
			}


			$result = mysqli_query($db_conx,"SELECT * FROM hospitals_info WHERE updated='1'
				ORDER BY hospital_id DESC 
				LIMIT 6") or die('database error!!');

                        //print values to screen
			$i=0;
			
			while ($row = mysqli_fetch_assoc($result)) {
				$hosinfo[$i][0]= $row['fullname'];
				$hosinfo[$i][1]= $row['street_no'];
				$hosinfo[$i][2]= $row['street_name'];
				$hosinfo[$i][3]= $row['postcode'];
				$hosinfo[$i][4]= $row['town'];
				$hosinfo[$i][5]= $row['city'];
				$hosinfo[$i][6]= $row['capacity'];
				$hosinfo[$i][7]= $row['phone'];
				$hosinfo[$i][8]= $row['email'];
				$hosinfo[$i][9]= $row['web'];
				$hosinfo[$i][10]= $row['services'];
				$i++;
			}
			?>

			<div class="panel panel-primary">
				<h3 style="padding: 10px;" class="bg-blue center">Recently Connected Hospitals</h3>
				<div class="panel-body">
					<div class="row" style="text-align:center;">

					<?php 
					$limits = ($num_hos>=3)?3:$num_hos;
					for($i=0;$i<$limits;$i++){?>
						<div class="col-xs-12 col-sm-4 col-md-4 ">
							<div class="thumbnail">
								<?php echo '<img class="img-responsive" src="user_hos/'.$hosimg[$i][1].'" alt="'.$hosimg[0][0].'"height="80px" width="120px">'; ?>
								
								<div class="caption">
									<?php echo "<h4>".$hosinfo[$i][0]."</h4>" ?>
									<?php echo "<p>".$hosinfo[$i][5]."-".$hosinfo[$i][3]."</p>" ?>
									<?php echo "<h4>".$list[$i][2]."</h4>" ?>
									<?php echo "<p> Join date : ".$list[$i][4]."</p>" ?>
									<?php $id=$hos_id[$i]; echo '<button id="hos-modal-'.$i.'" value="'.$hos_id[$i].'" class="btn btn-link" href="#hosModal" role="button" data-toggle="modal">Details</button>'; ?>
								</div>
							</div>
						</div>
					<?php } ?>
					<div class="col-xs-12">					
						<button id="hos-more-click" class="btn btn-link pull-left" style="padding: 0px; margin-left: 15px;" role="btn">View more</button>
					</div>
						<div id="hos-view-more">
					<?php 
					$limits = ($num_hos>=3)?3:$num_hos;
					for($i=3;$i<$limits;$i++){?>
						<div class="col-xs-12 col-sm-4 col-md-4 ">
							<div class="thumbnail">
								<?php echo '<img class="img-responsive" src="user_hos/'.$hosimg[$i][1].'" alt="'.$hosimg[0][0].'"height="80px" width="120px">'; ?>
								
								<div class="caption">
									<?php echo "<h4>".$hosinfo[$i][0]."</h4>" ?>
									<?php echo "<p>".$hosinfo[$i][5]."-".$hosinfo[$i][3]."</p>" ?>
									<?php echo "<h4>".$list[$i][2]."</h4>" ?>
									<?php echo "<p> Join date : ".$list[$i][4]."</p>" ?>
									<?php $id=$hos_id[$i]; echo '<button id="hos-modal-'.$i.'" value="'.$hos_id[$i].'" class="btn btn-link" href="#hosModal" role="button" data-toggle="modal">Details</button>'; ?>
								</div>
							</div>
						</div>
					<?php } ?>
						<button id="hos-less-click" class="btn btn-link pull-left" style="padding: 0px; margin-left: 15px;" role="btn">View less</button>
						</div>
					</div>
				</div>
			</div>
				

			<!--/div-->
			<!--3rd Left Column End here-->

			<!--4th Row Start here-->
			<div class="divider">
				<p></p>
			</div>


			<!--New Founded Area Start here-->

			<!--4th Left Column Start here-->
			<!--div class="col-xs-12 col-sm-12 col-md-6 "-->

			<!--New Founded Area End here-->




		</div>
		<!--4th Left Column End here-->

		<!--/div-->
		<!--4th Row End here-->

		<!--Recently connected Medicine Company start here-->

		<!--New Left Sidebar/Row Start Here-->
		<!--div class="row"-->

		
		<!-- <div class="divider">
			<p></p>
		</div> -->

		<!--2nd Right Column Start here-->
		<div class="col-xs-12 col-sm-12 col-md-4 ">


			<!--/div-->
			<!--2nd Right Column End here-->

			<!--Recently connected Regions start here-->

			<div class="divider">
				<p></p>
			</div>

			<?php

	/****************************************************************************************************/
  	/**************************************                       ***************************************/
  	/**************************************    Region Start Here  ***************************************/
  	/**************************************                       ***************************************/
 	 /****************************************************************************************************/


				$result = mysqli_query($db_conx,"SELECT * FROM regions WHERE activated='1' AND repeated='0'
					ORDER BY region_id DESC LIMIT 6") or die('database error!!');

                    //print values to screen
					$i=0;
					$total_region = 0;
					while ($row = mysqli_fetch_assoc($result)) {
						$region_hos[$i][0]= $row['id'];
						$region_hos[$i][1]= $row['name'];
						$region_hos[$i][2]= $row['street_name'];
						$region_hos[$i][3]= $row['town'];
						$region_hos[$i][4]= $row['city'];
						$region_hos[$i][5]= $row['postcode'];
						$region_hos[$i][6]= $row['country'];
						$total_region++;
						$i++;
					}
				$hosnum[0] = 0;
				$drnum[0] = 0;
				$hosnum[1] = 0;
				$drnum[1] = 0;
				$hosnum[2] = 0;
				$drnum[2] = 0;
				$hosnum[3] = 0;
				$drnum[3] = 0;

				for($k=0;$k<$total_region;$k++){
					$temcity = $region_hos[$k][4];
					$tempost = $region_hos[$k][5];
					$temcountry = $region_hos[$k][6];
					
					$result = mysqli_query($db_conx,"SELECT * FROM regions WHERE activated='1' AND city='$temcity' AND postcode='$tempost' AND country='$temcountry' AND category='hospital'
					ORDER BY region_id DESC ") or die('database error!!');
					$i=0;
					while ($row = mysqli_fetch_assoc($result)) {
						$region_hos_id[$k][$i]= $row['id'];
						$region_hos_name[$k][$i]= $row['name'];
						$region_hos_str[$k][$i]= $row['street_name'];
						$region_hos_town[$k][$i]= $row['town'];
						$i++;
					}
					$hosnum[$k] = $i;

					$result = mysqli_query($db_conx,"SELECT * FROM regions WHERE activated='1' AND city='$temcity' AND postcode='$tempost' AND country='$temcountry' AND category='doctor'
					ORDER BY region_id DESC ") or die('database error!!');
					$i=0;
					while ($row = mysqli_fetch_assoc($result)) {
						$region_dr_id[$k][$i]= $row['id'];
						$region_dr_name[$k][$i]= $row['name'];
						$region_dr_spe[$k][$i]=$row['speciality'];
						$region_dr_str[$k][$i]= $row['street_name'];
						$region_dr_town[$k][$i]= $row['town'];
						$i++;
					}
					$drnum[$k] = $i;
				}
				
			?>

			<!--3rd Right Column Start here-->
			<!--div class="col-xs-12 col-sm-12 col-md-6 "-->
					<div style="margin-left:0px;margin-right:0px;" class="row">
						<?php
						$region = 0;
						while($total_region>$region){?>
						<div class="col-xs-12 col-sm-4 col-md-12"> 
							<div class="panel panel-info">
								<div class="bg-navi center">
									<h4 style="margin-top:0px;margin-bottom:0px;"><?php echo $region_hos[$region][4]." - ".$region_hos[$region][5];?></h4>
									<h5 style="margin-top:2px;margin-bottom:2px;"><?php echo $region_hos[$region][6];?></h5>
								</div>
								<!-- <img src="images/bannar-thumbnil.png" alt="traffic jam" class="img-responsive"> -->
								<div class="panel-body" style="text-align:center;padding: 0 2px 2px 10px;">
									
									<div class="row">
										<div class="col-md-6 col-sm-6">
											
											<?php
												if($hosnum[$region]>0){
													echo '<h5 style="color:blue">Hospitals</h5>';
													echo '<p style="margin-bottom:0px;"><strong>'.$region_hos_name[$region][0].'</strong></p>';
													echo '<p>'.$region_hos_str[$region][0].','. $region_hos_town[$region][0].'</p>';
												}
												if($hosnum[$region]>1){ 
													echo '<p style="margin-bottom:0px;"><strong>'.$region_hos_name[$region][1].'</strong></p>';
													echo '<p>'.$region_hos_str[$region][1].','. $region_hos_town[$region][1].'</p>';
												}
												if($hosnum[$region]>2){
													echo '<p style="margin-bottom:0px;"><strong>'.$region_hos_name[$region][2].'</strong></p>';
													echo '<p style="margin-bottom:20px;">'.$region_hos_str[$region][2].','.$region_hos_town[$region][2].'</p>';
												}
											?>
										</div>
										<div class="col-md-6 col-sm-6">
											<?php 
											if($drnum[$region]>0){
											 	echo '<h5 style="color:blue">Doctors</h5>';
												echo '<p style="margin-bottom:0px;"><strong>'.$region_dr_name[$region][0].'</strong></p>';
												echo '<p>'.$region_dr_spe[$region][0].'</p>';
											}
											if($drnum[$region]>1){
												echo '<p style="margin-bottom:0px;"><strong>'.$region_dr_name[$region][1].'</strong></p>';
												echo '<p>'.$region_dr_spe[$region][1].'</p>';
											}
											if($drnum[$region]>2){ 
												echo '<p style="margin-bottom:0px;"><strong>'.$region_dr_name[$region][2].'</strong></p>';
												echo '<p style="margin-bottom:20px;">'.$region_dr_spe[$region][2].'</p>';
											}?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
						$region++;
						} ?>
					</div>


			<!--Recently connected Regions end here-->

		</div>
		<!--3rd Right Column End here-->

	</div>
	<!--Left Sidebar/ Row End here-->




	<!--Modal Satrt here-->
	<div id="docmodals" class="container">
		<!-- Trigger the modal with a button -->
		<!--button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button-->

		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Modal Header</h4>
					</div>
					<div class="modal-body">
						<p>Some text in the modal.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!--Modal End here-->

</div>



<?php include_once("boiddo-footer.php"); ?>

<!--2nd Container End here-->

	<!--modal-->

	<div id="docModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
					<!-- <div>
						<button id="mod-next" type="button" class="close"><span class="glyphicon glyphicon-menu-right"></span></button>
						<button id="mod-prev" class="close pull-left list-inline"><span class="glyphicon glyphicon-menu-left"></span></button>
					</div>	 -->
				</div>
			</div>
		</div>
	</div>
	<!--Modal End Here-->

	<!--hosmodal-->

	<div id="hosModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
									<div class="col-xs-12 col-sm-12 col-md-12  pull-left list-inline"><button class="btn btn-success btn-md" data-dismiss="modal">Serial Request</button></div>
								</div>
								
							</div>
							
						</div>
					</form>
				</div>
				<div  style="background-color:#5BC0DE;padding-bottom:15px;" class="modal-footer">
					<!-- <div>
						<button id="mod-next" type="button" class="close"><span class="glyphicon glyphicon-menu-right"></span></button>
						<button id="mod-prev" class="close pull-left list-inline"><span class="glyphicon glyphicon-menu-left"></span></button>
					</div> -->	
				</div>
			</div>
		</div>
	</div>
	<!--Hospital Modal End Here-->


<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/reg.form.js"></script>
<script src="js/ex-index.js"></script>

<script type="text/javascript">


function setmodal(id){
	var doc_id = $("#"+id).val();
	var cham_id = $("#cham-"+id).val();
	var data = {doctors_id: doc_id};
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

function setmodalhos(id){
	var hos_id = $("#"+id).val();
	var data = {hos_id: hos_id};
	var modal_data = {};
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
<?php
?>