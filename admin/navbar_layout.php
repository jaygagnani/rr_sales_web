<!DOCTYPE>
<html>

<head>
	<title>Master Admin Home</title>

	<!-- all meta tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<!-- link the materialize css file -->
	<link href="./css/materialize.css" rel="stylesheet" type="text/css" hreflang="en">

	<!-- link material icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<style type="text/css">

		html,body{
			text-transform: uppercase;
		}

		nav{
			background-color: #333399;
			/*z-index: 0;
			box-shadow: 0 0 0 0;*/
			text-transform: uppercase;
		}

		.brand-logo{
			margin-top: 0.5%;
		}

		.brand-logo .hide-on-large-only{
			margin-top: 0.5%;
			left: 1px;
		}

		.dropdown-content li > a, .dropdown-content li > span{
			background-color: #333399;
			color: #fff;
		}

		.dropdown-content a:hover{
			color: #333399;
		}

		
		#med_small_search .input-field input[type=search]{
			margin-top: 10px;
			border-bottom: 2px solid #333399;
			color: #333399;
		}

		#med_small_search .input-field label i{
			color: #333399;
		}

		#med_small_search .input-field input[type=search]:focus,
		#med_small_search .input-field input[type=search]:focus + label i,
		#med_small_search .input-field input[type=search]:focus ~ .material-icons{
			background-color: #333399;
			color: #fff;
		}

		#large_search .input-field input[type=search]:focus,
		#large_search .input-field input[type=search]:focus + label i,
		#large_search .input-field input[type=search]:focus ~ .material-icons{
			background-color: #333399;
			color: #fff;
		}

		#large_search .input-field label i{
			color: #fff;
			border-bottom: #333399;
		}

	</style>

</head>

<body>

<div class="navbar-fixed">
<nav>
	<section class="container">
		<div class="nav-wrapper">
	    	<a href="./master_home.php" class="brand-logo left">
	    		<img src="../images/rr_logo.png" class="responsive-img hide-on-med-and-down" style="height:50px; "/>
	    		<img src="../images/rr_logo.png" class="responsive-img hide-on-large-only" style="height:50px;"/>
	    	</a>

	    	<!-- <a href="#!" class="center breadcrumb">abc</a> -->
      		<!-- <a href="#" class="button-collapse right"><i class="material-icons">menu</i></a> -->

      		<ul class="right hide-on-med-and-down">
		        <li>
		        	<form id="large_search" class="hide-on-med-and-down">
		        		<div class="input-field">
		        			<input id="search" type="search" placeholder="Search..."  onkeyup="searchProducts(this.value);"/>
		        			<label for="search">
		        				<i class="material-icons">search</i>
		        			</label>
		        			<i class="material-icons">close</i>
		        		</div>
		        	</form>
		        </li>
        		<li><a href="#!" class="dropdown-button" data-activates="settings_large_dropdown" data-beloworigin="true" data-hover="true" data-constrainWidth="false"><i class="material-icons">settings</i></a></li>
        		<li><a href="#!" class="tooltipped" data-position="bottom" data-tooltip="Logout" data-delay="10"><i class="material-icons">power_settings_new</i></a></li>
      		</ul>

      		<!-- Menu Dropdown -->
      		<ul class="right hide-on-large-only">
    			<li><a href="#" id="small_search_a"><i class="material-icons">search</i></a></li>
    			<li><a href="#" class="dropdown-button" data-activates="settings_med_small_dropdown" data-beloworigin="true" data-hover="true" data-constrainWidth="true"><i class="material-icons">settings</i></a></li>
        		<li><a href="#!" class="tooltipped" data-position="bottom" data-tooltip="Logout" data-delay="10"><i class="material-icons">power_settings_new</i></a></li>
  			</ul>
      		<!-- Dropdown menu ends -->

      		<!-- Settings Dropdown for Small and Medium Devices-->
      		<ul id="settings_med_small_dropdown" class="dropdown-content hide-on-large-only">
	        	<li><a href="#">Add Sub Admin</a></li>
        		<li><a href="#">Company Profile</a></li>
        	</ul>
        	<!-- Settings Dropdown close -->


        	<!-- Settings Dropdown for Large Devices-->
      		<ul id="settings_large_dropdown" class="dropdown-content hide-on-med-and-down">
	        	<li><a href="#">Add Sub Admin</a></li>
        		<li><a href="#">Company Profile</a></li>
        	</ul>
        	<!-- Settings Dropdown close -->


   		</div>

   		<!-- Search Bar for Medium and Small Devices -->
   		<div id="small_search_bar" class="row">
   			<form id="med_small_search" class="hide-on-large-only">
		        <div class="input-field">
          			<input id="search" type="search" placeholder="Search..." onkeyup="searchProducts(this.value);">
          			<label for="search"><i class="material-icons">search</i></label>
          			<i class="material-icons">close</i>
      			</div>
      		</form>
      	</div>
   		<!-- Search Bar Section Close -->

   </section>
</nav>
</div>

<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.js"></script>
<script type="text/javascript" src="js/search_keyword.js"></script>

<script>
	$(document).ready(function(){
		$('#small_search_bar').hide();
		$('#small_search_a').click(function(){
			$('#small_search_bar').toggle(500);
		});

		$('dropdown-button').dropdown();

	});

</script>

</body>

</html>