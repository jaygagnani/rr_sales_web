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
				<div class="col-lg-12 col-md-12 col-sm-12" style="border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 1.2em;">
					Enter delivery/billing address
				</div>
			</div>

			<div class="row" style="margin-top: 20px;">

				<div class="col-lg-12 col-md-12 col-sm-12">
					
					<form role="form" id="address-form" class="col-lg-12 col-md-12 col-sm-12">
	
						<!-- <div class="col-lg-12 col-md-12 col-sm-12">
							<div class="form-group col-lg-5">
								<label for="name">Full name* <br/> <span style="font-size: 8pt;">(or company name)</span></label>
								<input type="text" id="name" name="name" class="form-control" required>
							</div>
						</div> -->

						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="form-group col-lg-5 col-md-5 col-sm-12">
								<label for="add-line-1">Address line 1 *</label>
								<input type="text" id="add-line-1" name="add-line-1" class="form-control" required>
							</div>

							<div class="col-lg-1 col-md-1"></div>
							
							<div class="form-group col-lg-5 col-md-5 col-sm-12">
								<label for="add-line-2">Address line 2 <span style="font-size: 9pt;">(optional)</span></label>
								<input type="text" id="add-line-2" name="add-line-2" class="form-control">
							</div>
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="form-group col-lg-5 col-md-5 col-sm-12">
								<label for="area">Area *</label>
								<input type="text" id="area" name="area" class="form-control" required>
							</div>

							<div class="col-lg-1 col-md-1"></div>

							<div class="form-group col-lg-5 col-md-5 col-sm-12">
								<label for="town">Town/City *</label>
								<input type="text" id="town" name="town" class="form-control" required>
							</div>
						
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="form-group col-lg-5 col-md-5 col-sm-12">
								<label for="pincode">Pin code *</label>
								<input type="text" id="pincode" name="pincode" class="form-control" required>
							</div>

							<div class="col-lg-1 col-md-1"></div>
													
							<div class="form-group col-lg-5 col-md-5 col-sm-12">
								<label for="state">State *</label>
								<input type="text" id="state" name="state" class="form-control" required>
							</div>
						</div>

							
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="form-group col-lg-5 col-md-5 col-sm-12">
								<label for="country">Country *</label>
								<input type="text" id="country" name="country" class="form-control" required>
							</div>
						</div>
						

						<div class="col-lg-12 col-md-12 col-sm-12">
							<button type="submit" id="submit-address-btn" class="btn btn-default">Submit</button>
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

	$(document).ready(function(){

		var if_header_update = "<?php if(isset($_GET['update'])){echo $_GET['update'];} else{echo 'false';} ?>";
		var if_login = "<?php if(isset($_SESSION['user'])){echo 1;} else{ echo 0;} ?>";

		if( (if_header_update.toUpperCase() == "true".toUpperCase()) || (if_login == 1) ){
			fetchUserAddress("<?php if(isset($_SESSION['user'])) {echo $_SESSION['user'];} ?>", "textbox");
		}
		
		if( (if_header_update.toUpperCase() == "true".toUpperCase()) && (if_login == 0) ){
			var buyer_name_field = "<div class='col-lg-12 col-md-12 col-sm-12'><div class='form-group col-lg-5'><label for='buyer-name'>Full name* <br/> <span style='font-size: 8pt;''>(or company name)</span></label><input type='text' id='buyer-name' name='buyer-name' class='form-control' required></div></div>";

			$(buyer_name_field).prependTo("#address-form");

		}
		else if( (if_header_update.toUpperCase() == "false".toUpperCase()) && (if_login == 0) ){
			var buyer_name_field = "<div class='col-lg-12 col-md-12 col-sm-12'><div class='form-group col-lg-5'><label for='buyer-name'>Full name* <br/> <span style='font-size: 8pt;''>(or company name)</span></label><input type='text' id='buyer-name' name='buyer-name' class='form-control' required></div></div>";

			$(buyer_name_field).prependTo("#address-form");

		}

		
		
		$("#address-form").on("submit", function(event){
			console.log("submit");
			if("<?php if(isset($_SESSION['user'])) {echo 1;} else {echo 0;} ?>" == 1){
				console.log("if");
				$.ajax({
					method: "POST",
					url: "../server/add_address.php",
					data: {
						email: $.trim("<?php if(isset($_SESSION['user'])) {echo $_SESSION['user'];} ?>"),
						addressline1: $.trim($("#add-line-1").val()),
						addressline2: $.trim($("#add-line-2").val()),
						area: $.trim($("#area").val()),
						town: $.trim($("#town").val()),
						pincode: $.trim($("#pincode").val()),
						state: $.trim($("#state").val()),
						country: $.trim($("#country").val())
					}
				})
				.success(function(data, status){
					var reply = JSON.parse(data);
					if(reply.status == "success"){
						if(reply.message == "true"){
							if("<?php if(isset($_GET['update'])){echo 1;} else{ echo 0;} ?>" == 1){
								
								if("<?php if(isset($_SESSION['cart_id'])) {echo 1;} else {echo 0;} ?>" == 1){
									window.location.href = "./order.php?cart=1";
								}
								else{
									window.location.href = "./order.php";
								}

							}else{
								alert("Address successfully changed.");
							}

						}
						else{
							alert(reply.message);
						}
					}
				});

			}
			// else if("<?php if(isset($_SESSION['product_id'])) {echo 1;} else {echo 0;} ?>" == 1){
			// 	$.getScript("./js/jquery.redirect.js", function(){
			// 		$.redirect( "./order.php", {"buyer_name": $.trim($("#buyer-name").val()), "addressline1": $.trim($("#add-line-1").val()), "addressline2": $.trim($("#add-line-2").val()), "area": $.trim($("#area").val()), "town": $.trim($("#town").val()), "pincode": $.trim($("#pincode").val()), "state": $.trim($("#state").val()), "country": $.trim($("#country").val()) } );
			// 	});
			// }
			else{
				alert("Login to add/change address or click 'Buy now' on a product to proceed further");
			}

			event.preventDefault();
		});
	});

</script>