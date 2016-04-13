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

	
</head>

<body>

<div class="wrapper" style="height: 100%;">
	
	<?php require_once('./navbar.php'); ?>

	<div class="container">
		<div class="row">
		
			<?php require_once('./filter_bar.php'); ?>

 
 			<div class="col-lg-10 col-md-10" id="category-container" style="padding-left: 65px;">
				<div id="title" class="col-lg-12 col-md-12" style="border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 1.2em; line-height: 25px;">
					<!-- Category Name -->
					<br/>
				</div>

				<div class="col-lg-12 col-md-12" style="margin-top: 5px;">

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12" id="product-count" style="text-align: right; padding-right: 15px; color: rgb(235,46,58); text-transform: none; font-weight: bold;">
							Showing 1 - 40 products.
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
							<?php include('./pagination.php'); ?>
						</div>
					</div>

					<div class="col-lg-12 col-md-12" id="display-product">
						
						<!-- Products within current category will be displayed here -->

					</div>

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right; margin-top: -30px;">
							<?php include('./pagination.php'); ?>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>

	<?php include_once('./footer.php'); ?>

</div>

<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>

<script src="./js/common_js.js" type="text/javascript"></script>

<script>

var DISPLAY_LIMIT = 40;
var CURR_PAGE = 1;
var TOTAL_RECORDS = 0;

var CATEGORY = "<?php echo $_GET['category']; ?>";

$(document).load(function(){
	$('#loader-div').show();
});

$(document).ready(function(){

	$("#display-product").html('');

	setMainDisplayContainer($(window));

	paginationLength("<?php echo $_GET['category']; ?>", DISPLAY_LIMIT);

	paginationNavigation("<?php echo $_GET['category']; ?>", CURR_PAGE);
	


});

$(window).resize(function(){
	setMainDisplayContainer(this);
});

// function displayProducts(page_number){
// 	$.getJSON("../server/fetch_products.php?category=<?php echo $_GET['category']; ?>&page="+page_number, function(data, status){
// 		if(data){
// 			var json_data;
			
// 			$("#title").html(data[0].category_name);

// 			if(data.length > 1){
				
// 				$.each(data, function(i, product){
// 					if(product.id){
// 						json_data = "<div class='col-lg-3 col-md-4 col-sm-6 display_catalogue'><a href='./product_master.php?product="+product.nicename+"'><div class='div_with_bg_img' alt='"+product.name+"' style='background: url(../"+product.img+"); background-size:100%; '><div class='div_text_item'>"+product.name+"</div></div></a></div>";
// 						$(json_data).appendTo("#display-product");
// 					}
// 				});
// 				$(".pagination").show() ;

// 			}else{

// 				$("#display-product").html("<i style='color: red; text-transform: none;'>Sorry! No products within this category.</i>");
// 				$(".pagination").hide() ;
// 				$("#product-count").hide() ;

// 			}
// 		}else{

// 			alert(2);
// 			$("#display-product").html("<i style='color: red; text-transform: none;'>Sorry! No products within this category.</i>");
// 			$(".pagination").hide() ;
// 			$("#product-count").hide() ;

// 		}
// 	});
// }

</script>

</body>

</html>