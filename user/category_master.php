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


<?php require_once('./navbar.php'); ?>

<div class="container">
	<div class="row">
		
		<?php require_once('./filter_bar.php'); ?>

 
 		<div class="col-lg-10 col-md-10" id="category-container" style="padding-left: 65px;">
			<div id="title" class="col-lg-12 col-md-12" style="border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 1.2em; line-height: 25px;">
				Product
			</div>

			<div class="col-lg-12 col-md-12" id="display-product" style="margin-top: 50px;">
				
				<!-- Products within current category will be displayed here -->

			</div>

			<div>
				<ul class="pagination pagination-sm">
					<li><a href="#">&lt;&lt;</a></li>
  					<li><a href="#" class="active">1</a></li>
  					<li><a href="#">2</a></li>
  					<li><a href="#">3</a></li>
  					<li><a href="#">4</a></li>
  					<li><a href="#">5</a></li>
  					<li><a href="#">&gt;&gt;</a></li>
				</ul>
			</div>

		</div>

	</div>
</div>


<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>

<script src="./js/common_js.js" type="text/javascript"></script>

<script>

$(document).load(function(){
	$('#loader-div').show();
});

$(document).ready(function(){

	$("#display-product").html('');

	setMainDisplayContainer($(window));

	//var length;
	//var callLengthFunction = getProductsLength("<?php echo $_GET['category']; ?>");

	displayProducts(0);

});

$(window).resize(function(){
	setMainDisplayContainer(this);
});

function displayProducts(offset){
	$.getJSON("../server/fetch_products.php?category=<?php echo $_GET['category']; ?>&page="+offset, function(data, status){
		console.log("get in");
		if(data){
			alert(1);
			var json_data;
			$.each(data, function(i, category){
				json_data = "<div class='col-lg-3 col-md-4 col-sm-6 display_catalogue'><a href='./category_master.php?category="+category.nicename+"'><div class='div_with_bg_img' alt='"+category.name+"' style='background: url(../"+category.img+"); background-size:100%; '><div class='div_text_item'>"+category.name+"</div></div></a></div>";
				$(json_data).appendTo("#display-product");
			});
		}else{
			alert(2);
			$("#display-product").html("<i>Sorry...No products within this category</i>");
			$(".pagination").hide();
		}
	});
}

</script>

</body>

</html>