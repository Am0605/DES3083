<?php
include 'dblink.php';

// Your SQL query
$product = $_POST['productid'];
$sql = "SELECT productid, productname, productdescription, price FROM product WHERE productid = $product";

// Execute the query
$result = $conn->query($sql);

// Fetch the data
$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}

// Output the data in JSON format
echo json_encode($data);

// Close the connection
$conn->close();
?>