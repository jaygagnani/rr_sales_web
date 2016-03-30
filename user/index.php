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

		label{
			text-transform: lowercase;
		}

		.form-group select, .form-group select:focus{
			border-style: hidden;
			box-shadow: none;
			text-align: left;
			padding-left: 2px;
		}

		.form-group{
			font-weight: bold;
		}

		option{
			font-weight: bold;
			color: #333399;
		}

		option[disabled]{
			font-weight: normal;
		}

		#by_make_select, #by_type_select{
			color: #333399;
		}


	</style>

</head>

<body>

<?php require_once('./navbar.php'); ?>


<div class="container" style="margin-right: 0px;">
	<div class="row">
		<div class="col-lg-2 form-group">

				<h4 style="text-transform: none;"><b>Filter by</b></h4>

				<div class="checkbox" style="margin-top: 20px;">
					<label><input type="checkbox"> <b>2 Wheeler</b> </label>
				</div>
				<div class="checkbox" style="margin-top: 10px;">
					<label><input type="checkbox"> <b>3 Wheeler</b> </label>
				</div>

				<hr style="background-color:#000;"/>

				<div class="" style="margin-top: 10px;">
					<div class="form-group">
  						<select class="form-control" id="by_make_select">
  							<option selected disabled>By Make/Model</option>
    						<option>1</option>
    						<option>2</option>
    						<option>3</option>
    						<option>4</option>
  						</select>
					</div>
				</div>

				<hr style="background-color:#000;"/>

				<div class="" style="margin-top: 10px;">
					<div class="form-group">
  						<select class="form-control" id="by_type_select">
  							<option selected disabled>By Type</option>
    						<option>1</option>
    						<option>2</option>
    						<option>3</option>
    						<option>4</option>
  						</select>
					</div>
				</div>

		</div>

		<div class="col-lg-10" style="padding-left: 65px;">
				<div class="col-lg-12" style="border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 1.5em; line-height: 25px;">
					Spare parts by Make/Model
				</div>

				<div class="col-lg-12" style="margin-top: 50px;">
					<div class="col-lg-3">
						<!-- <img src="../images/dummy_pics/1.jpg" class="img-responsive"/> -->
						<div style="background: url('../images/dummy_pics/1.jpg'); background-repeat: no-repeat; background-size: 100%; height: 170px;"
							<center>
							<div style="background-color: #333399; color: #fff; position: relative; top: 140px; height: 30px;">
								Category 1
							</div>
						</center>
						</div>
					</div>
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


<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>

$(document).load(function(){
	$('#loader-div').show();
});

$(document).ready(function(){

	$.getJSON("../server/fetch_categories.php", function(data, status){
		if(data){
			var json_data;
			$.each(data, function(i, category){
				json_data = "<div class='form-group'><input type='checkbox' id='"+category.nicename+"' name='"+category.nicename+"'/><label for='"+category.nicename+"'>"+category.name+"</label></div>";
				$(json_data).appendTo("#category_filter_form");
			});
		}
	});

});

</script>

</body>