<!DOCTYPE>

<html>

<?php
if(!session_id())
	session_start();

?>

<head>

<!-- meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<!-- favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
	
<!--Import Material Icons Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- link the materialize css file -->
	<link href="./css/materialize.css" rel="stylesheet" type="text/css" hreflang="en">

<!-- Link custom stylesheets -->
	<link href="./css/common_styles.css" rel="stylesheet" type="text/css" hreflang="en">

	<style>
		input[type=text]:disabled,
		input[type=number]:disabled{
			color: #000 !important;
			border-bottom: 2px solid red !important;
		}

		input[type=text]{
			color: #000;
		}

	</style>

</head>

<body>

<?php
	require_once('./navbar_layout.php');
?>


<div class="row">
	<form id="product_form" enctype="multipart/form-data">
		
		<div class="col s3 hide-on-med-and-up"><br/></div>
		
		<div class="col l3 m3 s6">
			<div class="card" style="left: 15px;">
				<div class="card-content">
					<img id="product_img" name="product_img" src="../images/dummy_pics/1.jpg" class="responsive-img" style="width: 100%; height: inherit; padding: 0px;"/>
				</div>
			</div>

			<!-- Change Image Btn -->
			<div class="file-field" id="change_image_btn" hidden>
				<div class="btn">
					<span> File </span>
					<input type="file" name="new_image_file" id="new_image_file">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>
			<!-- Ends Change Image Btn -->

		</div>

		<div class="col s3 hide-on-med-and-up"><br/></div>
		
		<div class="col l9 m9 s12">
			<div class="row">
				<div class="col l12 m12 s12">
					<div class="col s1 hide-on-med-and-up"><br/></div>
					<div class="input-field col l6 m6 s10">
						<label for="product_name" id="product_name_lbl">Product Name</label>
          				<input id="product_name" name="product_name" type="text" class="validate set_editable" disabled="true" style="float:left; font-style: bold; font-size: 2em;"/>
        			</div>
        			<div class="col l5 m7 s4 right">
	        			<div class="right">
        					<a id="delete_product_btn" class="waves-effect waves-light btn" onclick='deleteProduct("<?php echo $_GET['product'] ?>", "<?php if(isset($_SESSION['category_nicename'])) {echo $_SESSION['category_nicename'];} else{echo null;} ?>")' style="margin-top: 25px; right: 20px; background-color: #fff; color: red;">Delete Product</a>
        				</div>
        			</div>
        			<!-- <div class="col s1 hide-on-med-and-up"><br/></div> -->
				</div>
			</div>

			<div class="row">
				<div class="col l12 m12 s12">
					<div class="card" style="width: 97%;">
						<div class="card-content">

							<div class="row" id="display-product-details" style="padding:20px; padding-top: 30px;">

								<!-- Products will be printed here from fetchProductDetails() method -->

							</div>

							<div id="save_btn" class="row" style="display: hidden;">
								<center>
									<a class="waves-effect waves-light btn" style="background-color: #333399;">Save Changes</a>
								</center>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="fixed-action-btn" id="add_product_btn" style="right: 24px; bottom: 43px;">
			<a class="btn-floating btn-large waves-effect waves-light red modal-trigger" onclick="editProductDetails();">
				<i class="material-icons">edit</i>
			</a>
		</div>

	</form>

</div>


<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="./js/materialize.js"></script>

<script type="text/javascript" src="./js/common_js.js"></script>


<script type="text/javascript">

$(document).ready(function(){
	$('#save_btn').hide();


	fetchProductDetails("<?php if(isset($_SESSION['category_nicename'])) {echo $_SESSION['category_nicename'];} else{echo null;} ?>", "<?php echo $_GET['product']; ?>");

});


</script>

</body>

</html>