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
	function paginationLength(category, limit){

		var total_records = 0;
		var total_pages = 1;
		
		__getProductsLength(category).success(function(data){
			
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

				$("ul.pagination").html("<li class='previous'><a href='#' onclick=paginationNavigation('"+ category +"','prev')>Previous page</a></li>");
				$("ul.pagination").append("<li><a href='#' onclick=paginationNavigation('"+ category +"','prev')>&#x25C4</a></li>");
				
				for(i=0; i < total_pages; i++){
					if(i == 0){
						$("ul.pagination").append("<li><a href='#' class='active' value='"+ (i+1) +"' onclick=paginationNavigation('"+ category +"',"+ (i+1) +");>" + (i+1) + "</a></li>");
						continue;
					}
					$("ul.pagination").append("<li><a href='#' class='abc' value='"+ (i+1) +"' onclick=paginationNavigation('"+ category +"',"+ (i+1) +")>"+ (i+1) +"</a></li>");
				}
				
				$("ul.pagination").append("<li><a href='#!' onclick=paginationNavigation('"+ category +"','next');>&#x25BA</a></li>");
				$("ul.pagination").append("<li class='next'><a href='#!' onclick=paginationNavigation('"+ category +"','next');>Next page</a></li>");
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