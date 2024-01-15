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




// Seed the `product` table
$numberOfProducts = 6;

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
?>