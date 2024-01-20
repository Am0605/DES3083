<?php
require_once 'vendor/autoload.php';

use Faker\Factory as FakerFactory;

$faker = FakerFactory::create();
$faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));



$dbHost = '127.0.0.1';
$dbName = 'sweettoothbakery';
$dbUser = 'root';
$dbPass = '';

// Create a PDO instance
$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// number of seeder for each table:
$numberOfCustomers = 10;
$numberOfProducts = 6;
$numberOfOrders = 8;
$numberOfRevenues = 8;
$numberOfSuppliers = 5;
$numberOfSales = 15;

// Seed the `customer` table


for ($i = 0; $i < $numberOfCustomers; $i++) {
    $customername = $faker->name;
    $cuscontactnumber = $faker->numerify('##########');
    $email = $faker->email;
    $address = $faker->address;

    $sql = "INSERT INTO customer (customername, cuscontactnumber, email, address) VALUES (:customername, :cuscontactnumber, :email, :address)";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':customername', $customername);
    $statement->bindParam(':cuscontactnumber', $cuscontactnumber);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':address', $address);

    $statement->execute();
}

echo "Customer table seeded successfully.\n";


// Seed the `product` table


for ($i = 0; $i < $numberOfProducts; $i++) {
    $productname = $faker->foodName();  // generates a random dish name
    $productdescription = $faker->foodDescription($faker->foodName());  // generates a random food description
    $price = $faker->numberBetween(5, 30);

    $sql = "INSERT INTO product (productname, productdescription, price) VALUES (:productname, :productdescription, :price)";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':productname', $productname);
    $statement->bindParam(':productdescription', $productdescription);
    $statement->bindParam(':price', $price);

    $statement->execute();
}

echo "Product table seeded successfully.\n";



// Seed the `order` table


for ($i = 0; $i < $numberOfOrders; $i++) {
    $customerid = $faker->numberBetween(1, $numberOfCustomers);
    $totalamount = $faker->numberBetween(20, 150);
    $date = $faker->date;

    $sql = "INSERT INTO `order` (customerid, totalamount, date) VALUES (:customerid, :totalamount, :date)";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':customerid', $customerid);
    $statement->bindParam(':totalamount', $totalamount);
    $statement->bindParam(':date', $date);

    $statement->execute();
}

echo "Order table seeded successfully.\n";



// Seed the `supplier` table


for ($i = 0; $i < $numberOfSuppliers; $i++) {
    $suppliername = $faker->company;
    $contactnum = $faker->numerify('##########');
    $email = $faker->email;

    $sql = "INSERT INTO supplier (suppliername, contactnum, email) VALUES (:suppliername, :contactnum, :email)";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':suppliername', $suppliername);
    $statement->bindParam(':contactnum', $contactnum);
    $statement->bindParam(':email', $email);

    $statement->execute();
}

echo "Supplier table seeded successfully.\n";

// Seed the `sales` table


for ($i = 0; $i < $numberOfSales; $i++) {
    $productid = $faker->numberBetween(1, $numberOfProducts);
    $supplierid = $faker->numberBetween(1, $numberOfCustomers);
    $orderid = $faker->numberBetween(1, $numberOfCustomers);
    $quantity = $faker->numberBetween(1, 10);
    $totalprice = $faker->numberBetween(50, 200);
    $date = $faker->date;

    $sql = "INSERT INTO sales (productid, supplierid, orderid, quantity, totalprice, date) VALUES (:productid, :supplierid, :orderid, :quantity, :totalprice, :date)";
    
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':productid', $productid);
    $statement->bindParam(':supplierid', $supplierid);
    $statement->bindParam(':orderid', $orderid);
    $statement->bindParam(':quantity', $quantity);
    $statement->bindParam(':totalprice', $totalprice);
    $statement->bindParam(':date', $date);

    $statement->execute();
}

// Seed the `revenue` table

for ($i = 0; $i < $numberOfRevenues; $i++) {
    $saleid = $faker->numberBetween(1, $numberOfSales);
    $totalrevenue = $faker->numberBetween(30, 200);
    $date = $faker->date;

    $sql = "INSERT INTO revenue (saleid, totalrevenue, date) VALUES (:saleid, :totalrevenue, :date)";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':saleid', $saleid);
    $statement->bindParam(':totalrevenue', $totalrevenue);
    $statement->bindParam(':date', $date);

    $statement->execute();
}

echo "Revenue table seeded successfully.\n";

echo "Sales table seeded successfully.\n";