<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Send the email
    $to = "arsemateferi5@gmail.com"; 
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
    
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Subject: $subject\n\n";
    $body .= "Message:\n$message\n";

    if (mail($to, $subject, $body, $headers)) {
        // Insert into the database
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            $successMessage = "Message sent successfully!";
        } else {
            $errorMessage = "Message sent, but there was an issue saving to the database.";
        }

        $stmt->close();
    } else {
        $errorMessage = "There was a problem sending your message.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Me</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <nav id="desktop-nav">
        <div class="logo">Arsema Teferi</div>
        <div>
            <ul class="nav-links">
                <li><a href="#about">About</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="add_project.php">Add Project</a></li>
            </ul>
        </div>
    </nav>
    
    <section id="contact">
        <h1 class="title">Contact Me</h1>
        <form action="contact.php" method="POST" id="contact-form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required />
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required />
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-color-2">Send Message</button>
        </form>
        
        <?php if (isset($successMessage)): ?>
            <p class="success" id="success-message"><?php echo $successMessage; ?></p>
            <script>
                setTimeout(function() {
                    var message = document.getElementById('success-message');
                    if (message) {
                        message.style.display = 'none';
                    }
                }, 5000); 
            </script>
        <?php elseif (isset($errorMessage)): ?>
            <p class="error"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
    </section>
    
    <footer>
        <p>Copyright &#169; 2024 Arsema Teferi. All Rights Reserved.</p>
    </footer>

    <style>
        #contact-form {
            display: flex;
            flex-direction: column;
            max-width: 500px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            margin-bottom: 5px;
        }

        input, textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        button {
            color: red;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ffcccc; /* Adjust hover color here */
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</body>
</html>