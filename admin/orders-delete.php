<?php

require '../config/function.php';

$paraResultId = checkParamId('id');
if (is_numeric($paraResultId)){

    $deleteId = validate($paraResultId);

    $delete = getById('delete',$deleteId);

    if($delete['status'] == 200)
    {
        $response = delete('delete', $deleteId);
        if($response)
        {
            $deleteImage = "../".$delete['data']['image'];
            if(file_exists($deleteImage)){
                unlink($deleteImage);
            }
            
            redirect('orders.php', 'Delete Deleted Successfully');
        }
        else
        {
            redirect('orders.php', 'Something Went Wrong.');
        }
    }
    else
    {
        redirect('orders.php',$delete['message']);   
    }
}else{
    redirect('orders.php', 'Something Went Wrong.');
}

?>
