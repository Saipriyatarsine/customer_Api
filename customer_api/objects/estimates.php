<?php
class estimates{
 
    // database connection and table name
    private $conn;
    private $table_name = "shifting_info";
 
    // object properties
    public $id;
    public $city;
    public $moving_from;
    public $moving_to;
    public $move_size;
    public $moving_date;
    public $is_inspection;
    public $shifting_type;
    public $shifting_sub_type;
    public $created_date;
    public $last_update_date;


     
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
// create product
function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            id=:id, city=:city, moving_from=:moving_from, moving_to=:moving_to
            move_size=:move_size, moving_date=:moving_date, is_inspection=:is_inspection
            shifting_type=:shifting_type,  shifting_sub_type=:shifting_sub_type,
            created_date=:created_date, last_update_date=:last_update_date";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->city=htmlspecialchars(strip_tags($this->city));
    $this->moving_from=htmlspecialchars(strip_tags($this->moving_from));
    $this->moving_to=htmlspecialchars(strip_tags($this->moving_to));
    $this->move_size=htmlspecialchars(strip_tags($this->move_size));
    $this->moving_date=htmlspecialchars(strip_tags($this->moving_date));
    $this->is_inspection=htmlspecialchars(strip_tags($this->is_inspection));
    $this->shifting_type=htmlspecialchars(strip_tags($this->shifting_type));
    $this->shifting_sub_type=htmlspecialchars(strip_tags($this->shifting_sub_type));
    $this->created_date=htmlspecialchars(strip_tags($this->created_date));
    $this->last_update_date=htmlspecialchars(strip_tags($this->last_update_date));

     
    // bind values
    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":city", $this->city);
    $stmt->bindParam(":moving_from", $this->moving_from);
    $stmt->bindParam(":moving_to", $this->moving_to);
    $stmt->bindParam(":move_size", $this->move_size);
    $stmt->bindParam(":moving_date", $this->moving_date);
    $stmt->bindParam(":is_inspection", $this->is_inspection);
    $stmt->bindParam(":shifting_type", $this->shifting_type);
    $stmt->bindParam(":shifting_sub_type", $this->shifting_sub_type);
    $stmt->bindParam(":created_date", $this->created_date);
    $stmt->bindParam(":last_update_date", $this->last_update_date);

    
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

    // read products
function read(){
 
    // select all query
    $query = "SELECT
    id,  city, moving_from, moving_to, move_size, moving_date, is_inspection,
    shifting_type, shifting_sub_type, created_date, last_update_date
            FROM
                " . $this->table_name . " ";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}