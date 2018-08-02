<?php 
include_once("check-login-status.php");
if($user_ok != true || $log_category != 'doctor'){
	header("Location: index.php");
	exit;
}
$i = 0;
$today = 0;
$yesterday = 0;
$visit_query = mysqli_query($db_conx,"SELECT * FROM doctors_visit WHERE doctor_id='$log_id' ORDER BY request_id DESC");
$seen_query = mysqli_query($db_conx,"UPDATE doctors_visit SET seen='1' WHERE doctor_id='$log_id' ORDER BY request_id DESC");
while($visit_row = mysqli_fetch_assoc($visit_query)){
	$request_id[$i] = $visit_row['request_id'];
	$chamber_id[$i] = $visit_row['chamber_id'];
	$type[$i] = $visit_row['type'];
	$requestor[$i] = $visit_row['requestor'];
	$rq_relation[$i] = $visit_row['rq_relation'];
	$rq_age[$i] = $visit_row['rq_age'];
	$rq_sex[$i] = $visit_row['rq_sex'];
	$rq_houseno[$i] = $visit_row['rq_houseno'];
	$rq_housename[$i] = $visit_row['rq_housename'];
	$rq_town[$i] = $visit_row['rq_town'];
	$rq_city[$i] = $visit_row['rq_city'];
	$rq_postcode[$i] = $visit_row['rq_postcode'];
	$rq_country[$i] = $visit_row['rq_country'];
	$patient[$i] = $visit_row['patient'];
	$sex[$i] = $visit_row['sex'];
	$age[$i] = $visit_row['age'];
	$suffering[$i] = $visit_row['suffering'];
	$duration[$i] = $visit_row['duration'];
	$blood_group[$i] = $visit_row['blood_group'];
	$weight[$i] = $visit_row['weight'];
	$height[$i] = $visit_row['height'];
	$date[$i] = $visit_row['date'];
	$expt_date[$i] = $visit_row['expt_date'];
	$tz[$i] = $visit_row['tz'];
	$fees[$i] = $visit_row['fees'];
	$currency[$i] = $visit_row['currency'];
	$seen[$i] = $visit_row['seen'];
	$approve[$i] = $visit_row['approve'];
	$approve_date[$i] = $visit_row['approve_date'];

	$expt_date_stat = $expt_date[$i];
	$expt_date_stat = strtotime($expt_date_stat);
	$expt_date[$i] = date("d M Y",$expt_date_stat);
	$expt_day[$i] = date("l",$expt_date_stat);

	$approve_date_stat = $approve_date[$i];
	$approve_date_stat = strtotime($approve_date_stat);
	$approve_date[$i] = date("d M Y",$approve_date_stat);
	$approve_day[$i] = date("l",$approve_date_stat);

	$ch_id=$chamber_id[$i];

	if($type[$i] == 'chamber'){
		$cham_query = mysqli_query($db_conx,"SELECT * FROM doctors_chambers WHERE chamber_id='$ch_id' AND doctor_id='$log_id' LIMIT 1");
		while($cham_row = mysqli_fetch_assoc($cham_query)){
			$chamber_ids[$i] = $cham_row['chamber_id'];
			$chamber_name[$i] = $cham_row['chamber_name'];
			$ch_town[$i] = $cham_row['town'];
			$ch_postcode[$i] = $cham_row['postcode'];
			$ch_city[$i] = $cham_row['city'];
			$ch_country[$i] = $cham_row['country'];

			$names = $chamber_name[$i];
			$strpos_h = strpos($names, "Hospital");
			$strpos_d = strpos($names, "Diagnostic");
			$strpos_p = strpos($names, "Pharmecy");
			$strpos_pa = strpos($names, "Pharma");
			$strpos_m = strpos($names, "Medical");
			if($strpos_h > 0){
				$cham_pics[$i] = 'H';
			}else if($strpos_d > 0){
				$cham_pics[$i] = 'D';
			}else if($strpos_p > 0 || $strpos_pa > 0){
				$cham_pics[$i] = 'P';
			}else if($strpos_m > 0){
				$cham_pics[$i] = 'M';
			}else{
				$cham_pics[$i] = 'C';
			}
		}
	}//type chamber end
	if($type[$i] == 'dochos'){
		$dochos_query = mysqli_query($db_conx,"SELECT * FROM doctors_professional WHERE doctor_id='$log_id' LIMIT 1");
		while($dochos_row = mysqli_fetch_assoc($dochos_query)){
			$chamber_name[$i] = $dochos_row['hospital_name'];
			$ch_town[$i] = $dochos_row['town'];
			$ch_postcode[$i] = $dochos_row['postcode'];
			$ch_city[$i] = $dochos_row['city'];
			$ch_country[$i] = $dochos_row['country'];

			$cham_pics[$i] = '<img class="img-rounded" src="images/hos-default.png" alt="hospital" height="100px" width="90px">';
		}
	}
	$check_date = $date[$i];
	if(date("Y-m-d")== $check_date){
		$today += 1;
	}
	//$yes_date = date("yesterday");
	$new_check_date = strtotime($check_date);
	$prev_day[$i] = date("d M Y",$new_check_date);
	$yes_date = strtotime("Yesterday");
	$yes_date = date("Y-m-d",$yes_date);
	if($yes_date == $check_date){
		$yesterday += 1;
	}
	
	$rq_id = $request_id[$i];
	$testdate = $yes_date;
	$testdateone = $check_date;
	$i++;
}
$total = $i;

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="images/boiddo-band.png" />
	<title>Boiddo | Patient Request</title>
	<meta name="description" content="Online doctor and hospitals whats you need while trubling. Find your nearest hospital, get information about doctors and hospitals. Get serial of them... and many more option what you need.">
	<meta name="keywords" content="online doctor, boiddo, healthcare, online hospitals, medical information">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

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
							<div class="col-sm-8">
								<center><h3><i>Requests</i></h3></center>
								<div class="well">
									<?php if($today){echo '<center><h4>Today</h4></center><br>'; }?>
									<?php for($i=0; $i<$today; $i++){
										if($approve[$i] == 0){
											echo '<button onclick="deleteRequest(\''.$request_id[$i].'\')" type="button" href="#requestDeleteModal" role="button" data-toggle="modal" class="close" style="padding:2px"><span class="glyphicon glyphicon-remove"></span></button>';
										}
										if($seen[$i]){
											echo '<div class="panel panel-default">';
										}else{
											echo '<div class="panel panel-info">';
										} ?>

										<div class="panel-heading">
											<div class="row">
												<div class="col-sm-2">
													<?php if($type[$i] == "chamber"){?>
													<br>
													<span class="logo"><?php echo $cham_pics[$i]; ?></span>
													<?php }else{
														echo $cham_pics[$i];
													} ?>
												</div>
												<div class="col-sm-3">
													<?php echo '<p><strong>'.$chamber_name[$i].'</strong></p>';?>
													<?php echo '<p>'.$ch_town[$i].'-'.$ch_postcode[$i].'</p>';?>
													<?php echo '<p>'.$ch_city[$i].'-'.$ch_country[$i].'</p>';?>
												</div>
												<div class="col-sm-3">
													
													<p><i>Patient</i></p>
													<?php echo '<p>'.$patient[$i].'</p>';?>
													<?php echo '<p>Suffering '.$suffering[$i].' '.$duration[$i].'s</p>';?>
												</div>
												<div class="col-sm-2">
													
													<p><i>Expected</i></p>
													<?php echo '<p>'.$expt_date[$i].'</p>';?>
													<?php echo '<p>'.$expt_day[$i].'</p>';?>
													<?php echo '<button onclick="approvemodalView(\''.$request_id[$i].'\',\''.$chamber_ids[$i].'\')" href="#approveModal" class="btn btn-sm btn-info visible-sm approve" data-toggle="modal">Approve Now</button>';?>
												</div>
												<div class="col-sm-2">
													
													
													<?php if($approve[$i]==0){ echo '<button onclick="approvemodalView(\''.$request_id[$i].'\',\''.$chamber_ids[$i].'\')" href="#approveModal" class="btn btn-sm btn-info hidden-sm approve" data-toggle="modal">Approve Now</button>';}
													else{ echo "<p><i>Approved</i></p>
														<p>".$approve_date[$i]."</p>
													<p>".$approve_day[$i]."</p>";
													echo '<button onclick="modalView(\''.$request_id[$i].'\',\''.$chamber_ids[$i].'\')" href="#viewModal" class="btn btn-sm btn-link approve" data-toggle="modal">View Details</button>';
												}
												?>
											</div>
										</div>
									</div>
								</div>

								<?php } ?>
								<?php if($today){
									echo '<hr class="std-margin">';
								}?>

								<?php if($yesterday){echo '<center><h4>Yesterday</h4></center><br>'; }?>
								<?php for($i=$today; $i<$today+$yesterday; $i++){
									if($approve[$i] == 0){ 
										echo '<button type="button" class="close" style="padding:2px"><span class="glyphicon glyphicon-remove"></span></button>';
									}
									if($seen[$i]){
										echo '<div class="panel panel-default">';}else{
											echo '<div class="panel panel-info">';
										} ?>
										<div class="panel-heading">
											<div class="row">
												<div class="col-sm-2">
													<?php if($type[$i] == "chamber"){?>
													<br>
													<span class="logo"><?php echo $cham_pics[$i]; ?></span>
													<?php }else{
														echo $cham_pics[$i];
													} ?>
												</div>
												<div class="col-sm-3">
													<?php echo '<p><strong>'.$chamber_name[$i].'</strong></p>';?>
													<?php echo '<p>'.$ch_town[$i].'-'.$ch_postcode[$i].'</p>';?>
													<?php echo '<p>'.$ch_city[$i].'-'.$ch_country[$i].'</p>';?>
												</div>
												<div class="col-sm-3">
													
													<p><i>Patient</i></p>
													<?php echo '<p>'.$patient[$i].'</p>';?>
													<?php echo '<p>Suffering '.$suffering[$i].' '.$duration[$i].'s</p>';?>
												</div>
												<div class="col-sm-2">
													
													<p><i>Expected</i></p>
													<?php echo '<p>'.$expt_date[$i].'</p>';?>
													<?php echo '<p>'.$expt_day[$i].'</p>';?>
													<?php echo '<button onclick="approvemodalView(\''.$request_id[$i].'\',\''.$chamber_ids[$i].'\')" href="#approveModal" class="btn btn-sm btn-info visible-sm approve" data-toggle="modal">Approve Now</button>';?>
												</div>
												<div class="col-sm-2">
													
													
													<?php if($approve[$i]==0){ echo '<button onclick="approvemodalView(\''.$request_id[$i].'\',\''.$chamber_ids[$i].'\')" href="#approveModal" class="btn btn-sm btn-info hidden-sm approve" data-toggle="modal">Approve Now</button>';}
													else{ echo "<p><i>Approved</i></p>
														<p>".$approve_date[$i]."</p>
													<p>".$approve_day[$i]."</p>";
													echo '<button onclick="modalView(\''.$request_id[$i].'\',\''.$chamber_ids[$i].'\')" href="#viewModal" class="btn btn-sm btn-link approve" data-toggle="modal">View Details</button>';
												}
												?>
											</div>
										</div>
									</div>
								</div>

								<?php } ?>
								<?php if($yesterday){
									echo '<hr class="std-margin">';
								}?>

								<?php for($i=$today+$yesterday; $i<$total; $i++){ ?>
								<?php
								if(($i>0 && $prev_day[$i] != $prev_day[$i-1]) || $i == 0){
									echo '<center><h4>'.$prev_day[$i].'</h4></center><br>';

								}
								if($approve[$i] == 0){
									echo '<button type="button" class="close" style="padding:2px"><span class="glyphicon glyphicon-remove"></span></button>';
								}
								if($seen[$i]){
									echo '<div class="panel panel-default">';}else{
										echo '<div class="panel panel-info">';
									} ?>
									<div class="panel-heading">
										<div class="row">
											<div class="col-sm-2">
												<?php if($type[$i] == "chamber"){?>
												<br>
												<span class="logo"><?php echo $cham_pics[$i]; ?></span>
												<?php }else{
													echo $cham_pics[$i];
												} ?>
											</div>
											<div class="col-sm-3">
												<?php echo '<p><strong>'.$chamber_name[$i].'</strong></p>';?>
												<?php echo '<p>'.$ch_town[$i].'-'.$ch_postcode[$i].'</p>';?>
												<?php echo '<p>'.$ch_city[$i].'-'.$ch_country[$i].'</p>';?>
											</div>
											<div class="col-sm-3">

												<p><i>Patient</i></p>
												<?php echo '<p>'.$patient[$i].'</p>';?>
												<?php echo '<p>Suffering '.$suffering[$i].' '.$duration[$i].'s</p>';?>
											</div>
											<div class="col-sm-2">

												<p><i>Expected</i></p>
												<?php echo '<p>'.$expt_date[$i].'</p>';?>
												<?php echo '<p>'.$expt_day[$i].'</p>';?>
												<?php echo '<button onclick="approvemodalView(\''.$request_id[$i].'\',\''.$chamber_ids[$i].'\')" href="#approveModal" class="btn btn-sm btn-info visible-sm approve" data-toggle="modal">Approve Now</button>';?>
											</div>
											<div class="col-sm-2">
												<?php if($approve[$i]==0){ echo '<br><button onclick="approvemodalView(\''.$request_id[$i].'\',\''.$chamber_ids[$i].'\')" href="#approveModal" class="btn btn-sm btn-info hidden-sm approve" data-toggle="modal">Approve Now</button>';}
												else{ echo "<p><i>Approved</i></p>
													<p>".$approve_date[$i]."</p>
												<p>".$approve_day[$i]."</p>";
												echo '<button onclick="modalView(\''.$request_id[$i].'\',\''.$chamber_ids[$i].'\')" href="#viewModal" class="btn btn-sm btn-link approve" data-toggle="modal">View Details</button>';
											}?>
										</div>
									</div>
								</div>
							</div>
							<?php if($i<$total-1 && $prev_day[$i] != $prev_day[$i+1])
							echo '<hr class="std-margin">'; ?>
							<?php } ?>

							<?php ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
