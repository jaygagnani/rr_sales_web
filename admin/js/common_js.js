// Pagination functions

	function __getProductsLength(category){
		return $.get("../server/get_catalogue_length.php?category="+category);
	}

	// To display the pagination box
	function paginationLength(category, limit){

		var total_records = 0;
		var total_pages = 1;
		
		__getProductsLength(category).success(function(data){
			
			total_records = data;

			total_pages = total_records / limit ;
			
			total_pages = Math.ceil(total_pages);
			
			if(total_pages == 1){		

				//$("ul.pagination").html("<li class='previous disabled'><a href='#'>Previous page</a></li>");
				$("ul.pagination").append("<li class='disabled'><a href='#'><i class='material-icons'>chevron_left</i></a></li>");

				$("ul.pagination").append("<li class='waves-effect'><a href='#' class='active'>1</a></li>");
				
				$("ul.pagination").append("<li class='disabled'><a href='#'><i class='material-icons'>chevron_right</i></a></li>");
				//$("ul.pagination").append("<li class='next disabled'><a href='#'>Next page</a></li>");

			}
			else if(total_pages > 1){

				//$("ul.pagination").html("<li class='previous'><a href='#' onclick=paginationNavigation('"+ category +"','prev')>Previous page</a></li>");
				$("ul.pagination").append("<li class='waves-effect'><a href='#' onclick=paginationNavigation('"+ category +"','prev')><i class='material-icons'>chevron_left</i></a></li>");
				
				for(i=0; i < total_pages; i++){
					if(i == 0){
						$("ul.pagination").append("<li class='waves-effect'><a href='#' class='active' value='"+ (i+1) +"' onclick=paginationNavigation('"+ category +"',"+ (i+1) +");>" + (i+1) + "</a></li>");
						continue;
					}
					$("ul.pagination").append("<li class='waves-effect'><a href='#' class='abc' value='"+ (i+1) +"' onclick=paginationNavigation('"+ category +"',"+ (i+1) +")>"+ (i+1) +"</a></li>");
				}
				
				$("ul.pagination").append("<li class='waves-effect'><a href='#!' onclick=paginationNavigation('"+ category +"','next');><i class='material-icons'>chevron_right</i></a></li>");
				//$("ul.pagination").append("<li class='next'><a href='#!' onclick=paginationNavigation('"+ category +"','next');>Next page</a></li>");
			}
		});
	}

	// To traverse between pages using the pagination
	function paginationNavigation(category, page){
	
		var page_number = 1;

		var active_page = $(".pagination a.active");

		var i = parseInt(active_page.html());

		if(typeof page == "string"){

			if(page.toUpperCase() == "next".toUpperCase()){
				var last_page = $(".pagination li:nth-last-child(3)>a").html();
				last_page = parseInt(last_page);
			
				if(i){

					if(i >= last_page){
						page_number = i;
					}else{
						page_number = i + 1;
						
						active_page.removeClass("active");
						$(".pagination li a[value="+ page_number +"]").addClass("active");
					}

				}else{

				}
			}else if(page.toUpperCase() == "prev".toUpperCase()){
				var first_page = 1;
				if(i){

					if(i <= first_page){
						page_number = first_page;

					}else{
						page_number = i - 1;

						active_page.removeClass("active");
						$(".pagination li a[value='"+ page_number +"']").addClass("active");
					}

				}else{

				}
			}
			
			//console.log(page + " : " + page_number);

		}else if(typeof page == "number"){

			page_number = page;

			active_page.removeClass("active");
			$(".pagination li a[value='"+ page_number +"']").addClass("active");

		}

		displayProducts(category, page_number);

	}

	// Ajax call to get products for current / selected page

	function displayProducts(category, page_number){
		$("#display-product").html('');
		$.getJSON("../server/fetch_products.php?category=" + category + "&page="+page_number, function(data, status){
			if(data){
				var json_data;
				$.each(data, function(i, product){
					if(product.id){
						json_data = "<div class='col l3 m6 s6 center display_data_in_card'><a href='product_master.php?product="+product.nicename+"'><div class='div_with_bg_img' style='background: url(../"+product.img+");'><div class='div_text_item' style='height: 50px;'>"+product.name+"</div></div></a></div>";
						//json_data = "<div class='col l3 m6 s6 center display_data_in_card'><a href='product_master.php?product="+product.nicename+"'><img src='../"+product.img+"' alt='' class='responsive-img' style='border-bottom:1px solid #000; height: 150px; width: 220px; margin-bottom: 5px;'/></a><br/><center><span>"+product.name+"</span></center></div>";
						$(json_data).appendTo('#display-product');
					}
					else if(product.category_name && product.category_img){
						$('#category_name').val(product.category_name);
						$('#category_name_lbl').hide();
						$('#category_img').attr('src',"../"+product.category_img);
						$('#category_img').on('mouseout',function(){
							$('#category_img').attr('src',"../"+product.category_img);
						});
					}
				});
			}else{
				json_data += "No Category Found";
				$(json_data).appendTo('#displayJson');
			}
		});
	}

