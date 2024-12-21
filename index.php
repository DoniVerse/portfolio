<?php
include 'db.php'; // Include database connection
session_start(); // Start session for handling uploads

// Fetch projects from the database
$result = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");


$hardCodedProjects = [
    [
        'title' => 'safe space',
        'description' => 'an online journal.',
        'image_path' => 'safe space.png', 
        'link' => 'https://github.com/DoniVerse/safe-space.git'
    ],
    [
        'title' => 'mindfull moments',
        'description' => 'a mental wellness platform.',
        'image_path' => 'wellness.jpg', 
        'link' => 'https://github.com/DoniVerse/mindfull_moments.git'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Portfolio</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="mediaqueries.css" />
</head>
<body>
    <nav id="desktop-nav">
        <div class="logo">Arsema Teferi</div>
        <div>
            <ul class="nav-links">
                <li><a href="#about">About</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
                <!-- uncoment this when i want to add a project  -->
                <!-- <li><a href="add_project.php">Add Project</a></li> -->
            </ul>
        </div>
    </nav>
    <nav id="hamburger-nav">
        <div class="logo">Arsema Teferi</div>
        <div class="hamburger-menu">
            <div class="hamburger-icon" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="menu-links">
                <li><a href="#about" onclick="toggleMenu()">About</a></li>
                <li><a href="#experience" onclick="toggleMenu()">Experience</a></li>
                <li><a href="#projects" onclick="toggleMenu()">Projects</a></li>
                <li><a href="#contact" onclick="toggleMenu()">Contact</a></li>
            </div>
        </div>
    </nav>
    <section id="profile">
        <div class="section__pic-container">
            <img src="profile2.png" alt="profile picture" />
        </div>
        <div class="section__text">
            <p class="section__text__p1">Hello, I'm</p>
            <h1 class="title">Arsema Teferi</h1>
            <p class="section__text__p2">Frontend Developer</p>
            <div class="btn-container">
                <button class="btn btn-color-2" onclick="window.open('#')">Download CV</button>
                <button class="btn btn-color-1" onclick="location.href='#contact'">Contact Info</button>
            </div>
            <div id="socials-container">
                <img src="./assets/linkedin.png" alt="My LinkedIn profile" class="icon" onclick="location.href='https://linkedin.com/'" />
                <img src="./assets/github.png" alt="My Github profile" class="icon" onclick="location.href='https://github.com/DoniVerse/'" />
            </div>
        </div>
    </section>
    <section id="about">
        <h1 class="title">About Me</h1>
        <div class="section-container">
            <div class="about-details-container">
                <div class="about-containers">
                    <div class="details-container">
                        <img src="./assets/experience.png" alt="Experience icon" class="icon" />
                        <h3>Experience</h3>
                        <p>1 year <br /> Frontend development</p>
                    </div>
                    <div class="details-container">
                        <img src="./assets/education.png" alt="Education icon" class="icon" />
                        <h3>Education</h3>
                        <p>B.Sc. Bachelors Degree</p>
                    </div>
                </div>
                <div class="text-container">
                    <p>
                        I'm a dedicated web developer with a strong foundation in HTML, CSS, and JavaScript. I'm passionate about creating clean, efficient, and user-friendly websites. I'm always eager to learn new technologies and improve my skills.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="experience">
        <h1 class="title">Experience</h1>
        <div class="experience-details-container">
            <div class="about-containers">
                <div class="details-container">
                    <h2 class="experience-sub-title">Frontend Development</h2>
                    <div class="article-container">
                        <article>
                            <img src="./assets/checkmark.png" alt="Experience icon" class="icon" />
                            <div>
                                <h3>HTML</h3>
                                <p>Intermediate</p>
                            </div>
                        </article>
                        <article>
                            <img src="./assets/checkmark.png" alt="Experience icon" class="icon" />
                            <div>
                                <h3>CSS</h3>
                                <p>Intermediate</p>
                            </div>
                        </article>
                        <article>
                            <img src="./assets/checkmark.png" alt="Experience icon" class="icon" />
                            <div>
                                <h3>SASS</h3>
                                <p>Basic</p>
                            </div>
                        </article>
                        <article>
                            <img src="./assets/checkmark.png" alt="Experience icon" class="icon" />
                            <div>
                                <h3>JavaScript</h3>
                                <p>Basic</p>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="details-container">
                    <h2 class="experience-sub-title">Backend Development</h2>
                    <div class="article-container">
                        <article>
                            <img src="./assets/checkmark.png" alt="Experience icon" class="icon" />
                            <div>
                                <h3>PostgreSQL</h3>
                                <p>Basic</p>
                            </div>
                        </article>
                        <article>
                            <img src="./assets/checkmark.png" alt="Experience icon" class="icon" />
                            <div>
                                <h3>C#</h3>
                                <p>Basic</p>
                            </div>
                        </article>
                        <article>
                            <img src="./assets/checkmark.png" alt="Experience icon" class="icon" />
                            <div>
                                <h3>PHP</h3>
                                <p>Basic</p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="projects">
        <p class="section__text__p1">Recent</p>
        <h1 class="title">Projects</h1>
        
        <?php
        
        $projects = array_merge($hardCodedProjects, $result->fetch_all(MYSQLI_ASSOC));
        
     
        if (count($projects) > 0): ?>
            <?php foreach ($projects as $project): ?>
                <div class="details-container color-container">
                    <div class="article-container">
                        <img src="<?php echo htmlspecialchars($project['image_path']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="project-img" />
                    </div>
                    <h2 class="experience-sub-title project-title"><?php echo htmlspecialchars($project['title']); ?></h2>
                    <p><?php echo htmlspecialchars($project['description']); ?></p>
                    <div class="btn-container">
                        <button class="btn btn-color-2 project-btn" onclick="window.open('<?php echo htmlspecialchars($project['link']); ?>')">Github</button>
                        <?php if (isset($project['id'])): // Check if it's a dynamic project ?>
                            <a href="delete_project.php?id=<?php echo $project['id']; ?>" class="btn btn-color-1">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No projects found.</p>
        <?php endif; ?>
    </section>
    <section id="contact">
        <h1 class="title">Contact Me</h1>
        <div class="contact-info-upper-container">
            <div class="contact-info-container">
                <img src="./assets/email.png" alt="Email icon" class="icon contact-icon email-icon" />
                <p><a href="mailto:examplemail@gmail.com">arsemateferi5@gmail.com</a></p>
            </div>
            <div class="contact-info-container">
                <img src="./assets/linkedin.png" alt="LinkedIn icon" class="icon contact-icon" />
                <p><a href="https://www.linkedin.com">LinkedIn</a></p>
            </div>
        </div>
    </section>
    <footer>
        <nav>
            <div class="nav-links-container">
                <ul class="nav-links">
                    <li><a href="#about">About</a></li>
                    <li><a href="#experience">Experience</a></li>
                    <li><a href="#projects">Projects</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
        </nav>
        <p>Copyright &#169; 2024 Arsema Teferi. All Rights Reserved.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>