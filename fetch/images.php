<?php
include '../base/conn.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch images, usernames, captions, product IDs, like counts, save counts, comment counts, and share counts
$sql = "SELECT p.image, p.username, p.caption, p.productid, 
               COUNT(DISTINCT l.productid) as likes, 
               COUNT(DISTINCT s.productid) as saves,
               COUNT(DISTINCT c.productid) as comments,
               COUNT(DISTINCT sh.productid) as shares
        FROM products p
        LEFT JOIN likes l ON p.productid = l.productid
        LEFT JOIN saves s ON p.productid = s.productid
        LEFT JOIN comments c ON p.productid = c.productid
        LEFT JOIN share sh ON p.productid = sh.productid
        GROUP BY p.productid, p.image, p.username, p.caption";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = array(
            'image' => 'uploads/' . $row['image'],
            'username' => $row['username'],
            'caption' => $row['caption'],
            'productid' => $row['productid'],
            'likes' => $row['likes'],
            'saves' => $row['saves'],
            'comments' => $row['comments'],
            'shares' => $row['shares']
        );
    }
} else {
    echo json_encode([]);
    exit();
}

$conn->close();

echo json_encode($data);
?>
