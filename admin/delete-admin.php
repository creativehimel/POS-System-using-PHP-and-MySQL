<?php
include('config/function.php');

$paramResult = checkParam('id');
if (is_numeric($paramResult)){
    $id = validate($paramResult);
    $admin = getRecordById('admins', $id);
    if ($admin['status'] == 200){
        $adminDeleteRes = deleteRecord('admins', $id);
        if ($adminDeleteRes){
            redirect('admin.php', 'Admin deleted successfully.');
        }else{
            redirect('admin.php', 'Something went wrong!!');
        }
    }else{
        redirect('admin.php', $admin['message']);
    }
}else{
    redirect('admin.php', 'Invalid param ID!');
}
?>