<?php
include 'db.php';
session_start();

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM projects WHERE id = $id");
$project = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $image = $_FILES['image']['name'];
    
    // If a new image is uploaded, handle it
    if ($image) {
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $stmt = $conn->prepare("UPDATE projects SET title = ?, description = ?, image = ?, link = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $description, $image, $link, $id);
    } else {
        $stmt = $conn->prepare("UPDATE projects SET title = ?, description = ?, link = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $description, $link, $id);
    }
    
    $stmt->execute();
    $stmt->close();
    
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Project</title>
    <link rel="stylesheet" href="simple_add_project.css">
</head>
<body>
    <div class="container">
        <h1>Edit Project</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="title">Project Title</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>

            <label for="description">Project Description</label>
            <textarea name="description" id="description" required><?php echo htmlspecialchars($project['description']); ?></textarea>

            <label for="image">Upload New Image (optional)</label>
            <input type="file" name="image" id="image">

            <label for="link">Project Link</label>
            <input type="text" name="link" id="link" value="<?php echo htmlspecialchars($project['link']); ?>" required>

            <button type="submit">Update Project</button>
        </form>
    </div>
</body>
</html>
<style>
/* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    padding: 20px;
}

.container {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
</style>