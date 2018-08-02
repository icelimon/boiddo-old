<?php

include_once("config.inc.php");

if(isset($_POST['username'])){
	
	$username = $_POST['username'];
	$regex = "/^([a-z])+[a-z0-9_]+$/";

	if(is_numeric($username[0])){
		echo "username cannot begin with a number";
	}else if(strlen($username)<4){
		echo "please use at least four character";

	}else if(preg_match($regex, $username)) {
		echo "";
	}else if(!preg_match($regex, $username)){
		echo "please use lowercase alphabet, number or underscore";
	}
	if(preg_match($regex, $username) && strlen($username)>3){

		$query = "SELECT * FROM doctors WHERE doctor_username='$username'";
		$result = mysqli_query($db_conx,$query);
		$result_query = mysqli_num_rows($result);

		if($result_query == 1){
			echo "unavailable";
		}else{
			$hquery = "SELECT * FROM hospitals WHERE hospital_username='$username'";
			$hresult = mysqli_query($db_conx, $hquery);
			$hresult_query = mysqli_num_rows($hresult);

			if($hresult_query == 1){
				echo "unavailable";
			}else{
				$diaquery = "SELECT * FROM diagnostics WHERE diagnostic_username='$username'";
				$diaresult = mysqli_query($db_conx, $diaquery);
				$diaresult_query = mysqli_num_rows($diaresult);

				if($diaresult_query == 1){
					echo "unavailable";
				}else{
					$cquery = "SELECT * FROM companies WHERE company_username='$username'";
					$cresult = mysqli_query($db_conx, $cquery);
					$cresult_query = mysqli_num_rows($cresult);

					if($cresult_query == 1){
						echo "unavailable";
					}else{
						$aquery = "SELECT * FROM ambulances WHERE ambulance_username='$username'";
						$aresult = mysqli_query($db_conx, $aquery);
						$aresult_query = mysqli_num_rows($aresult);

						if($aresult_query == 1){
							echo "unavailable";
						}else{
							echo "available";
						}
					}
				}
			}
		}
	}
	
}


if(isset($_POST['email']))
{
	
	$email = $_POST['email'];
	if(!empty($email))
	{
		
		$dquery = "SELECT * FROM doctors WHERE doctor_email='$email'";
		$dresult = mysqli_query($db_conx, $dquery);
		$dresult_query = mysqli_num_rows($dresult);
		if($dresult_query == 1)
		{
			echo "this email is already used";
			
		}else{
			$hquery = "SELECT * FROM hospitals WHERE hospital_email='$email'";
			$hresult = mysqli_query($db_conx, $hquery);
			$hresult_query = mysqli_num_rows($hresult);
			if($hresult_query == 1)
			{
				echo "this email is already used";
				
			}else{
				$diaquery = "SELECT * FROM diagnostics WHERE diagnostic_email='$email'";
				$diaresult = mysqli_query($db_conx, $diaquery);
				$diaresult_query = mysqli_num_rows($diaresult);
				if($diaresult_query == 1)
				{
					echo "this email is already used";
					
				}else{
					$cquery = "SELECT * FROM companies WHERE company_email='$email'";
					$cresult = mysqli_query($db_conx, $cquery);
					$cresult_query = mysqli_num_rows($cresult);
					if($cresult_query == 1)
					{
						echo "this email is already used";
						
					}else{
						$aquery = "SELECT * FROM ambulances WHERE ambulance_email='$email'";
						$aresult = mysqli_query($db_conx, $aquery);
						$aresult_query = mysqli_num_rows($aresult);
						if($aresult_query == 1)
						{
							echo "this email is already used.";
							
						}
					}
				}
			}
		}  
	}
	
}

if(isset($_POST["email"]))
{
	$email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "invalid email format"; 
	}else{
		echo "valid email format";
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(isset($_POST['postcode'])){
	$postcode = mysql_real_escape_string($_POST['postcode']);
	$regex = "/^[A-Z0-9- ]+$/";
	if(strlen($postcode)<3 || strlen($postcode)>9 || (!preg_match($regex, $postcode))){
		echo "invalid post code format";
	}else{
		echo "valid post code format";
	}
}



    //mysql_close($dbname);
?>
