<?php
include 'Connection.php';

// Set the content type to JSON
header('Content-Type: application/json');

try {
    $sql = "SELECT p.productid, o.orderid, o.customername, o.address, p.productname, o.quantity, p.price, o.discount 
        FROM `order` o
        JOIN product p ON o.productid = p.productid";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch the data
    $data = array();

    while ($row = $stmt->fetch()) {
        $data[] = $row;
    }

    // Output the data in JSON format
    echo json_encode(["data" => $data]);
} catch (Exception $e) {
    // Handle exceptions and return an error response
    echo json_encode(["error" => "An error occurred"]);
} finally {
    // Close the database connection
    $pdo = null;
}
?>
