<?php
include 'Connection.php';

$customername = $_POST['name'];
$address = $_POST['address'];
$productId = $_POST['order_productid'];
$quantity = $_POST['quantity'];
$discountType = $_POST['discountType'];

// Set default discounts
$discount = 0; // Default discount

if ($discountType === 'B40') {
    $discount = 10; // B40 discount is 10%
} elseif ($discountType === 'M40') {
    $discount = 5; // M40 discount is 5%
}

// Prepare the SQL statement with placeholders
$stmt = $pdo->prepare("INSERT INTO `order` (customername, address, productid, quantity, discount) VALUES (?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bindParam(1, $customername);
$stmt->bindParam(2, $address);
$stmt->bindParam(3, $productId);
$stmt->bindParam(4, $quantity);
$stmt->bindParam(5, $discount);

// Execute the statement
if ($stmt->execute()) {
    echo "New product added successfully";
    return 1;
} else {
    echo "Error: " . $stmt->errorInfo()[2]; // Use errorInfo() to get the specific error message
}

// Close the connection (optional)
$pdo = null;
exit();
?>
