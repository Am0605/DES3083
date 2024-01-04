<?php
include 'dblink.php';

$productname = $_POST['productname'];
$productdescription = $_POST['productdescription'];
$productprice = $_POST['price'];

$sql = "INSERT INTO product (productname, productdescription, price)
VALUES ('$productname', '$productdescription', '$productprice')";

if ($conn->query($sql) === TRUE) {
    echo "New product added successfully";
    return 1;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
exit();
?>