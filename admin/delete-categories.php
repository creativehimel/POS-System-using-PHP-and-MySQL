<?php
include('config/function.php');

$paramResult = checkParam('id');
if (is_numeric($paramResult)){
    $id = validate($paramResult);
    $category = getRecordById('categories', $id);
    if ($category['status'] == 200){
        $categoryDeleteRes = deleteRecord('categories', $id);
        if ($categoryDeleteRes){
            redirect('categories.php', 'Admin deleted successfully.');
        }else{
            redirect('categories.php', 'Something went wrong!!');
        }
    }else{
        redirect('categories.php', $admin['message']);
    }
}else{
    redirect('categories.php', 'Invalid param ID!');
}
?>