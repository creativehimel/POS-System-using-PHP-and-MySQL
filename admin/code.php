<?php

include('config/function.php');
require('config/dbcon.php');
global $conn;
// Add admin code
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

// Update Admin data code
if(isset($_POST['updateAdmin'])){
    $id = validate($_POST['id']);
    $adminRecord = getRecordById('admins',$id);
    if ($adminRecord['status'] != 200){
        redirect('edit-admin.php?id='.$id, 'Please fill required fields.');
    }
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $status = validate($_POST['status']);
    $emailCheckQuery = "SELECT * FROM admins WHERE email='$email' AND id != '$id'";
    $emailCheck = mysqli_query($conn, $emailCheckQuery);
    if ($emailCheck){
        if (mysqli_num_rows($emailCheck) > 0){
            redirect('edit-admin.php?id='.$id, 'Email already used by another user.');
        }
    }
    if ($password != ''){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }else{
        $hashedPassword = $adminRecord['data']['password'];
    }
    if($name !='' && $email != '') {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'status' => $status
        ];
        $result = updateRecord('admins', $id, $data);
        if($result){
            redirect('admin.php', 'Admin updated successfully.');
        }else{
            redirect('edit-admin.php?id='.$id, 'Something went wrong!');
        }
    }else{
        redirect('create-admin.php', 'Please fill required fields.');
    }
    }

// Add Category Code
if(isset($_POST['saveCategory'])){
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = validate($_POST['status']);
    $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];
        
    $result = insertRecord('categories', $data);
    if($result){
        redirect('categories.php', 'Category created successfully.');
    }else{
        redirect('create-categories.php', 'Something went wrong!');
    }
}

//Update Category code 
if(isset($_POST['updateCategory'])){
    $catId = validate($_POST['id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = validate($_POST['status']);
    $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];
        
    $result = updateRecord('categories', $catId, $data);
    if($result){
        redirect('categories.php', 'Category updated successfully.');
    }else{
        redirect('edit-categories.php', 'Something went wrong!');
    }
}

// Create a product code
if(isset($_POST['saveProduct'])){
    
    $name = validate($_POST['name']);
    $category_id = validate($_POST['category_id']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $description = validate($_POST['description']);
    $status = validate($_POST['status']);
    if($_FILES['image']['size'] > 0){
        $path = '../assets/uploads/products';
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = 'product-'.time() .'.'. $image_ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $path .'/'. $fileName);
        $finalImage = $path .'/'. $fileName;
    }else{
        $finalImage = '';
    }
    $data = [
            'category_id' => $category_id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'quantity' => $quantity,
            'image' => $finalImage,
            'status' => $status
        ];
        
    $result = insertRecord('products', $data);
    if($result){
        redirect('products.php', 'Product created successfully.');
    }else{
        redirect('create-products.php', 'Something went wrong!');
    }
}
