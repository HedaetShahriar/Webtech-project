<?php
    $conn = new mysqli('localhost', 'root', '', 'project');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT `Id`,`Name`,`Contact`, `Role`, `consultancyType`, `image` FROM `users` WHERE `Role` = 'consultant'";

    $result = $conn->query($sql);
    $therapists = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $therapists[] = $row;
        }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find a Therapist</title>
    <link rel="stylesheet" href="Styles/therapist.css">
    <script src="https://kit.fontawesome.com/6a2c66ea03.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <header class="header">
    <nav class="nav-bar display-flex">
            <div class="nav-logo display-flex">
                <img src="images/logo.png" alt="InnerEcho Logo" class="logo">
                <h1 class="nav-title"> InnerEcho </h1>
            </div>
            <ul class="nav-links display-flex ">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="therapist.php">Services</a></li>
            </ul>
            <a href="login.php"><button class="btn-primary">Login</button></a>
        </nav>
        <h1>Find a Therapist</h1>
        <p>Search and connect with the best therapists for your needs.</p>
    </header>
    
    <section class="search-filter">
        <input type="text" placeholder="Search by name or type..." class="search-bar">
        <select class="filter">
            <option value="">Session Type</option>
            <option value="Online">Online</option>
            <option value="Family">Family</option>
            <option value="Personal">Personal</option>
        </select>
        <button class="btn-search" id="search-btn">Search</button>
    </section>
    
    <section class="therapist-list">
        <!-- Dynamic therapist cards will be loaded here -->
        <?php foreach ($therapists as $therapist): ?>
        <div class="therapist-card">
            <img src="<?php echo $therapist['image']; ?>" alt="Therapist" class="therapist-img">
            <h2><?php echo $therapist['Name']; ?></h2>
            <p><?php echo $therapist['consultancyType']; ?></p>
            <a href="bookAppointment.php"><button class="btn-book">Book Appointment</button></a>
        </div>
        <?php endforeach; ?>
    </section>
    <footer>
        <div class="footer-container">
            <div>
                <div class="footer-logo">
                    <img src="images/logo_white.png" alt="InnerEcho Logo" class="logo-footer">
                    <h2>InnerEcho</h2>
                </div>
                <p class="footer-description">"Your journey to mental well-being starts here – compassionate care, expert guidance, and 24/7 support at InnerEcho."</p>
            </div>
            <div class="about-us">
                <h2>Contact</h2>
                <p>Address: Bashundhara R/A, Block E, Dhaka</p>
                <p>Phone: +123 456 7890</p>
                <p>Email:innerecho@gmail.com</p>
            </div>
        </div>     
    </footer>
</body>
</html>
