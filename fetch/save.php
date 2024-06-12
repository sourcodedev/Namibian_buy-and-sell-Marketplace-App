<?php
// Start the session
session_start();

// Retrieve the user ID from the session
if (isset($_SESSION['user_token'])) {
    $userId = $_SESSION['user_token'];
} else {
    // Redirect the user to the authentication page if not logged in
    header("Location: ../auth/");
    exit; // Stop further execution
}

// Include database connection
include '../base/conn.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a random alphanumeric string
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $length > $i; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $productid = $_POST['productid'];
    $userid = $userId;

    if ($action === 'save') {
        // Generate a random save ID
        $saveid = generateRandomString(10);
        $message = "User saved a product"; // Customize your message if needed
        $date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO saves (saveid, productid, userid, message, date) VALUES ('$saveid', '$productid', '$userid', '$message', '$date')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action === 'unsave') {
        $sql = "DELETE FROM saves WHERE productid='$productid' AND userid='$userid'";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
