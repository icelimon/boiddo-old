<?php
include_once("check-login-status.php");

if($user_ok == true && $log_category == "doctor"){
	$u = $log_username;
}else{
	header("location: http://boiddo.com");
	exit(); 
}
if(isset($_GET['id'])){
	$profile = $_GET['id'];
	$query_getid = mysqli_query($db_conx,"SELECT doctor_id FROM doctors WHERE profile='$profile' LIMIT 1");
	while($row_getid = mysqli_fetch_assoc($query_getid)){
		$new_id = $row_getid['doctor_id'];
	}

}
if($log_id == $new_id){
	header("location: http://www.boiddo.com/doctor.php");
}

if(isset($profile)){
	$query = mysqli_query($db_conx,"SELECT * FROM doctors_options WHERE doctor_id='$new_id' LIMIT 1");
	$per_query = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE doctor_id ='$new_id' LIMIT 1");
	$dr_query_status_planet = mysqli_query($db_conx, "SELECT * FROM doctors_status WHERE doctor_id='$new_id' ORDER BY status_id DESC");
}else{
	$query = mysqli_query($db_conx,"SELECT * FROM doctors_options WHERE doctor_id='$log_id' LIMIT 1");
	$per_query = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE doctor_id ='$log_id' LIMIT 1");
	$dr_query_status_planet = mysqli_query($db_conx, "SELECT * FROM doctors_status WHERE doctor_id='$log_id' ORDER BY status_id DESC");
}

while($rowopt = mysqli_fetch_assoc($query)){
	$image = $rowopt['image'];
	$img_name = $rowopt['img_name'];
}
if($image == NULL){
	$profile_pic = '<img class="img-rounded img-responsive" src="images/default-dr.png" alt="'.$image.'">';
	$comment_pic = '<img class="" width="30" height="30" src="images/default-dr.png" alt="'.$image.'">';
}else{
	$profile_pic = '<img class="img-rounded img-responsive" src="user_doc/'.$img_name.'" alt="'.$image.'">';
	$comment_pic = '<img class="" width="30" height="30" src="user_doc/'.$img_name.'" alt="'.$image.'">';
}

while($rowper = mysqli_fetch_assoc($per_query)){
	$country = $rowper['country'];
	$speciality = $rowper['speciality'];
	$fullname = $rowper['full_name'];
	$city = $rowper['city'];
	$postcode = $rowper['postcode'];
	$country = $rowper['country'];
}


/************************** Doctors Status Section**********************************/
function timecal($hr,$min,$sec){
	if($sec < 0){
		$sec += 60;
		$min -= 1; 
	}
	if($min < 0){
		$min += 60;
		$hr -= 1;
	}
	if($hr < 0){
		$hr += 24;
	}
	if($hr == 0){
		if($min == 0){
			$sub_time = 'Just now';
		}else{
			$sub_time = $min.'M ago';
		}
	}else{
		$sub_time = $hr.'H:'.$min.'M ago';
	}
	return $sub_time;

}