//ENDS Pagination Functions

// Product Master Page

function fetchProductDetails(category, product_main){
	$.getJSON("../server/fetch_product_details.php?category="+category+"&product="+product_main, function(data){
		if(data){
			var json_data;
			$.each(data, function(i, product){
				if(product.id){

					$('#product_img').attr('src','../'+product.img);
					$('#product_img').attr('alt',product.name);

					$('#product_name').val(product.name);
					$('#product_name_lbl').hide();

					json_data = "";

					// Product ID
					json_data += "<div class='row'><div class='input-field col l6 m6 s10'>";
						json_data += "<label class='active' for='product_id' data-error='Product ID cannot be empty' data-success='ok'>Product ID *</label>";
          				json_data += "<input id='product_id' name='product_id' type='text' placeholder='Enter ID' class='validate set_editable' value='"+product.product_id+"' disabled required='true' >";
        			json_data += "</div></div>";

        			json_data += "<div class='row'>";
        				
        				// Rate
						json_data += "<div class='input-field col l4 m4 s4'>";
							json_data += "<label class='active' for='product_rate'>Rate (in INR)</label>";
          					json_data += "<input id='product_rate' name='product_rate' type='text' placeholder='Enter rate' class='validate set_editable' value='"+product.rate+"' disabled/>";
        				json_data += "</div>";

        				// Per
        				json_data += "<div class='input-field col l4 m4 s4'>";
							json_data += "<label class='active' for='product_per'>Per</label>";
          					json_data += "<select id='product_per' name='product_per' disabled ><option selected value='"+product.per+"'>"+product.per+"</option></select>";
        				json_data += "</div>";

        				// Min. Quantity
						json_data += "<div class='input-field col l4 m4 s4'>";
							json_data += "<label class='active' for='product_min_qty'>Minimum Quantity</label>";
          					json_data += "<input id='product_min_qty' name='product_min_qty' type='number' min='1' placeholder='Enter minimum quantity' class='validate set_editable' value='"+product.min_qty+"' disabled/>";
        				json_data += "</div>";

        			json_data += "</div>";


        			json_data += "<div class='row'>";

	        			// Vehicle
						json_data += "<div class='input-field col l6 m6 s10'>";
							json_data += "<label class='active' for='product_vehicle'>Vehicle</label>";
          					json_data += "<input id='product_vehicle' name='product_vehicle' type='text' placeholder='Enter vehicle name' class='validate set_editable' value='"+product.vehicle+"' disabled/>";
        				json_data += "</div>";

        				// Wheels
						json_data += "<div class='input-field col l6 m6 s10'>";
							json_data += "<label class='active' for='product_wheels'>Number of Wheels</label>";
          					json_data += "<input id='product_wheels' name='product_wheels' type='number' min='2' max='3' placeholder='Enter number of wheels' class='validate set_editable' value='"+product.wheels+"' disabled/>";
        				json_data += "</div>";

        			json_data += "</div>";

        			// Description
        			json_data += "<div class='row'><div class='input-field col l6 m6 s10'>";
						json_data += "<label class='active' for='product_desc'>Description</label>";

        				if(product.desc)
							json_data += "<input id='product_desc' name='product_desc' type='text' placeholder='Enter description' class='validate set_editable' value='"+product.desc+"' disabled/>";
						else
							json_data += "<input id='product_desc' name='product_desc' type='text' placeholder='Enter description' class='validate set_editable' value='No description' disabled/>";

					json_data += "</div></div>";
					

					// Meta-Data or Extra Information
					if(product.meta_length > 0){
						json_data += "<br/><h6><b>Extra Information</b></h6>";
						json_data += "<hr/>";

						$.each(product.meta_data, function(i, meta_data){

							// Vehicle
							json_data += "<div class='row'><div class='input-field col l6 m6 s10'>";
								json_data += "<label class='active' for='product_"+Object.keys(meta_data)+"'>"+Object.keys(meta_data)+"</label>";
          						json_data += "<input id='product_"+Object.keys(meta_data)+"' name='product_"+Object.keys(meta_data)+"' type='text' placeholder='Enter "+Object.keys(meta_data)+"' class='validate set_editable' value='"+meta_data[Object.keys(meta_data)]+"' disabled/>";
        					json_data += "</div></div>";

						});
						// json_data += "<p>"+$i->key+"</p>";
					}
					else{
						json_data += "</div>";
					}

					$(json_data).appendTo('#display-product-details');
					$('select').material_select();

					fetchDistinctPerValues(product.per);

					$('#save_btn').on('click', function(){
						updateProductDetails(product_main, product);
					});

				}
			});
		}else{
			json_data += "No Category Found";
			$(json_data).appendTo('#display-product-details');
		}
	});
}

