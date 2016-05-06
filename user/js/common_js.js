function setMainDisplayContainer(obj){
	if($(obj).width() < 992){
		$('#category-container').css('padding-left','0px');
		$('#search-results-div').css('padding-left','0px');
	}else{
		$('#category-container').css('padding-left','65px');
		$('#search-results-div').css('padding-left','65px');
	}
}

// Pagination functions

	function __getProductsLength(category){
		return $.get("../server/get_catalogue_length.php?category="+category);
	}

	// To display the pagination box
	function paginationDisplay(category, limit, data){

		var total_records = 0;
		var total_pages = 1;
		
		//__getProductsLength(category).success(function(data){
			
			total_records = data;

			total_pages = total_records / limit ;
			
			total_pages = Math.ceil(total_pages);
			
			if(total_pages == 1){		

				$("ul.pagination").html("<li class='previous disabled'><a href='#'>Previous page</a></li>");
				$("ul.pagination").append("<li class='disabled'><a href='#'>&#x25C4</a></li>");

				$("ul.pagination").append("<li><a href='#' class='active'>1</a></li>");
				
				$("ul.pagination").append("<li class='disabled'><a href='#'>&#x25BA</a></li>");
				$("ul.pagination").append("<li class='next disabled'><a href='#'>Next page</a></li>");

			}
			else if(total_pages > 1){

				$("ul.pagination").html("<li class='previous'><a href='#' onclick=paginationNavigation('"+ category +"','prev',"+ limit +","+ total_records +")>Previous page</a></li>");
				$("ul.pagination").append("<li><a href='#' onclick=paginationNavigation('"+ category +"','prev',"+ limit +","+ total_records +")>&#x25C4</a></li>");
				
				for(i=0; i < total_pages; i++){
					if(i == 0){
						$("ul.pagination").append("<li><a href='#' class='active' value='"+ (i+1) +"' onclick=paginationNavigation('"+ category +"',"+ (i+1) +","+ limit +","+ total_records +");>" + (i+1) + "</a></li>");
						continue;
					}
					$("ul.pagination").append("<li><a href='#' class='abc' value='"+ (i+1) +"' onclick=paginationNavigation('"+ category +"',"+ (i+1) +","+ limit +","+ total_records +")>"+ (i+1) +"</a></li>");
				}
				
				$("ul.pagination").append("<li><a href='#!' onclick=paginationNavigation('"+ category +"','next',"+ limit +","+ total_records +");>&#x25BA</a></li>");
				$("ul.pagination").append("<li class='next'><a href='#!' onclick=paginationNavigation('"+ category +"','next',"+ limit +","+ total_records +");>Next page</a></li>");
			}
		//});
	}

	// To traverse between pages using the pagination
	function paginationNavigation(category, page, limit, total_records){
	
		var page_number = 1;

		var next, next_symbol, last, last_symbol;

		previous = $(".pagination li:first-child");
		previous_symbol = $(".pagination li:nth-child(2)");

		next = $(".pagination li:last-child");
		next_symbol = $(".pagination li:nth-last-child(2)");

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


		// if((page_number > 1) && (page_number < $(".pagination li:nth-last-child(3)").html())){

		// 	alert(1);
		// 	if(next.hasClass("disabled") || next_symbol.hasClass("disabled")){
		// 		next.removeClass("disabled");
		// 		next_symbol.removeClass("disabled");
		// 	}
		// 	if(previous.hasClass("disabled") || previous_symbol.hasClass("disabled")){
		// 		previous.removeClass("disabled");
		// 		previous_symbol.removeClass("disabled");
		// 	}
		// }
		// else if(page_number <= 1){

		// 	alert(2);

		// 	previous.addClass("disabled");
		// 	previous_symbol.addClass("disabled");

		// 	if(next.hasClass("disabled") || next_symbol.hasClass("disabled")){
		// 		next.removeClass("disabled");
		// 		next_symbol.removeClass("disabled");
		// 	}
		// }
		// else if(page_number >= $(".pagination li:nth-last-child(3)").html()){

		// 	alert(3);

		// 	next.addClass("disabled");
		// 	next_symbol.addClass("disabled");

		// 	if(previous.hasClass("disabled") || previous_symbol.hasClass("disabled")){
		// 		previous.removeClass("disabled");
		// 		previous_symbol.removeClass("disabled");
		// 	}
		// }

		displayProducts(category, page_number, limit);

		var last_record = (page_number) * limit;
		var first_record = (last_record - limit) + 1;

		if(page_number == $(".pagination li:nth-last-child(3)>a").html()){
			last_record = total_records;
		}

		$("#product-count").html("Showing " + first_record + " - " + last_record + "products."); 

	}

	// Ajax call to get products for current / selected page
		// function displayCatalogue(){

		// }

	function displayProducts(category, page_number, limit){
		console.log(category + " : " + page_number);
		$("#display-product").html('');
		$.getJSON("../server/fetch_products.php?category=" + category + "&limit="+limit+"&page="+page_number, function(data, status){
			if(data){
				var json_data;
			
				$("#title").html(data[0].category_name);

				if(data.length > 1){
					
					$.each(data, function(i, product){
						if(product.id){
							json_data = "<div class='col-lg-3 col-md-4 col-sm-6 display_catalogue'><a href='./product.php?product="+product.nicename+"'><div class='div_with_bg_img' alt='"+product.name+"' style='background: url(../"+product.img+"); background-size:100%; '><div class='div_text_item'>"+product.name+"</div></div></a></div>";
							$(json_data).appendTo("#display-product");
						}
					});
					$(".pagination").show() ;

				}else{

					$("#display-product").html("<i style='color: red; text-transform: none;'>Sorry! No products within this category.</i>");
					$(".pagination").hide() ;
					$("#product-count").hide() ;

				}
			}else{

				alert(2);
				$("#display-product").html("<i style='color: red; text-transform: none;'>Sorry! No products within this category.</i>");
				$(".pagination").hide() ;
				$("#product-count").hide() ;

			}
		});
	}

