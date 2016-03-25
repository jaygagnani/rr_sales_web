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
	<link href="../css/materialize.css" rel="stylesheet" type="text/css" hreflang="en">

<!-- Link custom stylesheets -->
	<link href="./css/common_styles.css" rel="stylesheet" type="text/css" hreflang="en">

</head>

<body>

<?php
	require_once('./navbar_layout.php');
?>

<div class="row">
	<div class="col l1 m1"><br/></div>
	<div class="col l0 m10 s12">
		<div class="card">
			<div class="card-content">
				<div class="row" id="display-category" style="padding:20px; padding-top: 30px;">
					<!-- Categories will be printed here from fetchCategories() method -->
				</div>
			</div>
		</div>
	</div>
	<div class="col l1 m1">
		<div class="fixed-action-btn" id="add_category_btn" style="right: 96px; bottom: 43px;">
			<a class="btn-floating btn-large waves-effect waves-light red modal-trigger" href="#add_category_modal">
				<i class="material-icons">add</i>
			</a>
		</div>
	</div>
</div>


<!-- Add Category Modal -->
<div id="add_category_modal" class="modal">
	<div class="modal-header">
		<h5 style="margin-left: 30px;">Add Category</h5>
		<hr/>
	</div>
	<div class="modal-content" style="padding: 30px;">
		<div class="row">
			<form id="add_category_form" enctype="multipart/form-data" action="../server/add_category.php" method="POST">
				<div class="col l6 m12 s12">
					<div class="input-field">
						<input id="category_name" name="category_name" type="text" class="validate"/>
						<label for="category_name">Category Name</label>
					</div>
				</div>
				
				<div class="col l6 m12 s12">
					<div class="center" style="width: 100%;">
						<img id="disp_category_img" name="category_img" class="responsive-img center" style="display: none;"/>
					</div>
					<div action="#" class="center">
	    				<div class="file-field input-field center">
      						<div class="row" id="file_path_tb" style="display: none;">
	      						<div class="file-path-wrapper center row">
		        					<input class="file-path validate" id="disp_tmp_path" type="text" placeholder="File Path"/>
      							</div>
      						</div>
      						<div class="row">
			      				<div class="btn" style="margin-left: 25%;">
	        						<span>Upload Image</span>
        							<input type="file" name="category_img_file" id="i_file"/>
      							</div>
      						</div>
      					</div>
  					</div>
  				</div>
  				<div class="row center">
  					<button class="btn waves-effect waves-light" type="submit" name="action">Submit</button>
  				</div>
  			</form>
		</div>
	</div>
</div>
<!-- Add Category Modal Ends -->


<!-- Scripts Section -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>
<script type="text/javascript" src="../js/search_keyword.js"></script>

<script>

$(document).ready(function(){
	fetchCategories();

	$('.modal-trigger').leanModal();


	$('#i_file').change(function(event) {
		if(event.target.files[0]){
			var tmppath = URL.createObjectURL(event.target.files[0]);
			$('#disp_category_img').attr('src',URL.createObjectURL(event.target.files[0]));
    		$('#disp_category_img').show(1000);
    		$('#file_path_tb').show(1000);
		}else{		
			$('#disp_category_img').attr('src', '');
    		$('#disp_category_img').hide();
    		$('#file_path_tb').hide();
		}
    	
	});


// Attach a submit handler to the form
	$('#add_category_form').submit(function(){

		// Stop form from submitting normally
		event.preventDefault();

		if($('#category_name').val()){
			var formData = new FormData($(this)[0]);

			$.ajax({
        		url: $(this).attr('action'),
        		type: 'POST',
        		data: formData,
        		async: false,
        		error: function(request, error){
        			console.log(request);
        			alert(error);
        		},
        		success: function (data,status) {
		            //alert(data + " , " + status)
	            	fetchCategories();
	            	$('#category_name').val("");
					$('#add_category_modal').closeModal();
        		},
        		cache: false,
        		contentType: false,
	        	processData: false
    		});

		}else{
			$('#category_name').css('border-bottom','2px solid red');
			$('#category_name').focus(function(){
				$(this).css('box-shadow','0 1px 0 0red');
			});
			$('#category_name ~ label').css('color','red');
			$('#category_name ~ label').html('Please enter Category Name');
		}


		return true;

	});

});
	
function fetchCategories(){
	$('#display-category').html('');
	$.getJSON("../server/fetch_categories.php", function(data){
		if(data){
			var json_data;
			$.each(data, function(i, category){
				json_data = "<div class='col l3 m6 s6 center display_data_in_card'><a href='category_master.php?category="+category.nicename+"'><img src='../"+category.img+"' alt='' class='responsive-img' style='border-bottom:1px solid #000; height: 150px; width: 220px; margin-bottom: 5px;'/></a><br/><center><span>"+category.name+"</span></center></div>";
				//json_data = "<a href='./category_master.php?category="+category.nicename+"' style='color: #000; font-size: 1.2em;'><div class='col l3 m4 s6 center display_data_in_card' style='background-image: url(../"+category.img+"); background-size:200px; background-repeat: no-repeat; height:170px;'><center><p style='margin-left: -12px; background-color: #000; color: #fff; position: relative;'>"+category.name+"</p></center></div></a>";
				//<img src='../"+category.img+"' alt='"+category.name+"' class='responsive-img' style='height: 150px; width: 200px;'/><p style='background-color:#000; filter: blur(12px); -webkit-filter: blur(12px);'>"+category.name+"</p>
				$(json_data).appendTo('#display-category');
			});
		}else{
			json_data += "No Category Found";
			$(json_data).appendTo('#displayJson');
		}
	});
}


</script>


</body>

</html>