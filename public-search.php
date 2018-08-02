<?php

    //require("config.inc.php");
mysql_connect("localhost","root","");
mysql_select_db("boiddo");



if(isset($_POST['username'])){
	
	$username = mysql_real_escape_string($_POST['username']);
	$regex = "/^([a-zA-Z])+[A-Za-z0-9_]+$/";

	if(strlen($username)<4){
		echo "At least 4 Character";
	}else if(preg_match($regex, $username)) {
		echo "";
	}else if(!preg_match($regex, $username)){
		echo "please use alphabet, number or underscore.";
	}
	if(preg_match($regex, $username) && strlen($username)>3){

		$query = "SELECT * FROM doctors WHERE doctor_username='$username'";
		$result = mysql_query($query);
		$result_query = mysql_num_rows($result);

		if($result_query == 1){
			echo "Not available.";
		}else{
			$hquery = "SELECT * FROM hospitals WHERE hospital_username='$username'";
			$hresult = mysql_query($hquery);
			$hresult_query = mysql_num_rows($hresult);

			if($hresult_query == 1){
				echo "Not available.";
			}else{
				$diaquery = "SELECT * FROM diagnostics WHERE diagnostic_username='$username'";
				$diaresult = mysql_query($diaquery);
				$diaresult_query = mysql_num_rows($diaresult);

				if($diaresult_query == 1){
					echo "Not available.";
				}else{
					$cquery = "SELECT * FROM companies WHERE company_username='$username'";
					$cresult = mysql_query($cquery);
					$cresult_query = mysql_num_rows($cresult);

					if($cresult_query == 1){
						echo "Not available.";
					}else{
						$aquery = "SELECT * FROM ambulances WHERE ambulance_username='$username'";
						$aresult = mysql_query($aquery);
						$aresult_query = mysql_num_rows($aresult);

						if($aresult_query == 1){
							echo "Not available.";
						}else{
							echo "available.";
						}
					}
				}
			}
		}
	}
	
}else{
	echo "Empty field.";
}


if(isset($_POST['email']))
{
	
	$email = mysql_real_escape_string($_POST['email']);
	if(!empty($email))
	{
		
		$dquery = "SELECT * FROM doctors WHERE doctor_email='$email'";
		$dresult = mysql_query($dquery);
		$dresult_query = mysql_num_rows($dresult);
		if($dresult_query == 1)
		{
			echo "Email is already used.";
			
		}else{
			$hquery = "SELECT * FROM hospitals WHERE hospital_email='$email'";
			$hresult = mysql_query($hquery);
			$hresult_query = mysql_num_rows($hresult);
			if($hresult_query == 1)
			{
				echo "Email is already used.";
				
			}else{
				$diaquery = "SELECT * FROM diagnostics WHERE diagnostic_email='$email'";
				$diaresult = mysql_query($diaquery);
				$diaresult_query = mysql_num_rows($diaresult);
				if($diaresult_query == 1)
				{
					echo "Email is already used.";
					
				}else{
					$cquery = "SELECT * FROM companies WHERE company_email='$email'";
					$cresult = mysql_query($cquery);
					$cresult_query = mysql_num_rows($cresult);
					if($cresult_query == 1)
					{
						echo "Email is already used.";
						
					}else{
						$aquery = "SELECT * FROM ambulances WHERE ambulance_email='$email'";
						$aresult = mysql_query($aquery);
						$aresult_query = mysql_num_rows($aresult);
						if($aresult_query == 1)
						{
							echo "Email is already used.";
							
						}
					}
				}
			}
		}  
	}else{
		echo "Empty field.";
	}
	
}

if(isset($_POST["email"]))
{
	$email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid email format."; 
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
		echo "Invalid Post Code Format.";
	}else{
		echo "valid post code format.";
	}
}



    //mysql_close($dbname);
?>
