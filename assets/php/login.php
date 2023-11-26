<?php
header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Invalid credentials'];

// MySQL Connection
$mysqlConnection = new mysqli("localhost", "root", "", "siva", 4306);

if ($mysqlConnection->connect_error) {
    $response['message'] = "MySQL Connection failed: " . $mysqlConnection->connect_error;
    echo json_encode($response);
    exit();
}

// Store the value of $_POST['username'] in a separate variable
$username = $_POST['username'];

$stmt = $mysqlConnection->prepare("SELECT * FROM register WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Check if the entered password matches the stored hash
    if (password_verify($_POST['password'], $row['password'])) {
        $response['success'] = true;
        $response['message'] = 'Login successful';
    } else {
        $response['message'] = 'Invalid password';
    }
} else {
    $response['message'] = 'Invalid username';
}

$stmt->close();
$mysqlConnection->close();

echo json_encode($response);
?>
