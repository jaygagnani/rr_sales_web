<?php

class DbConnection {

	const host = "127.0.0.1";
	const db_uname = "root";
	const db_pwd = "";

	const DATABASE_NAME = "rr_sales_db";

	const USER = "user";
	const USER_META = "user_meta";
	const CATEGORY = "category";
	const PRODUCT = "product";
	const PRODUCT_META = "product_meta";
	const CART = "cart";
	const ORDER = "order";
	const ORDER_DETAILS = "order_details";

	// Connection variable
	private static $mysqli;
	static function init(){
		self::$mysqli = new mysqli(self::host, self::db_uname, self::db_pwd, self::DATABASE_NAME);
	}

	function __construct(){
		if(mysqli_connect_errno()){
			printf("Connection failed: %s\n", mysqli_connect_error());
		}
	}

	function __destruct(){
		if(self::$mysqli){
			
			self::$mysqli->close();
		}
	}


	function fetchTableColumnNames($table_name){
		$sql = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".self::DATABASE_NAME."' AND `TABLE_NAME`='$table_name';";
			
		$result = self::$mysqli->query($sql);

		if($result->num_rows > 0){
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$column_names[] = array($row['COLUMN_NAME']);
			}

			return json_encode($column_names);

		}else{
			return false;
		}
	}


// Helper Methods

	//Image Upload Function
	function __uploadImage($image, $dir){
		if(isset($image)){
			$errors = array();
			$file_name = $image['name'];
			$file_size = $image['size'];
			$file_tmp = $image['tmp_name'];
			$file_type = $image['type'];
			$file_ext = strtolower(end(explode('.', $image['name'])));
			$file_error_code = $image['error'];

			$img_dir = "../images/".$dir."/";
	
			$extensions = array("jpeg","jpg","png");
			
			if(in_array($file_ext,$extensions) == false){
				$errors[] = "extension not allowed, please choose a JPEG or PNG file.";
			}

			if($file_size > 5000000){
				$errors[] = "file size larger than 5 mb. Please upload image of size 5mb or lower.";
			}
			

			if(empty($errors) == true){
				$upload_success = move_uploaded_file($file_tmp, $img_dir.$file_name);
				if((int)$upload_success === 1){
					$img_dir = "/images/".$dir."/";
					return $img_dir.$file_name;
				}else{
					return false;
				}
				
			}else{
				echo "Error Code : ".$file_error_code."<br/>Errors : ";
				return false;
			}
		}
	}

	function __getNicename($name, $id){
		$pattern = '/[ .!@#%&_]+/';
		$nicename = preg_replace($pattern,'_', $name);
		$pattern = '/\(\w+\)/';
		$nicename = preg_replace($pattern,'', $nicename);

		$nicename = $nicename.".".$id;

		return $nicename;
	}

