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

		.btn{
			font-size: 1.7rem;
			margin-top: 10px;
			width: 150px;
		}

		.btn:hover:not([enabled="enabled"]),
		.btn:active:not([enabled="enabled"]){
  			background-color: #333399;
  			color: #fff;
		}

	</style>

	
</head>

<body>

<div class="wrapper" style="height: 100%;">
	
	<?php require_once('./navbar.php'); ?>

	<div class="container">
		<div class="row">

			<?php require_once('./filter_bar.php'); ?>
			

			<div class="col-lg-10 col-md-10" id="category-container" style="padding-left: 65px;">
				<div id="title" class="col-lg-12 col-md-12" style="border-bottom: 1px solid #000; font-size: 1.2em; line-height: 25px;">
					<!-- Breadcrumb -->

						<ul class="breadcrumb" style="text-transform: none;">
							<li><a href="./">Home</a></li>
							<li><a href="#">Category</a></li>
							<li><a href="#">Product</a></li>
						</ul>

					<br/>
				</div>

				<div class="col-lg-12 col-md-12" style="margin-top: 5px;">

					<div class="col-lg-12 col-md-12" id="display-product-details">
						
						<!-- Product Details will be displayed here -->

						<div class="row" style="margin-top: 10px; padding-bottom: 20px;">
							<div class="col-lg-12 col-md-12">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<img id="product-img" src="../images/no-image.png" alt="" class="img-responsive" style="width: 100%; border-radius: 15px;"/>
								</div>

								<div class="col-lg-1 col-md-1"></div>

								<div class="col-lg-7 col-md-7" style="padding-left: 10px;">
									<div class="row">
										<h2 id="product-name"> <!-- product's NAME here --> </h2>
										<p>Product no. : <span id="product-id"> <!-- product's ID here --> </span> </p>
										<p>Vehicle : <span id="product-vehicle"> <!-- product's VEHICLE here --> </span></p>
										<h4 style="font-size: 2rem;">INR <span id="product-rate"> <!-- product's RATE here --> </span> per <span id="product-per"> <!-- product's PER here --> </span></h4>
										<p>Minimum quantity : <span id="product-min-qty"> <!-- product's MINIMUM QUANTITY here --> </span></p>

										<br/>

										<p>Quantity : 
											<input type="number" id="quantity-input" min="0" value="0" step="0" required style="width: 70px;"/>
											<span id="quantity-error-msg" class="error-msg-display" hidden></span>
										</p>

									</div>

									<div class="row">
										<div class="col-lg-4 col-md-4">
											<button type="button" id="add-to-cart-btn" class="btn btn-default col-lg-12"><span class="fa fa-shopping-cart">&nbsp;&nbsp;Add to cart</span></button>
										</div>
											
										<div class="col-lg-4 col-md-4">
											<button type="button" id="buy-now-btn" class="btn btn-default"><span class="fa fa-credit-card">&nbsp;&nbsp;Buy now</span></button>
										</div>

									</div>

										<div class="row" id="error-msg" class="error-msg-display" style="color: red; font-style: italic;" hidden>
											<div class="col-lg-12 col-md-12">
												Login to purchase or add product to cart.
											</div>
										</div>

									
									
									<div id="product-desc" class="row" style="margin-top: 20px;" hidden>
										<p><b>Description</b></p>
										<p id="desc"> <!-- product's DESCRIPTION here --> </p>
									</div>

									<div id="product-extra" class="row" style="margin-top: 20px;" hidden>
										<!-- Any EXTRA Information will be displayed here -->
									</div>


								</div>
							</div>
						</div>
						
					</div>
				</div>

				<div id="similar-products">
					
					<div id="similar-products-title" class="col-lg-12 col-md-12" style="border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 1.2em; line-height: 25px; margin-top: 100px;">
						Similar auto parts
						<br/>
					</div>

					<div class="col-lg-12 col-md-12">
						<?php include_once('./similar_products_carousel.php'); ?>
					</div>

				</div>

			</div>

		</div>
	</div>

	<?php include_once('./footer.php'); ?>

</div>


<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="./js/common_js.js" type="text/javascript"></script>

<script type="text/javascript">

	$(document).ready(function(){
		$("#filter_bar").html("");

		setMainDisplayContainer(this);

		var CATEGORY = "<?php if(isset($_GET['category'])){echo $_GET['category'];} else{echo null;} ?>";
		var PRODUCT = "<?php echo $_GET['product']; ?>";
		var USER = "<?php if(isset($_SESSION['user'])){echo $_SESSION['user'];} else{echo null;} ?>";

		fetchProductDetails(USER, CATEGORY, PRODUCT);

		similarProductsCarousel();

		fetchSimilarProducts(PRODUCT);
	});


	$(window).resize(function(){
		setMainDisplayContainer(this);
	});

</script>

</body>

</html>