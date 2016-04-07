function searchProducts(searchParam){
		//$('#display_category').hide();
		//searchParam = $.trim(searchParam);
		if(searchParam == / ^\s+ /){
			//Do nothing
			alert(1);
		}
		else if(searchParam == '' || searchParam == null || searchParam === undefined){
			fetchCategories();
		}

		else if($.trim(searchParam) != ''){
			$('#display-category').html('');
			var json_data = '';
			$.getJSON("../server/fetch_search_results.php?searchParameter="+searchParam,
			function(data, status){
				if(data){
					console.log("if : "+data);
					$.each(data, function(i, product){
						
						json_data = "<div class='col l3 m6 s6 center display_data_in_card'><a href='product_master.php?product="+product.nicename+"'><img src='../"+product.img+"' alt='' class='responsive-img' style='border-bottom:1px solid #000; height: 150px; width: 220px; margin-bottom: 5px;'/></a><br/><center><span><b><i>"+product.product_id+"</i></b> - "+product.name+"</span></center></div>";
						$(json_data).appendTo('#display-category');
					});
				}else{
				//	$('#display-category').html("<center>No Product(s) Found.</center>");
					console.log("else"+data);
				}
			});
		}
		
	}