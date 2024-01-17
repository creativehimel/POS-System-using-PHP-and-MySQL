<?php
include('config/function.php');

$paramResult = checkParam('id');
if (is_numeric($paramResult)){
    $id = validate($paramResult);
    $product = getRecordById('products', $id);
    if ($product['status'] == 200){
        $productDeleteRes = deleteRecord('products', $id);
        if ($productDeleteRes){
            $deleteImage = "../".$product['data']['image'];
            if(file_exists($deleteImage)){
                unlink($deleteImage);
            }
            redirect('products.php', 'Product deleted successfully.');
        }else{
            redirect('products.php', 'Something went wrong!!');
        }
    }else{
        redirect('products.php', $product['message']);
    }
}else{
    redirect('products.php', 'Invalid param ID!');
}