function fetchDistinctPerValues(stored_per_value){

	$.getJSON("../server/fetch_product_per_values.php", function(data){
		$.each(data.data, function(i, per_value){

			if(per_value == "" || per_value == null || per_value == "null"){
			}
			else if(stored_per_value.toUpperCase() == per_value.toUpperCase()){

				//$("<option value='"+per_value+"'>"+per_value+"</option>").appendTo('#product_per');
			}
			else{

				$("<option value='"+per_value+"'>"+per_value+"</option>").appendTo('#product_per');
			}

		});
	});
}

function editProductDetails(){
	
	$('input').attr('disabled',false);
	$('select').attr('disabled',false);

	$('select').material_select();
	
	$('#save_btn').show(100);
	$('#change_image_btn').show(100);


	var file_input = $("#change_image_btn input[type=file]");
	var no_of_files = file_input.get(0).files.length;	
	console.log("length : " + no_of_files);
	
}

function updateProductDetails(product_nicename, product){

	var file_input = $("#change_image_btn input[type=file]");
	var no_of_files = file_input.get(0).files.length;
	var img_file = file_input.get(0).files[0];

	var old_name = product.name;

	var name = $('#product_name').val();
	var id = $('#product_id').val();
	var rate = $('#product_rate').val();
	var per = $('#product_per').val();
	var min_qty = $('#product_min_qty').val();
	var vehicle = $('#product_vehicle').val();
	var wheels = $('#product_wheels').val();
	var desc = $('#product_desc').val();

	var wheels_min = $('#product_wheels').prop('min');
	var wheels_max = $('#product_wheels').prop('max');


	var validate = validateProductForm(name, id, rate, per, min_qty, vehicle, wheels_min, wheels_min, wheels_max);
	

	if(validate != true){
		alert(validate);
	}
	else{

		var formData = new FormData($("#product_form")[0]);

		$.ajax({
        	url: "../server/update_product_details.php?nicename="+product_nicename,
        	type: 'POST',
        	data: formData,
        	async: true,
        	error: function(request, error){
        		console.log(request);
        		alert(error);
        	},
        	success: function (data,status) {
		        console.log("data : ");
	           	console.log(data);

	           	var reply = JSON.parse(data);

				console.log(reply);
				
				if((reply.status).toUpperCase() == "success".toUpperCase()){
				
					if((reply.message).toUpperCase() == "name not changed".toUpperCase()){
					
						window.location.reload();
					}
					else if((reply.message).toUpperCase() == "name changed".toUpperCase()){
					
						window.location.href = "./product_master.php?product="+reply.data;
					}
				}

        	},
        	cache: true,
        	contentType: false,
	       	processData: false
    	});
		
	}
}

