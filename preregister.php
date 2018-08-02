<?php
include_once("check-login-status.php");
require("/home/boiddoco/public_html/phpmailer/PHPMailer_5.2.0/class.phpmailer.php");
    //require("check-user-email.php");
if($user_ok==true && $log_category=='doctor'){
	header("location: edit-profile-dr.php");
}else if($user_ok==true && $log_category=='hospital'){
	header("location: edit-profile-hos.php");
}


$newname=$_COOKIE['regconfname'];
$newemail=$_COOKIE['regconfemail'];
$newcategory=$_COOKIE['regconfcat'];
$com_code = $_COOKIE['comcode'];

$to="limon.pstu@gmail.com";
        //$to="$newemail";
$headers="From: Boiddo\n";
$headers .= "Reply-To: Boiddo\r\n";
$headers.="MIME-Version: 1.0\r\n";
$headers.="Content-Type: text/html; charset=ISO-8859-1\r\n";
$subject="Confirm Registration";
$msg='<html><body>';
$msg.='<h2>Hello '.$newname.'</h2>';
$msg.='<h3>You have been registered <a style="text-decoration: none;" href="http://www.boiddo.com">Boiddo</a> at '.$newcategory.' category.</h3>';
$msg.='<p>Your Boiddo account is not activate yet. Please confirm us that really you make registration by activating this account.';
$msg.='If you did not made registration, please ignore this message.';
$msg.='Click the following link to activate this boiddo account.</p>';
$msg.='<p><a href="http://www.boiddo.com/confirmation.php?user-conf='.urlencode($com_code).'&com-cat='.urlencode($newcategory).'">Click here to activate</a></p>';
$msg.='</body></html>';


$mail = new PHPMailer();
    $mail->IsSMTP();                                      // set mailer to use SMTP
    $mail->Host = "localhost";  // specify main and backup server
    $mail->SMTPAuth = true;     // turn on SMTP authentication
    $mail->Username = "info@boiddo.com";  // SMTP username
    $mail->Password = "114850"; // SMTP password

    $mail->From = "no-reply@boiddo.com";
    $mail->FromName = "Boiddo";
    $mail->AddAddress($to);                  // name is optional

    $mail->WordWrap = 250;                                 // set word wrap to 50 characters
    $mail->IsHTML(true);                                  // set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $msg;
    $mail->AltBody = $msg;

    


    if(isset($_COOKIE['reg']) || isset($_SESSION['reg'])){
    	if($mail->Send()){
    		
    		unset($_SESSION['reg']);
    		session_destroy();
    		
    		
    		?>

    		<!DOCTYPE html>
    		<html lang="en">
    		<head>
    			<link rel="shortcut icon" href="images/boiddo-band.png" />
    			<title>Boiddo | Registration Conformation</title>
    			<meta charset="utf-8">
    			<meta name="viewport" content="width=device-width, initial-scale=1">
    			<link rel="stylesheet" href="css/bootstrap.min.css">
    			<link rel="stylesheet" href="css/styles.css">
    		</head>

    		<body>
    			<!--1st Container Start here -->
    			<div class="container no-padding">

    				<!--Page Header End-->
    				<div id="top" class="page-header no-margin">

    					<span><h1 style="margin-left: 12px"><strong>BOIDDO</strong> <small>health service station</small></h1></span>
    				</div>
    				<!--Page Header End here-->

    			</div>
    			<!--1st Container End here -->

    			<!--2nd Container Start here -->
    			<div class="container">
    				<div class="panel panel-default bgc" style="height: 314px">
    					<div class="panel-title">
    						<h2 class="center">Registration Successful</h2>
    					</div>
    					<div class="well">
    						<h4 class="center">The activation link has been sent to your email. <span style="color: #655467"><strong>please check your email inbox</strong></span> and activate your account by using activation link</h4>
    						<p>If you dont receive activation email, please use the resend email button of this page. After 6 hours your activation link does not work, so i must recomend you please active your account as soon as possible. If you face further problem please contact us. Thanks you for comming with us and hope you will being with us.</p>
    						
    					</div>
    					
    				</div>
    			</div>
    			<!--2nd Container End here -->

    			<!--Start if the Footer-->

    			<?php include_once('boiddo-footer.php');?>


    			<!--End if the Footer-->

    			<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script-->
    			<script src="js/jquery.js"></script>
    			<script src="js/bootstrap.min.js"></script>
    			
    		</body>
    		</html>
    		<?php
    		exit;
    	}else{
    		echo "message sending failed.!!";
    	}
    }else{
    	echo "<h1>Error 503</h1>";
    	echo "Unauthorized entry.!!!";
    }
    ?>