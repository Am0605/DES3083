<?php
include 'Connection.php';

$productname = $_POST['productname'];
$productdescription = $_POST['productdescription'];
$productprice = $_POST['price'];

$data = [
    'productname' => $productname,
    'productdescription' => $productdescription,
    'price' => $productprice,
];
//pakai placeholder sini
$sql = "INSERT INTO product (productname, productdescription, price)
VALUES (:productname, :productdescription, :price)";
//buat pdo dari connection. ni prepare for sanitation
$stmt = $pdo->prepare($sql);

if ($stmt->execute($data)) {
    echo "New product added successfully";
    return 1;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$pdo = null;
exit();
?>