$i=0;
while($rows = mysqli_fetch_assoc($dr_query_status_planet)){
	$id_planet_sts[$i] = $rows['status_id'];
	$dr_id_planet_sts[$i] = $rows['doctor_id'];
	$speciality_planet_sts[$i] = $rows['speciality'];
	$planet_sts[$i] = $rows['status'];
	$name_planet_sts[$i] = $rows['fullname'];
	$image_planet_sts[$i] = $rows['img_name'];
	$hos_name_planet_sts[$i] =$rows['hospital_name'];
	$hos_city_planet_sts[$i] = $rows['hospital_city'];
	$hos_country_planet_sts[$i] = $rows['hospital_country'];
	$likes_planet_sts[$i] = $rows['likes'];
	$comments_planet_sts[$i] = $rows['comments'];
	$seens_planet_sts[$i] = $rows['seens'];
	$status_planet_img[$i] = '<img class="img-rounded img-responsive" width="70" height="70" src="user_doc/'.$image_planet_sts[$i].'" alt="'.$name_planet_sts[$i].'">';

	$dr_id = $dr_id_planet_sts[$i];
	$profile_query = mysqli_query($db_conx,"SELECT * FROM doctors WHERE doctor_id='$dr_id' LIMIT 1");
	if($profilerow = mysqli_fetch_assoc($profile_query)){
		$profile_id[$i]=$profilerow['profile'];
		$tz = $profilerow['tz'];
	}
	date_default_timezone_set($tz);
	
	$time = $rows['status_time'];
	$date = $rows['status_date'];
	
	$newtime = strtotime($time);
	$htime = date('H',$newtime);
	$mintime = date('i',$newtime);
	$sectime = date('s',$newtime);
	if(($htime/12) >= 1){
		$aptime = $htime % 12;
		if($aptime == 0){
			$aptime = 12;  
		}
		
		$printtime = $aptime.":".$mintime." PM";
	}else{
		$aptime = date('H:i',$newtime);
		$printtime = $aptime." AM";
	}
	$planet_sts_hr = date('H') - date('H',$newtime);
	$planet_sts_min =date('i') - date('i',$newtime);
	$planet_sts_sec =date('s') - date('s',$newtime);

	$newdate = strtotime($date);
	$printdate = date('d M Y',$newdate);
	$planet_sts_yr = date('Y')-date('Y',$newdate);
	$planet_sts_mon = date('m')-date('m',$newdate);
	$planet_sts_day = date('d')-date('d',$newdate);
	if($planet_sts_yr == 0){
		if($planet_sts_mon == 0){
			if($planet_sts_day == 0){
				$planet_date[$i] = "Today";
				$planet_time[$i] = timecal($planet_sts_hr,$planet_sts_min,$planet_sts_sec);
			}else if($planet_sts_day == 1){
				$planet_date[$i] = "Yesterday";
				$planet_time[$i] = $printtime;
			}else{
				$planet_date[$i] = $planet_sts_day.' days ago';
				$planet_time[$i] = $printtime;
			}
		}else{
			$planet_date[$i] = $printdate;
			$planet_time[$i] = $printtime;
		}
	}else{
		$planet_date[$i] = $printdate;
		$planet_time[$i] = $printtime;
	}
  //$planet_time[$i] = $planet_sts_hr;

	$dislike[$i] = 1;
	$sts_id = $id_planet_sts[$i];
	if(isset($profile)){
		$like_query = mysqli_query($db_conx,"SELECT dislike FROM doctors_likes WHERE status_id='$sts_id' AND doctor_id='$new_id' LIMIT 1");
	}else{
		$like_query = mysqli_query($db_conx,"SELECT dislike FROM doctors_likes WHERE status_id='$sts_id' AND doctor_id='$log_id' LIMIT 1");
	}
	if($newrow = mysqli_fetch_assoc($like_query)){
		$dislike[$i]=$newrow['dislike'];
	}
	$dr_id = $dr_id_planet_sts[$i];
	$profile_query = mysqli_query($db_conx,"SELECT profile FROM doctors WHERE doctor_id='$dr_id' LIMIT 1");
	if($profilerow = mysqli_fetch_assoc($profile_query)){
		$profile_id[$i]=$profilerow['profile'];
	}
	$seens = $seens_planet_sts[$i]+1; 
	$seen_query = mysqli_query($db_conx,"UPDATE doctors_status SET seens='$seens' WHERE status_id='$sts_id' LIMIT 1");
	$i++;
}
$length_sts = $i;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/boiddo-band.png" />
	<title>Boiddo</title>
	<meta name="generator" content="Boiddo" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/stylesnewfb.css" rel="stylesheet">
	<style type="text/css">
		.bgimg {
			background-image: url('images/bg.jpg');
		}
	</style>

