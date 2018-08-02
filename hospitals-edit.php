<?php
	include_once("check-login-status.php");

	if($user_ok != true || $log_username =="" || $log_category != "hospital"){
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
    /******************************** Updated All Sections Start Here ***********************************/
    if(($_POST['selectaction'])=='publishButton'){

    	$pub_sql="SELECT * FROM hospitals_info WHERE hospital_username='$log_username' LIMIT 1";
    	$pub_query = mysqli_query($db_conx,$pub_sql);
    	while ($row = mysqli_fetch_assoc($pub_query)) {
	    	$pub_name = $row['fullname'];
	    	$pub_strno = $row['street_no'];
	    	$pub_strname = $row['street_name'];
	    	$pub_town = $row['town'];
	    	$pub_city = $row['city'];
	    	$pub_post = $row['postcode'];
	    	$pub_capacity = $row['capacity'];
	    	$pub_phone = $row['phone'];
	    	$pub_services = $row['services'];
    	}
    	if(!empty($pub_name) && !empty($pub_strname) && !empty($pub_town) && !empty($pub_city) && !empty($pub_post) && !empty($pub_capacity) && !empty($pub_phone) && !empty($pub_services)){
    			$up_sql="UPDATE hospitals_info SET updated='1' WHERE hospital_username='$log_username' LIMIT 1";
    			$up_query = mysqli_query($db_conx,$up_sql);
    	}

    	$pub_sql="SELECT * FROM hospitals WHERE hospital_username='$log_username' LIMIT 1";
    	$pub_query = mysqli_query($db_conx,$pub_sql);
    	while ($row = mysqli_fetch_assoc($pub_query)) {
    		$pub_country = $row['hospital_country'];
    		$pub_published = $row['published'];
    	}

	    $sql = "SELECT updated FROM hospitals_options WHERE hospital_username='$log_username' LIMIT 1";
	    $query = mysqli_query($db_conx, $sql);
	    $row = mysqli_fetch_array($query);
	    $options_updated = $row[0];

	    $sql = "SELECT updated FROM hospitals_info WHERE hospital_id='$log_id' LIMIT 1";
	    $query = mysqli_query($db_conx, $sql);
	    $row = mysqli_fetch_array($query);
	    $info_updated = $row[0];

	    $num = 5;
	    $psql = "SELECT * FROM regions WHERE category='$log_category' AND city='$pub_city' AND postcode='$pub_post' AND country='$pub_country'";
	    $pquery = mysqli_query($db_conx, $psql);
	    $num= mysqli_num_rows($pquery);
	    

	    if(($options_updated == 1) && ($info_updated == 1) && ($pub_published == 0)){
	    	$sql = "UPDATE hospitals SET updated ='1' WHERE hospital_username='$log_username' LIMIT 1";
	    	$query = mysqli_query($db_conx, $sql);

	    	$sqli = "UPDATE hospitals SET published='1' WHERE hospital_username='$log_username' LIMIT 1";
	    	$queryi = mysqli_query($db_conx, $sqli);

	    	if($num>0){
	    		$nsql = mysqli_query($db_conx,"UPDATE regions SET name='$pub_name',street_no='$pub_strno',street_name='$pub_strname',town='$pub_town',city='$pub_city',postcode='$pub_post',activated='1',repeated='1' WHERE id='$log_id' AND category='$log_category' LIMIT 1");	
	    	}else{
	    		$nsql = mysqli_query($db_conx,"UPDATE regions SET name='$pub_name',street_no='$pub_strno',street_name='$pub_strname',town='$pub_town',city='$pub_city',postcode='$pub_post',activated='1',repeated='0' WHERE id='$log_id' AND category='$log_category' LIMIT 1");
	    	}
	    	echo "all updated!!";
	    	exit;
	    }else{
	    	echo "failed to update..";
	    	exit;
	    }
	}
    /********************************* Updated All Sections End Here *************************************/

	
	/****************************************************************************************************/
	/****************************************************************************************************/
	/************************************** Professional Section Start Here *****************************/
	/****************************************************************************************************/
	/****************************************************************************************************/


	/******************************** Hospital Name Section Start Here *********************************/

	else if(($_POST['selectaction']) == "savehosname-pro"){
		$hospitalname =$_POST['hospitalname'];
		$hospitalname = ucwords($hospitalname);

        if (empty($hospitalname)){
            echo "required!"; 
            exit();
        }else if(strlen($hospitalname)<6){
        	echo "too short!"; 
            exit();
        }else{
			$sql = "UPDATE hospitals_info SET fullname='$hospitalname' WHERE hospital_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $hospitalname;
				exit();
			}else{
				echo "error";
				exit();
			}
		}
	}

	/******************************** Hospital Name Section End Here ***********************************/


	/****************************** Hospital Address Section Start Here **********************************/

	else if(($_POST['selectaction']) == "savehos-add-pro"){
		$hos_streetno =  $_POST['hos_streetno'];
		$hos_streetname =  $_POST['hos_streetname'];
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
			$hos_address = $hos_house.$hos_streetname."/ ".$hos_town."-".$hos_postcode;
			$sql = "UPDATE hospitals_info SET street_no='$hos_streetno', street_name='$hos_streetname',town='$hos_town',postcode='$hos_postcode' WHERE hospital_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $hos_address;
				exit();
			}else{
				echo "error";
				exit();
			}
		}
	}

	/****************************** Hospital Address Section End Here *********************************/


	/******************************* Hospital City Section Start Here **********************************/

	else if(($_POST['selectaction']) == "savehoscity-pro"){
		$hoscity = $_POST['hoscity'];
		$hoscity = ucwords($hoscity);
		
		$regex = "/^[0-9a-zA-Z-+ ]+$/";
		if(!preg_match($regex, $hoscity)){
			echo "invalid format!";
			exit();
		}else if(empty($hoscity)){
			echo "required!";
			exit();
		}else{
			$sql = "UPDATE hospitals_info SET city='$hoscity' WHERE hospital_id='$log_id' LIMIT 1";
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
	/****************************** Hospital City Section End Here ***********************************/


	/***************************** Hospital Service Section Start Here ***********************************/

	else if(($_POST['selectaction']) == "hos_ser"){

		$sql = "SELECT temp_services FROM hospitals_info WHERE hospital_id='$log_id' LIMIT 1";
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

	else if(($_POST['selectaction'])=="hos_ser_save"){
		//$storeddata = $_POST['storedata'];
		
		if(isset($_POST['idntext']) && isset($_POST['service'])){
		$idntexts = $_POST['idntext'];
		$serviecs = $_POST['service'];
		
		$idandtext = implode(",",$idntexts);
		$myservice = implode(",",$serviecs);
		}else{
			$idandtext = "zero/empty";
			$myservice = "empty";
		}
		$sql = "UPDATE hospitals_info SET services='$myservice' WHERE hospital_id='$log_id' LIMIT 1";
		$sqlone = "UPDATE hospitals_info SET temp_services='$idandtext' WHERE hospital_id='$log_id' LIMIT 1";
		$query_one = mysqli_query($db_conx, $sqlone);
		if($query = mysqli_query($db_conx, $sql)){
			echo $myservice;
			exit();
		}else{
			echo "error";
			exit();
		}
	}


	/****************************** Hospital Service Section End Here ***********************************/


	/***************************** Hospital Capacity Section Start Here *********************************/

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
			$sql = "UPDATE hospitals_info SET capacity='$hoscapacity' WHERE hospital_id='$log_id' LIMIT 1";
			if($query = mysqli_query($db_conx, $sql)){
				echo $hoscapacity;
				//echo "updated...";
				exit();
			}else{
				echo "error";
				exit();
			}
		}
		
		echo "error";
		exit();
	}
/********************************* Hospital Capacity Section End Here ************************************/

/******************************* Hospital Contacts Section Start Here ************************************/

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
			$sql = "UPDATE hospitals_info SET phone='$hos_phone', email='$hos_email', web='$hos_web' WHERE hospital_id='$log_id' LIMIT 1";
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
	/******************************* Hospital Contacts Section End Here **********************************/

?>