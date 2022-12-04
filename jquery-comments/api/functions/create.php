<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	 
	// get database connection
	include_once '../config/db.php';
	 
	// instantiate product object
	include_once '../objects/comment.php';
	 
	$database = new Database();
	$db = $database->getConnection();
	 
	$comment = new Comment($db);
	 
	// get posted data
	$data = json_decode(file_get_contents("php://input"));
	
	// set product property values
	if (!is_null($data)) {
		$comment->id = $data->id;
		// $comment->creator = $data->creator;
		$comment->fullname = $data->fullname;
		$comment->content = $data->content;
		$comment->lang = $data->lang;
		// $comment->item = $data->item;
		// $comment->parent = $data->parent;
		// $comment->upvote_count = $data->upvote_count;
		// $comment->user_has_upvoted = $data->user_has_upvoted;
		// $comment->created_by_staff = $data->created_by_staff;
		// $comment->created_by_current_user = $data->created_by_current_user;

		// create the product
		if($comment->create()){
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