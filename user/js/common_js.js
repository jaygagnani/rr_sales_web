function setMainDisplayContainer(obj){
	if($(obj).width() < 992){
		$('#category-container').css('padding-left','0px');
	}else{
		$('#category-container').css('padding-left','65px');
	}
}

function getProductsLength(category){
	return $.get("../server/get_catalogue_length.php?category="+category);
}