// End Helper Methods

	//User Functions
		// Login and Registration Functions
		function registerNewUser($user_email, $user_name, $user_address, $user_contact_number, $user_password){
			$sql = "insert into ".self::USER." (user_email, user_name, user_address, user_contact_number, user_role, user_password) values ('$user_email','$user_name','$user_address','$user_contact_number','user','$user_password')";
			
			$result = self::$mysqli->query($sql);
			if(!$result){
				return false;
			}else{
				return true;
			}
		}

		function activateUser($user_id, $user_activation_code){
			$sql = "update ".self::USER." set user_activation_code='$user_activation_code'";
		}
		
		function loginUser($user_email, $user_password){
			$sql = "select * from ".self::USER." where user_email = '$user_email' and user_password = '".md5($user_password)."';";
			$result = self::$mysqli->query($sql);
                       
			if($result->num_rows == 1){
                      
				$row = $result->fetch_array(MYSQLI_ASSOC);
                                
				return json_encode($row);
                                
			}
            
            return json_encode(array("false"));
    	}
		// End Login and Registration Functions
	
		// Manage Profile Functions
		function fetchUserDetails($user_id){
			$sql = "select * from ".self::USER." where user_id = ".(int)$user_id.";";
			$result = self::$mysqli->query($sql);
			if(!$result){
				return false;
			}else{
				 $row = $result->fetch_row();
				if(!$row){
					return false;
				}else{
					return $row;
				}
			}
			return false;
		}
		
		function updateUserDetails($user_id, $user_name, $user_address, $user_contact_number){
			$sql = "update ".self::USER." set user_name = '$user_name', user_address = '$user_address', user_contact_number = '$user_contact_number' where id = ".(int)$user_id.";";
			$result = self::$mysqli->query($sql);
			
			if(self::$mysqli->affected_rows == 1){
				return true;
			}
			return false;
		}
		// End Manage Profile Functions
		
	// End User Functions

	// User_Meta Functions
	function addUserMetaRecord($user_id, $user_meta_key, $user_meta_value){
		$sql = "insert into ".self::USER_META." (user_id, meta_key, meta_value) values(".(int)$user_id.", '$user_meta_key', '$user_meta_value');";
		$result = self::$mysqli->query($sql);
		if(self::$mysqli->affected_rows == 1){
			return true;
		}
		return false;
	}

	function removeUserMetaRecord($user_id, $user_meta_key){
		$sql = "delete from ".self::USER_META." where user_id = ".(int)$user_id." and meta_key = '$user_meta_key';";
		$result = self::$mysqli->query($sql);
		if(self::$mysqli->affected_rows == 1){
			return true;
		}
		return false;
	}

	function updateUserMetaRecord($user_id, $user_meta_key, $user_meta_value){
		$sql = "update ".self::USER_META." set meta_value = '$user_meta_value' where user_id = ".(int)$user_id." and meta_key = '$user_meta_key';";
		$result = self::$mysqli->query($sql);
		if(self::$mysqli->affected_rows() == 1){
			return true;
		}
		return false;
	}

	function fetchUserMetaRecord($user_id){
		$sql = "select meta_key, meta_value from ".self::USER_META." where user_id = ".(int)$user_id.";";
		$result = self::$mysqli->query($sql);
		$final_result = array();
		$row="";

		if(!$result){
			return false;
		}else{
			$i = 0;
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$final_result[$i] = $row;
				$i = $i + 1;
			}
			return $final_result;
		}
		return false;
	}
	// End User_Meta Functions
		
	// Category Functions
	function addCategory($category_name, $category_img){
		//upload image
		if($category_img){
			$upload_success = $this->__uploadImage($category_img, "categories");
		}else{
			$upload_success = false;
		}
		
		if($upload_success !== false){
			$sql = "insert into ".self::CATEGORY." (category_name, category_img) values ('$category_name','".$upload_success."');";
		}else{
			$sql = "insert into ".self::CATEGORY." (category_name) values ('$category_name');";
		}
		$result = self::$mysqli->query($sql);
		if(self::$mysqli->affected_rows == 1){
			$id = self::$mysqli->insert_id;
			
			$nicename = $this->__getNicename($category_name, $id);

			$sql = "update ".self::CATEGORY." set category_nicename='".$nicename."' where id=".$id.";";
			$result = self::$mysqli->query($sql);

			if(self::$mysqli->affected_rows == 1)
				return true;
			
		}
		
		return self::$mysqli->error;
	}

	function updateCategory($category_nicename, $category_new_name, $category_img){

		$nicename = "";

		$category = $this->fetchCategoryDetails($category_nicename);
		if($category['id'] < 0)
			return false;

		$id = $category['id'];

		if($category_img){
			// Do nothing for now
		}else{
			$nicename = $this->__getNicename($category_new_name, $id);
			$sql = "update ".self::CATEGORY." set category_name = '$category_new_name', category_nicename = '$nicename' where id = $id;";
		}
		
		$result = self::$mysqli->query($sql);
		
		if(self::$mysqli->affected_rows == 1){
			return $nicename;
		}
		return false;
	}

	function removeCategory($category_id){
		$sql = "delete from ".self::CATEGORY." where category_id = '$category_id';";
		$result = self::$mysqli->query($sql);
		
		if(self::$mysqli->affected_rows == 1){
			return true;
		}
		return false;
	}

