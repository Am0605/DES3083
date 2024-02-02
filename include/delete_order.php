<?php
include 'Connection.php';


if (isset($_POST['orderId'])) {
    
    $sql = "DELETE FROM `order` WHERE orderid = ?";
    
    $stmt = $pdo->prepare($sql);

    $orderId = $_POST['orderId']; 

    $stmt->bindParam(1, $orderId);

 
    if ($stmt->execute()) {
        echo "Order deleted successfully";
    } else {
        echo "Error deleting order: " . $stmt->errorInfo()[2];
    }

    $stmt = null;
} else {
    echo "Error: Order ID not provided";
}

$pdo = null;
?>
