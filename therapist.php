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
                <li><a href="">Services</a></li>
            </ul>
            <a href="login.php"><button class="btn-primary">Login</button></a>
        </nav>
        <h1>Find a Therapist</h1>
        <p>Search and connect with the best therapists for your needs.</p>
    </header>
    
    <section class="search-filter">
        <input type="text" placeholder="Search by name or specialty..." class="search-bar">
        <select class="filter">
            <option value="">Select Specialization</option>
            <option value="anxiety">Anxiety</option>
            <option value="depression">Depression</option>
            <option value="relationship">Relationship Therapy</option>
            <option value="family">Family Counseling</option>
        </select>
        <select class="filter">
            <option value="">Experience Level</option>
            <option value="1-5">1-5 Years</option>
            <option value="6-10">6-10 Years</option>
            <option value="10+">10+ Years</option>
        </select>
        <select class="filter">
            <option value="">Session Type</option>
            <option value="online">Online</option>
            <option value="in-person">In-Person</option>
        </select>
        <button class="btn-search">Search</button>
    </section>
    
    <section class="therapist-list">
        <div class="therapist-card">
            <img src="images/team-1.jpg" alt="Therapist" class="therapist-img">
            <h2>Dr. John Doe</h2>
            <p>Specialist in Anxiety & Stress</p>
            <a href="bookAppointment.php"><button class="btn-book">Book Appointment</button></a>
            
        </div>
        <div class="therapist-card">
            <img src="images/team-2.jpg" alt="Therapist" class="therapist-img">
            <h2>Dr. Jane Smith</h2>
            <p>Expert in Family Counseling</p>
            <a href="bookAppointment.php"><button class="btn-book">Book Appointment</button></a>
        </div>
        <div class="therapist-card">
            <img src="images/team-3.png" alt="Therapist" class="therapist-img">
            <h2>Dr. Emily White</h2>
            <p>Depression & Self-Care Coach</p>
            <a href="bookAppointment.php"><button class="btn-book">Book Appointment</button></a>
        </div>
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
