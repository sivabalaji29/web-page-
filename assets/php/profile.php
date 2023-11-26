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

$stmt = $mysqlConnection->prepare("SELECT id, username, name, age, dob, contact FROM register WHERE username = ?");
$stmt->bind_param("s", 'current_user_username'); // Replace 'current_user_username' with the actual username
$stmt->execute();
$result = $stmt->get_result();
$userDetailsMySQL = $result->fetch_assoc();

// Check if the result is not empty
if ($userDetailsMySQL !== null) {
    $response['success'] = true;
    $response['message'] = 'User profile details retrieved successfully';
    $response['userDetails'] = $userDetailsMySQL;
} else {
    $response['message'] = 'User profile not found';
}

$stmt->close();
$mysqlConnection->close();

echo json_encode($response);
?>