</head>
<body>

	<div class="container-fluid">
		<div class="box">
			<div class="row row-offcanvas row-offcanvas-left">

				<?php include_once('dr-header.php');?>
				<div class="padding">
					<div class="full col-sm-9">

						<!-- content -->                      
						<div class="row">

							<!-- main col right -->
							<!--Post status-->
							<div class="col-sm-8">
								
								<div class="well"> 
									<div class="bgimg">
										<ul class="list-inline nomarginpadding">
											<li><?php echo $profile_pic;?></li>
											<li><h4><?php echo $fullname;?></h4>
												<i><?php echo $speciality;?></i>
												<p><?php echo $city."-".$postcode;?></p>
												<p><?php echo $country;?></p>
												<div class="visible-lg"><br/><br/><br/><br/><br/></div>
												<div class="visible-lg"><button style="margin-left:200px" class="btn btn-default">Message</button>
													<button class="btn btn-default">Add Doctor</button>
													<button class="btn btn-default">Block</button>
												</div>
												<div class="hidden-lg"><button class="btn btn-default">Message</button>
													<button class="btn btn-default">Add Doctor</button>
													<button class="btn btn-default">Block</button>
												</div>
											</li>
											
										</ul>
										<div>
											<!-- Nav tabs -->
											<ul class="nav nav-tabs" role="tablist">
												<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
												<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
												<li role="presentation"><a href="#doctors" aria-controls="doctors" role="tab" data-toggle="tab">Doctors</a></li>
											</ul>

											<!-- Tab panes -->
											<div class="tab-content">
												<div role="tabpanel" class="tab-pane fade in active" id="home"></div>
												<div role="tabpanel" class="tab-pane fade" id="profile"></div>
												<div role="tabpanel" class="tab-pane fade" id="doctors"></div>
											</div>

										</div>
									</div><!---->
									<br/>
									
									
									<!--View status start-->
									<?php if($length_sts > 50){ $length_sts = 50; }?>

									<?php for($i=0; $i<$length_sts; $i++){?>
									<div class="panel panel-default">
										<div class="panel-heading adjust-ph">
											<ul class="list-inline nomarginpadding">
												<li class="pull-left"><?php echo $status_planet_img[$i]; ?></li>
												<li><?php echo '<h4><a style="color:#002277" href="doctor.php?id='.$profile_id[$i].'">'.$name_planet_sts[$i].'</a></h4>'; ?>
													<?php echo '<i>'.$speciality_planet_sts[$i].'</i>'; ?>
													<div class="hidden-xs"><br/><br/></div>
												</li>

												<?php if($dr_id_planet_sts[$i] == $log_id){ echo 
													'<li class="pull-right"><span class="visual-xs"><br></span>
													<button onclick="deleteStatus(\'delete\',\''.$id_planet_sts[$i].'\')" type="button" class="btn btn-link" data-toggle="popover" title="Popover title" data-trigger="focus" data-content="And here">
														<span class="glyphicon glyphicon-trash"></span>
													</button>
												</li>';}?>
												<a id="deleteConf" class="hidden" href="#postDeleteModal" role="button" data-toggle="modal"></a>
												<?php echo '<li class="pull-right"><span class="visual-xs"><br></span><i>'.$planet_date[$i].'</i><br><i>'.$planet_time[$i].'</i></li>';?>
											</ul>

										</div>
										<div class="panel-body" style="margin-top:0px">

											<?php echo '<p>'.$planet_sts[$i].'</p>';?>
											<div class="clearfix"></div>
										</div>
										<hr style="margin:0px 0px;">
										<div class="panel-head adjust-ph"style="background-color:#EFE">                        
											<ul class="list-inline">
												<?php if($dislike[$i]){ echo '<li><span id="like-'.$i.'" name="'.$id_planet_sts[$i].'" class="glyphicon glyphicon-hand-right btn"> Like '.$likes_planet_sts[$i].'</span></li>';}
												else{echo '<li><span id="like-'.$i.'" name="'.$id_planet_sts[$i].'" class="glyphicon glyphicon-hand-right btn"> Liked '.$likes_planet_sts[$i].'</span></li>';}?>
												<?php echo '<li><span id="cmnt-'.$i.'"  value="'.$comments_planet_sts[$i].'" class="glyphicon glyphicon-comment btn"> Comments '.$comments_planet_sts[$i].'</span></li>';?>
												<?php echo '<li style="float:right;padding-top:10px"><span class="glyphicon glyphicon-user hidden-xs"> '.$seens_planet_sts[$i].' View</span></li>';?>
											</ul>
										</div>
										<hr style="margin:0px 0px;">
										<?php
										$stsid = $id_planet_sts[$i];
										$k=0;
										$cmnt_query = mysqli_query($db_conx,"SELECT * FROM doctors_comments WHERE status_id='$stsid' ORDER BY comments_id DESC");
										while ($row = mysqli_fetch_assoc($cmnt_query)) {
											$cmnt_dr_id = $row['doctor_id'];
											$comments= $row['comments'];
											$cmnt_name= $row['fullname'];
											$cmnt_time= $row['comments_time'];
											$cmnt_date= $row['comments_date'];
											$cmnt_pic= $row['img_name'];
											$cmnt_id_query = mysqli_query($db_conx,"SELECT profile FROM doctors WHERE doctor_id='$cmnt_dr_id' LIMIT 1");
											$cmnt_id_row = mysqli_fetch_assoc($cmnt_id_query);
											$cmnt_profile = $cmnt_id_row['profile'];
											$comments_pic = '<img class="" width="30" height="30" src="user_doc/'.$cmnt_pic.'" alt="'.$cmnt_name.'">';

											$ctime = $row['comments_time'];
											$cdate = $row['comments_date'];

											$newctime = strtotime($ctime);
											$htime = date('H',$newctime);
											$mintime = date('i',$newctime);
											$sectime = date('s',$newctime);
											if(($htime/12) >= 1){
												$aptime = $htime % 12;
												if($aptime == 0){
													$aptime = 12;  
												}
												$printtime = $aptime.":".$mintime." PM";
											}else{
												$aptime = date('H:i',$newctime);
												$printtime = $aptime." AM";
											}
											$c_hr = date('H') - date('H',$newctime);
											$c_min =date('i') - date('i',$newctime);
											$c_sec =date('s') - date('s',$newctime);

											$newcdate = strtotime($cdate);
											$printdate = date('d M Y',$newcdate);
											$c_yr = date('Y')-date('Y',$newcdate);
											$c_mon = date('m')-date('m',$newcdate);
											$c_day = date('d')-date('d',$newcdate);
											if($c_yr == 0){
												if($c_mon == 0){
													if($c_day == 0){
														$c_date = "Today";
														$c_time = timecal($c_hr,$c_min,$c_sec);
													}else if($c_day == 1){
														$c_date = "Yesterday";
														$c_time = $printtime;
													}else{
														$c_date = $c_day.' day';
														$c_time = $printtime;
													}
												}else{
													$c_date = $printdate;
													$c_time = $printtime;
												}
											}else{
												$c_date = $printdate;
												$c_time = $printtime;
											}

											?>
											<div class="clearfix"></div>
											<div class="panel-heading adjust-ph">
												<ul class="list-inline nomarginpadding comment">
													<li class="pull-left"><?php echo $comments_pic; ?></li>
													<li><?php echo '<a style="color:#002277;" href="doctor.php?id='.$cmnt_profile.'"><b style="padding-top:0px">'.$cmnt_name.'</b></a>';?>
														<?php echo '<br><i>'.$c_date.' '.$c_time.'</i>';?></li>
														<li><?php echo '<p>'.$comments.'</p>'; ?></li>


													</ul>
												</div>


												<div class="clearfix"></div>
												<?php } ?>
												<div class="panel-heading adjust-ph">
													<div class="input-group">
														<div class="input-group-btn">
															<?php echo $comment_pic; ?> 
														</div>
														<?php echo '<input  id="status-'.$i.'" name="'.$id_planet_sts[$i].'" style="margin-left:5px" type="text" class="form-control comments" placeholder="Add a comment..">';?>
													</div>

												</div>
											</div>
											<?php } ?>

										</div>
									</div>
									<!-- main col left --> 

									<div class="col-sm-4">

										<div class="panel panel-default">
											<div class="panel-thumbnail"></div>
											<div class="panel-body">
												<p class="lead">Urbanization</p>
												<p>45 Followers, 13 Posts</p>

												<p>

												</p>
											</div>
										</div>










									</div>


								</div><!--/row-->

								<hr>


							</div><!-- /col-9 -->
						</div><!-- /padding -->
					</div>
					<!-- /main -->

				</div>
			</div>
			<!--Post delete modal-->
			<div id="postDeleteModal" class="modal fade" tab-index="1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header" style="background-color:#FFF">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							Do you really want to delete this content?
						</div>
						<div class="modal-body" style="margin:10px 5px">
							<ul class="list-inline">
								<li style="margin-left:80px"><button id="yesDelete" class="btn btn-danger"data-dismiss="modal" aria-hidden="true">Yes</button></li>
								<li style="margin-left:20px"><button id="noDelete" class="btn btn-info" data-dismiss="modal" aria-hidden="true">No</button></li>
							</ul>
						</div>
						
					</div>
				</div>
			</div>


			<!--post modal-->
			<div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							Update Status
						</div>
						<div class="modal-body">
							<form class="form center-block">
								<div class="form-group">
									<textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<div>
								<button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Post</button>
								<ul class="pull-left list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
							</div>	
						</div>
					</div>
				</div>
			</div>
			<!-- script references -->
			<!--script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script-->
			<script src="js/jquery.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="js/scripts.fb.js"></script>
			<script src="js/comments.js"></script>
			<script type="text/javascript">
				/********************************* For profiles header*******************************/
				$("#planetactive").removeClass("glyphicon glyphicon-chevron-right");
				$("#settingsactive").removeClass("glyphicon glyphicon-chevron-right");
				$("#messageactive").removeClass("glyphicon glyphicon-chevron-right");
				$("#doctorsactive").removeClass("glyphicon glyphicon-chevron-right");

				/************************************ Status post ************************************/

				function setcomment(id,e){
					var comments = $("#"+id).val();
					var status_id = $("#"+id).attr('name');
					var types = "comments";
					if(e.keyCode == 13 && comments!=""){

						$.post("dr-status-comments.php",{
							types: types,
							status_id: status_id,
							comments: comments
						},function(data){
							var success = data.indexOf("successfully comment posted...");
							var failed = data.indexOf("failed to post comment...");
							if(success>=0){
								window.location.href = "doctor.php";
							}else if(failed>=0){
								alert(data);
							}
						});
					}
				}

				function setlike(id){
					var like_id = $("#"+id).attr('name');
					var types = "likes";
        //alert("liked");
        $.post("dr-status-comments.php",{
        	types: types,
        	statusid: like_id
        },function(data){
        	$("#"+id).html(data).css('color','blue');
        });
    }

    function viewcomment(id){
    	$("#viewcmnt-"+id).css('display','block');
    	$("#cmnt-"+id).css('color','blue');
    	alert("comment click..."+id);
    }

    function deleteStatus(actions,id){
    	var types = "delete";
    	$("#deleteConf").click();
    	$('#yesDelete').click(function(){
    		$.post("dr-status-comments.php",{status_id: id,types: types},
    			function(data){
    				window.location.href = "doctor.php";
    			});
    	});
    }

    $(document).ready(function(){
    	

    });
</script>
</body>
</html>