<?php

if(!session_id())
	session_start();

if(!isset($_GET['category']))
	header('Location: master_home.php');

$_SESSION['category_nicename'] = $_GET['category'];

?>

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
	<div class="col l3 m3 s12">
		<div class="card" style="left: 15px;">
			<div class="card-content">
				<img id="category_img" src="" class="responsive-img" style="width: 100%; height: inherit; padding: 0px;"/>
			</div>
		</div>

		<div class="row">
			<div class="col l12 m12 s4">
        			<a href="../server/download_category.php?category=<?php echo $_GET['category']; ?>" class="waves-effect waves-light btn" style="margin-top: 25px; background-color: #333399; color: #fff;">Download Catalogue</a>
        	</div>

			<div class="col l12 m12 s4">
        		<!--	<a class="waves-effect waves-light btn" style="margin-top: 25px; background-color: red; color: #fff;">Print Catalogue</a>	-->
        	</div>

			<div class="col l12 m12 s4">
        		<a class="waves-effect waves-light btn" onclick="deleteCategory();" style="margin-top: 25px; background-color: red; color: #fff;">Delete Category</a>
        	</div>
        </div>
	</div>
	<div class="col s3 hide-on-med-and-up"><br/></div>

	<div class="col l9 m9 s12">
		<div class="row">
			<div class="col l12 m12 s12">
				<div class="col s1 hide-on-med-and-up"><br/></div>
				<div class="input-field col l6 m6 s10">
					<label for="category_name" id="category_name_lbl">Category Name</label>
          			<input id="category_name" type="text" class="validate" disabled="true" onkeypress="saveCategoryName(event, this);" onblur="resetCategoryName();" style="float:left; font-style: bold; font-size: 2em;">
          			<a href="#" onclick="editCategoryName()"><i class="material-icons prefix" style="color: #333399;">mode_edit</i></a>
          			<div class="row" style="color: #333399;">
          				<span>Press enter to save.</span>
          			</div>
        		</div>
        		
        		<!-- <div class="col s1 hide-on-med-and-up"><br/></div> -->
			</div>
		</div>

		<div class="row">

			<div class="col l12 m12 s12">
				<div class="card" style="width: 97%;">
					<div class="card-content">

						<div class="row">
							<div class="col l12 m12 s12">
								<?php include('./pagination.php'); ?>
							</div>
						</div>

						<div class="row" id="display-product" style="padding:20px;">
							<!-- Products will be printed here from fetchProducts() method -->
						</div>

						<div class="row">
							<div class="col l12 m12 s12">
								<?php include('./pagination.php'); ?>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="fixed-action-btn" id="add_product_btn" style="right: 24px; bottom: 43px;">
			<a class="btn-floating btn-large waves-effect waves-light red modal-trigger" href="./add_product.php">
				<i class="material-icons">add</i>
			</a>
		</div>
</div>


<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="./js/materialize.js"></script>

<script type="text/javascript" src="./js/common_js.js"></script>

<script type="text/javascript">

category_name=null;

var DISPLAY_LIMIT = 40;
var CURR_PAGE = 1;
var TOTAL_RECORDS = 0;

var CATEGORY = "<?php echo $_GET['category']; ?>";


$(document).ready(function(){
	$('.input-field span').hide();

	paginationLength("<?php echo $_GET['category']; ?>", DISPLAY_LIMIT);

	paginationNavigation("<?php echo $_GET['category']; ?>", CURR_PAGE);

	//$('.modal-trigger').leanModal();

});

// history.pushState(null, null, "<?php echo $_SERVER['REQUEST_URI']; ?>");
// window.addEventListener('popstate', function(event){
// 	window.location.assign("./master_home.php");
// });


function editCategoryName(){
	$('#category_name').attr('disabled',false);
	category_name = $('#category_name').val();
	$('.input-field span').show(100);
	$('#category_name').focus();
}

function resetCategoryName(){
	$('#category_name').val(category_name);
	$('#category_name').attr('disabled',true);
}

function saveCategoryName(e, cat_name){
	//var code = (e.keyCode ? e.keyCode : e.which);
	if(e.keyCode == 13){
		if($.trim($('#category_name').val()) == ""){
			// Do Nothing
		}else{
			category_name = $('#category_name').val();
			updateCategoryNameInDb(category_name);
			cat_name.blur();
			$('.input-field span').hide(100);
		}
	}
}

function updateCategoryNameInDb(category_name){
	$.get("../server/update_category.php?category=<?php echo $_SESSION['category_nicename'] ?>&category_new_name="+category_name,
		function(data,status){
			//alert(data+"\n"+status);
			if(status == "success"){
				//alert(data + "\n2 : <?php echo $_SESSION['category_nicename']; ?>");
				window.location.href="./category_master.php?category=" + data;
			}
		}
	);
}

function deleteCategory(){
	$.get("../server/delete_category.php?category=<?php echo $_SESSION['category_nicename']; ?>", 
		function(data, status){
			if(data == true)
				window.location.href = "./master_home.php";
			else
				alert("Some problem was occured. Please try again!");
		}
	);
}

</script>

</body>

</html>