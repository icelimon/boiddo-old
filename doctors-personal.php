<?php
	include_once("check-login-status.php");

	if($user_ok != true || $log_username =="" || $log_category != "doctor"){
		header("location: index.php");
	}
?>

<?php

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    /*************************************** Updated All Sections Start Here ***************************************/
	if(($_POST['selectaction'])=='publishButtondr'){

		$pub_sql="SELECT * FROM doctors_personal WHERE doctor_id='$log_id' AND category='$log_category' LIMIT 1";
	    $pub_query = mysqli_query($db_conx,$pub_sql);
	    while ($row = mysqli_fetch_assoc($pub_query)) {
		    $pub_name = $row['full_name'];
		    $pub_strno = $row['street_no'];
		    $pub_strname = $row['street_name'];
		    $pub_degrees = $row['degrees'];
		    $pub_town = $row['town'];
		    $pub_city = $row['city'];
		    $pub_post = $row['postcode'];
		    $pub_country = $row['country'];
		    $pub_phone = $row['phone'];
		    $pub_speciality = $row['speciality'];
		    $pub_updated = $row['updated'];
		    $pub_published = $row['published'];
	    }

	    if(!empty($pub_name) && !empty($pub_strname) && !empty($pub_town) && !empty($pub_city) && !empty($pub_degrees)){
	    	$sql = "UPDATE doctors_personal SET updated='1' WHERE doctor_id='$log_id' LIMIT 1";
	    	$query = mysqli_query($db_conx, $sql);
	    }

	    $pub_sql="SELECT * FROM doctors_professional WHERE doctor_id='$log_id' AND category='$log_category' LIMIT 1";
	    $pub_query = mysqli_query($db_conx,$pub_sql);
	    while ($row = mysqli_fetch_assoc($pub_query)) {
		    $pub_hos_name = $row['hospital_name'];
		    $pub_hos_strname = $row['street_name'];
		    $pub_hos_town = $row['town'];
		    $pub_hos_city = $row['city'];
		    $pub_hos_post = $row['postcode'];
		    $pub_hos_phone = $row['phone'];
		    $pub_hos_services = $row['hospital_services'];
		    $pub_hos_capacity = $row['hospital_capacity'];
	    }
	    if(!empty($pub_hos_name) && !empty($pub_hos_strname) && !empty($pub_hos_town) && !empty($pub_hos_city) && !empty($pub_hos_post) && !empty($pub_hos_phone) && !empty($pub_hos_services) && !empty($pub_hos_capacity)){
	    	$sql = "UPDATE doctors_professional SET updated='1' WHERE doctor_username='$log_username' LIMIT 1";
	    	$query = mysqli_query($db_conx, $sql);
	    }
	    $sql = "SELECT * FROM doctors_options WHERE doctor_username='$log_username' LIMIT 1";
	    $query = mysqli_query($db_conx, $sql);
	    while($row = mysqli_fetch_assoc($query)){
	    	$options_updated = $row['updated'];
	    	$image = $row['image'];
	    }

	    $sql = "SELECT updated FROM doctors_personal WHERE doctor_id='$log_id' LIMIT 1";
	    $query = mysqli_query($db_conx, $sql);
	    $row = mysqli_fetch_array($query);
	    $personal_updated = $row[0];

	    $sql = "SELECT updated FROM doctors_professional WHERE doctor_id='$log_id' LIMIT 1";
	    $query = mysqli_query($db_conx, $sql);
	    $row = mysqli_fetch_array($query);
	    $professional_updated = $row[0];

	    $num = 0;
		$pquery = mysqli_query($db_conx,"SELECT region_id FROM regions WHERE category='$log_category' AND city='$pub_city' AND postcode='$pub_post' AND country='$pub_country'");
		$num= mysqli_num_rows($pquery);

		$profile = 1000000000+$log_id;

	    if(($options_updated == 1) && ($personal_updated == 1) && ($professional_updated == 1) && ($pub_published == 0)){
	    	$sql = "UPDATE doctors SET updated='1', profile='$profile' WHERE doctor_username='$log_username' LIMIT 1";
	    	$query = mysqli_query($db_conx, $sql);
	    	$sql = "UPDATE doctors_options SET published='1' WHERE doctor_username='$log_username' LIMIT 1";
	    	$query = mysqli_query($db_conx, $sql);
	    	$sql = "UPDATE doctors_personal SET published='1' WHERE doctor_id='$log_id' LIMIT 1";
	    	$query = mysqli_query($db_conx, $sql);
	    	$sql = "UPDATE doctors_professional SET published='1' WHERE doctor_username='$log_username' LIMIT 1";
	    	$query = mysqli_query($db_conx, $sql);
	    	$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET speciality='$pub_speciality' WHERE doctor_id='$log_id' AND main_hospital='1' LIMIT 1");
	    	if($num>0){
		    	$nsql = mysqli_query($db_conx,"UPDATE regions SET activated='1',repeated='1' WHERE id='$log_id' AND category='$log_category' LIMIT 1");	
		    }else{
		    	$nsql = mysqli_query($db_conx,"UPDATE regions SET activated='1',repeated='0' WHERE id='$log_id' AND category='$log_category' LIMIT 1");
		    }
	    	echo "all updated!!";
	    }
}
    /*************************************** Updated All Sections End Here ***************************************/


	/*************************************** Name Section Start Here ***************************************/
	else if(($_POST['selectaction']) == "savename"){
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		
		if(is_numeric($firstname[0])){
	        echo "number on first start!";
	        exit();
	    }else if(strlen($middlename)>0){
	    		if(is_numeric($middlename[0])){
	        	echo "number on middle start!";
	        	exit();
	    	}
	    }else if(is_numeric($lastname[0])){
	        echo "number on last start!";
	        exit();
	    }

		$regex = "/([a-zA-Z.])+$/";
		if(!preg_match($regex, $firstname)){
	        echo "first wrong input!";
	        exit();
		}else if(!preg_match($regex, $middlename) && strlen($middlename)>0){
	        echo "middle wrong input!";
	        exit();
		}else if(!preg_match($regex, $lastname)){
	        echo "last wrong input!";
	        exit();
		}

		// $firstname = strtolower($firstname);
		// $middlename = strtolower($middlename);
		// $lastname = strtolower($lastname);

		$firstname = ucfirst($firstname);
		$middlename = ucfirst($middlename);
		$lastname = ucfirst($lastname);

		if(strlen($firstname)<2){  
			echo "first too short";
			exit();
		}else if(strlen($lastname)<2){
			echo "last too short";
			exit();
		}else{
			$fullname = "Dr. ".$firstname." ".$middlename." ".$lastname;
			$region_query = mysqli_query($db_conx,"UPDATE regions SET name='$fullname' WHERE id='$log_id' AND category='doctor' LIMIT 1");
			$sql = "UPDATE doctors_personal SET full_name='$fullname' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $fullname;
				exit();
			}else{
				echo "error occured";
				exit();
			}
		}
	}
	/*************************************** Name Section End Here ***************************************/


	/*************************************** Degree Section Start Here ***************************************/
	else if(($_POST['selectaction']) == "savedegree"){
		$newdegree = $_POST['degree'];
		$passyear = $_POST['year'];
		$newdegree = strtoupper($newdegree);
		if($passyear == 'Passing Year'){
			echo "error";
			exit();
		}
		if(empty($newdegree)){
			echo "required!";
			exit();
		}else{
			$oldsql = "SELECT degrees,pass_year FROM doctors_personal WHERE doctor_id='$log_id' LIMIT 1";
			$oldquery = mysqli_query($db_conx, $oldsql);
			$oldrow = mysqli_fetch_assoc($oldquery);
			$olddegree = $oldrow['degrees'];
			$oldyear = $oldrow['pass_year'];
			if(empty($olddegree)){
			 	$newdegree = $olddegree.$newdegree;
			 	$passyear = $oldyear.$passyear;
			}else{
				$newdegree = $olddegree.", ".$newdegree;
				$passyear = $oldyear.", ".$passyear;
			}
			
			$sql = "UPDATE doctors_personal SET degrees='$newdegree', pass_year='$passyear' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $newdegree;
				exit();
			}else{
				echo "error";
				exit();
			}
		}
	}
	else if(($_POST['selectaction']) == "rmvdegree"){
		$olddegree = $_POST['degree'];
		$oldsql = "DELETE degrees,pass_year FROM doctors_personal WHERE doctor_id='$log_id' LIMIT 1";
		$oldquery = mysqli_query($db_conx, $oldsql);
		
		$newdegree = "";
		$newyear = "";
		
			$sql = "UPDATE doctors_personal SET degrees='$newdegree',pass_year='$newyear' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $newdegree;
				exit();
			}else{
				echo "error";
				exit();
			}
	}
	/*************************************** Degree Section End Here ***************************************/

	/************************************** Email Section Start Here **************************************/

	else if(($_POST['selectaction']) == "saveemail"){
		$newemail = $_POST['email'];

		$isemail = test_input($_POST["email"]);
        if (!filter_var($isemail, FILTER_VALIDATE_EMAIL)) {
            echo "invalid format!"; 
            exit();
        }

		$sql = "UPDATE doctors_personal SET email='$newemail' WHERE doctor_id='$log_id' LIMIT 1";
		if($query = mysqli_query($db_conx, $sql)){
			echo $newemail;
			exit();
		}else{
			echo "error";
			exit();
		}
	}

	/************************************** Email Section End Here **************************************/

	/************************************** Address Section Start Here **************************************/

	else if(($_POST['selectaction']) == "saveaddress"){
		$houseno = $_POST['houseno'];
		$housename = $_POST['housename'];
		$streetno = $_POST['streetno'];
		$streetname = $_POST['streetname'];
		$town = $_POST['town'];
		$house="";
		$housename = ucwords($housename);
		$streetname = ucwords($streetname);
		$town = ucwords($town);

		if(!empty($houseno)){
			$house .= $houseno."-";
		}
		if(!empty($housename)){
			$house .= $housename."/ ";
		}
		if(!empty($streetno)){
			$house .= $streetno."-";
		}

		if(strlen($streetname)<3){
			echo "required streetname";
			exit();
		}else if(strlen($town)<3){
			echo "requireds town";
			exit();
		}else{
			$address = $house.$streetname."/ ".$town;
			$region_query = mysqli_query($db_conx,"UPDATE regions SET apt_no='$houseno',apt_name='$housename', street_no='$streetno', street_name='$streetname',town='$town' WHERE id='$log_id' AND category='doctor' LIMIT 1");
			$sql = "UPDATE doctors_personal SET apt_no='$houseno',apt_name='$housename', street_no='$streetno', street_name='$streetname',town='$town' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $address;
				exit();
			}else{
				echo "error";
				exit();
			}
		}
	}

	/************************************** Address Section End Here **************************************/

	/************************************** City Section Start Here **************************************/

	else if(($_POST['selectaction']) == "savecity"){
		$city = $_POST['city'];
		$postcode = $_POST['postcode'];
		$city = ucwords($city);
		$regex = "/^[A-Z0-9- ]+$/";
		if(strlen($city)<3){
			echo "invalid format!";
			exit();
		}else if(!empty($postcode)){
			if(!preg_match($regex, $postcode)){
				echo "invalid format!";
				exit();
			}else{
				$citypost = $city."-".$postcode;
				$sql = "UPDATE doctors_personal SET city='$city', postcode='$postcode' WHERE doctor_id='$log_id' LIMIT 1";
				if($query = mysqli_query($db_conx, $sql)){
					echo $citypost;
					exit();
				}else{
					echo "error";
					exit();
				}
			}
		}else{
			$sql = mysqli_query($db_conx,"SELECT doctor_postcode FROM doctors WHERE doctor_id='$log_id' LIMIT 1");
			$row=mysqli_fetch_array($sql);
			$postcode = $row[0];
			$region_query = mysqli_query($db_conx,"UPDATE regions SET city='$city',postcode='$postcode' WHERE id='$log_id' AND category='doctor' LIMIT 1");
			$sql = "UPDATE doctors_personal SET city='$city',postcode='$postcode' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				
			    $sqlcode = "SELECT doctor_postcode FROM doctors WHERE doctor_id='$log_id' LIMIT 1";
			    $querycode = mysqli_query($db_conx, $sqlcode);
			    $rowcode = mysqli_fetch_array($querycode);
			    $code = $rowcode[0];
			    $citycode = $city."-".$code;
			  	
				echo $citycode;
				exit();
			}else{
				echo "error";
				exit();
			}
		}
		echo "error";
		exit();
	}
	/************************************** City Section End Here **************************************/
	/************************************** Phone Section Start Here **************************************/

	else if(($_POST['selectaction']) == "savephone"){
		$phone = $_POST['phone'];
		
		$regex = "/^[0-9-+ ]+$/";
		if(!preg_match($regex, $phone)){
			echo "invalid format!";
			exit();
		}else{
			$region_query = mysqli_query($db_conx,"UPDATE regions SET contact='$phone' WHERE id='$log_id' AND category='doctor' LIMIT 1");
			$sql = "UPDATE doctors_personal SET phone='$phone' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $phone;
				exit();
			}else{
				echo "error";
				exit();
			}
		}
	}

	/************************************** Phone Section End Here **************************************/


	/****************************************************************************************************/
	/****************************************************************************************************/
	/************************************** Professional Section Start Here *****************************/
	/****************************************************************************************************/
	/****************************************************************************************************/


	/************************************** Hospital Name Section Start Here **************************************/

	else if(($_POST['selectaction']) == "savehosname-pro"){
		$hospitalname = $_POST['hospitalname'];
		$roomno = $_POST['room'];
		$hospitalname = ucwords($hospitalname);

        if (empty($hospitalname)){
            echo "required!"; 
            exit();
        }else if(strlen($hospitalname)<6){
        	echo "too short!"; 
            exit();
        }else{
        	$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET chamber_name='$hospitalname' WHERE doctor_id='$log_id' AND main_hospital='1' LIMIT 1");
        	
			$sql = "UPDATE doctors_professional SET hospital_name='$hospitalname', room_no='$roomno' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $hospitalname;
				exit();
			}else{
				echo "error";
				exit();
			}
		}
	}

	/************************************** Hospital Name Section End Here **************************************/


	/************************************** Hospital Address Section Start Here **************************************/

	else if(($_POST['selectaction']) == "savehos-add-pro"){
		$hos_streetno = $_POST['hos_streetno'];
		$hos_streetname = $_POST['hos_streetname'];
		$hos_town = $_POST['hos_town'];
		$hos_postcode = $_POST['hos_postcode'];
		$hos_house="";
		$regex = "/^[A-Z0-9- ]+$/";
		$hos_streetname = ucwords($hos_streetname);
		$hos_town = ucwords($hos_town);

		if(!empty($hos_streetno)){
			$hos_house .= $hos_streetno."-";
		}

		if(strlen($hos_streetname)<3){
			echo "required streetname!";
			exit();
		}else if(strlen($hos_town)<3){
			echo "required town!";
			exit();
		}else if(strlen($hos_postcode)<3){
			echo "required postcode!";
			exit();
		}else if(!preg_match($regex, $hos_postcode)){
				echo "invalid format!";
				exit();
		}else{
			$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET street_no='$hos_streetno', street_name='$hos_streetname', town='$hos_town', postcode='$hos_postcode' WHERE doctor_id='$log_id' AND main_hospital='1' LIMIT 1");
			
			$hos_address = $hos_house.$hos_streetname."/ ".$hos_town."-".$hos_postcode;
			$sql = "UPDATE doctors_professional SET street_no='$hos_streetno', street_name='$hos_streetname',town='$hos_town',postcode='$hos_postcode' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $hos_address;
				exit();
			}else{
				echo "error";
				exit();
			}
		}
	}

	/************************************** Hospital Address Section End Here **************************************/


	/************************************** Hospital City Section Start Here **************************************/

	else if(($_POST['selectaction']) == "savehoscity-pro"){
		$hoscity = $_POST['hoscity'];
		$hoscountry = $_POST['hoscountry'];
		$hoscity = ucwords($hoscity);
		
		$regex = "/^[0-9a-zA-Z-+ ]+$/";
		if(!preg_match($regex, $hoscity)){
			echo "invalid format!";
			exit();
		}else if(empty($hoscity)){
			echo "required!";
			exit();
		}else if($hoscountry == "Country of this hospital"){
			echo "error";
			exit;
		}else{
			$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET city='$hoscity',country='$hoscountry' WHERE doctor_id='$log_id' AND main_hospital='1' LIMIT 1");
			
			$sql = "UPDATE doctors_professional SET city='$hoscity',hos_country='$hoscountry' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $hoscity;
				exit();
			}else{
				echo "error";
				exit();
			}
		}
		
		echo "error";
		exit();
	}
	/************************************** Hospital City Section End Here **************************************/


	/************************************** Hospital Map Section Start Here **************************************/

	else if(($_POST['selectaction']) == "savehosmap-pro"){
		$address = $_POST['address'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		
		$regex = "/^[0-9a-zA-Z-+ ]+$/";
		if(!preg_match($regex, $hoscity)){
			echo "invalid format!";
			exit();
		}else if(empty($hoscity)){
			echo "required!";
			exit();
		}else{
			$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET lat='$lat',lng='$lng' WHERE doctor_id='$log_id' AND main_hospital='1' LIMIT 1");
			//$region_query = mysqli_query($db_conx,"UPDATE regions SET city='$hoscity',country='$hoscountry' WHERE id='$log_id' AND category='doctor' LIMIT 1");
			$sql = "UPDATE doctors_professional SET lat='$lat', lng='$lng' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $hoscity;
				exit();
			}else{
				echo "error";
				exit();
			}
		}
		
		echo "error";
		exit();
	}
	/************************************** Hospital Map Section End Here **************************************/


	/************************************** Hospital Service Section Start Here **************************************/

	else if(($_POST['selectaction']) == "hos_ser"){

		$sql = "SELECT temp_services FROM doctors_professional WHERE doctor_id='$log_id' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$num = mysqli_num_rows($query);
		$row = mysqli_fetch_assoc($query);
		if($num == 1){
			$hos_services = $row['temp_services'];
			$array = array();
			$i = 0;
			while(!empty($hos_services)){
				$len = strcspn($hos_services, ",");
        		$newlen = strlen($hos_services)-$len;
				$new_str = substr($hos_services, 0, $len);
				$hos_services = substr($hos_services, $len+1, $newlen);

				$idlen = strcspn($new_str, "/");
				$fulllen = strlen($new_str)-$idlen;
				$new_id = substr($new_str, 0, $idlen);
				$new_str = substr($new_str, $idlen+1, $fulllen);

				$array[$i] = $new_id;
				$array[$i+1] = $new_str;
				$i+=2;
			}
			echo json_encode($array);
			exit();
		}else{
			echo "error";
			exit();
		}
		
	}

	else if(($_POST['selectaction']) == "hos_ser_save"){
		//$storeddata = mysqli_real_escape_string($db_conx, $_POST['storedata']);
		
		if(isset($_POST['idntext']) && isset($_POST['service'])){
		$idntexts = $_POST['idntext'];
		$serviecs = $_POST['service'];
		
		$idandtext = implode(",",$idntexts);
		$myservice = implode(",",$serviecs);
		}else{
			$idandtext = "zero/empty";
			$myservice = "empty";
		}
		$sql = "UPDATE doctors_professional SET hospital_services='$myservice' WHERE doctor_id='$log_id' LIMIT 1";
		$sqlone = "UPDATE doctors_professional SET temp_services='$idandtext' WHERE doctor_id='$log_id' LIMIT 1";
		$query_one = mysqli_query($db_conx, $sqlone);
		if($query = mysqli_query($db_conx, $sql)){
			echo $myservice;
			exit();
		}else{
			echo "error";
			exit();
		}
	}


	/************************************** Hospital Service Section End Here **************************************/


	/************************************** Hospital Capacity Section Start Here **************************************/

	else if(($_POST['selectaction']) == "savehoscapacity-pro"){
		$hoscapacity = $_POST['capacity'];
		$regex = "/^[0-9-+ ]+$/";
		if(!preg_match($regex, $hoscapacity)){
			echo "invalid format!";
			exit();
		}else if(empty($hoscapacity)){
			echo "required!";
			exit();
		}else{
			$sql = "UPDATE doctors_professional SET hospital_capacity='$hoscapacity' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $hoscapacity;
				exit();
			}else{
				echo "error";
				exit();
			}
		}
		
		echo "error";
		exit();
	}
	/************************************** Hospital Capacity Section End Here **************************************/

	/************************************** Hospital Contacts Section Start Here **************************************/

	else if(($_POST['selectaction']) == "savehoscontacts-pro"){
		$hos_phone = $_POST['hosphone'];
		$hos_email = $_POST['hosemail'];
		$hos_web = $_POST['hosweb'];

		$ishosemail = test_input($hos_email);
        $hos_contacts ="";

		$regex = "/^[0-9-+ ]+$/";
		$regwebex = "/^[0-9a-z-.]+$/";

		if(!preg_match($regex, $hos_phone)){
			echo "invalid phone format!";
			exit();
		}else if(empty($hos_phone)){
			echo "required!";
			exit();
		}
		if(!empty($ishosemail)){
			if (!filter_var($ishosemail, FILTER_VALIDATE_EMAIL)) {
            	echo "invalid email format!"; 
            	exit();
        	}
    	}
    	if(!empty($hos_web)){ 
    		if(!preg_match($regwebex, $hos_web)){
				echo "invalid web format!";
				exit();
			}
		}
			$chamber_query = mysqli_query($db_conx,"UPDATE doctors_chambers SET contact='$hos_phone' WHERE doctor_id='$log_id' AND main_hospital='1' LIMIT 1");
			
			$sql = "UPDATE doctors_professional SET phone='$hos_phone', email='$hos_email', web='$hos_web' WHERE doctor_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){

				if(empty($hos_email) && empty($hos_web)){
					$hos_contacts = $hos_phone;
				}else if(empty($hos_email)){
					$hos_contacts = $hos_phone." | ".$hos_web;
				}else if(empty($hos_web)){
					$hos_contacts = $hos_phone." | ".$hos_email;
				}else{
					$hos_contacts = $hos_phone." | ".$hos_email." | ".$hos_web;
				}
				
				echo $hos_contacts;
				exit();
			}else{
				echo "error";
				exit();
			}
		
		echo "error";
		exit();
	}
	/************************************** Hospital Contacts Section End Here **************************************/

?>