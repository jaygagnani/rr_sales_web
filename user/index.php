<!DOCTYPE html>

<html>

<head>

<!-- meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<!-- favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />

<!-- Bootstrap CDN CSS -->
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

<!-- Link custom stylesheets -->
	<link href="./css/common_styles.css" rel="stylesheet" type="text/css" hreflang="en">

	<style type="text/css">

		.modal {
			text-align: center;
		}

		/*@media screen and (min-width: 768px) { */
  			.modal:before {
    			display: inline-block;
    			vertical-align: middle;
    			content: " ";
	    		height: 100%;
  			}
		/*}*/

		.modal-dialog {
  			display: inline-block;
  			text-align: left;
  			vertical-align: middle;
		}

		.modal-header h4{
			text-transform: none;
		}

		.modal-header button{
			color: red;
			opacity: 0.7;
		}

		.modal-header button:hover{
			color: red;
			opacity: 1;
		}

		.modal-header button span{
			font-size: 15px;
		}

		.modal .modal-content .modal-body{
			text-align: center;
			font-weight: bold;
			margin-bottom: 20px;
		}

		.modal .modal-content .modal-body .main-category{
			height: 170px;
		}

	</style>

</head>

<body style="background-color: ">

<?php require_once('./navbar_layout.php'); ?>


<div class="container-fluid" style="margin-top: 8%;">
	<div class="row">
		<div class="col-lg-3">
			<div class="panel panel-default" style="margin-left: 50px; width: 80%;">
				<div class="panel-heading center" style="color: #333399; font-size: 1.2em; font-weight: bold;">Filter by Category</div>
				<div class="panel-body">
					<form role="form" name="category_filter_form" id="category_filter_form">
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- 2 and 3 wheeler option modal -->
<div id="wheeler_2_3_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content -->
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" onclick="">
					<span class="hidden-xs hidden-sm" style="margin-right: 10px;">
						Show all products
					</span>
					&times;
				</button>
				<h4 class="modal-title">Shop for</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-sm-12">
						<a href="#">
							<img src="../images/wheeler_2.jpg" alt="2 wheeler vehicles" class="img-responsive main-category"/>
							<hr/>
							<span>Two Wheeler Parts</span>
						</a>
					</div>
					<div class="col-lg-6 col-sm-12">
						<a href="#">
							<img src="../images/wheeler_3.jpg" alt="3 wheeler vehicles" class="img-responsive main-category"/>
							<hr/>
							<span>Three Wheeler Parts</span>
						</a>
					</div>
				</div>
			</div>

			<!-- <div class="modal-footer">
			</div> -->

		</div>
		<!-- Modal content ends -->

	</div>
</div>
<!-- Modal ends -->


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

	$('#wheeler_2_3_modal').modal("show");
});

</script>

</body>