<?php
include 'Connection.php';

// $sql = "SELECT productid, productname, productdescription, price FROM product";

$stmt = $pdo->prepare("SELECT productid, productname, productdescription, price FROM product");

$stmt->execute();

// Fetch the data
$data = array();

    while($row = $stmt->fetch()) {
        $data[] = $row;
    }


// Output the data in JSON format
echo json_encode($data);

$pdo = null;
?>