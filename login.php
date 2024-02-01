<?php
include 'include/Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $row["password"])) {
            $role = $row["role"];

            // Redirect to the appropriate page based on the role
            if ($role == "admin") {
                header("Location: admin_dashboard.php");
                exit();
            } elseif ($role == "staff") {
                header("Location: staff_dashboard.php");
                exit();
            } else {
                echo "Invalid role";
            }
        } else {
            echo "Invalid username or password";
            echo "Entered username: $username<br>";
            echo "Entered password: $password<br>";
            print_r($row);
        }
    } else {
        echo "Invalid username or password";
        echo "Entered username: $username<br>";
        echo "Entered password: $password<br>";
        print_r($row);
    }
}
