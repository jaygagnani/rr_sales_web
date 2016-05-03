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

		html, body{
			text-transform: none;
		}

		.profile-display .table,
		.profile-display .table tbody tr td,
		.profile-display .table thead tr th{
			border: 0;
		}

		.profile-display .table tbody tr td,
		.profile-display .table thead tr th,
		.profile-display .panel-collapse .table tbody tr td,
		.profile-display .panel-collapse .table thead tr th{
			width: 25%;
			text-align: left;
		}

		.profile-display .table tbody tr td:first-child,
		.profile-display .table thead tr th:first-child,
		.profile-display .table tbody tr td:last-child,
		.profile-display .table thead tr th:last-child{
			width: 10%;
		}

		.profile-display .table tbody tr td:nth-child(3),
		.profile-display .table thead tr th:nth-child(3){
			width: 45%;
		}

		#order-accordion .table{
			margin-bottom: 0px !important;
		}


	</style>

</head>

<body>

<?php require_once('./navbar.php'); ?>


<div class="container">
	<div class="row">

		<div class="col-lg-1 col-md-1 col-sm-1"></div>

		<div class="profile-display col-lg-10 col-md-10 col-sm-10">
			
			<div class="row">
				<h3> <b> <span id="user-name"></span>&apos;s </b> profile <sup><a href="#!" id="edit-profile-link"> <span class="fa fa-edit"></span> </a></sup> </h3>
				
				<div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
					<table class="table" id="disp-profile-data">
						<tbody>
							<tr>
								<td>Email ID : </td>
								<td> <?php echo $_SESSION['user']; ?> </td>
							</tr>
							<tr>
								<td>Contact : </td>
								<td id="user-contact"> </td>
							</tr>
							<tr>
								<td>Address : </td>
								<td id="user-address"> </td>
							</tr>	
						</tbody>
					</table>

					<form role="form" id="edit-profile-data-form" hidden>
						<table class="table" id="edit-profile-data">
							<tbody>
								<tr class="form-group">
									<td> <label for="profile-name">Name : </label> </td>
									<td> <input type="text" class="form-control" id="profile-name"> </td>
								</tr>
								<tr class="form-group">
									<td> <label for="profile-contact">Contact : </label> </td>
									<td> <input type="text" class="form-control" id="profile-contact"> </td>
								</tr>
								<tr class="form-group">
									<td> <label for="profile-address">Address : </label> </td>
									<td> <input type="text" class="form-control" id="profile-address"> </td>
								</tr>
							</tbody>
						</table>
					</form>

				</div>

				<div class="col-lg-1 col-md-1"></div>

				<div class="col-lg-4 col-md-5 col-sm-5 col-xs-12" id="profile-extra-info" hidden>
					<table class="table">
						<tbody>
							<!-- Any extra information will be displayed here -->
						</tbody>
					</table>
				</div>

			</div>

			<div class="row">
				<h3> Your Orders </h3>

				<div class="panel-group" id="order-accordion">
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">

								<table class="table" style="margin-bottom: 0px;">
									<thead>
										<tr>
											<th>Sr. No.</th>
											<th>Order Date</th>
											<th>Transaction ID</th>
											<th>Total Amount</th>
											<th>&nbsp;&nbsp;</th>
											<!-- <th class="fa fa-chevron-down"></th> -->
										</tr>
									</thead>
								</table>

							</h4>
						</div>
					</div>

					<!-- Display all orders here as acordions -->

				</div>

			</div>

		</div>

		<div class="col-lg-1 col-md-1 col-sm-1"></div>

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

$(document).load(function(){
	$('#loader-div').show();
});

$(document).ready(function(){

	setMainDisplayContainer($(window));

	var user = "<?php echo $_SESSION['user']; ?>";

	fetchUserProfile(user);

	fetchOrderHistory(user);

	$("#edit-profile-link").on("click", function(){
		editProfile(user);
	});

});

$(window).resize(function(){
	setMainDisplayContainer(this);
});

</script>

</body>