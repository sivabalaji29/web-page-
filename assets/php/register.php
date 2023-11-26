<?php
// MySQL Connection
$mysqlConnection = new mysqli("localhost", "root", "", "siva", 4306);

if ($mysqlConnection->connect_error) {
    die("MySQL Connection failed: " . $mysqlConnection->connect_error);
}

// Assuming 'id' is an auto-increment column
$stmt = $mysqlConnection->prepare("INSERT INTO register (id, username, name, age, dob, contact, password) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Hash the password
$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt->bind_param("ssissss", $_POST['id'], $_POST['username'], $_POST['name'], $_POST['age'], $_POST['dob'], $_POST['contact'], $hashedPassword);

$stmt->execute();

$stmt->close();
$mysqlConnection->close();

// MongoDB Connection
try {
    require 'vendor/autoload.php'; // Load Composer's autoloader

    $mongoConnection = new MongoDB\Client("mongodb://localhost:27017");
    $mongoCollection = $mongoConnection->siva->register;

    // Hash the password for MongoDB as well
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $userProfile = [
        'username' => $_POST['username'],
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'dob' => $_POST['dob'],
        'contact' => $_POST['contact'],
        'password' => $hashedPassword // Use the hashed password
    ];

    $mongoCollection->insertOne($userProfile);

    echo "MongoDB Registration successful";
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "MongoDB Connection failed: " . $e->getMessage();
}

// Redirect to the login page
header("Location: /assets/html/login.html");
exit(); // Ensure that no further code is executed after the header
?>