<!--hosmodal-->

<div id="approveModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="padding">
				<div style="text-align:center;background-color:#5BC0DE;" class="modal-header">
					<span style="font-size: 18px;" id="chamber-name"></span>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
					<p style="font-style:italic;"><span id="chamber-add"></span></p><br>
				</div>
				<div class="modal-body">
					<form class="form center-block">
						<div class="form-group">
							<div class="row">
								<br>
								<div class ="col-xs-1 col-sm-1"></div>
								<div class="col-xs-11 col-sm-5">
									<center><p>Patient</p></center>
									<br>
									<h4 id="patient-name"></h4>
									<i><span id="setsex"></span></i><br>
									<span id="age"></span> Years Old.<br>
									<p>Blood Group : <span id="blood-group"></span></p>
									<p>Occupation : <span id="occupation"></span></p>
									<p>Weight : <span id="weight"></span></p>
									<p>Height : <span id="height"></span></p>
								</div>
								<div class="col-xs-offset-1 col-xs-10 col-sm-5">
									<p>Expected Date : <i><b><span id="expt-date"></span></b></i></p><br>
									<center><span><b>Approve Date</b></span></center>
									<div class="row">
										<div class="col-xs-6">
											<select id="approve-date" class="form-control">
												<option value="0">Date</option>
												<?php for($i=1;$i<32;$i++){
													if($i<10){
														$k = "0".$i;
													}else{
														$k=$i;
													}
													echo '<option value="'.$k.'">'.$i.'</option>';
												}	?>
											</select>
										</div>
										<div class="col-xs-6">
											<select id="approve-month" class="form-control">
												<option value="00">Month</option>
												<option value="01">January</option>
												<option value="02">February</option>
												<option value="03">March</option>
												<option value="04">April</option>
												<option value="05">May</option>
												<option value="06">June</option>
												<option value="07">July</option>
												<option value="08">August</option>
												<option value="09">September</option>
												<option value="10">October</option>
												<option value="11">November</option>
												<option value="12">December</option>
											</select>
										</div>
									</div>
									<br><center><p><b>Time</b></p></center>
									<div class="row">
										<div class="col-xs-4">
											<input type="text" id="hour" class="form-control">
										</div>
										<div class="col-xs-4">
											<input type="text" id="minute" class="form-control">
										</div>
										<div class="col-xs-4">
											<select id="ampm" class="form-control">
												<option value="AM">AM</option>
												<option value="PM">PM</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-1 col-sm-1"></div>
								<br>
							</div>
						</div>
					</form>
				</div>
			</div>


			<div  style="background-color:#5BC0DE;padding-bottom:15px;" class="modal-footer">

				<button id="saveBtn" class="pull-right btn btn-primary" data-dismiss="modal">Save</button>
			</div>
		</div>
	</div>
