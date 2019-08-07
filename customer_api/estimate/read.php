<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/estimates.php';
 
$database = new Database();
$db = $database->getConnection();
 
$shifting_info = new estimates($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->city) &&
    !empty($data->moving_from) &&
    !empty($data->moving_to) &&
    !empty($data->move_size) &&
    !empty($data->moving_date) &&
    !empty($data->is_inspection) &&
    !empty($data->shifting_type) &&
    !empty($data->shifting_sub_type) &&
    !empty($data->created_date) &&
    !empty($data->last_update_date)
){
 
    // set product property values
    $shifting_info->id=$data->id ;
    $shifting_info->city=$data->city ;
    $shifting_info->moving_from=$data->moving_from ;
    $shifting_info->moving_to=$data->moving_to ;
    $shifting_info->move_size=$data->move_size ;
    $shifting_info->moving_date=$data->moving_date ;
    $shifting_info->is_inspection=$data->is_inspection ;
    $shifting_info->shifting_type=$data->shifting_type ;
    $shifting_info->shifting_sub_type=$data->shifting_sub_type;
    $shifting_info->created_date=$data->created_date;
    $shifting_info->last_update_date=$data->last_update_date;
    
     // create the product
    if($shifting_info->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Estimate was created."));
    }
 
    // if unable to create the product, tell the user
    else{
     // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create Estimate."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create Estimate. Data is incomplete."));
}
?>