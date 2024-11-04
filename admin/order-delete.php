<?php
include('includes/header.php');

if(isset($_GET['id'])) {
    $orderId = validate($_GET['id']);
    
    $checkOrder = "SELECT * FROM orders WHERE id='$orderId'";
    $checkOrderResult = mysqli_query($conn, $checkOrder);
    
    if(mysqli_num_rows($checkOrderResult) > 0) {
        $deleteOrderItems = "DELETE FROM order_items WHERE order_id='$orderId'";
        $deleteOrderItemsResult = mysqli_query($conn, $deleteOrderItems);
        
        $deleteOrder = "DELETE FROM orders WHERE id='$orderId'";
        $deleteOrderResult = mysqli_query($conn, $deleteOrder);
        
        if($deleteOrderResult) {
            redirect('orders.php', 'Order deleted successfully');
        } else {
            redirect('orders.php', 'Something went wrong');
        }
    } else {
        redirect('orders.php', 'No such order found');
    }
} else {
    redirect('orders.php', 'Order id missing');
}
?>