//ENDS Pagination Functions

// Product Details

	function fetchProductDetails(user, category, product_main){

		$.getJSON("../server/fetch_product_details.php?category="+ category +"&product="+ product_main, function(data){
			
			if(data){
				var json_data;

				$('ul.breadcrumb').html("<li><a href='./'>Home</a></li>");
				if(category){
					$("<li><a href='./category_master.php?category="+ category +"'>"+ data[0].category_name +"</a></li>").appendTo('ul.breadcrumb');
				}else{
					$("<li><a href='./category_master.php?category="+ data[0].category_nicename +"'>"+ data[0].category_name +"</a></li>").appendTo('ul.breadcrumb');
				}
				$("<li><a href='#'>"+ data[0].name +"</a></li>").appendTo('ul.breadcrumb');

				
				$.each(data, function(i, product){
					if(product.id){

						$('#product-img').attr('src','../'+product.img);
						$('#product-img').attr('alt',product.name);

						$('#product-name').html(product.name);
						$('#product-id').html(product.product_id);

						$('#product-vehicle').html(product.vehicle);
						$('#product-rate').html(product.rate);
						$('#product-per').html(product.per);
						$('#product-min-qty').html(product.min_qty);

						var quantity_input = $('#quantity-input');

						quantity_input.val(product.min_qty);
						quantity_input.attr('min', product.min_qty);
						quantity_input.attr('step', product.min_qty);

						if(product.desc != null && product.desc != ""){
							$('#product-desc').show();
							$('#product-desc #desc').html(product.desc);
						}
						else{
							$('#product-desc').hide();
						}

						if(!user){
							$('#add-to-cart-btn').attr('disabled','true');
							$('#buy-now-btn').attr('disabled','true');
							$('#error-msg').show();
						}

						$('#add-to-cart-btn').on('click', function(){
							var quantity = parseInt(quantity_input.val());
							var error_msg_dom = $('#quantity-error-msg');
							
							if(__checkProductQuantity(quantity, product.min_qty, quantity_input, error_msg_dom)){
								addToCart(user, product_main, quantity);
							}
							
						});

						$('#buy-now-btn').on('click', function(){
							var quantity = parseInt($("#quantity-input").val());

							var error_msg_dom = $('#quantity-error-msg');

							if(__checkProductQuantity(quantity, product.min_qty, quantity_input, error_msg_dom)){
							
								$.getScript("./js/jquery.redirect.js", function(){
									$.redirect( "./order.php", {"product": product_main, "order_qty": quantity} );
								});
							
							}
						});

						

						if(product.meta_length > 0){
							
							$('#product-extra').show();

							json_data = "";

							$.each(product.meta_data, function(i, meta_data){

								json_data += "<p><b>" + Object.keys(meta_data) + "</b></p>";
								json_data += "<p>" + meta_data[Object.keys(meta_data)] + "</p>";

							});
							// json_data += "<p>"+$i->key+"</p>";
						}
						else{
							$('#product-extra').hide();
						}

						$(json_data).appendTo('#product-extra');
					}
				});
			}else{
				json_data += "No Category Found";
				$(json_data).html('#display-product-details');
			}
		});
	}

	function fetchDistinctVehicles(){
		$.getJSON("../server/fetch_distinct_vehicles.php", function(data, status){
			if(data.status == "success")
			{
				var vehicle_select_obj = $("#by_vehicle_name");

				$.each(data.data, function(i, vehicle){
					$("<option value='"+vehicle+"'>"+vehicle+"</option>").appendTo(vehicle_select_obj);
				});
			}
		});
	}

// ENDS Product Details

// Similar Products Carousel

function similarProductsCarousel(){
	$('#myCarousel').carousel({
	  interval: 10000
	});

	$('.carousel .item').each(function(){
  		var next = $(this).next();
  		if (!next.length) {
    		next = $(this).siblings(':first');
  		}
  		next.children(':first-child').clone().appendTo($(this));
	  
  		if (next.next().length>0) {
    		next.next().children(':first-child').clone().appendTo($(this));
  		}
  		else {
  			$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
  		}
	});
}

function fetchSimilarProducts(product){

	$.getJSON("../server/fetch_similar_products.php?product=" + product, function(data, status){

		console.log(data);

		if(data){
			var json_data = '';

			$.each(data, function(i, product){
				json_data += "<div class='item'><a href='./product.php?category="+ product.category_name +"&product="+ product.nicename +"'><img src='"+ product.img +"' alt='"+ product.name +"' class='img-responsive'></a></div>";
			});

			$('.carousel-inner').html(json_data);

			$('.carousel-inner:first-child>.item').addClass('active');

		}
		else{
			$('#similar-products').hide();
		}
	});
}

// ENDS Similar Products Carousel

// Cart Functions

