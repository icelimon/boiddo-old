<?php 
include_once("check-login-status.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="images/boiddo-band.png" />
	<title>Boiddo</title>
	<meta name="description" content="Online doctor and hospitals whats you need while trubling. Find your nearest hospital, get information about doctors and hospitals. Get serial of them... and many more option what you need.">
	<meta name="keywords" content="online doctor, boiddo, healthcare, online hospitals, medical information">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">

</head>
		<?php 
		if($user_ok == false){
		?>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-2" style="padding-top:0px;">
			<div class="">
				<a href="terms.php#contact" style="font-size:24px;text-decoration:none">Contact us</a><br/>
				Call us: <a href="">+88 01738 ****44</a>
				<p>E-mail: <a href="terms.php#contact" style="color:blue">info@boiddo.com</a></p>
			</div>
		</div>
		<div class="col-sm-5" style="padding:5px;text-align:center">
			<br/>
			<h3 style="color:blue">subscription is only for professionals</h3>
		</div>

		<div class="col-sm-4" style="float:right;margin-right:15px">
			<div class="">
			<form id="loginform" method="POST" onsubmit="return false;" class="form-group-sm" role="form" onclick="return onSubmit;">
				<div class="row" style="margin-top:10px;">
					<div class="col-xs-6" style="padding-left:0px">
						<input id="loginemail" name="email" type="text" placeholder="user" class="form-control form-group" required>
					</div>
					<div class="col-xs-6" style="padding-right:0px">
						<input  id="loginpassword" name="pass" type="password" placeholder="password" class="form-control form-group" required>
					</div>
					
					<div class="col-xs-6" style="padding-left:0px;margin-top:-15px">
						<button style="margin-top:10px" id="btnlogin" name="btn-login" class="btn btn-info btn-block pull-right" type="submit"><strong>Log In</strong></button>
					</div>
					<div class="col-xs-6" style="padding-right:0px;margin-top:-10px">
						<input type="checkbox"><span style="font-size:13px"> Remember password?</span><br/> <a style="color:#000;font-size:13px" href="#">Forgot password?</a>
					</div>
					<p id="iscorrect"></p>
				</div>
			</form>
			</div>
		</div>
		<?php } ?>
	</div>
</div>

<script src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$("#btnlogin").click(function() {

	var logemail = $("#loginemail").val();
	var logpassword = $("#loginpassword").val();
	            //$('#fault').html("Please wait...");
	            $("#iscorrect").html("").css('color','blue');
	            $.post("phplogin.php", {
	            	email: logemail,
	            	password: logpassword
	            },function(data) {
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
                        	window.location.href = "edit-profile-dr.php";
                        	//alert(data);
                    	}else if(suchos>=0){
                        	window.location.href = "edit-profile-hos.php";
                        	//alert(data);
                    	}else{
                    		$("#iscorrect").html("log in failed").css('color','red');
                    	}
	            });

	 });

	$('#loginpassword').keypress(function(e){
		logine = $("#loginemail").val();
		loginp = $("#loginpassword").val();
		if(e.keyCode==13 && logine !="" && loginp)
			$('#btnlogin').click();
	});

});
</script>
</body>
</html>