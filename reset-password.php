<?php
include_once("check-login-status.php");
if($user_ok==true){
	header("location: edit-profile-dr.php");
	exit();
}
?>

<?php
if(isset($_POST['c']) && isset($_POST['p'])){
	$ccode=mysql_real_escape_string($_POST['c']);
	$newpass=mysql_real_escape_string(md5($_POST['p']));

	$dsql="SELECT doctor_username FROM doctors_options WHERE temp_pass='$ccode' LIMIT 1";
	$dquery=mysqli_query($db_conx,$dsql);
	$dnumrows=mysqli_num_rows($dquery);

	$hsql="SELECT hospital_username FROM hospitals_options WHERE temp_pass='$ccode' LIMIT 1";
	$hquery=mysqli_query($db_conx,$hsql);
	$hnumrows=mysqli_num_rows($hquery);

	$diasql="SELECT diagnostic_username FROM diagnostics_options WHERE temp_pass='$ccode' LIMIT 1";
	$diaquery=mysqli_query($db_conx,$diasql);
	$dianumrows=mysqli_num_rows($diaquery);

	$csql="SELECT company_username FROM companies_options WHERE temp_pass='$ccode' LIMIT 1";
	$cquery=mysqli_query($db_conx,$csql);
	$cnumrows=mysqli_num_rows($cquery);

	$asql="SELECT ambulance_username FROM ambulances_options WHERE temp_pass='$ccode' LIMIT 1";
	$aquery=mysqli_query($db_conx,$asql);
	$anumrows=mysqli_num_rows($aquery);

	if($dnumrows>0){
		$row=mysqli_fetch_row($dquery);
		$un=$row[0];
		
		$sql="SELECT doctor_id FROM doctors_options WHERE doctor_username='$un' AND temp_pass='$ccode' LIMIT 1";
		$query=mysqli_query($db_conx,$sql);
		$numrows=mysqli_num_rows($query);
		if($numrows==0){
			echo "its not_found_user";
			exit();
		}else{
			$row=mysqli_fetch_row($query);
			$id=$row[0];
			$sql="UPDATE doctors SET doctor_password='$newpass' WHERE doctor_id='$id' AND doctor_username='$un' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			$sql="UPDATE doctors_options SET temp_pass='' WHERE doctor_id='$id' AND doctor_username='$un' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);

			$sql="SELECT doctor_id FROM doctors WHERE doctor_password='$newpass' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			$numrows=mysqli_num_rows($query);
			if(isset($numrows)){
				echo "its success";
				exit();
			}
            //header("location: login.php");
			exit();
		}
	}else if($hnumrows>0){
		$row=mysqli_fetch_row($hquery);
		$un=$row[0];
		
		$sql="SELECT hospital_id FROM hospitals_options WHERE hospital_username='$un' AND temp_pass='$ccode' LIMIT 1";
		$query=mysqli_query($db_conx,$sql);
		$numrows=mysqli_num_rows($query);
		if($numrows==0){
			echo "its not_found_user";
			exit();
		}else{
			$row=mysqli_fetch_row($query);
			$id=$row[0];
			$sql="UPDATE hospitals SET hospital_password='$newpass' WHERE hospital_id='$id' AND hospital_username='$un' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			$sql="UPDATE hospitals_options SET temp_pass='' WHERE hospital_id='$id' AND hospital_username='$un' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);

			$sql="SELECT hospital_id FROM hospitals WHERE hospital_password='$newpass' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			$numrows=mysqli_num_rows($query);
			if(isset($numrows)){
				echo "its success";
				exit();
			}
            //header("location: login.php");
			exit();
		}
	}else if($dianumrows>0){
		$row=mysqli_fetch_row($diaquery);
		$un=$row[0];
		
		$sql="SELECT diagnostic_id FROM diagnostics_options WHERE diagnostic_username='$un' AND temp_pass='$ccode' LIMIT 1";
		$query=mysqli_query($db_conx,$sql);
		$numrows=mysqli_num_rows($query);
		if($numrows==0){
			echo "its not_found_user";
			exit();
		}else{
			$row=mysqli_fetch_row($query);
			$id=$row[0];
			$sql="UPDATE diagnostics SET diagnostic_password='$newpass' WHERE diagnostic_id='$id' AND diagnostic_username='$un' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			$sql="UPDATE diagnostics_options SET temp_pass='' WHERE diagnostic_id='$id' AND diagnostic_username='$un' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);

			$sql="SELECT diagnostic_id FROM diagnostics WHERE diagnostic_password='$newpass' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			$numrows=mysqli_num_rows($query);
			if(isset($numrows)){
				echo "its success";
				exit();
			}
            //header("location: login.php");
			exit();
		}
	}else if($cnumrows>0){
		$row=mysqli_fetch_row($cquery);
		$un=$row[0];
		
		$sql="SELECT company_id FROM companies_options WHERE company_username='$un' AND temp_pass='$ccode' LIMIT 1";
		$query=mysqli_query($db_conx,$sql);
		$numrows=mysqli_num_rows($query);
		if($numrows==0){
			echo "its not_found_user";
			exit();
		}else{
			$row=mysqli_fetch_row($query);
			$id=$row[0];
			$sql="UPDATE companies SET company_password='$newpass' WHERE company_id='$id' AND company_username='$un' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			$sql="UPDATE companies_options SET temp_pass='' WHERE company_id='$id' AND company_username='$un' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);

			$sql="SELECT company_id FROM companies WHERE company_password='$newpass' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			$numrows=mysqli_num_rows($query);
			if(isset($numrows)){
				echo "its success";
				exit();
			}
            //header("location: login.php");
			exit();
		}
	}else if($anumrows>0){
		$row=mysqli_fetch_row($aquery);
		$un=$row[0];
		
		$sql="SELECT ambulance_id FROM ambulances_options WHERE ambulance_username='$un' AND temp_pass='$ccode' LIMIT 1";
		$query=mysqli_query($db_conx,$sql);
		$numrows=mysqli_num_rows($query);
		if($numrows==0){
			echo "its not_found_user";
			exit();
		}else{
			$row=mysqli_fetch_row($query);
			$id=$row[0];
			$sql="UPDATE ambulances SET ambulance_password='$newpass' WHERE ambulance_id='$id' AND ambulance_username='$un' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			$sql="UPDATE ambulances_options SET temp_pass='' WHERE ambulance_id='$id' AND ambulance_username='$un' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);

			$sql="SELECT ambulance_id FROM ambulances WHERE ambulance_password='$newpass' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			$numrows=mysqli_num_rows($query);
			if(isset($numrows)){
				echo "its success";
				exit();
			}
            //header("location: login.php");
			exit();
		}
	}else{
		echo "its code_mismatch";
		exit();
	}

  // if(isset($un) && isset($newpass)){
    // $u=preg_replace("#[a-z0-9]#i", '', $un);
    // $temppasshash=preg_replace("#[a-z0-9]#i", '', $ccode);
	
    // if(strlen($temppasshash)<10){
    //   exit();
    // }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="images/navbar-brand.png" />
	<title>Medic Aid | Reset Password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<script src="js/jquery.js"></script>
	
	<script type="text/javascript">
		
 // $.post("forgot-pass.php",{
 //          email: e
 //        }, function(data){

 	function resetpass(){
 		var password=$("#password").val();
 		var ccode=$("#ccode").val();
 		$("#isccode").html("");
 		$('#passwordlength').html('');
 		if ((password.length) < 6) { 
 			$('#passwordlength').html('At least 6 characters.').css('color', 'red');
 		}else{
 			$.post("reset-password.php",{
 				p: password,
 				c: ccode
 			},function(data){
 				var mat=data.indexOf("code_mismatch");
 				var fau=data.indexOf("not_found_user");
 				var suc=data.indexOf("success");
                    //alert(mat);
                    if(mat==6){
                    	$("#isccode").html("Confirmation code mismatch");
                    }else if(fau==6){
                    	$("#isccode").html("User not found");
                    }else if(suc==6){
                    	window.location.href = "login.php";
                        //alert(data);
                    }
                });
               //window.location = ("edit-profile-dr.php");
           }
       }

   </script>
