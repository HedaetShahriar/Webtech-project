<?php
    //if username is already set, redirect to index.php
    session_start();
    if (isset($_SESSION["uname"])) {
        switch ($_SESSION["role"]) {
            case 'admin':
                header("Location: adminDashboard.php");
                break;
            case 'consultant':
                header("Location: consultantDashboard.php");
                break;
            case 'user':
                header("Location: UserPage.php");
                break;
        }
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Appointment</title>
    <link rel="stylesheet" href="Styles/bookAppointment.css">
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
        <h1>Book an Appointment</h1>
        <p>Schedule a session with your preferred therapist.</p>
    </header>
    
    <section class="appointment-form">
        <form action="#" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="date">Preferred Date</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Preferred Time</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="therapist">Select Therapist</label>
                <select id="therapist" name="therapist">
                    <option value="Dr. John Doe">Dr. John Doe</option>
                    <option value="Dr. Jane Smith">Dr. Jane Smith</option>
                    <option value="Dr. Emily White">Dr. Emily White</option>
                </select>
            </div>
            <a href=""><button type="submit" class="btn-submit">Confirm Appointment</button></a>
        </form>
    </section>
    <footer>
        <div class="footer-container">
            <div>
                <div class="footer-logo">
                    <img src="images/logo_white.png" alt="InnerEcho Logo" class="logo-footer">
                    <h2>InnerEcho</h2>
                </div>
                <p class="footer-description"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, quae!</p>
            </div>
            <div class="about-us">
                <h2>Contact</h2>
                <p>Address: 1234 Street Name, City Name, United States</p>
                <p>Phone: +123 456 7890</p>
                <p>Email:@example.com</p>
            </div>
        </div>     
    </footer>
</body>
</html>
