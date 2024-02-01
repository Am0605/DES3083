<?php
require 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $customerName = $_POST['name'];
    $address = $_POST['address'];
    $productId = $_POST['order_productid'];
    $quantity = $_POST['quantity'];
    $discountType = $_POST['discountType'];

    // Set default discounts
    $discount = 0; // Default discount

    // Adjust discount based on selected type
    if ($discountType === 'B40') {
        $discount = 10; // B40 discount is 10%
    } elseif ($discountType === 'M40') {
        $discount = 5; // M40 discount is 5%
    }

    // Perform the order insertion into the database
    try {
        // Start a transaction
        $pdo->beginTransaction();

        // Insert order information into the order table
        $orderInsert = $pdo->prepare("INSERT INTO `order` (customername, address, productid, quantity, discount) VALUES (?, ?, ?, ?, ?)");
        $orderInsert->execute([$customerName, $address, $productId, $quantity, $discount]);

        // Commit the transaction
        $pdo->commit();

        // Return a success response (you can customize this response based on your needs)
        $response = ['success' => true, 'message' => 'Order successfully added.'];

    } catch (PDOException $e) {
        // An error occurred, rollback the transaction
        $pdo->rollBack();

        // Return an error response (you can customize this response based on your needs)
        $response = ['success' => false, 'message' => 'Error adding order: ' . $e->getMessage()];
    }

    // Output the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Handle invalid request method (e.g., redirect to an error page)
    http_response_code(405); // Method Not Allowed
    echo 'Invalid request method';
}
?>
