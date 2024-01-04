<?php
include 'dblink.php'; // Assuming this file contains your database connection code
// Check if form data is received
    // Assuming your form has a hidden input field for product ID named 'productId'
    $productId = $_POST['productid'];
    $productname = $_POST['productname'];
    $productdescription = $_POST['productdescription'];
    $price = $_POST['price'];

    
    $sql = "UPDATE product SET productname='$productname', productdescription='$productdescription', price='$price' WHERE productid= '$productId'";
    
    // Execute the query
    $result = $conn->query($sql);
    // Close the prepared statemen

// Close the database connection
$conn->close();
?>
