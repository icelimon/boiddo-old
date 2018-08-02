
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="images/boiddo-band.png" />
	<title>Boiddo | About</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Online doctor and hospitals whats you need while trubling">
	<meta name="keywords" content="online doctor, boiddo, healthcare, online hospitals, medical information">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/temp.css">
</head>

<body>
	<!--1st Container Start here -->
	<?php include_once('index-header.php');?>
	<div class="container">

		<!--Navbar Start here-->
		<div class="navbar navbar-inverse" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<span >
					<img class="logo" style="float:left;" src="images/boiddo-nav.png">
				</span>

			</div> 

			<div class="collapse navbar-collapse" id="navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="about.php">About</a></li>
					<li><a href="index.php#reg">Registration</a></li>
					<li><a href="about.php#contact">Contact us</a></li>
				</ul> 

			</div>
		</div>
		<!--Navbar End here-->

	</div>

	<div class="container" style="margin-top: -21px;">
		<div class="row">
			<img class="img-responsive" style="margin:0px;padding:0 5px 0 5px" width="auto" src="images/boiddo-baner.jpg">
		</div>
	</div>

	<div class="container" style="margin-top:10px;">

		<!--/div-->
		<!--1st Container End -->

		<!--2nd Container Start here-->
		<!--div class="container-fluid" style="margin-left: 14px; margin-right: 14px"-->




		<!--Main Content Start here-->
		<div class="row">

			<!--Left Column Start here-->
			<div class="col-xs-12 col-sm-12 col-md-7">

				<!--About doctors Start here-->
				<div class="panel panel-default">
					<h3 style="text-align: center; padding: 10px" class="bg-blue">Boiddo</h3>
					<div class="panel-body">
						<div>
							<h4>Boiddo.com is an online medical information and supporting site. It is usually painful to find out a particular specialized medical doctor or special service of a hospital to a person who is not familiar with medical services or unfamiliar about his/her locality. Boiddo.com will try to find out the solution of this problem.</h4>
							<h5>A fact is that, everyday thousands of people faces these types of problem. Also true that, a company or an organization will not be able to provide update information about doctors or/and hospital services until they connect with a global station. So boiddo.com is going to be this global station which is not help only to find doctors or hospitals to people but it has more several options such as, request for serial, visit time, visit place, fee etc. in the doctor category and available services, available patient capacity etc. in the hospital category.</h5>
							<p>In this website, it has two different category for registration. Frist category is doctor and second category is hospital. The registration option is only for the particular professional peoples. An android app “Boiddo” is another part of this project. Using this app, patient could search a particular doctor or hospital, they could follow them, they could make request for a serial etc.</p>
							<h4>By using boiddo.com</h4> <p>patient, medical doctors and hospital authorities could be beneficiaries in many ways. Patient could compare services between different hospitals, they could find their nearest hospital and/or doctor. They could be easily informed, when and where a particular specialized doctor will visits. Finally, I may conclude that, this project will help to reduce harassment patient and his/her family simultaneously hospitals and doctors could improve their service and could make their publicity more easily. 
						</p>
					</div>
				</div>    
			</div>
			<!--About doctors end here-->

			<!--About Hospitals Start here-->
			
			<!--About Hospitals end here-->


		</div>
		<!--Left Column End here-->

		<!--Right column Start here-->
		<!--Right column Start here-->
		<div class="col-xs-12 col-sm-12 col-md-5">
			<div id="contact" class="panel panel-danger  bgc">
				<h3 style="padding: 10px" class="center"><strong>Contact us</strong></h3>
				<div class="col-xs-12 col-sm-12 col-md-12" >
				</div>
				<div class="well">
					<div id="contactform" class="form-horizontal">

						<div class="form-group">
							<label for="contactname" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="contactname" placeholder="Name">
							</div>
						</div>
						<div class="form-group">
							<label for="contactemail" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="contactemail" placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<label for="contactsubject" class="col-sm-2 control-label">Subject</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="contactsubject" placeholder="Subject">
							</div>
						</div>
						<div class="form-group">
							<label for="contactmessage" class="col-sm-2 control-label">Message</label>
							<div class="col-sm-10 text-area">
								<textarea class="form-control" id="contactmessage" rows="6"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-2">
								<button class="btn btn-primary" id="contactsubmit">Submit</button>
							</div>
							<div class="col-sm-8">
								<span id="pleasewait"></span>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!--Right column End here-->
		<!--Right Column End here-->

		<!--Other services Start here-->
		<!--Other services End here-->
	</div>
	<!--Main Content/row End here-->
</div>
<!--2nd Container End here-->
</div>
<!--Modal Satrt here-->
<div class="container">
	<!-- Trigger the modal with a button -->
	<button class="visible-xs hidden-xs" id="modalsub" type="button" data-toggle="modal" data-target="#myModal"></button>

	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog" data-toggle="modal">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Thank you <span id='modal-names'></span></h4>
				</div>
				<div class="modal-body">
					<p>Your message has been send successfully.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div><!--Modal End here-->

</div>



<!--Start if the Footer-->
<?php include_once("boiddo-footer.php"); ?>

<!--End if the Footer-->

<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">

	function validateText(id)
	{
		if($("#"+id).val()==null || $("#"+id).val()=="")
		{
			var div = $("#"+id).closest("div");
			div.addClass("has-error");
			return false;
		}
		else
		{
			var div = $("#"+id).closest("div");
			div.removeClass("has-error");
			return true;
		}
	}

	$(document).ready(function(){

		$("#contactsubmit").click(function(){

			if(!validateText("contactname")){
				return false;
			}
			if(!validateText("contactemail")){
				return false;
			}
			if(!validateText("contactsubject")){
				return false;
			}
			if(!validateText("contactmessage")){
				return false;
			}
        //alert("Successfully submitted.!!");
        var submit='submit';
        var name = $("#contactname").val();
        var email = $("#contactemail").val();
        var sub = $("#contactsubject").val();
        var msg = $("#contactmessage").val();
        $("#pleasewait").html('Please wait, message sending...').css('color','blue');
        $.post("send-message.php",{
        	name: name,
        	email: email,
        	sub: sub,
        	msg: msg,
        	submit: submit
        },function(data){
            //alert(data);
            
            if(data == 'Message sent...'){
            	$("#modal-names").html(name);
            	$("#modalsub").click();
            	$("#pleasewait").html('Message sent');
            }else if(data == 'Message sending failed...'){
            	$("#modal-names").html(data);
            	$("#pleasewait").html('Message sending failed').css('color','red');
            }
        });

    });

});
</script>
</body>
</html>