// Fetch all records
	function fetchCategories(){
		$sql = "select * from ".self::CATEGORY.";";
		$result = self::$mysqli->query($sql);
		//print_r($reuslt);
		if($result->num_rows){
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$id = $row['id'];
				$name = $row['category_name'];
				$nicename = $row['category_nicename'];
				$img = $row['category_img'];
				$categories[] = array('id'=>$id, 'name'=>$name, 'nicename'=>$nicename, 'img'=>$img);
			}
			header('Content-Type: application/json');
			print json_encode($categories);
		}
		return false;
	}

	function fetchCategoryDetails($nicename){
		$sql = "select id, category_name, category_img, category_nicename from ".self::CATEGORY." where category_nicename='$nicename';";
		$result = self::$mysqli->query($sql);
		
		if($result->num_rows){
			$row = $result->fetch_row();
			$cat['id'] = $row[0];
			$cat['name'] = $row[1];
			$cat['img'] = $row[2];
			$cat['nicename'] = $row[3];
			
			return $cat;
		}
		
		return false;
	}
	// End Category Functions

	// Product Functions

	function addProduct($category_nicename, $product_id, $product_name, $product_vehicle, $product_rate, $product_per, $product_min_qty, $product_desc, $product_img){

		$category = $this->fetchCategoryDetails($category_nicename);
		if($category['id'] < 0)
			return false;

		$category_id = $category['id'];


		//print_r($product_img);

		$upload_success = null;

		if($product_img){
			$upload_success = $this->__uploadImage($product_img, "products");
		}else{
			$upload_success = false;
		}
		
		if($upload_success !== false){
			$sql = "INSERT INTO ".self::PRODUCT." (category_id,product_id,product_name,product_vehicle,product_rate,product_per,product_min_qty,product_description,product_img) VALUES ('$category_id', '$product_id', '$product_name', '$product_vehicle', '$product_rate', '$product_per', '$product_min_qty', '$product_desc', '$upload_success');";
		}else{
			$sql = "INSERT INTO ".self::PRODUCT." (category_id,product_id,product_name,product_vehicle,product_rate,product_per,product_min_qty,product_description) VALUES ('$category_id', '$product_id', '$product_name', '$product_vehicle', '$product_rate', '$product_per', '$product_min_qty', '$product_desc');";
		}
		
		$result = self::$mysqli->query($sql);
		if(!$result){
			die("invalid request : ".self::$mysqli->error);
		}else{
			if(self::$mysqli->affected_rows == 1){
				$id = self::$mysqli->insert_id;
				print_r("id : ".$id);
				$nicename = $this->__getNicename($product_name, $id);
				print_r("nicename : ".$nicename);
				$sql = "UPDATE ".self::PRODUCT." SET product_nicename='$nicename' WHERE id=$id;";
				$result = self::$mysqli->query($sql);

				if(self::$mysqli->affected_rows == 1){
					return true;
				}
			}
		}
		

		return self::$mysqli->error;
	}

//Fetch length of catalogue winthin a category
	function fetchCatalogueLength($category_nicename){
		$category = $this->fetchCategoryDetails($category_nicename);
		if($category['id'] < 0)
			return false;

		$sql = "select * from ".self::PRODUCT." where category_id=$category[id];";
		$result = self::$mysqli->query($sql);

		if(!$result)
			return false;

		return $result->num_rows;
	}

