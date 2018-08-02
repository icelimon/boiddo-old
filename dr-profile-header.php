<?php 
if($log_category == 'doctor'){
	$profileid = $_GET['id'];
	$sql_profile = "SELECT * FROM doctors WHERE profile='$profileid' LIMIT 1";
	$query_profile = mysqli_query($db_conx, $sql_profile);
	while($rowprofile = mysqli_fetch_assoc($query_profile)){
		$new_id=$rowprofile['doctor_id'];
	}
	$sql_pro = "SELECT hospital_name FROM doctors_professional WHERE doctor_id='$new_id' LIMIT 1";
	$query_pro = mysqli_query($db_conx, $sql_pro);
	while($rowpro = mysqli_fetch_assoc($query_pro)){
		$hos_name=$rowpro['hospital_name'];
	}
	$query_per = mysqli_query($db_conx,"SELECT * FROM doctors_personal WHERE doctor_id='$new_id' LIMIT 1");
	while($row = mysqli_fetch_assoc($query_per)){
		$fullname = $row['full_name'];
	}
	$sql = mysqli_query($db_conx,"SELECT image, img_name FROM doctors_options WHERE doctor_id='$new_id'
		LIMIT 1") or die('Invalid query: ' . mysqli_error());
                  //$query = mysqli_query($db_conx, $sql);
	while($rows=mysqli_fetch_assoc($sql)){
		$image=$rows['image'];
		$img_name=$rows['img_name'];
	}
}

$profile_pic = '<img class="img-rounded img-responsive" src="user_doc/'.$img_name.'" alt="'.$image.'" height="100px" width="100px">';
if($image == NULL){
	$profile_pic = '<img class="img-rounded img-responsive" src="images/default-dr.png" alt="'.$image.'" height="100px" width="100px">';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/boiddo-band.png" />
	<title>boiddo</title>
	<meta name="generator" content="Boiddo" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<link href="css/stylesnewfb.css" rel="stylesheet">
</head>
<body>
	<!-- sidebar -->
	<div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
		<ul class="nav">
			<li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
		</ul>

		<ul class="nav hidden-xs" id="lg-menu">
			<li style="margin-bottom:5px;"><center><?php echo $profile_pic;?></center></li>
			<li><center><?php echo $fullname;?></center></li>
			<li class="active"><a href="dr-planet.php"><i class="glyphicon glyphicon-globe"></i> Planet<i id="planetactive" style="float:right;"></i></a></li>
			<li><a href="#"><i class="glyphicon glyphicon-pencil"></i> Visits<i id="visitsactive" style="float:right;"></i></a></li>
			<li><a href="#"><i class="glyphicon glyphicon-envelope"></i> Messages<i id="messageactive" style="float:right;"></i></a></li>
			<li><a href="#"><i class="glyphicon glyphicon-tent"></i> Doctors<i id="doctorsactive" style="float:right;"></i></a></li>
			<li><a href="#"><i class="glyphicon glyphicon-refresh"></i> Refresh</a></li>
			<li><a href="edit-profile-dr.php"><i class="glyphicon glyphicon-cog"></i> Settings</a></li>
			<ul id="sub-items" class="sublist">
				<li><a href="#" id="click-per" style="text-decoration:none;">Personal Details</a><i id="settingsactive" style="float:right;"></i></li>
				<li><a href="#" id="click-pro" style="text-decoration:none;">Professional Details</a><i id="settingsproactive" style="float:right;"></i></li>
				<li><a href="#" id="click-set" style="text-decoration:none;">Account Setting</a><i id="settingssetactive" style="float:right;"></i></li>
			</ul>
		</ul>
		<ul class="list-unstyled hidden-xs" id="sidebar-footer">
			<li style="margin-bottom:-20px">
				<a href="http://www.boiddo.com/terms.php#contact"><h3>Contuct us</h3></a>
			</li>
			<li>info@boiddo.com</li>
			<li><span style="font-size:11px;">&copyCopyright boiddo corporation 2015</span></li>
		</ul>
		
		<!-- tiny only nav-->
		<ul class="nav visible-xs" id="xs-menu">
			<li><a href="#featured" class="text-center"><i class="glyphicon glyphicon-globe"></i></a></li>
			<li><a href="#stories" class="text-center"><i class="glyphicon glyphicon-list"></i></a></li>
			<li><a href="#" class="text-center"><i class="glyphicon glyphicon-envelope"></i></a></li>
			<li><a href="#" class="text-center"><i class="glyphicon glyphicon-paperclip"></i></a></li>
			<li><a href="#" class="text-center"><i class="glyphicon glyphicon-refresh"></i></a></li>
			<li><a href="http://www.boiddo.com/terms.php#contact" class="text-center"><i class="glyphicon glyphicon-phone"></i></a></li>
		</ul>

	</div>
	<!-- /sidebar -->
	
	<!-- main right col -->
	<div class="column col-sm-10 col-xs-11" id="main">
		
		<!-- top nav -->
		<div class="navbar navbar-blue navbar-static-top">  
			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<img href="http://boiddo.com" class="logo" src="images/boiddo-nav.png">
			</div>
			
			<nav class="collapse navbar-collapse" role="navigation">
				<form class="navbar-form navbar-left">
					<div class="input-group input-group-sm" style="max-width:360px;">
						<input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
				</form>
				<ul class="nav navbar-nav">
					<li>
						<a href="dr-planet.php"><i class="glyphicon glyphicon-globe"></i> Planet</a>
					</li>
					<li>
						<a href="profile.php"><i class="glyphicon glyphicon-user"></i> Profile</a>
					</li>
					<li>
						<a href="#postModal" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Visit</a>
					</li>
					<li>
						<a href="logout.php"><i class="glyphicon glyphicon-off"></i> Log out</a>
					</li>
					
				</ul>
				<ul class="nav navbar-nav navbar-right">
					
				</ul>
			</nav>
		</div>
		<!-- /top nav -->


	</body>
	</html>