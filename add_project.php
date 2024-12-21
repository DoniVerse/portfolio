<?php
include 'db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image']; // Path to image
    $link = $_POST['link'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO projects (title, description,image, link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $image, $link);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php"); // Redirect to the main page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Project</title>
</head>
<body>
    <h2>Add New Project</h2>
    <form method="POST" action="">
        <input type="text" name="title" placeholder="Project Title" required>
        <textarea name="description" placeholder="Project Description" required></textarea>
        <input type="text" name="image" placeholder="Image URL" required>
        <input type="text" name="link" placeholder="Project Link (URL)" required>
        <button type="submit">Add Project</button>
    </form>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>