<?php 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = $_SESSION['user_token'];
    $productId = $_GET['productid'];
  
    $query = "SELECT 1 FROM likes WHERE userid = ? AND productid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $userId, $productId);
    $stmt->execute();
    $stmt->store_result();
  
    echo json_encode($stmt->num_rows > 0);
  }


?>