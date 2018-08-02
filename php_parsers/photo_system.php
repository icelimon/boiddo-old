<?php
include_once("../check-login-status.php");
if($user_ok != true || $log_username == "") {
		exit();
	}
if (isset($_FILES["avatar"]["name"]) && $_FILES["avatar"]["tmp_name"] != ""){
	$fileName = $_FILES["avatar"]["name"];
    $fileTmpLoc = $_FILES["avatar"]["tmp_name"];
    $imgData = addslashes (file_get_contents($_FILES["avatar"]["tmp_name"]));
	$fileType = $_FILES["avatar"]["type"];
	$fileSize = $_FILES["avatar"]["size"];
	$fileErrorMsg = $_FILES["avatar"]["error"];
	$kaboom = explode(".", $fileName);
	$fileExt = end($kaboom);


	list($width, $height) = getimagesize($fileTmpLoc);
	if($width < 10 || $height < 10 ){
		header("location: ../message.php?msg=ERROR: That image has no dimensions or image height is less than image width!");
        exit();	
	}
	$db_file_name = $log_username.rand(100000000000,999999999999).".".$fileExt;
	//$db_file_name = $log_username."-".date().".".$fileExt;
	if($fileSize > 1048576) {
		header("location: ../message.php?msg=ERROR: Your image file was larger than 1mb");
		exit();	
	} else if (!preg_match("/\.(gif|jpg|png)$/i", $fileName) ) {
		header("location: ../message.php?msg=ERROR: Your image file was not jpg, gif or png type");
		exit();
	} else if ($fileErrorMsg == 1) {
		header("location: ../message.php?msg=ERROR: An unknown error occurred");
		exit();
	}
	if($log_category == "doctor"){
		$sql = "SELECT image FROM doctors_options WHERE doctor_username='$log_username' LIMIT 1";
	}else if($log_category == "hospital"){
		$sql = "SELECT image FROM hospitals_options WHERE hospital_username='$log_username' LIMIT 1";
	}else if($log_category == "diagnostic"){
		$sql = "SELECT image FROM diagnostics_options WHERE diagnostic_username='$log_username' LIMIT 1";
	}else if($log_category == "company"){
		$sql = "SELECT image FROM companies_options WHERE company_username='$log_username' LIMIT 1";
	}else if($log_category == "ambulance"){
		$sql = "SELECT image FROM ambulances_options WHERE ambulance_username='$log_username' LIMIT 1";
	}else{
		header("location: message.php?msg=please log in first.!!");
	}
	
	$query = mysqli_query($db_conx, $sql);
	$row = mysqli_fetch_row($query);
	$avatar = $row[0];
	if($log_category=='doctor'){
		//if($avatar != ""){
			$picurl = "../user_doc/$avatar"; 
		    if (file_exists($picurl)) { unlink($picurl); }
		    $moveResult = move_uploaded_file($fileTmpLoc, "../user_doc/$db_file_name");

		//}
	}else if($log_category=='hospital'){
		//if($avatar != ""){
			$picurl = "../user_hos/$avatar"; 
		    if (file_exists($picurl)) { unlink($picurl); }
		    $moveResult = move_uploaded_file($fileTmpLoc, "../user_hos/$db_file_name");
		//}
	}


	//$directoryPath = "/home/domain/public_html/site_name/pics/profiles/".$log_username;
	//mkdir($directoryPath, 0644);
	

	
	if ($moveResult != true) {
		header("location: ../message.php?msg=ERROR: File upload failed");
		exit();
	}
	include_once("../php_includes/image_resize.php");
	// $target_file = "$imgData";
	// $resized_file = "$imgData";
	if($log_category =='doctor'){
		$target_file = "../user_doc/$db_file_name";
		$resized_file = "../user_doc/$db_file_name";
	}else if($log_category =='hospital'){
		$target_file = "../user_hos/$db_file_name";
		$resized_file = "../user_hos/$db_file_name";
	}
	$wmax = 200;
	$hmax = 200;

	// Read the file
	// $fp = fopen($db_file_name, 'r');
	// $data = fread($fp, filesize($db_file_name));
	// $data = addslashes($data);
	// fclose($fp);
	img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

	if($log_category =='doctor'){
		$sql = "UPDATE doctors_options SET image='$resized_file', img_name='$db_file_name', updated='1' WHERE doctor_username='$log_username' LIMIT 1";
		$sqlsts = "UPDATE doctors_status SET img_name='$db_file_name' WHERE doctor_id='$log_id'";
		$sqlcmt = "UPDATE doctors_comments SET img_name='$db_file_name' WHERE doctor_id='$log_id'";
		$query = mysqli_query($db_conx, $sql);
		$querysts = mysqli_query($db_conx, $sqlsts);
		$querycmt = mysqli_query($db_conx, $sqlcmt);
		mysqli_close($db_conx);
		header("location: ../edit-profile-dr.php");
	}else if($log_category =='hospital'){
		$sql = "UPDATE hospitals_options SET image='$resized_file', img_name='$db_file_name', updated='1' WHERE hospital_username='$log_username' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		mysqli_close($db_conx);
		header("location: ../edit-profile-hos.php");
	}
	exit();
}
?>