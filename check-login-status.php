<?php

	include_once("config.inc.php");
	$user_ok=false;
	$log_id="";
	$log_username="";
	$log_email="";
	$log_password="";
	$log_category="";

	function evalLoggedUser($conx, $id, $u, $e, $p){
		$sql = "SELECT ip FROM doctors WHERE doctor_id='$id' AND doctor_username='$u' AND doctor_email='$e' AND doctor_password='$p' AND activated='1'";
		$query = mysqli_query($conx, $sql);
		$numrows = mysqli_num_rows($query);
		if($numrows>0){
			return true;
		}else{
			$h_sql = "SELECT ip FROM hospitals WHERE hospital_id='$id' AND hospital_username='$u' AND hospital_email='$e' AND hospital_password='$p' AND activated='1'";
			$h_query = mysqli_query($conx, $h_sql);
			$h_numrows = mysqli_num_rows($h_query);
			if($h_numrows>0){
				return true;
			}else{
				$d_sql = "SELECT ip FROM diagnostics WHERE diagnostic_id='$id' AND diagnostic_username='$u' AND diagnostic_email='$e' AND diagnostic_password='$p' AND activated='1'";
				$d_query = mysqli_query($conx, $d_sql);
				$d_numrows = mysqli_num_rows($d_query);
				if($d_numrows>0){
					return true;
				}else{
					$c_sql = "SELECT ip FROM companies WHERE company_id='$id' AND company_username='$u' AND company_email='$e' AND company_password='$p' AND activated='1'";
					$c_query = mysqli_query($conx, $c_sql);
					$c_numrows = mysqli_num_rows($c_query);
					if($c_numrows>0){
						return true;
					}else{
						$a_sql = "SELECT ip FROM ambulances WHERE ambulance_id='$id' AND ambulance_username='$u' AND ambulance_email='$e' AND ambulance_password='$p' AND activated='1'";
						$a_query = mysqli_query($conx, $a_sql);
						$a_numrows = mysqli_num_rows($a_query);
						if($a_numrows>0){
							return true;
						}else{
							return false;
						}
					}
				}
			}
		}
	}
		if(isset($_SESSION["userid"]) && isset($_SESSION["username"]) && isset($_SESSION["email"]) && isset($_SESSION["password"]) && isset($_SESSION["category"])){
			$log_id = preg_replace('#[^0-9]#', '', $_SESSION['userid']);
			$log_username = preg_replace('#[^a-z0-9]#i', '', $_SESSION['username']);
			$log_email = preg_replace('#[^a-z0-9_.+-]+@[a-z0-9-]+\.[a-z0-9-.]#i', '', $_SESSION['email']);
			$log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
			$log_category = preg_replace('#[^a-zA-Z]#i', '', $_SESSION['category']);

			$user_ok=evalLoggedUser($db_conx, $log_id, $log_username, $log_email, $log_password);

		}else if(isset($_COOKIE['id']) && isset($_COOKIE['user']) && isset($_COOKIE['mail']) && isset($_COOKIE['pass']) && isset($_COOKIE['cat'])){
			$_SESSION['userid'] = preg_replace('#[^0-9]#', '', $_COOKIE['id']);
			$_SESSION['username'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['user']);
			$_SESSION['email'] = preg_replace('#[^a-z0-9_.+-]+@[a-z0-9-]+\.[a-z0-9-.]#i', '', $_COOKIE['mail']);
			$_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['pass']);
			$_SESSION['category'] = preg_replace('#[^a-zA-Z]#i', '', $_COOKIE['cat']);

			$log_id = $_SESSION['userid'];
			$log_username = $_SESSION['username'];
			$log_email = $_SESSION['email'];
			$log_password = $_SESSION['password'];
			$log_category = $_SESSION['category'];
			$user_ok = evalLoggedUser($db_conx, $log_id, $log_username, $log_email, $log_password);
			if($user_ok == true){

				if(isset($numrows)){
					$sql = "UPDATE doctors SET lastlogin=NOW() WHERE doctor_username='$log_username' LIMIT 1";
					$query = mysqli_query($db_conx, $sql);
				}else if(isset($h_numrows)){
					$sql = "UPDATE hospitals SET lastlogin=NOW() WHERE hospital_username='$log_username' LIMIT 1";
					$query = mysqli_query($db_conx, $sql);
				}else if(isset($d_numrows)){
					$sql = "UPDATE diagnostics SET lastlogin=NOW() WHERE diagnostic_username='$log_username' LIMIT 1";
					$query = mysqli_query($db_conx, $sql);
				}else if(isset($c_numrows)){
					$sql = "UPDATE companies SET lastlogin=NOW() WHERE company_username='$log_username' LIMIT 1";
					$query = mysqli_query($db_conx, $sql);
				}else if(isset($a_numrows)){
					$sql = "UPDATE ambulances SET lastlogin=NOW() WHERE ambulance_username='$log_username' LIMIT 1";
					$query = mysqli_query($db_conx, $sql);
				}
				

			}
			
		}
		
	//echo $user_ok;
?>