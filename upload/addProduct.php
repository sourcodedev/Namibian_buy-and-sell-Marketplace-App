<?php
// Include the database connection file
include '../base/conn.php';

// Start the session
session_start();

// Retrieve the user ID from the session
if(isset($_SESSION['user_token'])) {
    $userId = $_SESSION['user_token'];
} else {
    // Handle the case where the user is not logged in or user token is not set
    // For example, you might redirect the user to the login page
    header("Location: ../index.php");
    exit; // Stop further execution
}

// Fetch the full name associated with the user token from the database
$sqlFullName = "SELECT full_name FROM users WHERE token = '$userId'";
$resultFullName = $conn->query($sqlFullName);
if ($resultFullName->num_rows > 0) {
    $row = $resultFullName->fetch_assoc();
    $fullName = $row['full_name'];
} else {
    // Handle the case where full name is not found
    $fullName = ''; // or any default value you want
}

// Retrieve caption and category from POST data
$caption = $_POST['caption'];
$category = $_POST['category'];
$productid = uniqid(); // Generate unique product ID for each product

// Prepare and execute SQL insert statements for each product
foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {

    $image = basename($_FILES['files']['name'][$key]); // Get file name
    $image = $conn->real_escape_string($image); // Escape special characters to prevent SQL injection

    // Insert product data into the 'products' table including productid, userid, and username
    $sql = "INSERT INTO products (productid, image, caption, category, userid, username) 
            VALUES ('$productid', '$image', '$caption', '$category', '$userId', '$fullName')";
    
    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        
        // Move uploaded file to 'uploads' folder
        $uploadsDirectory = '../uploads/';
        $targetFile = $uploadsDirectory . $image;
        if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $targetFile)) {
            echo "File moved successfully";
        } else {
            echo "Error moving file";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