function addToCart(user, product_nicename, quantity){
	$.post('../server/add_to_cart.php',
		{
			'user' : user,
			'product' : product_nicename,
			'quantity' : quantity
		},

		function(data,status){
			
			console.log(data);
			var reply = JSON.parse(data);
			
			if(data.status == "success" && (data.message).toUpperCase() == "added to cart.".toUpperCase()){
				var cart_badge = $(".badge");
				var cart_count = parseInt(cart_badge.html());

				cart_badge.html(cart_count+1);
			}

			console.log(reply.status);
			console.log(reply.message);
			$('#error-msg').html(reply.message);
			$('#error-msg').show();
		}
	);
}


function fetchCart(user, page){
	$.get('../server/fetch_cart.php?user='+user,
		function(data, status){
			var reply = JSON.parse(data);

			if(status == "success"){
			
				if(reply.status == "success"){
					console.log("status : " + reply.status);
					console.log("message : " + reply.message);
					console.log("data : " + reply.data);

					if(page == "cart"){

						var table_dom = $('.table tbody');
						$(table_dom).html('');

						var table_data = '';
						
						var sub_total = 0;
						
						if($.trim(reply.data) != "" && $.trim(reply.data) != null){
							$.each(reply.data, function(i, cart_item){
								
								sub_total += parseFloat(cart_item.product_sub_total);
								table_data = "<tr name='"+cart_item.product_nicename+"'><td>"+ cart_item.product_name +"</td><td style='width: 10em;'><input class='quantity-input' type='number' id='qty"+ i +"' min="+ parseInt(cart_item.product_min_quantity) +" step='"+ parseInt(cart_item.product_min_quantity) +"' value='"+ parseInt(cart_item.product_quantity) +"' style='width: 9rem;'> <span id='quantity-error-msg"+ i +"' class='error-msg-display' hidden></span> </td><td>"+ cart_item.product_rate +"</td><td id='subtotal"+i+"'>"+ cart_item.product_sub_total +"</td></tr>";

								$(table_data).appendTo(table_dom);

								$("#qty"+i).on("blur", function(){
									qty_flag = __checkProductQuantity($('#qty'+i).val(), cart_item.product_min_quantity, $('#qty'+i), $('#quantity-error-msg'+i));

									if(qty_flag){
										$('#quantity-error-msg'+i).hide();

										var new_product_subtotal = parseInt($('#qty'+i).val()) * parseFloat(cart_item.product_rate);
										$('#subtotal'+i).html(new_product_subtotal.toFixed(3));

										calcCartTotalCost($('#total-cart-cost'));
										
									}else{
										$('#qty'+i).val(parseInt(cart_item.product_quantity));
									}

								});

							});
							calcCartTotalCost($('#total-cart-cost'));
							//$('#total-cart-cost').html(sub_total.toFixed(3));
							$('.table tbody tr td').addClass("no-border");
						}
						else{
							table_dom.html("<tr><td colspan=4 style='color: red; font-style: italic;'><center>No products in your cart.</center></td></tr>");
						}
					}
					else if(page == "order"){
						
						$("#change-qty-link").prop("href", "./cart.php");

						var product_list_ol = $("ol#products-list");
						product_list_ol.html('');
						product_list_ol.css("margin-top", "20px");
						var ol_item;

						var total_cost = 0;

						$.each(reply.data, function(i, cart_item){
							console.log(cart_item);
							var item_name = cart_item.product_name;
							var qty = cart_item.product_quantity;
							var per = cart_item.product_per;
							var cost = cart_item.product_sub_total;

							total_cost += parseFloat(cost);

							ol_item = "<li> <b>"+item_name+"</b><br/>"+qty+" "+per+"<br/>INR "+cost+"<br/><hr/></li>";
							$(ol_item).appendTo(product_list_ol);
						});

						discount = parseFloat(total_cost) * 0.60;
						$("#total-discount").html(discount.toFixed(3));
						$(".total-amount").html(total_cost.toFixed(3));

					}
				}
			}
		}
	);
}

function calcCartTotalCost(output_obj){
	var total_rows = $("#cart-table tbody tr").length;
	var product_subtotal = 0;
	var total = 0;

	for(i=0; i<total_rows; i++){
		product_subtotal = $("#cart-table tbody tr").eq(i).find("td:last-child").html();
		//product_subtotal = $("#cart-table tbody tr:eq("+i+") td:last-child").html();
		total += parseFloat(product_subtotal);
	}

	output_obj.html(total.toFixed(3));
}

function showCartBadge(user){
	$.getJSON("../server/count_cart.php?user="+user, function(data, status){
		console.log(data.data);
		$(".badge").html(data.data);
	});
}

function finalizeCart(user){

	var tbody_tr = $("#cart-table tbody tr");
	var total_tr = tbody_tr.length;

	var nicename = [];
	var qty = [];
	var subtotal = [];

	for(i=0; i<total_tr; i++){
		nicename.push(tbody_tr.eq(i).attr("name"));
		qty.push(tbody_tr.eq(i).find("td:nth-child(2) .quantity-input").val());
		subtotal.push(tbody_tr.eq(i).find("td:last-child").html());
	}

	console.log(nicename);
	console.log(qty);

	console.log(user);

	$.getJSON("../server/updateCart.php", 
		{
			"user": user,
			"row_length": total_tr,
			"nicename": nicename,
			"qty": qty,
			"subtotal": subtotal
		},
		function(data, status){
			if(data.status == "success"){
				window.location.href='./order.php?cart=1';
			}
			else{
				alert(data.message);
			}
		}
	);
	
}

// ENDS Cart Functions




// Search Functions

