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

	</style>

</head>

<body>

<?php require_once('./navbar.php'); ?>


<div class="container">
	<div class="row">
		
		<?php require_once('./filter_bar.php'); ?>

		<div class="col-lg-10 col-md-10" id="category-container" style="padding-left: 65px;">
			<div class="col-lg-12 col-md-12" style="border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 1.2em; line-height: 25px;">
				Spare parts by Make/Model
			</div>

			<div class="col-lg-12 col-md-12" id="display-category" style="margin-top: 50px;">
					
				<!-- Categories by make will be displayed here -->

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


<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="./js/common_js.js" type="text/javascript"></script>

<script>

$(document).load(function(){
	$('#loader-div').show();
});

$(document).ready(function(){

	$("#display-category").html('');

	setMainDisplayContainer($(window));

	$.getJSON("../server/fetch_categories.php", function(data, status){
		if(data){
			var json_data;
			$.each(data, function(i, category){
				json_data = "<div class='col-lg-3 col-md-4 col-sm-6 display_catalogue'><a href='./category_master.php?category="+category.nicename+"'><div class='div_with_bg_img' alt='"+category.name+"' style='background: url(../"+category.img+"); background-size:100%; '><div class='div_text_item'>"+category.name+"</div></div></a></div>";
				$(json_data).appendTo("#display-category");
			});
		}
	});

});

$(window).resize(function(){
	setMainDisplayContainer(this);
});

</script>

</body>