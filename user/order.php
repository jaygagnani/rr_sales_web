<?php
session_start();

if(!isset($_SESSION['user']) && !isset($_POST['buyer_name'])){
	header('Location: ./');
}

if(isset($_GET['cart'])){
	if($_GET['cart'] == 1){
		$_SESSION['cart_id'] = 1;
	}
	else{
		header('Location: ./');
	}
}

if( isset($_POST['product']) ){
	//"id", "name", "rate", "per", "qty", "nicename"
	$_SESSION['product_nicename'] = $_POST['product'];
	$_SESSION['product_order_qty'] = $_POST['order_qty'];
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

		html, body{
			text-transform: none;
		}

		#main-container a{
			color: rgb(255,0,0) !important;
		}

		#main-container input[type=radio]{
			visibility: hidden;
		}

		#main-container .payment-mode-ul{
			list-style: none;
		}

		#main-container .payment-mode-ul>li{
			text-align: left !important;
		}

		#main-container .table{
			margin-bottom: 0px;
		}

		#main-container .table,
		#main-container .table tr,
		#main-container .table tr td{
			border: 0;
		}

		#main-container .table tr td:nth-child(odd){
			width: 35%;
		}

		#main-container ol{
			text-align: left;
			line-height: 30px;
		}

		#main-container ol#products-list li{
			text-align: left !important;
		}

		#main-container hr{
			background-color: #000;
			border-color: #000;
		}

	</style>

</head>

<body>

<?php require_once('./navbar.php'); ?>


<div class="container" id="main-container">
	<div class="row">

		<div class="col-lg-1 col-md-1"></div>

		<div class="col-lg-10 col-md-10">
			
			<div class="row">
				<div class="col-lg-6 col-md-6" style="font-size: 2rem;">
					<b> Review your order </b>
				</div>

				<div class="col-lg-6 col-md-6" style="padding: 9px; background: rgba(255,0,0,0.3); float: right; border-radius: 5px;">
					<center>
						<i class="fa fa-info-circle" style="color: rgb(255,0,0); font-size: 2rem;"></i>&nbsp;
						60% discount on your order on advance payment or full cash on delivery.
					</center>
				</div>
			</div>

			<div class="row" style="margin-top: 10px;">

				<div class="col-lg-7 col-md-7">

					<div class="row" style="border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 1.2em;">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							Delivery and billing address
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							Payment method
						</div>
					</div>

					<div class="row" style="margin-bottom: 20px;">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div>
								<b>
									<span id="buyer-name"></span><br/>
									<span id="add-line-1"></span><br/>
									<span id="add-line-2"></span>
									<span id="area"></span><br/>
									<span id="town"></span> - <span id="pincode"></span><br/>
									<span id="state"></span><br/>
									<span id="country"></span><br/>
								</b>

								<br/>
							</div>

							<div>
								
								<form>
								</form>

							</div>

							<a href="./address_select.php?update=true">Change address</a>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							Cash on delivery
							<!-- <ul class="payment-mode-ul">
								<li>
									<input type="radio" name="payment-mode">Net banking</input>
								</li>
								<li>
									<input type="radio" name="payment-mode">Cash on delivery</input>
								</li>
							</ul> -->
						</div>
					</div>

					<div class="row" style="border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 1.2em;">
						<div class="col-lg-12 col-md-12">
							Items <div style="float: right;"> <a id="change-qty-link" style="font-size: 10pt;">Change Quantity</a> </div>
						</div>
					</div>

					<div class="row" style="margin-bottom: 20px;">
						<ol id="products-list">
						</ol>
					</div>

				</div>

				<div class="col-lg-1 col-md-1"></div>

				<div class="col-lg-4 col-md-4 col-sm-12" style="border: 1px solid #333399; text-align: justify;">
					
					<button type="button" class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12" id="place-order-btn">Place your order</button>
					<span class="col-lg-12 col-md-12 col-sm-12">By placing your order you agree to R.R. Sales Corporation's <i>privacy notice</i> and <i>conditions of use</i></span>

					<table class="table col-lg-12 col-md-12 col-sm-12">
						<tbody>
							<tr>
								<td>Amount</td>
								<td class="total-amount">00.00</td>
							</tr>
							<tr>
								<td>Discount</td>
								<td>You can avail a discount of <b>INR <span id="total-discount"></span></b> at the time of delivery if you make full payment at the time of delivery.
							</tr>
							<tr style="border-top: 1px solid #333399;">
								<td>Order total</td>
								<td style="font-size: 14pt;">INR <span class="total-amount"></span> </td>
							</tr>
						</tbody>
					</table>

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



<?php //include_once('./footer.php'); ?>



<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="./js/common_js.js" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function(){

	var isset_user = "<?php if(isset($_SESSION['user'])) {echo 1;} else {echo 0;} ?>";
	var isset_cart = "<?php if(isset($_GET['cart'])) {echo $_GET['cart'];} else {echo 0;} ?>";
	var isset_product = "<?php if(isset($_SESSION['product_nicename'])) {echo 1;} else {echo 0;} ?>";

	var user = "<?php if(isset($_SESSION['user'])) {echo $_SESSION['user'];} else {echo null;} ?>"
	var product = '';
	var order_qty = 0;
	
	fetchUserAddress(user, "span");
		

	if(isset_cart == 1) {

		fetchCart(user, "order");
	}
	else if(isset_product == 1) {

		product = "<?php if(isset($_SESSION['product_nicename'])) {echo $_SESSION['product_nicename'];} ?>";
		order_qty = "<?php if(isset($_SESSION['product_order_qty'])) {echo $_SESSION['product_order_qty'];} ?>";
	
		fetchOrderByProductName(product, order_qty);
	}

	if(isset_cart == 1){
		placeOrder(user, 'cart', null, null);
	}
	else if(isset_product == 1){
		placeOrder(user, 'product', product, order_qty);
	}

});

</script>

</body>

</html>