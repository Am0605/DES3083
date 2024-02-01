<?php
include 'Connection.php';

// Set the content type to JSON

    $stmt = $pdo->prepare("SELECT p.productid, o.orderid, o.customername, o.address, p.productname, o.quantity, p.price, o.discount 
    FROM `order` o
    INNER JOIN product p ON o.productid = p.productid");

    $stmt->execute();

    // Fetch the data
    $data = array();
    while ($row = $stmt->fetch()) {
        $data[] = $row;
    }

    // Output the data in JSON format
    echo json_encode($data);

    // Close the database connection
    $pdo = null;

?>
