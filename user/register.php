<?php
session_start();

if(isset($_SESSION['user'])){
	header("Location: ./");
}

?>

<!DOCTYPE html>

<html>

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

		#main-container .btn{
			background-color: #333399;
			color: #fff;
		}

	</style>

</head>

<body>

<?php require_once('./navbar.php'); ?>

<div class="container" id="main-container">
	<div class="row">

		<div class="col-lg-1 col-md-1"></div>

		<div class="col-lg-10 col-md-10 col-sm-12">

			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 1.2em;">
					Register
				</div>
			</div>

			<div class="row" id="register-reply">
				<br/>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: red; font-style: italic;">
					<!-- Message displayed here -->
				</div>
			</div>

			<div class="row" style="margin-top: 20px;">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<form role="form" id="user-register-form" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
						<!-- <div class="col-lg-12 col-md-12 col-sm-12">
							<div class="form-group col-lg-5">
								<label for="name">Full name* <br/> <span style="font-size: 8pt;">(or company name)</span></label>
								<input type="text" id="name" name="name" class="form-control" required>
							</div>
						</div> -->

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
								<label for="full-name">Full Name *</label>
								<input type="text" id="full-name" name="full-name" class="form-control" required>
							</div>

						</div>
							
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
								<label for="company-name">Company Name</label>
								<input type="text" id="company-name" name="company-name" class="form-control">
							</div>
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
								<label for="contact-number">Contact Number * <span style="font-size: 9pt;">(mobile or office contact with std code)</span></label>
								<input type="text" id="contact-number" name="contact-number" class="form-control" required>
							</div>

						</div>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
								<label for="register-email">Email ID *</label>
								<input type="email" id="register-email" name="register-email" class="form-control" required>
							</div>
						
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<button type="submit" id="submit-register-btn" class="btn btn-default">Submit</button>
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>
</div>


<!-- Loader -->
<div class="row" id="loader-div" style="display: none;">
	<div class="col-sm-12">
		<center>
			<object type="image/svg+xml" data="../images/loading_gears.svg">Your browser does not support svg</object>
		</center>
	</div>
</div>
<!-- Loader ends -->



<?php include_once('./footer.php'); ?>



<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="./js/common_js.js" type="text/javascript"></script>


<script type="text/javascript">

	registerNewUser();

</script>