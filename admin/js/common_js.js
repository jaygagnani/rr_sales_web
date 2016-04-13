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
						json_data = "<div class='col l3 m6 s6 center display_data_in_card'><a href='category_master.php?category="+product.nicename+"'><div class='div_with_bg_img' style='background: url(../"+product.img+");'><div class='div_text_item' style='height: 40px;'>"+product.name+"</div></div></a></div>";
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