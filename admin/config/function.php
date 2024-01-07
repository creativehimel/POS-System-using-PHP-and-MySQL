<?php
session_start();
require('dbcon.php');

//Input Field Validation function
function validate($inputData){
    global $conn;
    $validatedData = mysqli_real_escape_string($conn, $inputData);
    return trim($validatedData);
}

//Redirect from one page to another page with message
function redirect($url, $status){
    $_SESSION['status'] = $status;
    header('Location:'.$url);
    exit(0);
}

//Display the messages after any process
function alertMessage(){
    if(isset($_SESSION['status'])){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            '.$_SESSION['status'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['status']);
    }
}

// Insert record in database using this function
function insertRecord($tableName, $data){
    global $conn;
    $table = validate($tableName);
    $columns = array_keys($data);
    $values = array_values($data);
    $finalColumn = implode(',', $columns);
    $finalvalue = "'".implode("', '", $values)."'";
    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalvalue)";
    $result = mysqli_query($conn, $query);
    return $result;
}

//Update record in database using this function

function updateRecord($tableName, $id, $data){
    global $conn;
    $table = validate($tableName);
    $id = validate($id);
    $updateDataString = "";
    foreach($data as $column => $value){
        $updateDataString .= $column.'='."'$value',";
    }
    $finalUpdateData = substr(trim($updateDataString),0,-1);
    $query = "UPDATE $table SET $finalUpdateData WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Get All records using this function
function getAllRecord($tableName, $status= NULL){
    global $conn;
    $table = validate($tableName);
    $status = validate($status);
    if($status == 'status'){
        $query = "SELECT * FROM $table WHERE status = '0'";
    }else{
        $query = "SELECT * FROM $table";
    }
    return mysqli_query($conn, $query);
}

// Get Record based on id using this function
function getRecordById($tableName, $id){
    global $conn;
    $table = validate($tableName);
    $id = validate($id);
    $query = "SELECT * FROM $table WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if($result){
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $response = [
            'status' => 200,
            'data' => $row,
            'message' => 'Record Found.'
            ];
            return $response;
            
        }else{
            $response = [
            'status' => 404,
            'message' => 'No Record Found.'
            ];
            return $response;
        }
    }else{
        $response = [
            'status' => 500,
            'message' => 'Something went wrong'
        ];
        return $response;
    }
}

// Delete Record from database using this function
function deleteRecord($tableName, $id){
    global $conn;
    $table = validate($tableName);
    $id = validate($id);
    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

?>