</div>

<!--Hospital Modal End Here-->

<div id="viewModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="padding">
				<div style="text-align:center;background-color:#5BC0DE;" class="modal-header">
					<span style="font-size: 18px;" id="view-ch-name"></span>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
					<p style="font-style:italic;"><span id="view-add"></span></p><br>
				</div>
				<div class="modal-body">
					<form class="form center-block">
						<div class="form-group">
							<div class="row">
								<br>
								<div class ="col-xs-1 col-sm-1"></div>
								<div class="col-xs-11 col-sm-5">
									<h4 id="view-name"></h4>
									<i><span id="viewsex"></span></i><br>
									<span id="viewage"></span> Years Old.<br>
									<p>Blood Group : <span id="viewblood-group"></span></p>
									<p>Occupation : <span id="viewoccupation"></span></p>
									<p>Weight : <span id="viewweight"></span></p>
									<p>Height : <span id="viewheight"></span></p>
								</div>
								<div class="col-xs-offset-1 col-xs-10 col-sm-5">
									<p>Expected Date : <i><b><span id="viewexpt-date"></span></b></i></p>
									<p>Approve Date : <i><b><span id="viewapprove-date"></span></b></i></p>
									<p>Time : <i><b><span id="view-time"></span></b></i></p>
									
								</div>
								<div class="col-xs-1 col-sm-1"></div>
								<br>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div  style="background-color:#5BC0DE;padding-bottom:15px;" class="modal-footer"></div>
		</div>
	</div>
