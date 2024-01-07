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



?>