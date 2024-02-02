<?php
include 'Connection.php';

// Check if necessary data is provided
if (isset($_POST['editorderid']) && isset($_POST['editcustomername']) && isset($_POST['editaddress']) && isset($_POST['editorder_productid']) && isset($_POST['editquantity']) && isset($_POST['editdiscountType'])) {
    $editOrderId = $_POST['editorderid'];
    $editCustomerName = $_POST['editcustomername'];
    $editAddress = $_POST['editaddress'];
    $editProductId = $_POST['editorder_productid'];
    $editQuantity = $_POST['editquantity'];
    $editDiscountType = $_POST['editdiscountType'];

    // Set default discounts
    $editDiscount = 0; // Default discount

    if ($editDiscountType === 'B40') {
        $editDiscount = 10; // B40 discount is 10%
    } elseif ($editDiscountType === 'M40') {
        $editDiscount = 5; // M40 discount is 5%
    }

    // Prepare the SQL statement with placeholders
    $stmt = $pdo->prepare("UPDATE `order` SET customername = ?, address = ?, productid = ?, quantity = ?, discount = ? WHERE orderid = ?");

    // Bind parameters
    $stmt->bindParam(1, $editCustomerName);
    $stmt->bindParam(2, $editAddress);
    $stmt->bindParam(3, $editProductId);
    $stmt->bindParam(4, $editQuantity);
    $stmt->bindParam(5, $editDiscount);
    $stmt->bindParam(6, $editOrderId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Order updated successfully";
    } else {
        echo "Error updating order: " . $stmt->errorInfo()[2];
    }

    // Close the statement
    $stmt = null;
} else {
    echo "Error: Missing data for updating order";
}

// Close the database connection
$pdo = null;
exit();
?>