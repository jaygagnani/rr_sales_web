<!DOCTYPE html>

<html lang="en">

<head>

<!-- meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<!-- favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />

<!-- Bootstrap CDN CSS -->
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

<!-- FontAwesome CDN CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<!-- Link custom stylesheets -->
	<link href="./css/common_styles.css" rel="stylesheet" type="text/css" hreflang="en">


	<style type="text/css">

	</style>
	
</head>

<body>

<div class="wrapper" style="height: 100%;">
	
	<?php require_once('./navbar.php'); ?>

	<div class="container" id="main-div">
		<div class="row">
		
			<div class="col-lg-1"></div>
			<div class="col-lg-10">
				
				<div class="row">
					<div id="title" class="col-lg-12 col-md-12" style="border-bottom: 1px solid #000; font-size: 1.2em; line-height: 25px;">
						<!-- Breadcrumb -->

							<ul class="breadcrumb" style="text-transform: none;">
								<li><a href="./">Home</a></li>
								<li><a href="#">Contact</a></li>
							</ul>

						<br/>
					</div>
				</div>

				<div class="row" style="margin-top: 20px;">

					<div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
						<h3> <b> CONTACT US </b> </h3>
						
						<br/>
						
						<b>Mr. Narendra Gagnani</b> <br/>
						9426-312-603
						
						<br/>
						<br/>

						<b>Mr. Mukesh Gagnani</b> <br/>
						9427-344-430

						<br/>
						<br/>

						<b>Office:</b>
						0265-2562-391
						
						<br/>
						<br/>
						
						<b>Office Affress: </b>
						R.R. Sales Corporation <br/>
						1st. Floor, Ajanta Appt. <br/>
						R.T.O Road, Warashia <br/>
						Vadodara <br/>
						Gujarat <br/>

					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">

						<h3> <b> OR MESSAGE US HERE <br/> <span style="font-size: 8pt;"> and we will get back to you shortly </span> </b> </h3>

						<div id="msg-error" style="color: red; font-style: italic;"> <!-- any error message would be here --> </div>

						<br/>

						<form role="form" id="contact-form">
							<div class="form-group">
								<input type="text" class="form-control" id="msg-name" placeholder="Name" required>
							</div>
							<div class="form-group">
								<input type="email" class="form-control" id="msg-email" placeholder="Email" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="msg-contact" placeholder="Phone number" required>
							</div>
							<div class="form-group">
								<textarea type="text" class="form-control" id="msg-msg" placeholder="Your inquiry or message" rows=10 required></textarea>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-default" value="Send" style="background-color: #333399; color: #fff; width: 150px;">
							</div>
						</form>

					</div>
					
				</div>

			</div>
			<div class="col-lg-1"></div>

		</div>
	</div>

	<?php //include_once('./footer.php'); ?>

</div>

<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="./js/common_js.js" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function(){

	$("#contact-form").on("submit", function(event){
		event.preventDefault();
		sendQueryMail();
	});

});

</script>

</body>

</html>