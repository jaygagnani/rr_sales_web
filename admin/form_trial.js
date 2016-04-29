function fetchProductDetails(category, product_main){
	
	$.getJSON("../server/fetch_product_details.php?category="+category+"&product="+product_main, function(data){

		if(data){
			var json_data;
			$.each(data, function(i, product){
				if(product.id){

					json_data = '';

					json_data += "<div class='input-field col l6 m6 s10'>";
						json_data += "<label for='product_id'>Product ID</label>";
          				json_data += "<input id='product_id' type='text' placeholder='dsf' class='validate set_editable' value='"+product.product_id+"' disabled/>";
        			json_data += "</div>";

        			$(json_data).appendTo("#display-product-details");
				}
			});
		}else{
			json_data += "No Category Found";
			$(json_data).appendTo('#display-product-details');
		}
	});

}