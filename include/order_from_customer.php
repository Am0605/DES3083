<?php
include 'Connection.php';

$name = $_POST['name'];
$contactnum = $_POST['contactNumber'];
$email = $_POST['email'];
$address = $_POST['address'];
$product = $_POST['product'];
$quantity = $_POST['quantity'];

$data1 = [
    'name' => $name,
    'contactnum' => $contactnum,
    'email' => $email,
    'address' => $address
];

$data2 = [
    'product' => $product,
    'quantity' => $quantity,
];

//pakai placeholder sini
$sql = "INSERT INTO customer (customername, cuscontactnumber, email, address)
VALUES (:name, :contactnum, :email,:address)";
//buat pdo dari connection. ni prepare for sanitation
$stmt = $pdo->prepare($sql);

if ($stmt->execute($data1)) {
    echo "New product added successfully";
    return 1;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$pdo = null;
exit();
?>