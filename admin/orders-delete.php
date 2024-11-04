<?php
require '../config/function.php';

$paraResultId = checkParamId('id');

if(is_numeric($paraResultId)) 
{
    $orderId = validate($paraResultId);
    
    // First check if order exists
    $order = getById('orders', $orderId);
    
    if($order['status'] == 200) 
    {
        // Delete order items first
        $orderItems = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id='$orderId'");
        
        if($orderItems) 
        {
            while($item = mysqli_fetch_array($orderItems)) 
            {
                $deleteOrderItems = delete('order_items', $item['id']);
                if(!$deleteOrderItems) {
                    redirect('orders.php', 'Something went wrong while deleting order items.');
                    exit();
                }
            }
        }
        
        // Now delete the main order
        $response = delete('orders', $orderId);
        
        if($response) 
        {
            // If order has any attached files/images
            if(isset($order['data']['invoice_file']) && !empty($order['data']['invoice_file']))
            {
                $deleteFile = "../".$order['data']['invoice_file'];
                if(file_exists($deleteFile)){
                    unlink($deleteFile);
                }
            }
            
            redirect('orders.php', 'Order Deleted Successfully');
        } 
        else 
        {
            redirect('orders.php', 'Something Went Wrong While Deleting Order.');
        }
    } 
    else 
    {
        redirect('orders.php', $order['message']);
    }
} 
else 
{
    redirect('orders.php', 'Invalid ID Parameter');
}

?>