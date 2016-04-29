<?php

if(session_status() == PHP_SESSION_NONE){
	session_start();
	if(!(isset($_SESSION['user']))) {
		header('Location: ./');
	}
}

?>

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
								<li><a href="#">Cart</a></li>
							</ul>

						<br/>
					</div>
				</div>

				<div class="row" style="margin-top: 20px;">
					<!-- <div class="table-responsive"> -->

						<table id="cart-table" class="table table-striped table-bordered table-hover table-condensed">
					
							<thead>
								<tr>
									<th colspan="4" style="border: 2px solid;">Cart</th>
								</tr>
								<tr class="active" style="text-transform: uppercase; color: red;">
									<th class="no-border">Item</th>
									<th class="no-border">Quantity</th>
									<th class="no-border">Price</th>
									<th class="no-border">Sub Total</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="no-border"></td>
									<td class="no-border"></td>
									<td class="no-border"></td>
									<td class="no-border"></td>
								</tr>
							</tbody>

							<tfoot>
								<tr>
									<td class="no-border"></td>
									<td class="no-border"></td>
									<td class="no-border" style="text-align: right;">Total</td>
									<td class="no-border" id="total-cart-cost">000.00</td>
								</tr>
							</tfoot>

						</table>

					<!-- </div> -->
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-12" style="padding-right: 0px; margin-top: -20px;">
						
							<div class="col-lg-6 col-md-6"></div>

							<div class="col-lg-6 col-md-6">
								
								<div class="col-lg-2"></div>

								<div class="col-lg-5 col-5" style="font-weight: bold; text-transform: uppercase; height: 46px;">
									<a href="./" style="width: 100%; line-height: 35px;">&lt; Continue Shopping</a>
								</div>
								<div class="col-lg-5 col-5" id="abc" style="margin-right: 0px; height: 46px;">
									<button type="button" class="btn btn-default" onclick='finalizeCart("<?php echo $_SESSION['user']; ?>");' style="width: 100%; float: right; margin-right: 0px; text-transform: uppercase;"><b>Place Order</b></button>
								</div>
							</div>

						<br/>
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
		fetchCart("<?php echo $_SESSION['user']; ?>", "cart");

	});

</script>

</body>

</html>