</div>
<!--Post delete modal-->
<div id="requestDeleteModal" class="modal fade" tab-index="1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="margin:30px 5px">
				<ul class="list-inline">
					<li style="margin-left:20px"><h4>Do you really want to remove this request?</h4></li>
					<li style="margin-left:20px"><button id="yesDelete" class="btn btn-danger"data-dismiss="modal" aria-hidden="true">Yes</button></li>
					<li style="margin-left:20px"><button id="noDelete" class="btn btn-info" data-dismiss="modal" aria-hidden="true">No</button></li>
				</ul>
			</div>

		</div>
	</div>
</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">

	function approvemodalView(id, chamberIds){
		var request_id = id;
		var chamber_id = chamberIds;
	$.post("modals.php",{request_id: request_id, chamber_id: chamber_id, category: "approvedate"},function(data){
		var modalData = $.parseJSON(data);

		// $.each(modalData, function(index, item) {
		// });

$("#chamber-name").html(modalData.chamber_name);
$("#chamber-add").html(modalData.chamber_city+"&nbsp-&nbsp"+modalData.chamber_country);
		//alert(modalData.sex);
		$("#patient-name").html(modalData.patient);
		$("#setsex").html(modalData.sex);
		$("#age").html(modalData.age);
		$("#blood-group").html(modalData.blood_group);
		$("#occupation").html(modalData.occupation);
		$("#weight").html(modalData.weight+" Kg");
		$("#height").html(modalData.height+" cm");
		$("#expt-date").html(modalData.expt_date);
		

		$("#saveBtn").click(function(){
			var approveDate = $("#approve-date option:selected").val();
			var approveMonth = $("#approve-month option:selected").val();
			var hour = $("#hour").val();
			var minute = $("#minute").val();
			var ampm = $("#ampm option:selected").val();
			$.post("modals.php",{request_id: request_id, chamber_id: chamber_id, date: approveDate, month: approveMonth, hour: hour, minute: minute, ampm: ampm, category: "setapprovedate"},function(newdata){
				if(newdata != 'successfully updated.'){
					alert("approve failed..");
				}
			});
		});
		
	});
}

