<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: DELETE");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	 
	 
	// get database connection
	include_once '../config/db.php';
	 
	// instantiate product object
	include_once '../objects/comment.php';

	// get database connection
	$database = new Database();
	$db = $database->getConnection();
	 
	// prepare product object
	$comment = new Comment($db);
	
	// get product id
	$data = json_decode(file_get_contents("php://input"));
	
	if (!is_null($data)) {
		// set product id to be deleted
		$comment->id = $data->id;
		 
		// delete the product
		if($comment->delete()){
		    echo '{';
		        echo '"message": "Product was deleted."';
		    echo '}';
		}
		else{ // if unable to delete the product
		    echo '{';
		        echo '"message": "Unable to delete object."';
		    echo '}';
		}
	}
	else{
	    echo '{';
	        echo '"message": "empty"';
	    echo '}';
	}
	
?>