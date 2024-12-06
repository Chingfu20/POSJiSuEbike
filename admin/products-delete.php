<?php

require '../config/function.php';

$paraResultId = checkParamId('id');
if (is_numeric($paraResultId)){

    $productId = validate($paraResultId);

    $product = getById('products',$productId);

    if($product['status'] == 200)
    {
        $response = delete('products', $productId);
        if($response)
        {
            $deleteImage = "../".$product['data']['image'];
            if(file_exists($deleteImage)){
                unlink($deleteImage);
            }
            
            redirect('products', 'Product Deleted Successfully');
        }
        else
        {
            redirect('products', 'Something Went Wrong.');
        }
    }
    else
    {
        redirect('products',$product['message']);   
    }
}else{
    redirect('products', 'Something Went Wrong.');
}

?>