function validateProductForm(name, id, rate, per, min_qty, vehicle, wheels, wheels_min, wheels_max){
	
	var flag = true;
	var msg = '';

	if(name == "" || name == null){
		msg += "Product name cannot be empty. \n";
		$("#product_name").val(product.name);
		flag = false;
	}
	if(id == "" || id == null){
		msg += "Product ID cannot be empty. \n";
		$("#product_id").val(product.product_id);
		flag = false;
	}
	if(rate == "" || rate == null){
		msg += "Product rate cannot be empty. \n";
		$("#product_rate").val(product.rate);
		flag = false;
	}
	if(per == "" || per == null){
		msg += "Product per cannot be empty. \n";
		$("#product_per").val(product.per);
		flag = false;
	}
	if(min_qty == "" || min_qty == null || min_qty < 1){
		msg += "Product minimum quantity cannot be empty or less than 1. \n";
		$("#product_min_qty").val(product.min_qty);
		flag = false;
	}
	if(vehicle == "" || vehicle == null){
		msg += "Product vehicle cannot be empty. \n";
		$("#product_vehicle").val(product.vehicle);
		flag = false;
	}
	if(wheels == "" || wheels == null){
		msg += "Product wheels cannot be empty. \n";
		$("#product_wheels").val(product.wheels);
		flag = false;
	}
	else if(wheels < wheels_min ||  wheels > wheels_max){
		msg += "Product wheels should be between " + wheels_min +" and " + wheels_max + ". \n";
		$("#product_wheels").val(product.wheels);
		flag = false;
	}

	if(flag){
		return flag;
	}
	else{
		return msg;
	}
}

function deleteProduct(product, category){
	$.get("../server/delete_product.php?product="+product,
		function(data, status){
			if(data == true){
				if(category == null)
					window.location.href = "./master_home.php";
				else
					window.location.href = "./category_master.php?category="+category;
			}
			else{
				alert("Could not delete the product. Try again.");
			}
		}
	);
}

// ENDS Product Master Page


// Order History Page

function fetchOrderHistory(user){

	$.getJSON("../server/fetch_order_history.php", function(data, status){
		
		var order_accordion = $("#order-accordion");
		
		if(data.status == "success"){			
			var panel = '';

			$.each(data.data, function(i, order){
				panel += "<li>";
				panel += "<div class='collapsible-header'>";
				
					panel += "<table> <tbody> <tr>";
					panel += "<td>"+order.sr_no+"</td><td>"+order.user_name+ "<br/> <a>"+order.user_email+"</a> </td><td>"+order.date_time+"</td><td>"+order.transaction_id+"</td><td>"+order.total_amount+"</td><td> <i class='material-icons'>expand_more</i> </td>";
					panel += "</tr> </tbody> </table>";
				
				panel += "</div>";

				panel += "<div id='o"+i+"' class='collapsible-body'>";
				
					panel += "<p><table> <thead> <tr>";
					panel += "<th>Sr. no.</th><th>Product no.</th><th>Product name</th><th>Quantity</th><th>Cost</th><th>&nbsp;&nbsp;</th>";
					panel += "</tr> </thead> <tbody>";

					$.each(order.details, function(j, details){
						panel += "<tr>";
						panel += "<td>"+details.sr_no+"</td><td>"+details.product_id+"</td><td>"+details.product_name+"</td><td>"+details.quantity+"</td><td>"+(parseFloat(details.quantity) * parseFloat(details.rate)).toFixed(3)+"</td><td>&nbsp;&nbsp;</td>";
						panel += "</tr>";
					});

					panel += "</tbody> </table> </p>";
				
				
				panel += "</div>"; // panel-collapse closed

				panel += "</li>";

				
			
			});
		
			order_accordion.append(panel);
			$('.collapsible').collapsible({
				accordian: true
			});

		}
		else{
			order_accordion.html("<br/><span style='font-style: italic; color: red;'>"+data.message+"</span>");
		}

	});
}

// ENDS Order History Page