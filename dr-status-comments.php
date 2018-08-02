<?php 
include_once("check-login-status.php");
if($user_ok != true || $log_category != 'doctor'){
	exit;
}
$tz_query = mysqli_query($db_conx,"SELECT tz FROM doctors WHERE doctor_id='$log_id'LIMIT 1");
while($tz_row = mysqli_fetch_assoc($tz_query)){
  $tz = $tz_row['tz'];
}
date_default_timezone_set($tz);

if($_POST['types'] == "status"){
	$status = $_POST['status'];
	$privecy = $_POST['privecy'];
	if(empty($status)){
		echo "empty status!";
		exit;
	}else{
		$dr_query_per = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE doctor_id='$log_id' LIMIT 1");
		while($rows = mysqli_fetch_assoc($dr_query_per)){
			$fullname = $rows['full_name'];
			$speciality = $rows['speciality'];
		}
		$dr_query_opt = mysqli_query($db_conx,"SELECT * FROM doctors_options WHERE doctor_id='$log_id' LIMIT 1");
		while($rows = mysqli_fetch_assoc($dr_query_opt)){
			$img_name = $rows['img_name'];
		}
		$dr_query_pro = mysqli_query($db_conx,"SELECT * FROM doctors_professional WHERE doctor_id='$log_id' LIMIT 1");
		while($rows = mysqli_fetch_assoc($dr_query_pro)){
			$dr_id = $rows['doctor_id'];
			$hos_name = $rows['hospital_name'];
			$hos_city = $rows['city'];
			$hos_country = $rows['country'];
		}
		$nowd = date("Y-m-d");
		$nowt = date("H:i:s");
		$dr_query_status = mysqli_query($db_conx,"INSERT INTO doctors_status(privecy, doctor_id, fullname, status, speciality, status_time, status_date, hospital_name, hospital_city, hospital_country,img_name, active)
			VALUES('$privecy','$dr_id','$fullname','$status','$speciality','$nowt','$nowd','$hos_name','$hos_city','$hos_country','$img_name','1')");
		if($dr_query_status){
			echo "successfully posted...";
			exit;
		}else{
			echo "failed to post...";
			exit;
		}
	}
}else if($_POST['types'] == 'comments'){
	$comments = $_POST['comments'];
	$status_id = $_POST['status_id'];
	//$cmnt_number = 0;
	$info_query = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE doctor_id='$log_id' LIMIT 1");
	while($row = mysqli_fetch_assoc($info_query)){
		$fullname = $row['full_name'];
	}
	$dr_query_opt = mysqli_query($db_conx,"SELECT * FROM doctors_options WHERE doctor_id='$log_id' LIMIT 1");
	while($rows = mysqli_fetch_assoc($dr_query_opt)){
		$img_name = $rows['img_name'];
	}
	$sts_update_query = mysqli_query($db_conx,"SELECT comments FROM doctors_status WHERE status_id='$status_id'LIMIT 1");
	while($uprow = mysqli_fetch_assoc($sts_update_query)){
		$cmnt_number = $uprow['comments'];
	}
	$cmnt_number++;
	$nowd = date("Y-m-d");
	$nowt = date("H:i:s");
	$cmnt_number_query = mysqli_query($db_conx,"UPDATE doctors_status SET comments='$cmnt_number' WHERE status_id='$status_id' LIMIT 1");
	$comments_query = mysqli_query($db_conx,"INSERT INTO doctors_comments(status_id, doctor_id, comments, comments_time, comments_date, fullname,img_name,active) 
		VALUES('$status_id','$log_id','$comments','$nowt','$nowd','$fullname','$img_name','1')");
	if($comments_query){
		echo "successfully comment posted...";
		exit;
	}else{
		echo "failed to post comment...";
		exit;
	}
}else if($_POST['types'] == 'likes'){
	$status_id = $_POST['statusid'];
	$liked = 0;
	
	$like_pre_query = mysqli_query($db_conx,"SELECT likes FROM doctors_status WHERE status_id='$status_id' LIMIT 1");
	while($pre_row = mysqli_fetch_assoc($like_pre_query)){
		$liked = $pre_row['likes'];
	}
	$exist_like_query = mysqli_query($db_conx,"SELECT * FROM doctors_likes WHERE status_id='$status_id' AND doctor_id='$log_id'");
	$row = mysqli_fetch_assoc($exist_like_query);
	$num= mysqli_num_rows($exist_like_query);
	if($num){
		$dislike = $row['dislike'];
		if($dislike){
			$liked++;
			$like_id_query = mysqli_query($db_conx,"UPDATE doctors_likes SET dislike='0' WHERE status_id='$status_id'AND doctor_id='$log_id' LIMIT 1");
		}else{
			$liked--;
			$like_id_query = mysqli_query($db_conx,"UPDATE doctors_likes SET dislike='1' WHERE status_id='$status_id'AND doctor_id='$log_id' LIMIT 1");
		}
		
		$like_num_query = mysqli_query($db_conx,"UPDATE doctors_status SET likes='$liked' WHERE status_id='$status_id' LIMIT 1");
		
		if($dislike==1){
			echo " Liked ".$liked;
			exit;
		}else{
			echo " Like ".$liked;
			exit;
		}
	}else{
		$liked++;
		$nowd = date("Y-m-d");
		$nowt = date("H:i:s");
		$like_num_query = mysqli_query($db_conx,"UPDATE doctors_status SET likes='$liked' WHERE status_id='$status_id' LIMIT 1");
		$like_id_query = mysqli_query($db_conx,"INSERT INTO doctors_likes(status_id,doctor_id,like_time,like_date,dislike)
		 VALUES('$status_id','$log_id','$nowt','$nowd','0')");
		echo " Liked ".$liked;
		exit;
	}
}else if($_POST['types'] == 'delete'){
	$status_id = $_POST['status_id'];
	$delete_sts_query = mysqli_query($db_conx,"DELETE FROM doctors_status WHERE status_id='$status_id'LIMIT 1");
	if($delete_sts_query){
		$delete_cmnt_query = mysqli_query($db_conx,"DELETE FROM doctors_comments WHERE status_id='$status_id'");
		if($delete_cmnt_query){
			$delete_like_query = mysqli_query($db_conx,"DELETE FROM doctors_likes WHERE status_id='$status_id'");
			if($delete_like_query){
				echo "deleted....";
				exit;
			}
		}
	}else{
		echo "delete operation failed...";
		exit;
	}
}
?>