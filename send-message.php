<?php  
require("/home/boiddoco/public_html/phpmailer/PHPMailer_5.2.0/class.phpmailer.php");

if(isset($_POST['submit'])){
	$to = "limon.pstu@gmail.com";
	$name = $_POST['name'];
	$subject = $_POST['sub'];
	$msg = $_POST['msg'];
	$msg .="\n Sender email: ".$_POST['email'];
	$mail = new PHPMailer();
    $mail->IsSMTP();                                      // set mailer to use SMTP
    $mail->Host = "localhost";  // specify main and backup server
    $mail->SMTPAuth = true;     // turn on SMTP authentication
    $mail->Username = "info@boiddo.com";  // SMTP username
    $mail->Password = "114850"; // SMTP password

    $mail->From = "info@boiddo.com";
    $mail->FromName = "boiddo-contact: ".$name;
    $mail->AddAddress($to);                  // name is optional

    $mail->WordWrap = 50;                                 // set word wrap to 50 characters
    $mail->IsHTML(true);                                  // set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $msg;
    $mail->AltBody = $msg;
    if(!$mail->Send()){
    	echo "Message sending failed...";
    	exit;
    }
    echo "Message sent...";
    exit;
}else{
	echo "Hey anoneymous, get out of here.!!";
	exit;
}
?>