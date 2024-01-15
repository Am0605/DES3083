<?php
include 'Connection.php';

$stmt = $pdo->prepare("SELECT productid, productname FROM product");

$stmt->execute();

// Fetch the data
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the data in JSON format
echo json_encode($data);

// Close the connection
$pdo = null;
?>