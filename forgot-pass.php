<?php
include_once("check-login-status.php");
if($user_ok==true){
	header("location: edit-profile-dr.php");
	exit();
}
?>
<?php
if(isset($_POST["email"])){
	$e=mysqli_real_escape_string($db_conx,$_POST["email"]);
	$category=mysqli_real_escape_string($db_conx,$_POST["cat"]);
		//echo $e;

	$to="limon.pstu@gmail.com";
        //$to="$e";
	$from="slimon_ice@yahoo.com";
	$headers="From: $from\n";
	$headers .= "Reply-To: ". $from . "\r\n";
        //$headers .= "CC: susan@example.com\r\n";
	$headers.="MIME-Version: 1.0\r\n";
	$headers.="Content-Type: text/html; charset=ISO-8859-1\r\n";
	$subject="Reset Password";
	$msg='<html><body>';
	$msg.='<h2>Hello '.$log_id.'</h2>';
	$msg.='<h3>You have tried to reset password at <a style="text-decoration: none;" href="http://www.boiddo.com">Boiddo</a> at '.$category.' category.</h3>';
	$msg.='<p>Please confirm us that really you want to reset your account password.';
	$msg.='If you did not try to reset password, please ignore this message.';
	$msg.='Click the following link to reset password of this boiddo account.</p>';
	$msg.='<p><a href="http://www.boiddo.com/confirmation.php?user-conf='.urlencode($com_code).'&com-cat='.urlencode($newcategory).'">Click here to activate</a></p>';
	$msg.='</body></html>';

	mail($to,$subject,$msg,$headers);


	if($category=='doctor'){
		$sql="SELECT doctor_id, doctor_username FROM doctors WHERE doctor_email='$e' AND activated='1' LIMIT 1";
		$query=mysqli_query($db_conx,$sql);
		$numrows=mysqli_num_rows($query);
		
		if($numrows>0){
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
				$id=$row['doctor_id'];
				$u=$row['doctor_username'];
			}
			$emailcut=substr($e, 0, 6);
			$randNum=rand(10000, 99999);
			$temppass="$emailcut$randNum";
                //$hashTempPass=md5($temppass);
			$sql="UPDATE doctors_options SET temp_pass='$temppass' WHERE doctor_username='$u' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
		}else{
			echo "no_exist";
			exit();
		}
	}

	else if($category=='hospital'){
		$sql="SELECT hospital_id, hospital_username FROM hospitals WHERE hospital_email='$e' AND activated='1' LIMIT 1";
		$query=mysqli_query($db_conx,$sql);
		$numrows=mysqli_num_rows($query);
		
		if($numrows>0){
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
				$id=$row['hospital_id'];
				$u=$row['hospital_username'];
			}
			$emailcut=substr($e, 0, 6);
			$randNum=rand(10000, 99999);
			$temppass="$emailcut$randNum";
                //$hashTempPass=md5($temppass);
			$sql="UPDATE hospitals_options SET temp_pass='$temppass' WHERE hospital_username='$u' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
		}else{
			echo "no_exist";
			exit();
		}
	}

	else if($category=='diagnostic'){
		$sql="SELECT diagnostic_id, diagnostic_username FROM diagnostics WHERE diagnostic_email='$e' AND activated='1' LIMIT 1";
		$query=mysqli_query($db_conx,$sql);
		$numrows=mysqli_num_rows($query);
		
		if($numrows>0){
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
				$id=$row['diagnostic_id'];
				$u=$row['diagnostic_username'];
			}
			$emailcut=substr($e, 0, 6);
			$randNum=rand(10000, 99999);
			$temppass="$emailcut$randNum";
                //$hashTempPass=md5($temppass);
			$sql="UPDATE diagnostics_options SET temp_pass='$temppass' WHERE diagnostic_username='$u' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
		}else{
			echo "no_exist";
			exit();
		}
	}

	else if($category=='medicine'){
		$sql="SELECT company_id, company_username FROM companies WHERE company_email='$e' AND activated='1' LIMIT 1";
		$query=mysqli_query($db_conx,$sql);
		$numrows=mysqli_num_rows($query);
		
		if($numrows>0){
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
				$id=$row['company_id'];
				$u=$row['company_username'];
			}
			$emailcut=substr($e, 0, 6);
			$randNum=rand(10000, 99999);
			$temppass="$emailcut$randNum";
                //$hashTempPass=md5($temppass);
			$sql="UPDATE companies_options SET temp_pass='$temppass' WHERE company_username='$u' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
		}else{
			echo "no_exist";
			exit();
		}
	}

	else {
		$sql="SELECT ambulance_id, ambulance_username FROM ambulances WHERE ambulance_email='$e' AND activated='1' LIMIT 1";
		$query=mysqli_query($db_conx,$sql);
		$numrows=mysqli_num_rows($query);
		
		if($numrows>0){
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
				$id=$row['ambulance_id'];
				$u=$row['ambulance_username'];
			}
			$emailcut=substr($e, 0, 6);
			$randNum=rand(10000, 99999);
			$temppass="$emailcut$randNum";
                //$hashTempPass=md5($temppass);
			$sql="UPDATE ambulances_options SET temp_pass='$temppass' WHERE ambulance_username='$u' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
		}else{
			echo "no_exist";
			exit();
		}
	}
	$to="$e";
	$from="slimon_ice@yahoo.com";
	$headers="From: $from\n";
	$headers.="MIME-Version 1.0\n";
	$headers.="Content-type: text/html; charset=iso-8859-1 \n";
	$subject="Medicaid Temporary Password";
	$msg="<h2>Hello".$u."</h2><p></p>";

	if(mail($to,$subject,$msg,$headers)){
		echo "success";
		exit();
	}else{
		echo "email_send_failed";
		exit();
	}
}
?>
<!--?php
	if(isset($_GET['u']) && isset($_GET['p'])){
		$u=preg_replace("#[a-z0-9]#i", '', $_GET['u']);
		$temppasshash=preg_replace("#[a-z0-9]#i", '', $_GET['p']);
		if(strlen($temppasshash)<10){
			exit();
		}
		$sql="SELECT doctor_id FROM doctors_options WHERE doctor_username='$u' AND temp_pass='$temppasshash' LIMIT 1";
		$query=mysqli_query($db_conx,$sql);
		$numrows=mysqli_num_rows($query);
		if($numrows==0){
			header("location: message.php?msg=There is no match for that username with the temporary password");
			exit();
		}else{
			$row=mysqli_fetch_row($query);
			$id=$row[0];
			$sql="UPDATE doctors SET doctor_password='$temppasshash' WHERE doctor_id='$id' AND doctor_username='$u' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);
			$sql="UPDATE doctors_options SET temp_pass='' WHERE doctor_id='$id' AND doctor_username='$u' LIMIT 1";
			$query=mysqli_query($db_conx,$sql);

			header("location: login.php");
			exit();
		}
	}
	?-->
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<link rel="shortcut icon" href="images/boiddo-band.png" />
		<title>Boiddo | Forgot Password</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Online doctor and hospitals whats you need while trubling">
		<meta name="keywords" content="online doctor, boiddo, healthcare, online hospitals, medical information">
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styles.css">
		<script src="js/jquery.js"></script>

    <!--script type="text/javascript">
    function forgotpass(){

    	var e=_("email").value;
    	if(e==""){
    		_("status").innerHTML="Type your email address";
    	}else{
    		_("forgotpassbtn").style.display="none";
    		_("status").innerHTML="Please wait..";
    		var ajax=ajaxObj("POST","forgot-pass.php");
    		ajax.onreadystatechange = function(){
    			if(ajaxReturn(ajax)==true){

    				var response=ajax.responseText;
    				alert(response);
    				if(response=="success"){
    					_("forgotpassform").innerHTML="<h3>Step 2. Check your email inbox in a few minutes</h3><p>You can close this window, if you like.</p>";
    				}else if(response=="no_exist"){
    					_("status").innerHTML="Sorry this email is not register yet.";
    				}else if(response=="email_send_failed"){
    					_("status").innerHTML="Mail function failed to execute.";
    				}else{
    					_("status").innerHTML="An unknown error ocuored.";
    				}

    			}
    		}
    		ajax.send("e="+e);
    	}
    }
