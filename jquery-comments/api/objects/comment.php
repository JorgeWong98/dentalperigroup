<?php

    class Comment{
     
        // database connection and table name
        private $conn;
        private $table_name = "jquery_comments";

        // object properties
        public $id;
        public $lang;
        public $creator;
        public $fullname;
        public $content;
        public $item;
        public $parent;

        public $upvote_count;
        public $user_has_upvoted;

        public $created;
        public $created_by_staff;
        public $created_by_current_user;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        // read products
        function read($lang){
            // select all query
            $query = "  SELECT C.id, C.created, C.content, C.fullname, True AS created_by_current_user 
                        FROM ".$this->table_name." C 
                        WHERE C.lang = '".$lang."' 
                        ORDER BY C.created DESC";

            // prepare query statement
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            return $stmt;
        }

        // create product
        function create(){
         
            // query to insert record
            $query =    "   INSERT INTO " . $this->table_name . " SET
                                id = :id,
                                lang = :lang,
                                fullname = :fullname,
                                content = :content,
                                created = now()
                        ";
         
            // prepare query
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->lang = htmlspecialchars(strip_tags($this->lang));
            // $this->creator = htmlspecialchars(strip_tags($this->creator));
            $this->fullname = htmlspecialchars(strip_tags($this->fullname));
            $this->content = htmlspecialchars(strip_tags($this->content));
            // $this->item = htmlspecialchars(strip_tags($this->item));
            // $this->parent = htmlspecialchars(strip_tags($this->parent));
            // $this->upvote_count = htmlspecialchars(strip_tags($this->upvote_count));
            // $this->user_has_upvoted = htmlspecialchars(strip_tags($this->user_has_upvoted));
            // $this->created = htmlspecialchars(strip_tags($this->created));
            // $this->created_by_staff = htmlspecialchars(strip_tags($this->created_by_staff));
            // $this->created_by_current_user = htmlspecialchars(strip_tags($this->created_by_current_user));
            // sanitizeArray($this);
         
            // params
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":lang", $this->lang);
            // $stmt->bindParam(":creator", $this->creator);
            $stmt->bindParam(":fullname", $this->fullname);
            $stmt->bindParam(":content", $this->content);
            // $stmt->bindParam(":item", $this->item);
            // $stmt->bindParam(":parent", $this->parent);
            // $stmt->bindParam(":upvote_count", $this->upvote_count);
            // $stmt->bindParam(":user_has_upvoted", $this->user_has_upvoted);
            // $stmt->bindParam(":created", $this->created);
            // $stmt->bindParam(":created_by_staff", $this->created_by_staff);
            // $stmt->bindParam(":created_by_current_user", $this->created_by_current_user);
            // bindArray($stmt, $this);
            
            // execute query
            if($stmt->execute()){
                return true;
            }else{
                print_r($stmt->errorInfo());
                return false;
            }

        }

        // delete the product
        function delete(){
         
            // delete query
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
         
            // prepare query
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
         
            // bind id of record to delete
            $stmt->bindParam(1, $this->id);
         
            // execute query
            if($stmt->execute()){
                return true;
            }
         
            return false;
        }

        // update the product
        function update(){
            // update query
            $query = "UPDATE " . $this->table_name . " SET content = :content WHERE id = :id";
         
            // prepare query statement
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->content=htmlspecialchars(strip_tags($this->content));
         
            // bind new values
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':content', $this->content);
         
            // execute the query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }

    


    // FUNCIONALIDADES -- PENDIENTE AUTOMATIZAR LOS PARAMETROS A USAR
    function sanitizeArray(&$input) {
        if (is_array($input)) {
            foreach($input as $var=>$val) {
                $input[$var] = htmlspecialchars(strip_tags($val));
            }
        }
    }

    function bindArray(&$dbObject, $input) {
        if (is_array($input)) {
            foreach($input as $var=>$val) {
                echo "entre".$var;
                $dbObject->bindParam(":".$var."", $val);
            }
        }
    }