function modalView(id, chamberIds){
	var request_id = id;
	var chamber_id = chamberIds;
	//alert(request_id);
	$.post("modals.php",{request_id: request_id, chamber_id: chamber_id, category: "viewapprovedate"},function(data){
		//alert(data);
		var modalData = $.parseJSON(data);
		$("#view-ch-name").html(modalData.chamber_name);
		$("#view-add").html(modalData.chamber_city+"&nbsp-&nbsp"+modalData.chamber_country);
		//alert(modalData.sex);
		$("#view-name").html(modalData.patient);
		$("#viewsex").html(modalData.sex);
		$("#viewage").html(modalData.age);
		$("#viewblood-group").html(modalData.blood_group);
		$("#viewoccupation").html(modalData.occupation);
		$("#viewweight").html(modalData.weight+" Kg");
		$("#viewheight").html(modalData.height+" cm");
		$("#viewexpt-date").html(modalData.expt_date);
		$("#viewapprove-date").html(modalData.approve_date);
		$("#view-time").html(modalData.approve_time);
		
	});
}

function deleteRequest(id){
	var category = "deleteRequest";
	$('#yesDelete').click(function(){
		$.post("modals.php",{request_id: id,category: category},
			function(data){
				if(data == "successfully deleted."){
					window.location.href = "requests.php";
				}else{
					alert("Operation failed!");
				}
				
			});
	});
}

</script>
</body>
</html>
