<?php
include 'dblink.php';

// Check if productId is provided
if (isset($_POST['productId'])) {
    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM product WHERE productid = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind the productId parameter
    $stmt->bind_param("i", $productId);

    // Set the value of $productId
    $productId = $_POST['productId'];

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error: Product ID not provided";
}

// Close the database connection
$conn->close();
?>