// Fetch all records
	function fetchProducts($category_nicename, $current_page = 1, $limit = 40){
		$category = $this->fetchCategoryDetails($category_nicename);
		if($category['id'] <= 0)
			return json_encode(false);
		
		$offset = ($current_page - 1) * $limit;

		$sql = "select * from ".self::PRODUCT." where category_id=$category[id] order by product_id asc LIMIT $limit OFFSET $offset;";
		$result = self::$mysqli->query($sql);
		$products[] = array('category_name'=>$category['name'], 'category_img'=>$category['img'], 'category_nicename'=>$category['nicename']);
		if($result->num_rows){
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$id = $row['id'];
				$product_id = $row['product_id'];
				$name = $row['product_name'];
				$nicename = $row['product_nicename'];
				$img = $row['product_img'];
				$vehicle = $row['product_vehicle'];
				$rate = $row['product_rate'];
				$per = $row['product_per'];
				$min_qty = $row['product_min_qty'];

				$products[] = array('id'=>$id, 'product_id'=>$product_id, 'name'=>$name, 'nicename'=>$nicename, 'img'=>$img, 'vehicle'=>$vehicle, 'rate'=>$rate, 'per'=>$per, 'min_qty'=>$min_qty);
			}
			header('Content-Type: application/json');
			return json_encode($products);
		}
		return json_encode($products);
	}

	function fetchProductsForDownload($category_nicename){
		$category = $this->fetchCategoryDetails($category_nicename);
		if($category['id'] < 0)
			return false;
		
		$sql = "select * from ".self::PRODUCT." where category_id=$category[id] order by product_id;";
		$result = self::$mysqli->query($sql);
		
		if($result->num_rows){
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$id = $row['id'];
				$product_id = $row['product_id'];
				$name = $row['product_name'];
				$nicename = $row['product_nicename'];
				$img = $row['product_img'];
				$vehicle = $row['product_vehicle'];
				$rate = $row['product_rate'];
				$per = $row['product_per'];
				$min_qty = $row['product_min_qty'];

				$products[] = array('product_id'=>$product_id, 'name'=>$name, 'img'=>$img, 'vehicle'=>$vehicle, 'rate'=>$rate, 'per'=>$per, 'min_qty'=>$min_qty);
			}
			//$products[] = array('category_name'=>$category['name'], 'category_img'=>$category['img'], 'category_nicename'=>$category['nicename']);
			header('Content-Type: application/json');
			return json_encode($products);
		}
		return false;
	}


	function fetchProductDetails($category_nicename, $product_nicename){
		$category = $this->fetchCategoryDetails($category_nicename);
		$sql = '';

		if(!empty($category_nicename))
			$sql = "select * from ".self::PRODUCT." where category_id=".$category['id']." and product_nicename='".$product_nicename."';";
		else
			$sql = "select * from ".self::PRODUCT." where product_nicename='".$product_nicename."';";

		$result = self::$mysqli->query($sql);

		if($result->num_rows){
			$row = $result->fetch_array(MYSQLI_BOTH);
			$id = $row['id'];
			
			if(!empty($category_nicename))
				$category_name = $category['name'];
			else
				$category_name = null;

			$product_id = $row['product_id'];
			$name = $row['product_name'];
			$vehicle = $row['product_vehicle'];
			$rate = $row['product_rate'];
			$per = $row['product_per'];
			$min_qty = $row['product_min_qty'];
			$img = $row['product_img'];

			$sql = "select meta_key, meta_value from ".self::PRODUCT_META." where product_id=".$id.";";
			$result = self::$mysqli->query($sql);
			
			$product_meta_num_rows = $result->num_rows;
			$product_meta = null;
			if($product_meta_num_rows){
				while($row = $result->fetch_array(MYSQLI_BOTH)){
					$product_meta[] = array($row['meta_key']=>$row['meta_value']);
				}
			}

			$product_detail[] = array('id'=>$id, 'category_name'=>$category_name, 'product_id'=>$product_id, 'name'=>$name, 'vehicle'=>$vehicle, 'rate'=>$rate, 'per'=>$per, 'min_qty'=>$min_qty, 'img'=>$img, 'meta_length'=>$product_meta_num_rows, 'meta_data'=>$product_meta);

			return json_encode($product_detail);
		}
	}

	// End Product Functions

	//Search Functions
	// function fetchSearchResults($searchParameter)
	// {
	// 	$sql = "SELECT * FROM ".self::PRODUCT." WHERE product_name LIKE '%$searchParameter%' OR product_id LIKE '$searchParameter%'";
 //   		$result=self::$mysqli->query($sql);
 //    	$rowcount=$result->num_rows;
 //    	if($rowcount < 1){
 //       		echo "No Products found!";
 //    	}
 //    	else{
 //   			while($row=$result->fetch_array(MYSQLI_BOTH)){
 //   				$arr[] = array('id'=>$row['id'], 'product_id' => $row['product_id'], 'name' => $row['product_name'], 'img' => $row['product_img'], 'nicename' => $row['product_nicename']);
	// 		}
	// 		return json_encode($arr);
 //   		}
	// }


	function fetchSearchResults($category_nicename, $searchParameter){
		$sql = '';
		if(!empty($category_nicename)){
			$category = $this->fetchCategoryDetails($category_nicename);
			$sql = "SELECT * FROM ".self::PRODUCT." WHERE category_id=$category[id] and product_name LIKE '$searchParameter%' OR product_id LIKE '$searchParameter%' order by product_id";
		}
		else
			$sql = "SELECT * FROM ".self::PRODUCT." WHERE product_name LIKE '%$searchParameter%' OR product_id LIKE '$searchParameter%' order by product_id";
   		$result=self::$mysqli->query($sql);
    	$rowcount=$result->num_rows;
    	if($rowcount == 0){
       		echo "No Products found!";
    	}
    	else{
   			while($row=$result->fetch_array(MYSQLI_BOTH)){
   				$arr[] = array('id'=>$row['id'], 'product_id' => $row['product_id'], 'name' => $row['product_name'], 'img' => $row['product_img'], 'nicename' => $row['product_nicename']);
			}
			return json_encode($arr);
   		}
	}

	// End Search Functions
}

DbConnection::init();

?>