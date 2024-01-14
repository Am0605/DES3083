<?php
require 'Connection.php';

$productId = $_POST['productid'];
    $productname = $_POST['productname'];
    $productdescription = $_POST['productdescription'];
    $price = $_POST['price'];

    $sql = "UPDATE product SET productname=:productname, productdescription=:productdescription, price=:price WHERE productid=:productid";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':productname', $productname);
    $stmt->bindParam(':productdescription', $productdescription);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':productid', $productId);

    if ($stmt->execute()) {
        echo "Product updated successfully!";
    } else {
        echo "Error updating product: " . $stmt->errorInfo()[2];
    }

    // Close the database connection
    $pdo = null; 
?>
