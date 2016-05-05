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
		function registerNewUser($user_name, $company_name, $contact_number, $email){
			$sql = "select count(*) from ".self::USER." where user_email='$email';";
			$result = self::$mysqli->query($sql);

			$password = '';

			if($result){
				$row = $result->fetch_array(MYSQLI_BOTH);
				if($row['count(*)'] == 1){
					return json_encode(array("status"=>"duplicate_entry", "message"=>"Entered email id has already been registered. Please enter another email id or check your email for your password."));
				}
			}

			$password_bytes = openssl_random_pseudo_bytes(3, $cstrong);
			$password_str = bin2hex($password_bytes);
			$password_md5 = md5($password_str);

			$sql = "insert into ".self::USER." (user_name, user_contact_number, user_email, user_role, user_password) values ('$user_name','$contact_number','$email','user', '$password_md5')";
			
			$result = self::$mysqli->query($sql);
			if($result){
				$user_id = self::$mysqli->insert_id;

				if($company_name != "" && $company_name != null){

					$sql = "insert into ".self::USER_META." (user_id, meta_key, meta_value) values($user_id, 'user_company_name', '$company_name')";

					$result = self::$mysqli->query($sql);

					if($result){
						return json_encode(array("status"=>"success", "message"=>"Please check your mail and log in with the password mailed.", "data"=>$password_str));
					}
					else{
						$delete_user = json_decode(deleteUser($email));
						if($delete_user == "true"){
							return json_encode(array("status"=>"failed", "message"=>"Sorry, some problem occured while registering. Try again."));
						}
						else{
							return json_encode(array("status"=>"success", "message"=>"Your account has been registered. But we had some problem adding your company name. Please login and edit your company name.", "data"=>$password_str));
						}
					}
				}

				if($result){
					return json_encode(array("status"=>"success", "message"=>"Please check your mail and log in with the password mailed.", "data"=>$password_str));
				}
				else{
					return json_encode(array("status"=>"failed", "message"=>"Sorry, some problem occured while registering. Try again."));
				}
			}
			else{
				return json_encode(array("status"=>"failed", "message"=>"Sorry, some problem occured while registering. Try again."));
			}
		}

		function sendNewRegisterMail($email, $password_str){
			require_once('./email_format.php');

			$subject = "New Account Registered";

			$content = "<h3 style='color: #333399;'>Congratulations $user_name</h3> <br/>";
			$content .= "You have successfully registered on R.R. Sales Corporation <br/>";
			$content .= "Your credentials are: <br/>";
			$content .= "Username - $email <br/>";
			$content .= "Password - $password_str <br/>";
			$content .= "Click on the following link and sign in <a href='http://www.rrsalescorporation.in'>rrsalescorporation.in</a> <br/>";
			$content .= "<br/><br/>";
			$content .= "Best, <br/>";
			$content .= "R.R. Sales Corporation,<br/> Vadodara,<br/> Gujarat";
					
			$mail_reply = json_decode(sendMail($email, $subject, $content));

			if($mail_reply == "true"){
				return json_encode(array("status"=>"success", "message"=>"Please check your mail and log in with the password mailed."));
			}
			else{
				return json_encode(array("status"=>"failed", "message"=>"You have been registered. Please check your mail.<br/> IF you have not recieved the mail yet use <a href='#!' data-toggle='modal' data-target='#forgot-password-modal'>Resend password</a>"));
			}

			print_r($mail_reply);
			return $mail_reply;
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

    	function deleteUser($email){
    		$sql = "delete * from ".self::USER." where user_email='$email';";
    		$result = self::$mysqli->query($sql);

    		if($result){
    			return json_encode("true");
    		}
    		else{
    			return json_encode("false");
    		}
    	}

		// End Login and Registration Functions
	

		// Manage Profile Functions
    	function forgotPassword($user_email){
			$sql = "select * from ".self::USER." where user_email = '$user_email';";
			$result = self::$mysqli->query($sql);
                       
			if($result){
				if($result->num_rows == 1){
					
					$row = $result->fetch_array(MYSQLI_BOTH);
					$old_password = $row['user_password'];

					$password_bytes = openssl_random_pseudo_bytes(3, $cstrong);
					$password_str = bin2hex($password_bytes);
					$password_md5 = md5($password_str);
					
					$sql = "update ".self::USER." set user_password='$password_md5' where user_email='$user_email';";
					$result = self::$mysqli->query($sql);

					if($result){
						$mail_sent = $this->sendForgotPasswordMail($user_email, $password_str);

						if($mail_sent == "true"){
							return json_encode(array("status"=>"success", "message"=>"Your password has been reset. Please check your mail for the new password."));
						}
						else{
							return json_encode(array("status"=>"success", "message"=>"Please check your mail for the new password.<br/> If you have not recieved the mail yet use <a href='../server/forgot_password.php?email=$user_email'>Resend password</a>"));
						}
					}
					else{
						return json_encode(array("status"=>"failed", "message"=>"Could not reset your password. Please try again."));
					}
				}
			}
            
            return json_encode(array("status"=>"failed", "message"=>"Could not find the specified email id. Please try again."));
    	}

    	function sendForgotPasswordMail($email, $password_str){
    		require_once('./email_format.php');

			$subject = "Forgot password";

			$content = "You have successfully generated new password on R.R. Sales Corporation <br/>";
			$content .= "Your password is: <br/>";
			$content .= "Password - $password_str <br/>";
			$content .= "Click on the following link and sign in <a href='http://www.rrsalescorporation.in'>rrsalescorporation.in</a> <br/>";
			$content .= "<br/><br/>";
			$content .= "Best, <br/>";
			$content .= "R.R. Sales Corporation,<br/> Vadodara,<br/> Gujarat";
					
			$mail_reply = json_decode(sendMail($email, $subject, $content));

			return $mail_reply;
    	}

		function fetchUserDetails($user_email){
			$sql = "select * from ".self::USER." where user_email = '$user_email';";
			$result = self::$mysqli->query($sql);
			
			if(!$result){
				return json_encode(array("status"=>"failed", "message"=>"No User Found. Signin and try again."));
			}

			$row = $result->fetch_array(MYSQLI_ASSOC);
			
			if(!$row){
				return json_encode(array("status"=>"failed", "message"=>"No User Found. Signin and try again."));
			}

			$id = $row['id'];
			$full_name = $row['user_name'];
			$addressline1 = $row['user_address_line_1'];
			$addressline2 = $row['user_address_line_2'];
			$area = $row['user_area'];
			$town = $row['user_town'];
			$state = $row['user_state'];
			$pincode = $row['user_pin_code'];
			$country = $row['user_country'];
			$contact_number = $row['user_contact_number'];

			$sql = "select * from ".self::USER_META." where user_id=$id;";
			$result = self::$mysqli->query($sql);

			if(!$result){
				return json_encode(array("status"=>"failed", "message"=>"Sory, some error occured. Signin and try again."));
			}

			$user_meta_num_rows = $result->num_rows;

			$user_meta = null;

			if($user_meta_num_rows){
				while($row = $result->fetch_array(MYSQLI_BOTH)){
					$user_meta[] = array($row['meta_key']=>$row['meta_value']);
				}
			}

			$user_detail[] = array("name"=>$full_name, "contact"=>$contact_number, "addressline1"=>$addressline1, "addressline2"=>$addressline2, "area"=>$area, "town"=>$town, "state"=>$state, "pincode"=>$pincode, "country"=>$country, "meta_length"=>$user_meta_num_rows, "meta_data"=>$user_meta);

			return json_encode(array( "status"=>"success", "message"=>"All records fetched.", "data"=>$user_detail ));
		}
		
		function updateUserDetails($user_email, $name, $contact, $addressline1, $addressline2,  $area, $town, $state, $pincode, $country, $old_pwd, $new_pwd){

			$sql = "select id, user_password from ".self::USER." where user_email='$user_email';";
			$result = self::$mysqli->query($sql);

			if(!$result){
				return json_encode(array("status"=>"failed", "message"=>"0. Sorry, some error occured. Your account details were not updated. Please try again."));
			}

			$row = $result->fetch_array(MYSQLI_ASSOC);
			$user_id = $row['id'];
			$old_password = $row['user_password'];

			$sql = "update ".self::USER." set user_name = '$name', user_contact_number = '$contact', user_address_line_1='$addressline1', user_address_line_2='$addressline2', user_area='$area', user_town='$town', user_state='$state', user_pin_code='$pincode', user_country='$country' where id = $user_id;";

			$result = self::$mysqli->query($sql);
			
			if($result){

				if( $old_pwd != '' && $old_pwd != null && $new_pwd != '' && $new_pwd != null ){
					if( md5($old_pwd) != $old_password ){
						return json_encode(array("status"=>"failed", "message"=>"Old Password is incorrect."));
					}

					$sql = "update ".self::USER." set user_password='".md5($new_pwd)."' where id=$user_id;";
					$result = self::$mysqli->query($sql);

					if(!$result){
						return json_encode(array("status"=>"failed", "message"=>"1. Sorry, some error occured. Your password was not changed. Please try again.".self::$mysqli->error));
					}
				}

				return json_encode(array("status"=>"success", "message"=>""));
		
			}

			return json_encode(array("status"=>"failed", "message"=>"3. Sorry, some error occured. Your account details were not updated. Please try again."));
		}

		function addAddressToUser($user_email, $addressline1, $addressline2, $area, $town, $pincode, $state, $country){
			$sql = "update ".self::USER." set user_address_line_1='$addressline1', user_address_line_2='$addressline2', user_area='$area', user_town='$town', user_pin_code='$pincode', user_state='$state', user_country='$country' where user_email='$user_email';";

			$result = self::$mysqli->query($sql);
			
			if($result){
				return json_encode(array("status"=>"success", "message"=>"true"));				
			}
			else{
				return json_encode(array("status"=>"failed", "message"=>"2. Sorry, due to some technical error your address was not updated. Please try again.", "data"=>self::$mysqli->error));
			}
		}

		function fetchUserAddress($user_email){
			$sql = "select user_name, user_address_line_1, user_address_line_2, user_area, user_town, user_state, user_pin_code, user_country from ".self::USER." where user_email='$user_email';";
			$result = self::$mysqli->query($sql);

			if($result){
				$row = $result->fetch_array(MYSQLI_BOTH);

				$user_name = $row['user_name'];
				$addressline1 = $row['user_address_line_1'];
				$addressline2 = $row['user_address_line_2'];
				$area = $row['user_area'];
				$town = $row['user_town'];
				$state = $row['user_state'];
				$pincode = $row['user_pin_code'];
				$country = $row['user_country'];

				$address_arr = array("user_name"=>$user_name, "addressline1"=>$addressline1, "addressline2"=>$addressline2, "area"=>$area, "town"=>$town, "pincode"=>$pincode, "state"=>$state, "country"=>$country);

				return json_encode(array("status"=>"success", "message"=>"true", "data"=>$address_arr));
			}
			else{
				return json_encode(array("status"=>"failed", "message"=>"false"));
			}
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

	function deleteCategory($category_nicename){
		$sql = "delete from ".self::CATEGORY." where category_nicename = '$category_nicename';";
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
			$sql = "INSERT INTO ".self::PRODUCT." (category_id,product_id,product_name,product_vehicle,product_rate,product_per,product_min_qty,product_desc,product_img) VALUES ('$category_id', '$product_id', '$product_name', '$product_vehicle', '$product_rate', '$product_per', '$product_min_qty', '$product_desc', '$upload_success');";
		}else{
			$sql = "INSERT INTO ".self::PRODUCT." (category_id,product_id,product_name,product_vehicle,product_rate,product_per,product_min_qty,product_desc) VALUES ('$category_id', '$product_id', '$product_name', '$product_vehicle', '$product_rate', '$product_per', '$product_min_qty', '$product_desc');";
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


	function updateProductDetails($nicename, $id, $name, $rate, $per, $min_qty, $vehicle, $wheels, $desc, $new_img){

		$sql = "select id, product_name from ".self::PRODUCT." where product_nicename='$nicename';";
		$result = self::$mysqli->query($sql);
		
		$auto_id = '';
		$product_old_name = '';

		if(!$result){
			return json_encode(array("status"=>"failed", "message"=>"Sorry, some problem occured."));
		}
		else{

			if($result->num_rows){
				$row = $result->fetch_array(MYSQLI_BOTH);
				$auto_id = $row['id'];
				$product_old_name = $row['product_name'];
			}
		}

		$sql = "update ".self::PRODUCT." set ";
			$sql .= "product_id='$id', product_name='$name', product_vehicle='$vehicle', ";
			$sql .= "product_no_of_wheels=$wheels, product_rate='$rate', product_per='$per', ";
			$sql .= "product_min_qty=$min_qty, product_desc='$desc'";


		if(!empty($new_img['name'])){
			$upload_image = $this->__uploadImage($new_img, "products");
			
			if($upload_image == false){

				return json_encode(array("status"=>"failed", "message"=>"Sorry, some problem occured while uploading the image."));
			}
			else{
				
				$sql .= ", product_img='$upload_image'";
			}
		}

		$sql .= " where id=$auto_id;";

		$result = self::$mysqli->query($sql);

		if(!$result){
			return json_encode(array("status"=>"failed", "message"=>"Sorry, some problem occured."));
		}else{
			if($product_old_name == $name)
				return json_encode(array("status"=>"success", "message"=>"name not changed"));
			else{
				$new_nicename = $this->__getNicename($name, $auto_id);

				$sql = "update ".self::PRODUCT." set product_nicename='$new_nicename' where id=$auto_id;";
				$result = self::$mysqli->query($sql);
				if($result)
					return json_encode(array("status"=>"success", "message"=>"name changed", "data"=>"$new_nicename"));
				else
					return json_encode(array("status"=>"failed", "message"=>"nicename not changed"));
			}
		}
	}

	function deleteProduct($product_nicename){
		$sql = "delete from ".self::PRODUCT." where product_nicename = '$product_nicename';";
		$result = self::$mysqli->query($sql);
		
		if($result)
			if(self::$mysqli->affected_rows == 1){
				return true;
			}

		return false;
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


	function fetchProductDetails($category_nicename = '', $product_nicename){
		if(!empty($category_nicename))
			$category = $this->fetchCategoryDetails($category_nicename);
		
		$sql = '';

		if(!empty($category_nicename))
			$sql = "select * from ".self::PRODUCT." where category_id=".$category['id']." and product_nicename='".$product_nicename."';";
		else
			$sql = "select p.*, c.category_name, c.category_nicename from ".self::PRODUCT." p INNER JOIN ".self::CATEGORY." c on p.category_id = c.id where product_nicename='".$product_nicename."';";

		$result = self::$mysqli->query($sql);

		if($result->num_rows){
			$row = $result->fetch_array(MYSQLI_BOTH);
			$id = $row['id'];
			
			if(!empty($category_nicename)){
				$category_name = $category['name'];
				$category_nicename = null;
			}
			else{
				$category_name = $row['category_name'];
				$category_nicename = $row['category_nicename'];
			}

			$product_id = $row['product_id'];
			$name = $row['product_name'];
			$nicename = $row['product_nicename'];
			$vehicle = $row['product_vehicle'];
			$wheels = $row['product_no_of_wheels'];
			$rate = $row['product_rate'];
			$per = $row['product_per'];
			$min_qty = $row['product_min_qty'];
			$img = $row['product_img'];
			$desc = $row['product_desc'];

			$sql = "select meta_key, meta_value from ".self::PRODUCT_META." where product_id=".$id.";";
			$result = self::$mysqli->query($sql);
			
			$product_meta_num_rows = $result->num_rows;
			$product_meta = null;
			if($product_meta_num_rows){
				while($row = $result->fetch_array(MYSQLI_BOTH)){
					$product_meta[] = array($row['meta_key']=>$row['meta_value']);
				}
			}

			$product_detail[] = array('id'=>$id, 'category_name'=>$category_name, 'category_nicename'=>$category_nicename, 'product_id'=>$product_id, 'name'=>$name, "product_nicename"=>$nicename, 'vehicle'=>$vehicle, 'wheels'=>$wheels, 'rate'=>$rate, 'per'=>$per, 'min_qty'=>$min_qty, 'img'=>$img, 'desc'=>$desc, 'meta_length'=>$product_meta_num_rows, 'meta_data'=>$product_meta);

			return json_encode($product_detail);
		}
	}

	function fetchDistinctPerValues(){
		$sql = "select distinct product_per from ".self::PRODUCT.";";
		$result = self::$mysqli->query($sql);
		if(!$result){
			return json_encode(array("status"=>"false"));
		}

		$per = array();
		while($row = $result->fetch_array(MYSQLI_BOTH)){
			$per[] = $row['product_per'];
		}

		return json_encode(array("status"=>"success", "data"=>$per));
	}

	function fetchSimilarProducts($product_nicename){
		$sql = "select product_name from ".self::PRODUCT." where product_nicename = '$product_nicename';";
		$result = self::$mysqli->query($sql);

		$product_name = '';

		if($result){
			$row = $result->fetch_array(MYSQLI_BOTH);
			$product_name = $row['product_name'];
		}

		$sql = "select p.* c.category_name from ".self::PRODUCT." p INNER JOIN ".self::CATEGORY." c on p.category_id=c.id where product_name like '%$product_name%' and product_name != '$product_name';";

		$result = self::$mysqli->query($sql);

		if($result){

			if($result->num_rows){
				$row = $result->fetch_array(MYSQLI_BOTH);
				$id = $row['id'];

				$name = $row['product_name'];
				$nicename = $row['product_nicename'];
				$img = $row['product_img'];
				$category_name = $row['category_name'];

				$product_detail[] = array('id'=>$id, 'name'=>$name, 'img'=>$img, 'nicename'=>$nicename, 'category'=>$category_name);

				return json_encode($product_detail);
			}
		}else{
			return false;
		}
	}


	function fetchDistinctVehicleNames(){
		$sql = "select distinct product_vehicle from ".self::PRODUCT.";";
		$result = self::$mysqli->query($sql);
		if(!$result){
			return json_encode(array("status"=>"failed"));
		}

		$vehicle = array();
		while($row = $result->fetch_array(MYSQLI_BOTH)){
			$vehicle[] = $row['product_vehicle'];
		}

		return json_encode(array("status"=>"success", "message"=>"", "data"=>$vehicle));
	}

	// End Product Functions

	//Search Functions

		// For admin
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

		// For user
		function fetchUserFilterResults($vehicle, $wheel_2, $wheel_3, $search_keyword){
			$sql = "select * from ".self::PRODUCT."";

			$extra = true;

			if($search_keyword != "null" && $search_keyword != ""){
				
				if($extra){
					$sql .= " where LOWER(product_name) like LOWER('%$search_keyword%')";
					$extra = false;
				}
				else{
					$sql .= " and product_name like '%$search_keyword%'";
				}

			}

			if($vehicle != "null" && $vehicle != ""){
				if(strtoupper($vehicle) == strtoupper("all")){

				}
				else{

					if($extra){
						$sql .= " where product_vehicle='$vehicle'";
						$extra = false;
					}
					else{
						$sql .= " and product_vehicle='$vehicle'";
					}

				}
			}

			if($wheel_2 == "true" && $wheel_3 == "false"){
				if($extra){
					$sql .= " where product_no_of_wheels=2";
					$extra = false;
				}
				else{
					$sql .= " and product_no_of_wheels=2";
				}
			}
			else if($wheel_2 == "false" && $wheel_3 == "true"){
				if($extra){
					$sql .= " where product_no_of_wheels=3";
					$extra = false;
				}
				else{
					$sql .= " and product_no_of_wheels=3";
				}
			}

			$sql .= " order by product_id asc;";

			$result = self::$mysqli->query($sql);
			if($result){
				
				if($result->num_rows > 0){
					$result_arr = array();
					while($row = $result->fetch_array(MYSQLI_BOTH)){
						$result_arr[] = array('id'=>$row['id'], 'product_id' => $row['product_id'], 'name' => $row['product_name'], 'img' => $row['product_img'], 'nicename' => $row['product_nicename']);
					}

					return json_encode(array("status"=>"success", "message"=>"true", "data"=>$result_arr));
				}
				else{
					return json_encode(array("status"=>"success", "message"=>"No Products found"));
				}

			}
			else{
				return json_encode(array("status"=>"success", "message"=>"Sorry, some error occured while processing your search. Refresh the page and try again!"));
			}

			return json_encode(array("status"=>"success", "message"=>"Sorry, some error occured while processing your search. Refresh the page and try again!"));
		}

	// End Search Functions

	// Cart Functions

	function addToCart($user, $product_nicename, $quantity){
		$sql = '';

		$sql = "SELECT u.id as user_id, p.id as product_id, p.product_rate FROM ".self::USER." u inner join ".self::PRODUCT." p on p.product_nicename='$product_nicename' and u.user_email='$user';";

		$result = self::$mysqli->query($sql);

		if(!$result){
			return json_encode(array('status'=>'failed', 'message'=>'Sorry, there was some problem caused. Please try again!'));
		}
		else{
			$row = $result->fetch_array(MYSQLI_BOTH);
			$user_id = $row['user_id'];
			$product_id = $row['product_id'];

			$product_rate = $row['product_rate'];
			$total_cost = $quantity * $product_rate;

			$sql = "SELECT count(*) FROM ".self::CART." where user_id=$user_id and product_id=$product_id;";

			$result = self::$mysqli->query($sql);
			if($result){
				$row = $result->fetch_array();
				if($row[0])
					return json_encode(array('status'=>'success', 'message'=>'Product already added to cart.'));
			}

			$sql = "INSERT INTO ".self::CART." (user_id, product_id, cart_qty, cart_product_cost) VALUES ($user_id, $product_id, $quantity, $total_cost)";

			$result = self::$mysqli->query($sql);
			if($result)
				return json_encode(array('status'=>'success', 'message'=>'Added to cart.'));
			else
				return json_encode(array('status'=>'failed', 'message'=>'Sorry, there was some problem caused. Please try again!'));
		}
	}

	function updateCart($user, $row_length, $product_nicename, $new_qty, $product_sub_total){
		$sql = "SELECT id FROM ".self::USER." where user_email='$user';";
		$result = self::$mysqli->query($sql);

		$flag = true;

		if($result){
			$row = $result->fetch_array(MYSQLI_BOTH);
			$user_id = $row['id'];

			for($i = 0; $i < $row_length; $i++){

				$sql = "SELECT id FROM ".self::PRODUCT." where product_nicename='".$product_nicename[$i]."';";
				$result = self::$mysqli->query($sql);

				if($result){
					$row = $result->fetch_array(MYSQLI_BOTH);
					$product_id = $row['id'];

					$sql = "UPDATE ".self::CART." set cart_qty=".$new_qty[$i].", cart_product_cost='".$product_sub_total[$i]."' where product_id=$product_id and user_id=$user_id;";
					$result = self::$mysqli->query($sql);

					if(!$result){
						$flag = false;
					}
				}
				else{
					return json_encode(array("status"=>"failed", "message"=>"Sorry, some problem occured. Try again."));
				}

			}

		}
		else{
			return json_encode(array("status"=>"failed", "message"=>"Sorry, some problem occured. Try again."));
		}

		if($flag){
			return json_encode(array("status"=>"success", "message"=>"Cart successfully updated."));
		}
		else{
			return json_encode(array("status"=>"failed", "message"=>"Sorry, some problem occured. Try again."));
		}

	}

	function fetchCart($user){
		$sql = "SELECT id FROM ".self::USER." where user_email='$user';";
		$result = self::$mysqli->query($sql);

		$user_id = 0;

		if($result){
			$row = $result->fetch_array(MYSQLI_BOTH);
			$user_id = $row['id'];
		}else{
			return json_encode(array('status'=>'failed', 'message'=>'Sorry, there was some problem caused. Please try again!'));
		}

		$sql = "SELECT p.product_name, p.product_nicename, p.product_rate, p.product_per, p.product_min_qty, c.* FROM ".self::CART." c inner join ".self::PRODUCT." p on p.id=c.product_id where c.user_id=$user_id;";
		$result = self::$mysqli->query($sql);

		$cart_arr = array();

		if($result){
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$cart_id = $row['id'];
				$product_name = $row['product_name'];
				$product_rate = $row['product_rate'];
				$product_nicename = $row['product_nicename'];
				$product_min_qty = $row['product_min_qty'];
				$per = $row['product_per'];
				$quantity = $row['cart_qty'];
				$cost = $row['cart_product_cost'];

				$cart_arr[] = array("product_name"=>$product_name, "product_nicename"=>$product_nicename, "product_quantity"=>$quantity, "product_min_quantity"=>$product_min_qty, "product_rate"=>$product_rate, "product_per"=>$per, "product_sub_total"=>$cost);
			}
		}else{
			return json_encode(array('status'=>'failed', 'message'=>'Sorry, there was some problem caused. Please try again!'));
		}

		return json_encode(array("status"=>"success", "message"=>"All data fetched", "data"=>$cart_arr));
	}

	//End Cart Functions

	// Order Functions

	function placeOrder($user, $order_from, $product_nicename, $product_order_qty){
		$sql = '';
		$user_id = null;

		$last_insert_id = 0;

		$sql = "select id from ".self::USER." where user_email='$user';";
		$result = self::$mysqli->query($sql);

		if($result){
			$row = $result->fetch_array(MYSQLI_BOTH);
			$user_id = $row['id'];
		}
		else{
			return json_encode(array("status"=>"failed", "message"=>"User not found. Please try signing in again."));
		}

		if($order_from == "cart"){
			
			// Check if records exist in cart
				$sql = "select count(*) from ".self::CART." where user_id=$user_id;";
				$result = self::$mysqli->query($sql);

				if(!$result){
					return json_encode(array("status"=>"failed", "message"=>"C0. Could not place your order. Please try again. "));
				}
				if($result->num_rows < 1){
					return json_encode(array("status"=>"failed", "message"=>"Empty Cart. Add product(s) to cart before making any purchase."));
				}


			//Insert into 'ORDER' table
				$sql = "insert into `".self::ORDER."` (`user_id`, `order_created_at`, `order_status`) values($user_id, NOW(), 'pending');";
				$result = self::$mysqli->query($sql);
				
				if(!$result){
					return json_encode(array("status"=>"failed", "message"=>"C1. Could not place your order. Please try again."));
				}
				
				// Get autoincrement id from last insert
					$last_insert_id = self::$mysqli->insert_id;

			// Update 'ORDER' table to add 'order_transaction_id' value
				$sql = "UPDATE `".self::ORDER."` SET `order_transaction_id` = concat(
						substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand($last_insert_id)*4294967296))*36+1, 1),
						substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
						substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
						substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
						substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
						substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
						substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
						substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed)*36+1, 1)
					)
					WHERE `id` = $last_insert_id ;";

				$result = self::$mysqli->query($sql);
				if(!$result){
					return json_encode(array("status"=>"failed", "message"=>"C2. Could not place your order. Please try again."));
				}

			//Fetch data from cart
				$sql = "select p.product_rate, c.* from ".self::CART." c INNER JOIN ".self::PRODUCT." p on p.id=c.product_id where c.user_id=$user_id;";
				$result = self::$mysqli->query($sql);

				if(!$result){
					return json_encode(array("status"=>"failed", "message"=>"C3. Could not place your order. Please try again."));
				}
			
				$order_total = 0;

				while($row = $result->fetch_array(MYSQLI_ASSOC)){
			
					$product_id = $row['product_id'];
					$cart_qty = $row['cart_qty'];
					$product_total_cost = $row['cart_product_cost'];
					$product_rate = $row['product_rate'];

					$order_total += $product_total_cost;

					$sql_1 = "insert into `".self::ORDER_DETAILS."` (`order_id`, `product_id`, `order_details_product_quantity`, `order_details_product_rate`) values($last_insert_id, $product_id, $cart_qty, $product_rate);";

					$result_1 = self::$mysqli->query($sql_1) or trigger_error(self::$mysqli->error);
			
				}
			
			// Update 'ORDER' table to add 'order_total_amount' value
				$sql = "UPDATE `".self::ORDER."` SET `order_total_amount`=$order_total where `id`=".$last_insert_id.";";
				
				$result = self::$mysqli->query($sql);

				if(!$result){
					return json_encode(array("status"=>"failed", "message"=>"C6. Could not place your order. Please try again.".self::$mysqli->error));
				}

			// Delete records from 'CART' table
				$sql = "delete from ".self::CART." where user_id=$user_id;";
				$result = self::$mysqli->query($sql);

				if(!$result){
					return json_encode(array("status"=>"failed", "message"=>"C7. Could not place your order. Please try again. ".self::$mysqli->error));
				}

			return json_encode(array("status"=>"success", "message"=>"Thank you for purchasing from R.R. Sales Corporation. <br/>You can see your order details in your profile.", "data"=>$last_insert_id));
			
		}
		else if($order_from == "product"){
			$sql = "select * from ".self::PRODUCT." where product_nicename='$product_nicename';";
			$result = self::$mysqli->query($sql);

			$p_id = '';
			$p_rate = 0;

			if(!$result){
				return json_encode(array("status"=>"failed", "message"=>"No product found with the given name."));
			}
			
			$row = $result->fetch_array(MYSQLI_BOTH);

			$p_id = $row['id'];
			$p_rate = $row['product_rate'];

			$order_total = (float)$product_order_qty * (float)$p_rate;

			$sql = "insert into `".self::ORDER."` (`user_id`, `order_created_at`, `order_total_amount`, `order_status`) values($user_id, NOW(), $order_total,'pending');";
			$result = self::$mysqli->query($sql);

			if(!$result){
				return json_encode(array("status"=>"failed", "message"=>"P1. Could not place your order. Please try again."));
			}

			$last_insert_id = self::$mysqli->insert_id;

			$sql = "UPDATE `".self::ORDER."` SET `order_transaction_id` = concat(
					substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand($last_insert_id)*4294967296))*36+1, 1),
					substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
					substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
					substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
					substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
					substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
					substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
					substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed)*36+1, 1)
				)
				WHERE `id` = $last_insert_id ;";

			$result = self::$mysqli->query($sql);

			if(!$result){
				return json_encode(array("status"=>"failed", "message"=>"P2. Could not place your order. Please try again."));
			}

			$sql = "insert into `".self::ORDER_DETAILS."` (`order_id`, `product_id`, `order_details_product_quantity`, `order_details_product_rate`) values($last_insert_id, $p_id, $product_order_qty, $p_rate);";
			$result = self::$mysqli->query($sql);

			if(!$result){
				return json_encode(array("status"=>"failed", "message"=>"P3. Could not place your order. Please try again."));
			}

			return json_encode(array("status"=>"success", "message"=>"Thank you for purchasing from R.R. Sales Corporation. <br/>You can see your order details in your profile.", "data"=>$last_insert_id));

		}
		
	}

	function sendOrderInvoiceMail($email, $order_id){
		require_once('./email_format.php');

		$sql = "select o.*, od.* from `".self::ORDER."` o inner join `".self::ORDER_DETAILS."` od on o.`id`=od.`order_id` where o.`id`=$order_id;";
		$result = self::$mysqli->query($sql);

		if(!$result){
			return json_encode(array("status"=>"failed", "message"=>"Your order has been placed but we were not able to email the invoice. Please contact us if you have not recieved the invoice on your registered email id."));
		}

		$row = $result->fetch_array(MYSQLI_ASSOC);
		$order_date = $row['order_created_at'];
		$total_amount = $row['order_total_amount'];
		$transaction_id = $row['order_transaction_id'];

		$subject = "Order Invoice";

		$content = "<p style='color: #333399;'>Thank you for purchasing from R.R. Sales Corporation </p> <br/>";
		$content .= "<table>";
		$content .= "<tbody>";
		$content .= "<tr>";
		$content .= "<td> <b>Order/Transaction ID</b> </td>";
		$content .= "<td>".$transaction_id."</td>";
		$content .= "</tr>";
		$content .= "<tr>";
		$content .= "<td> <b>Order Date</b> </td>";
		$content .= "<td>".$order_date."</td>";
		$content .= "</tr>";
		$content .= "</tbody>";
		$content .= "</table>";

		$content .= "<br/><br/>";
		$content .= "<table cellpadding='20px' cellspacing='0px' style='border: 1px solid #000;'>";
		$content .= "<thead>";
		$content .= "<tr style='border: 1px solid #000;'>";
		$content .= "<th style='border: 1px solid #000;'>Product ID</th>";
		$content .= "<th style='border: 1px solid #000;'>Product name</th>";
		$content .= "<th style='border: 1px solid #000;'>Quantity</th>";
		$content .= "<th style='border: 1px solid #000;'>Total Cost</th>";
		// $content .= "<th style='border: 1px solid #000;'></th>";
		$content .= "</tr>";
		$content .= "</thead>";

		$content .= "<tbody>";

		// For 1st record.
			$sql_1 = "select product_id, product_name from ".self::PRODUCT." where id=".$row['product_id'].";";
			$result_1 = self::$mysqli->query($sql_1);
			$row_1 = $result_1->fetch_array(MYSQLI_ASSOC);
			$product_id = $row_1['product_id'];
			$product_name = $row_1['product_name'];

			$content .= "<tr style='border: 1px solid #000;'>";
			$content .= "<td style='border: 1px solid #000;'>".$product_id."</td>";
			$content .= "<td style='border: 1px solid #000;'>".$product_name."</td>";
			$content .= "<td style='border: 1px solid #000;'>".$row['order_details_product_quantity']."</td>";
			$content .= "<td style='border: 1px solid #000;'>".((float)$row['order_details_product_quantity'] * (float)$row['order_details_product_rate'])."</td>";
			$content .= "</tr>";

		while($row = $result->fetch_array(MYSQLI_ASSOC)){

			$sql_1 = "select product_id, product_name from ".self::PRODUCT." where id=".$row['product_id'].";";
			$result_1 = self::$mysqli->query($sql_1);
			$row_1 = $result_1->fetch_array(MYSQLI_ASSOC);
			$product_id = $row_1['product_id'];
			$product_name = $row_1['product_name'];

			$content .= "<tr style='border: 1px solid #000;'>";
			$content .= "<td style='border: 1px solid #000;'>".$product_id."</td>";
			$content .= "<td style='border: 1px solid #000;'>".$product_name."</td>";
			$content .= "<td style='border: 1px solid #000;'>".$row['order_details_product_quantity']."</td>";
			$content .= "<td style='border: 1px solid #000;'>".((float)$row['order_details_product_quantity'] * (float)$row['order_details_product_rate'])."</td>";
			$content .= "</tr>";
		}

		$content .= "<tr> <td colspan='2'> </td>";
		$content .= "<td> Order Total </td>";
		$content .= "<td> ".$total_amount." </td> </tr>";
		
		$content .= "</tbody>";

		$content .= "</table>";

		// return json_encode(array("status"=>"success", "message"=>$content));

		$content .= "Best, <br/>";
		$content .= "R.R. Sales Corporation,<br/> Vadodara,<br/> Gujarat";
					
		$mail_reply = json_decode(sendMail($email, $subject, $content));

		if($mail_reply == "true"){
			return json_encode(array("status"=>"success", "message"=>"Please check your mail for the order invoice."));
		}
		else{
			return json_encode(array("status"=>"failed", "message"=>"Your order has been placed but we were not able to email the invoice. Please contact us if you have not recieved the invoice on your registered email id."));
		}

		print_r($mail_reply);
		return $mail_reply;
	}

	function fetchOrderHistory($type, $user_email){
		if($type == "user"){
			
			$sql = "select id, user_id, order_total_amount, order_transaction_id, order_status, DATE_FORMAT(`order_created_at`, '%d - %M - %Y') as order_created_at from `".self::ORDER."` where `user_id` = (select `id` from `".self::USER."` where `user_email`='$user_email') order by DATE_FORMAT(`order_created_at`, '%Y-%m-%d') asc;";
			
			$result = self::$mysqli->query($sql);

			if(!$result){
				return json_encode(array("status"=>"failed", "message"=>"You have made no orders till date."));
			}

			if($result->num_rows < 1){
				return json_encode(array("status"=>"failed", "message"=>"You have made no orders till date."));
			}

			$order_arr = array();
			
			$i = 1;

			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				$sql = "select p.product_id as pid, p.product_name, o.* from ".self::ORDER_DETAILS." o inner join ".self::PRODUCT." p on o.product_id=p.id where o.order_id=".$row['id'].";";

				
				$result_2 = self::$mysqli->query($sql);

				if(!$result_2){
					return json_encode(array("status"=>"failed", "message"=>"You have made no orders till date."));
				}

				$j = 1;
				$order_details_arr = array();
				while($row_2 = $result_2->fetch_array(MYSQLI_ASSOC)){
					$order_details_arr[] = array("sr_no"=>$j, "product_id"=>$row_2['pid'], "product_name"=>$row_2['product_name'], "quantity"=>$row_2['order_details_product_quantity'], "rate"=>$row_2['order_details_product_rate']);
					$j = (int)$j + 1;
				}

				$order_arr[] = array("sr_no"=>$i, "date_time"=>$row['order_created_at'], "total_amount"=>$row['order_total_amount'], "transaction_id"=>$row['order_transaction_id'], "status"=>$row['order_status'], "details"=>$order_details_arr);

				$i++;
			}

			return json_encode( array("status"=>"success", "message"=>"All records fetched", "data"=>$order_arr) );

		}
		else if($type == "user_role"){

			$sql = "select u.*, o.id, o.user_id, o.order_total_amount, o.order_transaction_id, o.order_status, DATE_FORMAT(o.`order_created_at`, '%d - %M - %Y') as order_created_at from `".self::ORDER."` o inner join `".self::USER."` u on o.user_id=u.id order by DATE_FORMAT(o.`order_created_at`, '%Y-%m-%d') asc;";
			
			$result = self::$mysqli->query($sql);

			if(!$result){
				return json_encode(array("status"=>"failed", "message"=>"No orders have been made."));
			}

			if($result->num_rows < 1){
				return json_encode(array("status"=>"failed", "message"=>"No orders have been made."));
			}

			$order_arr = array();
			
			$i = 1;

			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				$user_name = $row['user_name'];
				$user_email = $row['user_email'];

				$sql = "select p.product_id as pid, p.product_name, o.* from ".self::ORDER_DETAILS." o inner join ".self::PRODUCT." p on o.product_id=p.id where o.order_id=".$row['id'].";";
				
				$result_2 = self::$mysqli->query($sql);

				if(!$result_2){
					return json_encode(array("status"=>"failed", "message"=>"No orders have been made."));
				}

				$j = 1;
				$order_details_arr = array();
				while($row_2 = $result_2->fetch_array(MYSQLI_ASSOC)){
					$order_details_arr[] = array("sr_no"=>$j, "product_id"=>$row_2['pid'], "product_name"=>$row_2['product_name'], "quantity"=>$row_2['order_details_product_quantity'], "rate"=>$row_2['order_details_product_rate']);
					$j = (int)$j + 1;
				}

				$order_arr[] = array("sr_no"=>$i, "user_name"=>$user_name, "user_email"=>$user_email ,"date_time"=>$row['order_created_at'], "total_amount"=>$row['order_total_amount'], "transaction_id"=>$row['order_transaction_id'], "status"=>$row['order_status'], "details"=>$order_details_arr);

				$i++;
			}

			return json_encode( array("status"=>"success", "message"=>"All records fetched", "data"=>$order_arr) );

		}
	}

	function countCart($user_email){
		$sql = "select count(*) from ".self::CART." where user_id=(select id from ".self::USER." where user_email='$user_email');";
		$result = self::$mysqli->query($sql);

		if(!$result){
			return json_encode(array("status"=>"failed", "message"=>"Some error occured. Try again."));
		}

		$row = $result->fetch_array(MYSQLI_BOTH);
		$cart_count = $row[0];

		return json_encode(array("status"=>"success", "message"=>"Success", "data"=>$cart_count));
	}

	// End Order Functions
}

DbConnection::init();

?>