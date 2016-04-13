<?php

session_start();

?>
<!-- ASAP google font css -->
	<link href='https://fonts.googleapis.com/css?family=Asap:700italic,700,400italic,400' rel='stylesheet' type='text/css'>


<style type="text/css">

	*{
		font-family: 'Asap', sans-serif;
	}

	nav>*{
		text-transform: uppercase;
	}

	navbar>.icon-bar{
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


<nav class="navbar">
	<div class="container" style="width: 92%;">
		<div class="row" style="margin-top: 10px;">

			<div class="navbar-header col-lg-2 col-md-2 col-sm-3">

				<div class="col-lg-12">
					<div style="display: inline-block; height: 40px; width: 80px;">
						<img src="../images/rr_logo.png" class="img-responsive" style="margin-bottom: 20px; height: inherit; width: inherit; margin: 0 auto 10px;"/>
					</div>
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


			<div class="col-lg-10 col-md-10 col-sm-9" style="padding-left: 55px;">
				<div class="collapse navbar-collapse row" id="side-navbar" style="margin-top: 10px;">
					<ul class="nav navbar-nav col-lg-12 col-md-12 col-sm-12">
						<li class="col-lg-6 col-md-4 col-sm-3" style="text-align: center;">
							<div class="form-group">
  								<input type="text" class="form-control" id="search" placeholder="Search by part name, number, model, vehicle" style="float: left; width: 86.2%; margin-right: 0px; border-radius: 4px 0px 0px 4px;">
  								<button type="button" class="btn btn-lg btn-default" style="float:right; position: relative; margin-left: 0px; width: 13.8%; border-radius: 0px 4px 4px 0px; background-color: #333399; color: #fff; padding: 5px; margin-top: -1px;"><span class="glyphicon glyphicon-search"></span></button>
							</div>
						</li>
						<li class="col-lg-1 col-md-1">
						</li>
						<li class="col-lg-1.5 col-md-1.5" style="text-align: right;">
							
							<?php 
								if(!isset($_SESSION['user'])){

							?>
									<a href="#!" data-toggle="modal" data-target="#signInModal"><b><span class="fa fa-user">&nbsp; Sign in</span></b></a>
							<?php
								}
								else{
							?>

								<a href="../server/destroy_session.php" id="signout-link"><b><span class="fa fa-unlock">&nbsp; Sign out</span></b></a>	

								<script type="text/javascript">
									// $("#signout-link").on("click", function(){
									// 	$.ajax({
									// 		url: "../server/"
									// 	})
									// });
								</script>

							<?php
								}

							?>

						</li>
						<li class="col-lg-1.5 col-md-1.5" style="text-align: right;">
							<a href="#"><b><span class="fa fa-phone">&nbsp; Contact</span></b></a>
						</li>
						<li class="col-lg-1.5 col-md-1.5" style="text-align: right;">
							<a href="#"><b><span class="fa fa-shopping-cart">&nbsp; Cart</span></b></a>
						</li>

						<li>
							<?php
								if(isset($_SESSION['user'])){
							?>

									<a href="#"><b><span class="fa fa-shopping-user">&nbsp; Hello <?php echo explode(' ', $_SESSION['user_name'], 2)[0]; ?></span></b></a>

							<?php
								}
							?>
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
      			<center>
      				<span id="error"></span>
      			</center>

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
        			<button type="button" id="login_btn" class="btn btn-default">Submit</button>
        		</center>
      		</div>
    	</div>

  	</div>
</div>



<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script type="text/javascript">
	
	$(document).ready(function(){
		if($('.navbar-toggle').css('display') == "block"){
			$('li').css('text-align', 'left');
		}else if($('.navbar-toggle').css('display') == "none"){
			$('li').css('text-align', 'right');
		}

		$('#login_btn').on('click', function(){
			validateSignIn();
		});

		$("#error").hide();

	});

	$(window).resize(function(){
		if($('.navbar-toggle').css('display') == "block"){
			$('li').css('text-align', 'left');
		}else if($('.navbar-toggle').css('display') == "none"){
			$('li').css('text-align', 'right');
		}
	});


	function validateSignIn()
    {
    	var email = $("#email").val();
        var password = $("#password").val();

        console.log("\n" + email);
        console.log("\n" + password);
              
        if((email=="")&&(password!="")) //if email is blank
        {
            $("#error").html = "<h5>Enter Email ID !</h5>";
        }
        else if((email!="")&&(password=="")) //if password is blank
		{
			$("#error").html = "<h5>Enter Password !</h5>";
		}
		else if((email=="")&&(password=="")) //if both are blank
		{
			$("#error").html = "<h5>Enter Email ID and Password !</h5>";
		}
		else{
			//alert(2);
			$.post("../server/user_login.php",
			{
				email: email,
				password: password
			},
			function(data,status){

				jsonObj = JSON.parse(data);
                
				if(jsonObj[0] == "false"){
					$("#error").html("<h5>Incorrect Email ID and/or Password !</h5>");
					$("#error").show(100);
				}
				else if(jsonObj.user_role == "admin"){
					
					window.location.href = "../admin/master_home.php";
				}
				else if(jsonObj.user_role == "user"){

					window.location.reload();

				}
			});
		}
	}

</script>
