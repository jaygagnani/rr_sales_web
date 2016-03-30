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

<!-- ASAP google font css -->
	<link href='https://fonts.googleapis.com/css?family=Asap:700italic,700,400italic,400' rel='stylesheet' type='text/css'>

<!-- Link custom stylesheets -->
	<link href="./css/common_styles.css" rel="stylesheet" type="text/css" hreflang="en">

	<style type="text/css">

		*{
			font-family: 'Asap', sans-serif;
		}

		body{
			text-transform: uppercase;
		}

		.icon-bar{
			background-color: #000;
		}

		[class*="col-"]{
			padding: 5px;
		}


		::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    		font-style: italic;
		}
		
		:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   			font-style: italic;
		}
		
		::-moz-placeholder { /* Mozilla Firefox 19+ */
   			font-style: italic;
		}

		:-ms-input-placeholder { /* Internet Explorer 10-11 */
   			font-style: italic;
		}

		a{
			color: #333399;
		}


	</style>

</head>

<body>

<nav class="navbar">
	<div class="container" style="width: 92%;">
		<div class="row" style="margin-top: 10px;">

			<div class="navbar-header col-lg-2 col-md-2 col-sm-3">

				<div class="col-lg-12">
					<img src="../images/rr_logo.png" class="img-responsive" style="margin-bottom: 20px; height: 50px; width: inherit; margin: 0 auto 10px;"/>
				</div>
				
				<div class="col-lg-12">
					<center><span style="font-size: 12pt; font-weight: bold;">R.R Sales Corporation</span></center>
				</div>
				

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#side-navbar" style="position: relative; float: right;">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
			</div>

			<div class="col-lg-1 col-md-2"></div>

			<div class="col-lg-9 col-md-7 col-sm-9">
				<div class="collapse navbar-collapse row" id="side-navbar" style="margin-top: 10px;">
					<ul class="nav navbar-nav col-lg-12">
						<li class="col-lg-7 col-md-5" style="text-align: center;">
							<div class="form-group">
  								<input type="text" class="form-control" id="search" placeholder="Search by part name, number, model, vehicle" style="float: left; width: 86.2%; margin-right: 0px; border-radius: 4px 0px 0px 4px;">
  								<button type="button" class="btn btn-lg btn-default" style="float:right; position: relative; margin-left: 0px; width: 13.8%; border-radius: 0px 4px 4px 0px; background-color: #333399; color: #fff; padding: 5px; margin-top: -1px;"><span class="glyphicon glyphicon-search"></span></button>
							</div>
						</li>
						<li class="col-lg-1">
						</li>
						<li class="col-lg-1.5 col-md-1.5" style="text-align: right;">
							<a href="#!" data-toggle="modal" data-target="#signInModal"><b>Sign in</b></a>
						</li>
						<li class="col-lg-1.5 col-md-1.5" style="text-align: right;">
							<a href="#"><b>Contact</b></a>
						</li>
						<li class="col-lg-1.5 col-md-1.5" style="text-align: right;">
							<a href="#"><b>Cart</b></a>
						</li>

					</ul>
				</div>
			</div>
		</div>
	</div>
</nav>





<!-- Sign in modal -->

<!-- Modal -->
<div id="signInModal" class="modal fade" role="dialog">
  	<div class="modal-dialog modal-sm">

    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Sign In</h4>
      		</div>
      		<div class="modal-body">
        		<div class="form-group">
        			<label for="email">E-mail:</label>
  					<input type="email" class="form-control" id="email" name="email">
        		</div>
        		<div class="form-group">
        			<label for="password">Password:</label>
  					<input type="password" class="form-control" id="password" name="password">
        		</div>
      		</div>
      		<div class="modal-footer">
      			<center>
        			<button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
        		</center>
      		</div>
    	</div>

  	</div>
</div>



<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>
	
	$(document).ready(function(){
		if($('.navbar-toggle').css('display') == "block"){
			$('li').css('text-align', 'left');
		}else if($('.navbar-toggle').css('display') == "none"){
			$('li').css('text-align', 'right');
		}
	});

	$(window).resize(function(){
		if($('.navbar-toggle').css('display') == "block"){
			$('li').css('text-align', 'left');
		}else if($('.navbar-toggle').css('display') == "none"){
			$('li').css('text-align', 'right');
		}
	});

</script>

</body>

</html>