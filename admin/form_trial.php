<!DOCTYPE html>

<html>

<head>


<!--Import Material Icons Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- link the materialize css file -->
	<link href="./css/materialize.css" rel="stylesheet" type="text/css" hreflang="en">

</head>

<body>




<div class="row">
	<div class="col s3 hide-on-med-and-up"><br/></div>
	<div class="col l3 m3 s6">
		<div class="card" style="left: 15px;">
			<div class="card-content">
				<img id="product_img" src="../images/dummy_pics/1.jpg" class="responsive-img" style="width: 100%; height: inherit; padding: 0px;"/>
			</div>
		</div>
	</div>
	<div class="col s3 hide-on-med-and-up"><br/></div>
	<div class="col l9 m9 s12">
		<div class="row">
			<div class="col l12 m12 s12">
				<div class="col s1 hide-on-med-and-up"><br/></div>
				<div class="input-field col l6 m6 s10">
					<label for="product_name" id="product_name_lbl">Product Name</label>
          			<input id="product_name" type="text" class="validate set_editable" disabled="true" style="float:left; font-style: bold; font-size: 2em;"/>
        		</div>
        		<div class="col l5 m7 s4 right">
        			<div class="right">
        				<a class="waves-effect waves-light btn" style="margin-top: 25px; right: 20px; background-color: #fff; color: red;">Delete Product</a>
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
							<!-- Products will be printed here from fetchProducts() method -->

							<div class='input-field col l6 m6 s10'>
								<label for='product_id'>Product ID</label>
          						<input id='product_id' type='text' class='validate set_editable' value='ancv' disabled/>;
        					</div>;


						</div>

						<div id="save_btn" class="row" style="display: hidden;">
							<center>
								<a class="waves-effect waves-light btn">Save Changes</a>
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
</div>





<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="./js/materialize.js"></script>

<script type="text/javascript" src="./form_trial.js"></script>


<script type="text/javascript">

//fetchProductDetails("abd.17","<?php echo $_GET['product']; ?>");

</script>


</body>

</html>