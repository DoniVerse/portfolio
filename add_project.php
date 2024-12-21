<!--  -->
<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $link = htmlspecialchars(trim($_POST['link']));

    
    $image = $_FILES['image']; 
    $imagePath = 'uploads/' . basename($image['name']);

   
    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
        
        $stmt = $conn->prepare("INSERT INTO projects (title, description, image, link) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $description, $imagePath, $link);

        
        if ($stmt->execute()) {
            header("Location: index.php"); 
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close(); 
    } else {
        echo "Failed to upload image.";
    }
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
    <form method="POST" action="" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Project Title" required>
    <textarea name="description" placeholder="Project Description" required></textarea>
    <input type="file" name="image" required>
    <input type="text" name="link" placeholder="Project Link (URL)" required>
    <button type="submit">Add Project</button>
</form>
</html>

<?php
$conn->close(); 
?>
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