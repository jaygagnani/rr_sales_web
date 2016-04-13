function setMainDisplayContainer(obj){
	if($(obj).width() < 992){
		$('#category-container').css('padding-left','0px');
	}else{
		$('#category-container').css('padding-left','65px');
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

				$("ul.pagination").html("<li class='previous'><a href='#' onclick=paginationNavigation('"+ category +"','prev',"+ limit +")>Previous page</a></li>");
				$("ul.pagination").append("<li><a href='#' onclick=paginationNavigation('"+ category +"','prev',"+ limit +")>&#x25C4</a></li>");
				
				for(i=0; i < total_pages; i++){
					if(i == 0){
						$("ul.pagination").append("<li><a href='#' class='active' value='"+ (i+1) +"' onclick=paginationNavigation('"+ category +"',"+ (i+1) +","+ limit +");>" + (i+1) + "</a></li>");
						continue;
					}
					$("ul.pagination").append("<li><a href='#' class='abc' value='"+ (i+1) +"' onclick=paginationNavigation('"+ category +"',"+ (i+1) +","+ limit +")>"+ (i+1) +"</a></li>");
				}
				
				$("ul.pagination").append("<li><a href='#!' onclick=paginationNavigation('"+ category +"','next',"+ limit +");>&#x25BA</a></li>");
				$("ul.pagination").append("<li class='next'><a href='#!' onclick=paginationNavigation('"+ category +"','next',"+ limit +");>Next page</a></li>");
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


		if((page_number > 1) && (page_number < $(".pagination li:nth-last-child(3)").html())){

			alert(1);
			if(next.hasClass("disabled") || next_symbol.hasClass("disabled")){
				next.removeClass("disabled");
				next_symbol.removeClass("disabled");
			}
			if(previous.hasClass("disabled") || previous_symbol.hasClass("disabled")){
				previous.removeClass("disabled");
				previous_symbol.removeClass("disabled");
			}
		}
		else if(page_number <= 1){

			alert(2);

			previous.addClass("disabled");
			previous_symbol.addClass("disabled");

			if(next.hasClass("disabled") || next_symbol.hasClass("disabled")){
				next.removeClass("disabled");
				next_symbol.removeClass("disabled");
			}
		}
		else if(page_number >= $(".pagination li:nth-last-child(3)").html()){

			alert(3);

			next.addClass("disabled");
			next_symbol.addClass("disabled");

			if(previous.hasClass("disabled") || previous_symbol.hasClass("disabled")){
				previous.removeClass("disabled");
				previous_symbol.removeClass("disabled");
			}
		}

		displayProducts(category, page_number);

		var last_record = (page_number) * limit;
		var first_record = (last_record - limit) + 1;

		if(page_number == $(".pagination li:nth-last-child(3)>a").html()){
			last_record = total_records;
		}

		console.log("last_record : " + last_record);
		console.log("first_record : " + first_record);

		$("#product-count").html("Showing " + first_record + " - " + last_record + "products."); 

	}

	// Ajax call to get products for current / selected page
		// function displayCatalogue(){

		// }

	function displayProducts(category, page_number){
		console.log(category + " : " + page_number);
		$("#display-product").html('');
		$.getJSON("../server/fetch_products.php?category=" + category + "&page="+page_number, function(data, status){
			if(data){
				var json_data;
			
				$("#title").html(data[0].category_name);

				if(data.length > 1){
					
					$.each(data, function(i, product){
						if(product.id){
							json_data = "<div class='col-lg-3 col-md-4 col-sm-6 display_catalogue'><a href='./product_master.php?product="+product.nicename+"'><div class='div_with_bg_img' alt='"+product.name+"' style='background: url(../"+product.img+"); background-size:100%; '><div class='div_text_item'>"+product.name+"</div></div></a></div>";
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