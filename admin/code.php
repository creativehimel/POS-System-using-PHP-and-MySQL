<?php
include('config/function.php');
if(isset($_POST['saveAdmin'])){
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $status = validate($_POST['status']);
    if($name !='' && $email != '' && $password != ''){
        // email check
        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck)){
            redirect('create-admin.php', 'Email already used by another user.');
            }
        }
        
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
        
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone,
            'status' => $status
        ];
        
        $result = insertRecord('admins', $data);
        if($result){
            redirect('admin.php', 'Admin created successfully.');
        }else{
            redirect('create-admin.php', 'Something went wrong!');
        }
    }else{
        redirect('create-admin.php', 'Please fill required fields.');
    }
}
?>