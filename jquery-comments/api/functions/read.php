<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	 
	// include database and object files
	include_once '../config/db.php';
	include_once '../objects/comment.php';
	 
	// instantiate database and product object
	$database = new Database();
	$db = $database->getConnection();
	 
	// initialize object
	$comment = new Comment($db);
	 
	//parameters
	$langParametro = $_GET['lang'];
	$adminParametro = $_GET['admin'];

	// query products
	$stmt = $comment->read($langParametro);
	$num = $stmt->rowCount();
	
	// check if more than 0 record found
	if($num>0){
	 
	    // products array
	    $comments_arr=array();
	    $comments_arr["records"]=array();
	 
	    // retrieve our table contents
	    // fetch() is faster than fetchAll()
	    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	        // extract row
	        // this will make $row['name'] to
	        // just $name only
	        extract($row);
	 
	        $comment_item=array(
	        	"id" => $id,
				"fullname" => $fullname,
				"content" => $content,
				"created" => $created
	        );

	        if ($adminParametro > 0){
	        	$comment_item['created_by_current_user'] = $created_by_current_user;
	        }
	 
	        array_push($comments_arr["records"], $comment_item);
	    }
	 
	    echo json_encode($comments_arr);
	}
	else{
	    echo json_encode(
	        array("message" => "empty")
	    );
	}
?>