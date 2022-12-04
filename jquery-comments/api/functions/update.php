<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: PUT");
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
	 
	// get id of product to be edited
	$data = json_decode(file_get_contents("php://input"));

	if (!is_null($data)) {
		$comment->id = $data->id;
		$comment->content = $data->content;

		// create the product
		if($comment->update()){
		    echo '{';
		        echo '"message": "succes"';
		    echo '}';
		}
		else{ // if unable to create the product, tell the user
		    echo '{';
		        echo '"message": "error"';
		    echo '}';
		}
	}
	else{
	    echo '{';
	        echo '"message": "empty"';
	    echo '}';
	}
	 
?>