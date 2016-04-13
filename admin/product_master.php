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
		input[type=text]:disabled{
			color: #000;
			border-bottom: 2px solid red;
		}
	</style>

</head>

<body>

<?php
	require_once('./navbar_layout.php');
?>


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


<script type="text/javascript">

$(document).ready(function(){
	$('#save_btn').hide();
	fetchProductDetails();
});


function fetchProductDetails(){
	$.getJSON("../server/fetch_product_details.php?category=<?php echo $_SESSION['category_nicename']; ?>&product=<?php echo $_GET['product']; ?>", function(data){
		if(data){
			var json_data;
			$.each(data, function(i, product){
				if(product.id){

					$('#product_img').attr('src','../'+product.img);
					$('#product_img').attr('alt',product.name);

					$('#product_name').val(product.name);
					$('#product_name_lbl').hide();

					json_data = "";
					json_data += "<div class='row'><p class='col l2'>Product ID : </p><input type='text' class='col l6 set_editable product_detail' value='"+product.product_id+"' disabled/></div>";
					json_data += "<div class='row'><p class='col l2'>Rate per Quantity : </p> <input type='text' class='col l6 set_editable product_detail' value='Rs. "+product.rate+" / "+product.per+" ("+product.min_qty+")' disabled /></div>";
					json_data += "<div class='row'><p class='col l2'>Vehicle : </p><input type='text' class='col l6 set_editable product_detail' value='"+product.vehicle+"' disabled/></div>";
					json_data += "<div class='row'><p class='col l2'>Description : </p><input type='text' class='col l6 set_editable product_detail' value='"+product.description+"' disabled/></div>";

					if(product.meta_length > 0){
						json_data += "<br/><h6><b>Extra Information</b></h6>";
						json_data += "<hr/>";

						$.each(product.meta_data, function(i, meta_data){

							json_data += "<div class='row'><p class='col l2'>"+Object.keys(meta_data)+" : </p><input type='text' class='col l6 set_editable product_detail' value='"+meta_data[Object.keys(meta_data)]+"' disabled /></div>";

						});
						// json_data += "<p>"+$i->key+"</p>";
					}
					else{
						json_data += "</div>";
					}

					$(json_data).appendTo('#display-product-details');
				}
			});
		}else{
			json_data += "No Category Found";
			$(json_data).appendTo('#displayJson');
		}
	});
}


function editProductDetails(){
	console.log(1);
	$('input').attr('disabled',false);
	$('#save_btn').show(100);
}

</script>

</body>

</html>