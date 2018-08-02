<?php
include_once("check-login-status.php");
if($user_ok == true && $log_category == 'doctor'){
	header("Location: dr-planet.php");
}else if($user_ok == true && $log_category == 'hospital'){
	header("Location: edit-profile-hos.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="images/boiddo-band.png" />
	<title>Boiddo | Log In</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">

</head>

<body  style="height: 100%;">
	<!--1st Container Start here -->
	<div class="container no-padding">

		<!--Page Header End-->
		<div id="top" class="page-header no-margin">
			
			<span><h1 style="margin-left: 12px"><strong>BOIDDO</strong> <small>Universal Health Service Station</small></h1></span>
		</div>
		<!--Page Header End here-->

	</div>
	<!--1st Container End here -->

	<!--2nd Container Start here -->
	<div class="container">
		<div class="row" >
			<p ></p>
			<div class="col-sm-offset-3 col-sm-6" style="height: 324px">
				<div class="panel panel-default bgc">
					<div class="panel-title">
						<h3 class="center"><strong>Log In</strong></h3>
					</div>
					<!--Registration form Start here-->

					<div id="reg" class="well">
						<?php if($user_ok == false){?>
						<div class="col-xs-offset-5">
							<span id='isfailed' style="color:red;">Log in failed.</span>
						</div>
						<?php } ?>
						<form class="form-horizontal" method="POST" onsubmit="return false;" role="form" id="loginform">

							<div class="form-group">
								
								<label for="email" class="col-xs-4 col-sm-4 control-label">user</label>
								<div class="col-xs-8 col-sm-7"> 
									<input type="text" name="email" class="form-control" id="email" placeholder="email or username" required>
								</div>
							</div>

							<div class="form-group">
								
								<label for="password" class="col-xs-4 col-sm-4 control-label">password</label>
								<div class="col-xs-8 col-sm-7">
									<input type="password" name="pass" class="form-control" id="pass" placeholder="password" required>
								</div>
								<div class="col-xs-offset-5 col-sm-12">
									<span id='iscorrect'></span>
								</div>

							</div>

							<div class="form-group">
								<div class="col-xs-offset-4 col-xs-8 col-sm-offset-4 col-sm-8">
									<span id="forgot"><a style="text-decoration: none" href="forgot-pass.php">Forgot password ?</a></span>
									<p></p>
								</div>

								<div class="col-xs-offset-4 col-xs-3 col-sm-offset-4 col-sm-2">
									<button id="btnlogin" onclick="login()" name="btn-login" value="clicking" class="btn btn-primary">Log In</button>
								</div>
								<div class="col-xs-offset-2 col-xs-3 col-sm-offset-1 col-sm-4">
									<span id="fault"></span>
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
	<?php include_once('boiddo-footer.php');?>
	<!--End if the Footer-->

	<script src="js/jquery.js"></script>
	<script type="text/javascript">

		function login(){
			var password=$("#pass").val();
			var email=$("#email").val();

			$('#iscorrect').html('');
			$.post("phplogin.php",{
				password: password,
				email: email
			},function(data){
				var act=data.indexOf("not activate yet");
				var wrong=data.indexOf("wrong details");
				var err=data.indexOf("an error found");
				var sucdr=data.indexOf("success doctor");
				var suchos=data.indexOf("success hospital");
				if(act>=0){
					$("#iscorrect").html(data).css('color','red');
				}else if(wrong>=0){
					$("#iscorrect").html(data).css('color','red');
				}else if(err>=0){
					$("#iscorrect").html(data).css('color','red');
				}else if(sucdr>=0){
					window.location.href = "dr-planet.php";
                        //alert(data);
                    }else if(suchos>=0){
                    	window.location.href = "edit-profile-hos.php";
                        //alert(data);
                    }
                });
               //window.location = ("edit-profile-dr.php");
           }
       </script>

   </body>
   </html>
   <?php 
   ?>
