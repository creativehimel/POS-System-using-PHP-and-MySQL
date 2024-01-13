<?php
require('config/function.php');

if(isset($_POST['signInBtn']))
{
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    if($email == !'' && $password == !''){
        $query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if($result){
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];
                if(!password_verify($password, $hashedPassword)){
                    redirect('login.php', 'Invalid password!! Please enter right password.');
                }
                if($row['status'] != 1){
                    redirect('login.php', 'Your account has been banned. Contact your admin.');
                }
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id'=> $row['id'],
                    'name'=> $row['name'],
                    'email'=> $row['email'],
                    'phone'=> $row['phone'],
                ];

                redirect('admin', 'Logged in successfully');

            }else{
                redirect('login.php', 'Invalid Email address!! Please enter right email address.');
            }

        }else{
            redirect('login.php', 'Something went wrong!!');
        }
    }else{
        redirect('login.php', 'All fields are requied');
    }
}
?>