function getFilters(){

	var by_vehicle_name_obj = $("#by_vehicle_name");
	var by_wheels_obj = $("#by_wheels");
	var wheels_2_obj = $("#wheels_2_cb");
	var wheels_3_obj = $("#wheels_3_cb");
	var searh_keyword_btn = $("#search-keyword-btn");
	var searh_keyword_tf = $("#search");

	var vehicle_name = '';
	var wheel_2 = '';
	var wheel_3 = '';
	var search_keyword = '';

	wheel_2 = wheels_2_obj.prop("checked");
	wheel_3 = wheels_3_obj.prop("checked");
	vehicle_name = by_vehicle_name_obj.val();

	
	searh_keyword_tf.on("keyup", function(event){
		if(event.which == 13){
			search_keyword = searh_keyword_tf.val().trim();

			if(/^[a-zA-Z0-9- ]*$/.test(search_keyword) == false){
				search_keyword = search_keyword.replace(/[\W\D\S^//]*/, "");
			}

			filterSearch(vehicle_name, wheel_2, wheel_3, search_keyword);
		}
	});

	searh_keyword_tf.on("blur", function(event){
		search_keyword = searh_keyword_tf.val().trim();
		if(search_keyword == ""){
			filterSearch(vehicle_name, wheel_2, wheel_3, search_keyword);
		}
	});

	searh_keyword_btn.on("click", function(){
		search_keyword = searh_keyword_tf.val();

		if(/^[a-zA-Z0-9- ]*$/.test(search_keyword) == false){
			search_keyword = search_keyword.replace(/[\W\D\S]*/, "");
		}

		filterSearch(vehicle_name, wheel_2, wheel_3, search_keyword);
	});

	by_vehicle_name_obj.on("change", function(){
		vehicle_name = by_vehicle_name_obj.val();

		filterSearch(vehicle_name, wheel_2, wheel_3, search_keyword);
	});

	wheels_2_obj.on("change", function(){
		wheel_2 = wheels_2_obj.prop("checked");

		filterSearch(vehicle_name, wheel_2, wheel_3, search_keyword);
	});


	wheels_3_obj.on("change", function(){
		wheel_3 = wheels_3_obj.prop("checked");

		filterSearch(vehicle_name, wheel_2, wheel_3, search_keyword);
	});

	if( (vehicle_name == '' || vehicle_name == null || vehicle_name == "null") && wheel_2 == false && wheel_3 == false ){
		$("#search-results-div").hide();

	}else{
		filterSearch(vehicle_name, wheel_2, wheel_3, search_keyword);
	}

}

function filterSearch(vehicle_name, wheel_2, wheel_3, search_keyword){
	
	var search_result_div = $("#search-results-div");

	if( (vehicle_name == '' || vehicle_name == null || vehicle_name == "null") && wheel_2 == false && wheel_3 == false && (search_keyword == '' || search_keyword == null || search_keyword == "null")){
		search_result_div.html("");
		search_result_div.hide();
		$("#by_vehicle_name:first-child").attr("selected", "true");
	}else{
	
		$.getJSON("../server/user_filter_search.php?vehicle="+vehicle_name+"&wheel_2="+wheel_2+"&wheel_3="+wheel_3+"&search_keyword="+search_keyword,
			function(data, status){

				var disp_search_result = $("#display-search-result");

				if(data.status == "success"){

					search_result_div.show();

					if(data.message == "true"){
						$(disp_search_result).html("");

						$.each(data.data, function(i, product){
							if(product.id){
								json_data = "<div class='col-lg-3 col-md-4 col-sm-6 display_catalogue'><a href='./product.php?product="+product.nicename+"'><div class='div_with_bg_img' alt='"+product.name+"' style='background: url(../"+product.img+"); background-size:100%; '><div class='div_text_item'>"+product.name+"</div></div></a></div>";
								$(json_data).appendTo(disp_search_result);
							}
						});

					}
					else{
						$(disp_search_result).html("<i style='color: red;'>" + data.message + "</i>");
					}
				}
				else{
					search_result_div.hide();
					alert(data.message);
				}
			}
		);
	}
}

// ENDS Search Functions


// User Related Functions

function registerNewUser(){

	var full_name = '';
	var company_name = '';
	var contact_number = '';
	var email = '';

	var register_reply = $("#main-container #register-reply div");

	var pattern = / /;
	var flag = "true";

	$("#user-register-form").on("submit", function(e){

		e.preventDefault();

		full_name = $.trim($("#full-name").val());
		company_name = $.trim($("#company-name").val());
		contact_number = $.trim($("#contact-number").val());
		email = $.trim($("#register-email").val());

		// validate full name
		if(full_name != "" && full_name != null){
			pattern = /^[a-zA-Z\s*]+$/;
			
			if(!pattern.test(full_name)){
				
				register_reply.html("Your name should contain only charaters and a space");
				flag = "false";
				return null;
			}
			else{
				register_reply.html('');
			}
		}
		else{
			register_reply.html("Please enter your name.");
			flag = "false";
			return null;
		}


		// validate company name
		if(company_name != "" && company_name != null){
			pattern = /^[a-zA-Z\s0-9*]+$/;
			
			if(!pattern.test(company_name)){
				
				register_reply.html("Company name should contain only charaters and a space");
				flag = "false";
				return null;
			}
			else{
				register_reply.html('');
			}
		}
		else{
			register_reply.html('');
		}

		// validate contact number
		if(contact_number != "" && contact_number != null){
			pattern = /^[0-9]+$/;
			
			if(!pattern.test(contact_number)){
				
				register_reply.html("Contact number should contain only digits");
				flag = "false";
				return null;
			}
			else{
				register_reply.html('');
			}
		}
		else{
			register_reply.html("Please enter your contact number.");
			flag = "false";
			return null;
		}

		// validate email
		if(email == "" || email == null){
			register_reply.html("Please enter your email ID.");
			flag = "false";
			return null;
		}
		else{
			register_reply.html('');
		}

		if(flag == "true"){
			$.getJSON("../server/register_new_user.php?full_name="+full_name+"&company_name="+company_name+"&contact_number="+contact_number+"&email="+email,
				function(data, status){

					register_reply.html(data.message);
					
					if(data.status == "success"){
						register_reply.css("color", "#333399");
						register_reply.css("font-weight", "bold");

						__sendMail("../server/send_mail.php", email, data.data, register_reply, "register");
					}
					
				}
			);
		}

	});
	
}

function fetchUserAddress(user, dom_element_name){
	$.getJSON("../server/fetch_user_address.php?user="+user, 
		function(data, status){
			if(data.status == "success"){

				var address = data.data;
				if(dom_element_name == "textbox"){
					$("#add-line-1").val(address.addressline1);
					$("#add-line-2").val(address.addressline2);
					$("#area").val(address.area);
					$("#town").val(address.town);
					$("#pincode").val(address.pincode);
					$("#state").val(address.state);
					$("#country").val(address.country);
				}
				else if(dom_element_name == "span"){
					if(address.addressline1 != '' && address.addressline1 != null){
						$("#buyer-name").html(address.user_name);
						$("#add-line-1").html(address.addressline1);
						
						if($.trim(address.addressline2) == "" || address.addressline2 == null){
							$("#add-line-2").css("display", "none");
						}
						else{
							$("#add-line-2").html(address.addressline2 + "<br/>");
							$("#add-line-2").css("display", "block");
						}

						$("#area").html(address.area);
						$("#town").html(address.town);
						$("#pincode").html(address.pincode);
						$("#state").html(address.state);
						$("#country").html(address.country);
					}
					else{
						window.location.href = "./address_select.php?update=true";
					}
				}
			}
		}
	);
}

function forgotPassword(email){
	var email = $("#email-forgot-password").val();
    var error = $("#error-forgot-password");
              
    if(email == "" || email == null)//if email is blank
    {
    	error.css("color", "red");
		error.css("font-style", "italic");
        
        error.html('<h5>Enter Email ID !</h5>');
    }
    else{
    	$.post("../server/forgot_password.php?email="+email,
			function(data,status){

				jsonObj = JSON.parse(data);
                
				if(jsonObj.status == "success"){
					error.css("color", "#333399");
					error.css("font-weight", "bold");
				}
				else if(jsonObj.status == "failed"){
					error.css("color", "red");
					error.css("font-style", "italic");
				}

				error.html(jsonObj.message);
				console.log(jsonObj.message);
			}
		);
    }


}


function fetchUserProfile(user){
	$.getJSON("../server/fetch_user_details.php?user="+user, function(data, status){
		
		if(status == "success"){
			if(data.status == "success"){
				var address = '';

				$.each(data.data, function(i, user){

					$("#user-name").html(user.name);

					// For textboxes in edit profile
					$("#edit-name").val(user.name);

					$("#user-contact").html(user.contact);

					// For textboxes in edit profile
					$("#edit-contact").val(user.contact);

					address = user.addressline1 + "<br/>";

					// For textboxes in edit profile
					$("#edit-address-line1").val(user.addressline1);

					if(user.addressline2 != "" && user.addressline2 != null){
						address += user.addressline2 + "<br/>";

						// For textboxes in edit profile
						$("#edit-address-line2").val(user.addressline2);
					}

					address += user.area + "<br/>";
					address += user.town + "<br/>";
					address += user.state + " - ";
					address += user.pincode + "<br/>";
					address += user.country + "<br/>";


				// For textboxes in edit profile
					$("#edit-area").val(user.area);
					$("#edit-town").val(user.town);
					$("#edit-state").val(user.state);
					$("#edit-pincode").val(user.pincode);
					$("#edit-country").val(user.country);
				// End for textboxes in edit profile

					$("#user-address").html(address);

					if(user.meta_length > 0){
						var tr = '';
						var profile_extra_info_dom = $("#profile-extra-info");

						$.each(user.meta_data, function(j, meta_data){
							tr = "<tr><td>"+Object.keys(meta_data)+" : </td><td>"+meta_data[Object.keys(meta_data)]+"</td></tr>";
							
							profile_extra_info_dom.find(".table>tbody").append(tr);
						});

						profile_extra_info_dom.show();
					}

				});
				
			}
		}

	});
}

// ENDS User Related Functions

// Order Functions

function fetchGuestAddress(buyer_name, addressline1, addressline2, area, town, pincode, state, country){
	$("#buyer-name").html(buyer_name);
	$("#add-line-1").html(addressline1);
					
	if($.trim(addressline2) == "" || addressline2 == null){
		$("#add-line-2").css("display", "none");
	}
	else{
		$("#add-line-2").html(addressline2 + "<br/>");
		$("#add-line-2").css("display", "block");
	}

	$("#area").html(area);
	$("#town").html(town);
	$("#pincode").html(pincode);
	$("#state").html(state);
	$("#country").html(country);	
}

function fetchOrderByProductName(product_main, order_qty){
	
	$("#change-qty-link").prop("href", "./product.php?product="+product_main);

	var product_list_ol = $("ol#products-list");
	product_list_ol.html('');
	product_list_ol.css("margin-top", "20px");
	var ol_item;

	var total_cost = 0;

	$.getJSON("../server/fetch_product_details.php?product="+ product_main, function(data, status){
		
		if(status == "success"){
			
			$.each(data, function(i, product){
				
				var item_name = product.name;
				var per = product.per;
				var cost = parseFloat(product.rate) * parseFloat(order_qty) ;

				total_cost += parseFloat(cost);

				ol_item = "<li> <b>"+item_name+"</b><br/>"+order_qty+" "+per+"<br/>INR "+cost+"<br/><hr/></li>";
				$(ol_item).appendTo(product_list_ol);
			});

			discount = parseFloat(total_cost) * 0.60;
			$("#total-discount").html(discount.toFixed(3));
			$(".total-amount").html(total_cost.toFixed(3));
			
		}

	});
}


// 'email' : will contain user email if logged in else null
// 'from_cart' : will contain boolean value. 'true' means order is placed from cart, 'false' means single item purchase is being made directly from product page.
// 'from_product' : will contain boolean value. 'true' means single item purchase is being made directly from product page, 'false' means order is placed from cart.
// 'product_nicename' : if 'from_product' is 'true' then this will contain the product's id or else null.
function placeOrder(user, order_from, product, product_order_qty) {

	$("#place-order-btn").on("click", function(){

		if(user == "" || user == null){
			alert("Please login to make any orders");
		}

		if(product == "" || product == null){
			product = null;
			product_order_qty = 0;
		}

		//window.location.href = "../server/place_order.php?user="+user+"&order_from="+order_from+"&product_nicename="+product+"&product_order_qty="+product_order_qty;

		$.getJSON("../server/place_order.php?user="+user+"&order_from="+order_from+"&product_nicename="+product+"&product_order_qty="+product_order_qty,
			function(data, status){
				
				if(data.status == "success"){
					console.log("data : " + data.data);

					// __sendInvoiceMail(user, data.data);
					$.getJSON("../server/mail_order_invoice.php?user="+user+"&order="+data.data, function(mail_reply, status){
						alert(mail_reply);
					});

				}
				else{
					alert(data.message);
				}

			}
		);

	});

}

function fetchOrderHistory(user){
	$.getJSON("../server/fetch_order_history.php?user="+user, function(data, status){
		console.log(data.status);
		var order_accordion = $("#order-accordion");

		if(data.status == "success"){			
			var panel = '';
			$.each(data.data, function(i, order){
				panel = "<div class='panel panel-default'>";
				panel += "<div class='panel-heading'>";
				panel += "<div class='panel-title'>";
				
				panel += "<a data-toggle='collapse' data-parent='#order-accordion' href='#o"+i+"'>";
				panel += "<table class='table'>";
				panel += "<tbody>";
				panel += "<tr>";
				panel += "<td>"+order.sr_no+"</td><td>"+order.date_time+"</td><td>"+order.transaction_id+"</td><td>"+order.total_amount+"</td><td class='fa fa-chevron-down'></td>";
				panel += "</tr>";
				panel += "</tbody>";
				panel += "</table>";
				panel += "</a>";

				panel += "</div>";	// panel-title closed
				panel += "</div>";	// panel-heading closed

				panel += "<div id='o"+i+"' class='panel-collapse collapse'>";
				
				panel += "<table class='table'>";
				panel += "<thead>";
				panel += "<tr>";
				panel += "<th>Sr. no.</th><th>Product no.</th><th>Product name</th><th>Quantity</th><th>Cost</th><th>&nbsp;&nbsp;</th>";
				panel += "</tr>";
				panel += "</thead>";
				panel += "<tbody>";

				$.each(order.details, function(j, details){
					panel += "<tr>";
					panel += "<td>"+details.sr_no+"</td><td>"+details.product_id+"</td><td>"+details.product_name+"</td><td>"+details.quantity+"</td><td>"+(parseFloat(details.quantity) * parseFloat(details.rate)).toFixed(3)+"</td><td>&nbsp;&nbsp;</td>";
					panel += "</tr>";
				});

				panel += "</tbody>";
				panel += "</table>";
				
				
				panel += "</div>"; // panel-collapse closed

				panel += "</div>"; // panel closed

				order_accordion.append(panel);
			});
		
		}
		else{
			order_accordion.html("<br/><span style='font-style: italic; color: red;'>"+data.message+"</span>");
		}

	});
}

// ENDS Order Functions

// User Profile Functions
function editProfile(user){
	$("#disp-profile-data").hide();
	$("#edit-profile-data-form").show();
}

function updateUserDetails(user, event){

	event.preventDefault();

	var name = $("#edit-name");
	var contact = $("#edit-contact");
	var addressline1 = $("#edit-address-line1");
	var addressline2 = $("#edit-address-line2");
	var area = $("#edit-area");
	var town = $("#edit-town");
	var state = $("#edit-state");
	var pincode = $("#edit-pincode");
	var country = $("#edit-country");
	var old_pwd = $("#edit-old-password");
	var new_pwd = $("#edit-new-password");

	var error_msg_dom = $("#edit-error-msg");

	var flag = "true";

	var pattern = / /;

	pattern = /^[a-zA-Z\s*]+$/;
	
	// validate name
	if($.trim(name.val()) == ''){
		error_msg_dom.html("Name cannot be empty.");

		flag = "false";

		location.hash = "edit-error-msg";

		return flag;
	}
	else{
		if(! pattern.test(name.val()) ){
			error_msg_dom.html("Name should contain only alphabets.");

			flag = "false";

			location.hash = "edit-error-msg";

			return flag;
		}
	}

	// validate contact
	if($.trim(contact.val()) == ''){
		error_msg_dom.html("Contact cannot be empty.");

		flag = "false";

		location.hash = "edit-error-msg";

		return flag;
	}
	else{
		pattern = /^[0-9]+$/;
		if(! pattern.test(contact.val()) ){
			error_msg_dom.html("Contact should contain only digits 0-9.");

			flag = "false";

			location.hash = "edit-error-msg";

			return flag;
		}
	}

	// validate address line 1
	if($.trim(addressline1.val()) == ''){
		error_msg_dom.html("Address line 1 cannot be empty.");

		flag = "false";

		location.hash = "edit-error-msg";

		return flag;
	}
	else{
		pattern = /^[a-zA-Z0-9\s*]+$/;
		if(! pattern.test(addressline1.val()) ){
			error_msg_dom.html("Address Line 1 should contain only alphabets and digits. No symbols are allowed");

			flag = "false";

			location.hash = "edit-error-msg";

			return flag;
		}
	}

	// validate address line 2
	if(! $.trim(addressline2.val()) == ''){
		pattern = /^[a-zA-Z0-9\s*]+$/;

		if(! pattern.test(addressline2.val()) ){
			error_msg_dom.html("Address Line 2 should contain only alphabets and digits. No symbols are allowed");

			flag = "false";

			location.hash = "edit-error-msg";

			return flag;
		}
	}

	// validate area
	if($.trim(area.val()) == ''){
		error_msg_dom.html("Area cannot be empty.");

		flag = "false";

		location.hash = "edit-error-msg";

		return flag;
	}
	else{
		pattern = /^[a-zA-Z\s*]+$/;
		if(! pattern.test(area.val()) ){
			error_msg_dom.html("Area should contain only alphabets.");

			flag = "false";

			location.hash = "edit-error-msg";

			return flag;
		}
	}

	// validate town
	if($.trim(town.val()) == ''){
		error_msg_dom.html("Town cannot be empty.");

		flag = "false";

		location.hash = "edit-error-msg";

		return flag;
	}
	else{
		pattern = /^[a-zA-Z\s*]+$/;
		if(! pattern.test(town.val()) ){
			error_msg_dom.html("Town should contain only alphabets.");

			flag = "false";

			location.hash = "edit-error-msg";

			return flag;
		}
	}

	// validate state
	if($.trim(state.val()) == ''){
		error_msg_dom.html("State cannot be empty.");

		flag = "false";

		location.hash = "edit-error-msg";

		return flag;
	}
	else{
		pattern = /^[a-zA-Z\s*]+$/;
		if(! pattern.test(state.val()) ){
			error_msg_dom.html("State should contain only alphabets.");

			flag = "false";

			location.hash = "edit-error-msg";

			return flag;
		}
	}

	// validate pincode
	if($.trim(pincode.val()) == ''){
		error_msg_dom.html("Pincode cannot be empty.");

		flag = "false";

		location.hash = "edit-error-msg";

		return flag;
	}
	else{
		pattern = /^[0-9]+$/;
		if(! pattern.test(pincode.val()) ){
			error_msg_dom.html("Pincode should contain only digits between 0-9.");

			flag = "false";

			location.hash = "edit-error-msg";

			return flag;
		}
		else if( pincode.val().length != 6 ){
			alert( pincode.val().length );
			error_msg_dom.html("Pincode should only contain 6 digits in length.");

			flag = "false";

			location.hash = "edit-error-msg";

			return flag;
		}
	}

	// validate country
	if($.trim(country.val()) == ''){
		error_msg_dom.html("Country cannot be empty.");

		flag = "false";

		location.hash = "edit-error-msg";

		return flag;
	}
	else{
		pattern = /^[a-zA-Z\s*]+$/;
		if(! pattern.test(country.val()) ){
			error_msg_dom.html("Country should contain only alphabets.");

			flag = "false";

			location.hash = "edit-error-msg";

			return flag;
		}
	}

	// validate old password
	
	if($.trim(old_pwd.val()) == '' && $.trim(new_pwd.val()) == ''){
		// Do nothing
	}
	else if($.trim(old_pwd.val()) == '' && $.trim(new_pwd.val()) != ''){
		error_msg_dom.html("Old password cannot be empty.");

		flag = "false";

		location.hash = "edit-error-msg";

		return flag;
	}
	else if($.trim(old_pwd.val()) != '' && $.trim(new_pwd.val()) == ''){
		error_msg_dom.html("New password cannot be empty.");

		flag = "false";

		location.hash = "edit-error-msg";

		return flag;
	}
	else{
		if(old_pwd.val() == new_pwd.val()){
			error_msg_dom.html("Old and new password cannot be same.");

			flag = "false";

			location.hash = "edit-error-msg";

			return flag;
		}
		else{
			pattern = /^[a-zA-Z0-9]+$/;
			if(! pattern.test(new_pwd.val()) ){
				error_msg_dom.html("New password should only be a combination of alphanumeric charaters.");

				flag = "false";

				location.hash = "edit-error-msg";

				return flag;
			}
		}
		
	}

	if(flag == "false"){
		console.log("false");
	}
	else{
		console.log("true");

		error_msg_dom.html('');
		error_msg_dom.hide();

		//window.location.href = "../server/update_user_details.php?user="+user+"&name="+name.val()+"&contact="+contact.val()+"&addressline1="+addressline1.val()+"&addressline2="+addressline2.val()+"&area="+area.val()+"&town="+town.val()+"&state="+state.val()+"&pincode="+pincode.val()+"&country="+country.val()+"&old_pwd="+old_pwd.val()+"&new_pwd="+new_pwd.val();

		// alert("name="+name.val()+"\ncontact="+contact.val()+"\naddressline1="+addressline1.val()+"\naddressline2="+addressline2.val()+"\narea="+area.val()+"\ntown="+town.val()+"\nstate="+state.val()+"\npincode="+pincode.val()+"\ncountry="+country.val()+"\nold_pwd="+old_pwd.val()+"\nnew_pwd="+new_pwd.val());

		// +"&name="+name.val()+"&contact="+contact.val()+"&addressline1="+addressline1.val()+"&addressline2="+addressline2.val()+"&area="+area.val()+"&town="+town.val()+"&state="+state.val()+"&pincode="+pincode.val()+"&country="+country.val()+"&old_pwd="+old_pwd.val()+"&new_pwd="+new_pwd.val()
	
		$.getJSON("../server/update_user_details.php", 
			{
				"user": user,
				"name": name.val(),
				"contact": contact.val(),
				"addressline1": addressline1.val(),
				"addressline2": addressline2.val(),
				"area": area.val(),
				"town": town.val(),
				"state": state.val(),
				"pincode": pincode.val(),
				"country": country.val(),
				"old_pwd": old_pwd.val(),
				"new_pwd": new_pwd.val()
			},
			function(data, status){
				if(data.status == "success"){
					window.location.reload();
				}
				else{
					error_msg_dom.html(data.message);
					error_msg_dom.show();
					location.hash = "edit-error-msg";
				}
			}
		);

	}

}

// ENDS User Profile Functions

// Contact Functions

function sendQueryMail(){
	var name = $("#msg-name");
	var email = $("#msg-email");
	var contact = $("#msg-contact");
	var msg = $("#msg-msg");

	var error_msg_dom = $("#msg-error");

	var pattern = /^[a-zA-Z\s]+$/;

	if($.trim(name.val()) == '' ||  $.trim(name.val()) == null ){
		error_msg_dom.html("Name cannot be blank.");

		return false;
	}
	else if(! pattern.test(name.val()) ){
		error_msg_dom.html("Name should contain only letters.");

		return false;
	}

	if($.trim(email.val()) == '' ||  $.trim(email.val()) == null ){
		error_msg_dom.html("Email ID cannot be blank.");

		return false;
	}

	pattern = /^[0-9]+$/;
	if($.trim(contact.val()) == '' ||  $.trim(contact.val()) == null ){
		error_msg_dom.html("Contact number cannot be blank.");

		return false;
	}
	else if(! pattern.test(contact.val()) ){
		error_msg_dom.html("Contact number should contain only digits.");

		return false;
	}
	else if(contact.val().length < 10){
		error_msg_dom.html("Contact number should have 10 digits.");

		return false;
	}

	pattern = /^[\w\d\s\n,.$@&*\(\)\+\-\=]+$/;
	if($.trim(msg.val()) == '' ||  $.trim(msg.val()) == null ){
		error_msg_dom.html("Message cannot be blank.");

		return false;
	}
	else if(! pattern.test(msg.val()) ){
		error_msg_dom.html("Message can have only alphanumeric characters and some symbols [, . $ @ & * ( ) + - =].");

		return false;
	}

	error_msg_dom.html('');

	$.getJSON("../server/send_contact_mail.php",
		{
			"name": $.trim(name.val()),
			"email": $.trim(email.val()),
			"contact": $.trim(contact.val()),
			"msg": $.trim(msg.val())
		},
		function(data, status){
			error_msg_dom.html(data.message);
			
			if(data.status == "success"){
				error_msg_dom.css("color", "#333399");
				error_msg_dom.css("font-style", "bold");
			}

		}
	);

}

// ENDS Contact Functions


// Helper Methods

function __checkProductQuantity(quantity, min_qty, quantity_input, error_msg_dom){
	if(quantity){
		if(quantity % min_qty == 0){
			return true;
		}
		else if(quantity < min_qty){
			error_msg_dom.html("Minimum quantity should be "+ min_qty +".");
			error_msg_dom.show();
			quantity_input.val(min_qty);
			return false;
		}
		else{
			error_msg_dom.html("Please enter quantity as a multiple of "+ min_qty +".");
			error_msg_dom.show();
			quantity_input.val(min_qty);
			return false;
		}
	}
	else{
		error_msg_dom.show();
		error_msg_dom.html("Please enter a quantity.");
		return false;
	}
}
 
function __sendMail(url, email, pwd, dom_obj, operation){
	$.getJSON(url, 
		{
			"email": email, 
			"pwd": pwd,
			"operation": operation
		},
		function(data, status){
			dom_obj.html(data.message);

			return true;
		}
	);
}

function __sendInvoiceMail(user, order_id){
	$.getJSON("../server/mail_order_invoice.php?user="+user+"&order_id="+order_id, function(data, status){
		console.log(data);
	});
}

function size(obj) {
   	var size = 0, key;
   	for (key in obj) {
   	    if (obj.hasOwnProperty(key)) size++;
    }
    return size;
}

// ENDS Helper Methods
