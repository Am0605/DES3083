<?php
include 'Connection.php';

// Your SQL query
$product = $_POST['productid'];

$stmt = $pdo->prepare("SELECT productid, productname, productdescription, price FROM product WHERE productid = $product");

$stmt->execute();

// Fetch the data
$data = array();
    while($row = $stmt->fetch()) {
        $data[] = $row;
    }


// Output the data in JSON format
echo json_encode($data);

// Close the connection
$pdo = null;
?>