</script-->

<script type="text/javascript">

	function forgotpass(){

		var e=$("#email").val();
		var category = $('#category option:selected').text();
		if(e==""){
			$("#status").html("Type your email address");
		}else{
			$("#forgotpassbtn").css("display","none");
			$("#status").html("Please wait..");
			$.post("forgot-pass.php",{
				email: e,
				cat: category
			}, function(data){
				if(data=="success"){
					$("#forgotpassform").html("<h3>Step 2. Check your email inbox in a few minutes</h3><p>You can close this window, if you like.</p>");
				}else if(data=="email_send_failed"){
					$("#status").html("Mail function failed to execute.");
				}else if(data=="no_exist"){
					$("#status").html("Sorry this email is not register in this category or not activated yet.").css('color','red');
					$("#forgotpassbtn").css("display","block");
				}else{
					$("#status").html("An unknown error ocuored.");
				}
			});
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
			<div class="col-sm-offset-3 col-sm-6" style="height: 324px">
				<div class="panel panel-default bgc">
					<div class="panel-title">
						<h3 class="center"><strong>Forgot Password?</strong></h3>
						<h3 class="center"><strong>Generate a temporary login password</strong></h3>
					</div>
					<!--Registration form Start here-->

					<div id="reg" class="well">
						<div class="center">
							
						</div>
						<form class="form-horizontal" onsubmit="return false;" method="POST" role="form" id="forgotpassform">

							<div class="form-group">
								
								<label for="email" class="col-xs-5 col-sm-5 control-label">Step 1. Enter your email</label>
								<div class="col-xs-7 col-sm-7"> 
									<input type="text" name="email" class="form-control" id="email" onfocus="_('status').innerHTML='';" placeholder="email address" required maxlength="88">
								</div>
							</div>

							
							<div class="form-group">
								<label for="category" class="col-xs-5 col-sm-5 control-label">Category</label>
								<div class="col-xs-7 col-sm-7">
									<select id="category" class="form-control">
										<option>Doctor</option>
										<option>Hospital</option>
	                    <!-- <option>Diagnostic</option>
	                    <option>Ambulance</option>
	                    <option>Medicine</option> -->
	                </select>
	            </div>
	        </div>

	        <div class="form-group">
	        	

	        	<div class="col-xs-offset-5 col-xs-3 col-sm-offset-5 col-sm-2">
	        		<button id="forgotpassbtn" onclick="forgotpass()" name="btn-login" class="btn btn-primary">Generate Temp Password</button>
	        	</div>
	        	<p></p>
	        	<div class="col-xs-offset-2 col-xs-10 col-sm-offset-1 col-sm-11">
	        		<p id="status"></p>
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
	<?php include_once("boiddo-footer.php");?>
</div>
<!--End if the Footer-->

</body>
</html>