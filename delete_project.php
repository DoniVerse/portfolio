<?php
include 'db.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();


    header("Location: index.php");
    exit();
} else {
    echo "No project ID specified.";
}

$conn->close(); 
?>
