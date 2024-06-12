<?php
// Start the session
session_start();

// Include database connection
include '../base/conn.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the user ID from the session
if (isset($_GET['userid'])) {
    $userId = $_GET['userid'];

    // Fetch liked products
    $likedSql = "SELECT productid FROM likes WHERE userid = '$userId'";
    $likedResult = $conn->query($likedSql);

    $likedProducts = [];
    if ($likedResult->num_rows > 0) {
        while($row = $likedResult->fetch_assoc()) {
            $likedProducts[] = $row['productid'];
        }
    }

    // Fetch saved products
    $savedSql = "SELECT productid FROM saves WHERE userid = '$userId'";
    $savedResult = $conn->query($savedSql);

    $savedProducts = [];
    if ($savedResult->num_rows > 0) {
        while($row = $savedResult->fetch_assoc()) {
            $savedProducts[] = $row['productid'];
        }
    }

    // Combine results into an associative array
    $userActions = [
        'likes' => $likedProducts,
        'saves' => $savedProducts
    ];

    echo json_encode($userActions);
} else {
    echo json_encode([]);
}

$conn->close();
?>
