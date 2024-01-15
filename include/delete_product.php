<?php
include 'Connection.php';

// Check if productId is provided
if (isset($_POST['productId'])) {
    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM product WHERE productid = ?";
    
    
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(1,$productId);

    // Set the value of $productId
    $productId = $_POST['productId'];

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $pdo->errorInfo()[2];
    }

    // Close the statement
    $stmt = null;
} else {
    echo "Error: Product ID not provided";
}

// Close the database connection
$pdo = null;
?>