<?php
session_start();

// Ensure user_id is stored in session
if (!isset($_SESSION['user_token'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_token'];

include '../base/conn.php'; // Ensure this path is correct

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement to prevent SQL injection
$sql = "SELECT `image` FROM products WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = '../uploads/' . $row['image']; // Assuming images are stored in an 'uploads' directory
}

$stmt->close();
$conn->close();

echo json_encode($images);
?>
