<?php
include 'db.php'; // Include database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the main page
    header("Location: index.php");
    exit();
} else {
    echo "No project ID specified.";
}

$conn->close(); // Close the database connection
?>