<?php
	include_once("config.inc.php");

	$tz = $_POST['tz'];
	$name=$_POST['name']; 
	$email=$_POST['email'];
	$category=$_POST['category'];
	$country=$_POST['country'];
	$postcode=$_POST['postcode'];
	$month=$_POST['month'];
	$day=$_POST['day'];
	$year=$_POST['year'];
	$password=$_POST['password']; // Password Encryption, If you like you can also leave sha1.
	$agree=$_POST['agree'];
	$speciality=$_POST['speciality'];
	// Check if e-mail address syntax is valid or not
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$regex = "/^[A-Z0-9- ]+$/";
	//$regexuser = "/^([a-zA-Z])+[A-Za-z0-9_]+$/";
	$regexuser = "/^([a-z])+[a-z0-9_]+$/";
	$sex = "sexon";
	$setsex = "sexset";
	$birthday = $year."-".$month."-".$day;


	$http_client_ip=$_SERVER['HTTP_CLIENT_IP'];
    $http_x_forwarded_for=$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote_addr=$_SERVER['REMOTE_ADDR'];

    if(!empty($http_client_ip)){
        $ip=$http_client_ip;
    }else if(!empty($http_x_forwarded_for)){
        $ip=$http_x_forwarded_for;
    }else{
        $ip=$remote_addr;
    }


	if($category == 'doctor'){
		$sex=$_POST['sex'];
		$setsex=$_POST['setsex'];
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo "invalid email...";
	}else if(!preg_match($regexuser, $name)){
        echo "please use lowercase alphabet, number or underscore.";
	}else if(strlen($postcode)<3 || strlen($postcode)>9 || (!preg_match($regex, $postcode))){
        echo "invalid post code format.";
    }else if(is_numeric($name)){
    	echo "username cannot begin with a number.";
    }else if($speciality == 'Select one' && $category == 'doctor'){
    	echo "you miss this one!";
    	exit();
    }else if($sex == null && $category == 'doctor'){	
    	echo "required field sex.";
    }else if($month == 0 || $day == 'Day' || $year == 'Year'){
    	echo "required field birthday.";
    }else if($agree == null){
    	echo "you must agree.";
    }
    else{
    		$password_hash = md5($password);
		
			$dresult_username = mysqli_query($db_conx, "SELECT * FROM doctors WHERE doctor_username='$name'LIMIT 1");
			$ddata_username = mysqli_num_rows($dresult_username);

			$hresult_username = mysqli_query($db_conx, "SELECT * FROM hospitals WHERE hospital_username='$name'LIMIT 1");
			$hdata_username = mysqli_num_rows($hresult_username);

			$diaresult_username = mysqli_query($db_conx, "SELECT * FROM diagnostics WHERE diagnostic_username='$name' LIMIT 1");
			$diadata_username = mysqli_num_rows($diaresult_username);

			$cresult_username = mysqli_query($db_conx, "SELECT * FROM companies WHERE company_username='$name'LIMIT 1");
			$cdata_username = mysqli_num_rows($cresult_username);

			$aresult_username = mysqli_query($db_conx, "SELECT * FROM ambulances WHERE ambulance_username='$name'LIMIT 1");
			$adata_username = mysqli_num_rows($aresult_username);
			$com_code = md5(uniqid(rand()));
			setcookie('comcode', $com_code, strtotime('+30 days'),"/","","",TRUE);
			setcookie('regconfname', $name, strtotime('+30 days'),"/","","",TRUE);
        	setcookie('regconfemail', $email, strtotime('+30 days'),"/","","",TRUE);
        	setcookie('regconfcat', $category, strtotime('+30 days'),"/","","",TRUE);
			
			if($ddata_username == 0){
				if($hdata_username == 0){
					if($diadata_username == 0){
						if($cdata_username == 0){
							if($adata_username == 0){

								if($category=="doctor"){
									$dresult_email = mysqli_query($db_conx,"SELECT * FROM doctors WHERE doctor_email='$email' LIMIT 1");
									$ddata_email = mysqli_num_rows($dresult_email);

									if(($ddata_email)==0){
										$query = mysqli_query($db_conx,"INSERT INTO doctors(doctor_username, doctor_email, doctor_password, doctor_birthday, doctor_sex, doctor_postcode, doctor_country, joindate, activated, ip, com_code, tz) 
										VALUES ('$name', '$email', '$password_hash', '$birthday','$setsex','$postcode','$country',NOW(),0,'$ip','$com_code','$tz')"); // Insert query
										$optionquery = mysqli_query($db_conx,"INSERT INTO doctors_options(doctor_username) VALUES ('$name')");
										$personalquery = mysqli_query($db_conx,"INSERT INTO doctors_personal(speciality,sex,birth_year,postcode,country) VALUES ('$speciality','$setsex','$year','$postcode','$country')");
										$proquery = mysqli_query($db_conx,"INSERT INTO doctors_professional(doctor_username,country) VALUES ('$name','$country')");
										
										if($query && $optionquery){
											echo "You have Successfully Registered.....";
											$idsql = mysqli_query($db_conx,"SELECT doctor_id FROM doctors WHERE doctor_email='$email' LIMIT 1");
											$row = mysqli_fetch_array($idsql);
											$inid = $row[0];
											$region_newquery=mysqli_query($db_conx,"INSERT INTO regions(id,category,sex,postcode,country) VALUES ('$inid','$category','$setsex','$postcode','$country')");
											
											$_SESSION['reg']="registered";
											setcookie('reg', 'Registered', strtotime('+30 days'),"/","","",TRUE);
										}else{
											echo "Database Error....!!";
										}
									}else{
										echo "This email is already registered, Please try another email...";
									}

								}else if($category=="hospital"){
									$hresult_email = mysqli_query($db_conx, "SELECT * FROM hospitals WHERE hospital_email='$email' LIMIT 1");
									$hdata_email = mysqli_num_rows($hresult_email);

									if(($hdata_email)==0){
										$query = mysqli_query($db_conx, "INSERT INTO hospitals(hospital_username, hospital_email, hospital_password, hospital_esmonth, hospital_esday, hospital_esyear, hospital_postcode, hospital_country, joindate, activated, ip, com_code,tz) 
										VALUES ('$name', '$email', '$password_hash', '$month', '$day', '$year', '$postcode','$country',NOW(),0,'$ip','$com_code','$tz')"); // Insert query
										$optionquery = mysqli_query($db_conx, "INSERT INTO hospitals_options (hospital_username) VALUES ('$name')");
										$infoquery = mysqli_query($db_conx, "INSERT INTO hospitals_info (hospital_username,estd,country) VALUES ('$name','$year','$country')");
										if($query && $optionquery && $infoquery){
											echo "You have Successfully Registered.....";
											$idsql = mysqli_query($db_conx,"SELECT hospital_id FROM hospitals WHERE hospital_email='$email' LIMIT 1");
											$row = mysqli_fetch_array($idsql);
											$inid = $row[0];
											$region_newquery=mysqli_query($db_conx,"INSERT INTO regions(id,category,postcode,country) VALUES ('$inid','$category','$postcode','$country')");
											
											$_SESSION['reg']="registered";
											setcookie('reg', 'Registered', strtotime('+30 days'),"/","","",TRUE);
										}else{
											echo "Error....!!";
										}
									}else{
										echo "This email is already registered, Please try another email...";
									}

								}else if($category=="diagnostic"){
									$diaresult_email = mysqli_query($db_conx, "SELECT * FROM diagnostics WHERE diagnostic_email='$email' LIMIT 1");
									$diadata_email = mysqli_num_rows($diaresult_email);

									if(($diadata_email)==0){
										$query = mysqli_query($db_conx, "INSERT INTO diagnostics(diagnostic_username, diagnostic_email, diagnostic_password, diagnostic_esmonth, diagnostic_esday, diagnostic_esyear, diagnostic_postcode, diagnostic_country, joindate, activated, ip, com_code) 
										VALUES ('$name', '$email', '$password_hash','$month', '$day', '$year','$postcode','$country',NOW(),0,'$ip','$com_code')"); // Insert query
										$optionquery = mysqli_query($db_conx, "INSERT INTO diagnostics_options (diagnostic_username) VALUES ('$name')");
										if($query && $optionquery){
											echo "You have Successfully Registered.....";
											$idsql = mysqli_query($db_conx,"SELECT diagnostic_id FROM diagnostics WHERE diagnostic_email='$email' LIMIT 1");
											$row = mysqli_fetch_array($idsql);
											$inid = $row[0];
											$region_newquery=mysqli_query($db_conx,"INSERT INTO regions(id,category,postcode,country) VALUES ('$inid','$category','$postcode','$country')");
											setcookie('reg', 'Registered', strtotime('+30 days'),"/","","",TRUE);
											$_SESSION['reg']="registered";
										}else{
											echo "Error....!!";
										}
									}else{
										echo "This email is already registered, Please try another email...";
									}

								}else if($category=="medicine"){
									$cresult_email = mysqli_query($db_conx, "SELECT * FROM companies WHERE company_email='$email' LIMIT 1");
									$cdata_email = mysqli_num_rows($cresult_email);

									if(($cdata_email)==0){
										$query = mysqli_query($db_conx, "INSERT INTO companies(company_username, company_email, company_password, company_esmonth, company_esday, company_esyear, company_postcode, company_country, joindate, activated, ip, com_code) 
										VALUES ('$name', '$email', '$password_hash','$month', '$day', '$year','$postcode','$country',NOW(),0,'$ip','$com_code')"); // Insert query
										$optionquery = mysqli_query($db_conx, "INSERT INTO companies_options (company_username) VALUES ('$name')");
										if($query && $optionquery){
											echo "You have Successfully Registered.....";
											$idsql = mysqli_query($db_conx,"SELECT company_id FROM companies WHERE company_email='$email' LIMIT 1");
											$row = mysqli_fetch_array($idsql);
											$inid = $row[0];
											$region_newquery=mysqli_query($db_conx,"INSERT INTO regions(id,category,postcode,country) VALUES ('$inid','$category','$postcode','$country')");
											
											$_SESSION['reg']="registered";
											setcookie('reg', 'Registered', strtotime('+30 days'),"/","","",TRUE);
										}else{
											echo "Error....!!";
										}
									}else{
										echo "This email is already registered, Please try another email...";
									}
									
								}else if($category=="ambulance"){
									$cresult_email = mysqli_query($db_conx, "SELECT * FROM ambulances WHERE ambulance_email='$email' LIMIT 1");
									$cdata_email = mysqli_num_rows($cresult_email);

									if(($cdata_email)==0){
										$query = mysqli_query($db_conx, "INSERT INTO ambulances(ambulance_username, ambulance_email, ambulance_password, ambulance_esmonth, ambulance_esday, ambulance_esyear, ambulance_postcode, ambulance_country, joindate, activated, ip, com_code)
										 VALUES ('$name', '$email', '$password_hash','$month', '$day', '$year','$postcode','$country',NOW(),0,'$ip','$com_code')"); // Insert query
										$optionquery = mysqli_query($db_conx, "INSERT INTO ambulances_options (ambulance_username) VALUES ('$name')");
										if($query && $optionquery){
											echo "You have Successfully Registered.....";
											$idsql = mysqli_query($db_conx,"SELECT ambulance_id FROM ambulances WHERE ambulance_email='$email' LIMIT 1");
											$row = mysqli_fetch_array($idsql);
											$inid = $row[0];
											$region_newquery=mysqli_query($db_conx,"INSERT INTO regions(id,category,postcode,country) VALUES ('$inid','$category','$postcode','$country')");
											setcookie('reg', 'Registered', strtotime('+30 days'),"/","","",TRUE);
											$_SESSION['reg']="registered";
										}else{
											echo "Error....!!";
										}
									}else{
										echo "This email is already registered, Please try another email...";
									}
								}

							}else{
								echo "This username is already registered, Please try another name...";
							}
						}else{
							echo "This username is already registered, Please try another name...";
						}
					}else{
						echo "This username is already registered, Please try another name...";
					}
				}else{
					echo "This username is already registered, Please try another name...";
				}
			}else{
				echo "This username is already registered, Please try another name...";
			}

    }

?>