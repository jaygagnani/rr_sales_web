<!DOCTYPE>

<html>

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

	<style type="text/css">

		table thead tr th,
		table tbody tr td{
			padding-left: 50px;
			text-transform: none;
		}

		table thead tr th{
			width: 20%;
		}

		table tbody tr td{
			width: 25%;
		}

		table thead tr th:first-child,
		table tbody tr td:first-child{
			width: 10%;
		}

		table thead tr th:nth-child(2),
		table tbody tr td:nth-child(2){
			width: 30%;
		}

	</style>

</head>

<body>

<?php
	require_once('./navbar_layout.php');
?>

<div class="row">
	<div class="col l1 m1"><br/></div>
	<div class="col l0 m10 s12">
	
		<ul class="collapsible" data-collapsible="accordion" id="order-accordion">
			
			<li>		
				<table style="margin-bottom: 0px;">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Buyer Name</th>
							<th>Order Date</th>
							<th>Transaction ID</th>
							<th>Total Amount</th>
							<th>&nbsp;&nbsp;</th>
							<!-- <th class="fa fa-chevron-down"></th> -->
						</tr>
					</thead>
				</table>
			</li>
			
			<!-- Display all orders here as acordions -->

		</div>

	</div>
</div>

<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="./js/materialize.js"></script>
<script type="text/javascript" src="../js/search_keyword.js"></script>
<script type="text/javascript" src="./js/common_js.js"></script>

<script type="text/javascript">

$(document).ready(function(){

	fetchOrderHistory(null);

	$('.collapsible').collapsible();

});

</script>

</body>

</html>