</head>

<body>
	<!--1st Container Start here -->
	<div class="container no-padding">

		<!--Page Header End-->
		<div id="top" class="page-header no-margin">
			
			<span><h1 style="margin-left: 12px"><strong>MEDIC AID</strong> <small>health service station</small></h1></span>
		</div>
		<!--Page Header End here-->

	</div>
	<!--1st Container End here -->

	<!--2nd Container Start here -->
	<div class="container">
		<div class="row">
			<p ></p>
			<div class="col-sm-offset-3 col-sm-6">
				<div class="panel panel-default bgc"  style="height: 324px">
					<div class="panel-title">
						<h3 class="center"><strong>Reset Password</strong></h3>
					</div>
					<!--Registration form Start here-->

					<div id="reg" class="well">
						
						<p>Reset your password, Confirmation code has been sent to your email. please use that code.</p>
						
						<form class="form-horizontal" onsubmit="return false;" method="POST" role="form" id="regform">

							<div class="form-group">
								
								<label for="ccode" class="col-xs-4 col-sm-4 control-label">Confirmation code</label>
								<div class="col-xs-8 col-sm-8">
									<input type="text" name="code" class="form-control" id="ccode" placeholder="Confirmation code" required>
								</div>
								<div class="col-xs-offset-4 col-sm-offset-4">
									<span id='isccode'></span>
								</div>
								
							</div>
							<div class="form-group">
								
								<label for="password" class="col-xs-4 col-sm-4 control-label">New-Password</label>
								<div class="col-xs-8 col-sm-8">
									<input type="password" name="pass" class="form-control" id="password" placeholder="New Password" required>
								</div> 
								<div class="col-xs-offset-4 col-sm-offset-4">
									<span id='passwordlength'></span>
								</div>
								
							</div>


							<div class="form-group">
								<div class="col-xs-offset-4 col-xs-3 col-sm-offset-4 col-sm-3">
									<button id="confirmbtn" name="confirmbtn" onclick="resetpass()" class="btn btn-primary">Confirm</button>
								</div>
							</div>
							

							<!--li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li-->
							

						</form>
					</div>
				</div>
			</div>

			<!--Registration End here-->
		</div>
	</div>
	<!--2nd Container End here -->

	<!--Start if the Footer-->
	<div class="container-fluid no-padding bottom">
		<footer class="site-footer">
			<div class="container">
				<div class="row padding-left-30">
					<div class="col-xs-6 col-sm-4 col-md-4 no-margin">
						<h4>Contact Address</h4>
						<p>#Shariful Islam Limon</p>
						<p>Information and Communication Engineering</p>
						<p>Pabna University of Science and Technology</p>
						<p>Pabna-6600, Bangladesh</p>
					</div>


					<div class="col-xs-6 col-sm-4 col-md-4">
						<a  href="#"><img class="img-responsive no-margin no-padding" src="images/logo-100-75.png" alt="site logo"></a>
					</div>

					<div class="col-xs-6 col-sm-4 col-md-4 no-margin">
						<h4>Contact Address</h4>
						<p>#Shariful Islam Limon</p>
						<p>Information and Communication Engineering</p>
						<p>Pabna University of Science and Technology</p>
						<p>Pabna-6600, Bangladesh</p>
					</div>
				</div>
				<div class="bottom-footer">
					<div class="col-md-5">&copy Copyright smiplr 2015</div>
					<div class="col-md-7">
						<ul class="footer-nav">
							<li><a href="index.html">Home</a></li>
							<li><a href="index.html#reg">Registration</a></li>
							<li><a href="terms.html">Terms & Conditions</a></li>
							<li><a href="terms.html#contact">Contact us</a></li>
							<li><a href="#top">Top</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!--End if the Footer-->

	<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script-->


</body>
</html>
<?php 
?>
