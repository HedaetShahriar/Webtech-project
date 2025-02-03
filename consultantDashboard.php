<?php
    //if username is already set, redirect to index.php
    session_start();
    if (!isset($_SESSION["uname"])) {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultant Portal - InnerEcho</title>
    <link rel="stylesheet" href="Styles/consultantDashboard.css">
    <script src="https://kit.fontawesome.com/6a2c66ea03.js" crossorigin="anonymous"></script>
</head>
<body class="manrope-font">
    <header>
        <nav class="nav-bar display-flex">
            <div class="nav-logo display-flex">
                <img src="images/logo.png" alt="InnerEcho Logo" class="logo">
                <h1 class="nav-title"> InnerEcho </h1>
            </div>
            <ul class="nav-links display-flex ">
                <li><a href="adminDashboard.php">Home</a></li>
                <li><a href="adminUserInfo.php">User</a></li>
                <li><a href="adminConsultantInfo.php">Consultant</a></li>
            </ul>
            <?php
                echo '
                <div class="nav-buttons display-flex">
                    <a href=""><button class="button"><i class="fa-solid fa-bell"></i></button></a>
                    <a href="userProfile.php"><button class="button"><i class="fa-solid fa-user"></i></button></a>
                    <form action="" method="post">
                        <button type="submit" name="logout" class="button"><i class="fa-solid fa-right-from-bracket"></i></button>
                    </form>
                    <!-- <button class="button"><i class="fa-solid fa-user"></i></button> -->
                </div>
                ';

                // Check if the user is logged in
                if (isset($_SESSION["uname"])) {
                    if (isset($_POST['logout'])) {
                        unset($_SESSION['uname']); // Unset the session variable
                        unset($_SESSION['role']);
                        header("Location: index.php"); // Redirect to homepage
                        session_destroy(); // Destroy the session
                        exit();
                    }
                }
            ?>
        </nav>

    <main class="consultant-container">
        <!-- Requests Section -->
        <section class="request-section">
            <h2 class="section-title">Booking Requests</h2>
            <div class="no-request">
                <h1>No request for now</h1>
            </div>
            <div class="request-card">
                <div class="request-info">
                    <h3>John Doe</h3>
                    <p>Requested Time: Wednesday 3:00 PM</p>
                    <p>Consultation Type: Family</p>
                </div>
                <div class="request-actions">
                    <button class="accept-btn">Accept</button>
                    <button class="reject-btn">Reject</button>
                </div>
            </div>
            <div class="request-card">
                <div class="request-info">
                    <h3>Jane Smith</h3>
                    <p>Requested Time: Friday 10:00 AM</p>
                    <p>Consultation Type: Personal</p>
                </div>
                <div class="request-actions">
                    <button class="accept-btn">Accept</button>
                    <button class="reject-btn">Reject</button>
                </div>
            </div>
        </section>

        <!-- Update Availability Section -->
         <section>
            <h2 class="section-title">Update Availability</h2>
            <div class="container">
                <form action=" "class="form">
                    <label for="ctype">Consultant Type</label>
                    <select name="ctype" id="ctype">
                        <option>Select a type</option>
                        <option value="online">Online</option>
                        <option value="family">Family</option>
                        <option value="personal">Personal</option>
                    </select>
                    <label for="date">Date</label>
                    <select name="date" id="date" >
                        <option>Select a day</option>
                        <option value="Sunday-Tuesday">Sunday-Tuesday</option>
                        <option value="Monday-Wednesday">Monday-Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                    </select>
                    <label for="time">Time</label>
                    <select name="time" id="time">
                        <option>Select a time</option>
                        <option value="9 AM - 11:00 AM">9:00 AM - 11:00 AM</option>
                        <option value="11:00 AM - 1:00 PM">11:00 AM - 1:00 PM</option>
                        <option value="2:00 PM - 4:00 PM">2:00 PM - 4:00 PM</option>
                        <option value="6:00 PM - 8:00 PM">6:00 PM - 8:00 PM</option>
                        <option value="7:00 PM - 4:00 PM">7:00 PM - 4:00 PM</option>
                    </select>
                    <div>
                        <button class="add-slot-btn" type="submit">Add Time Slot</button>
                    </div>
                </form>

            </div>
         </section>
        <!-- Current Availability Section -->
        <section class="availability-section"> 
            <h2 class="section-title">Current Availability</h2>
            <div class="container">
            <div class="time-slot">
                <p>Monday 9:00 AM - 11:00 AM (Online)</p>
                <button>Remove</button>
            </div>
            <div class="time-slot">
                <p>Wednesday 2:00 PM - 4:00 PM (Family)</p>
                <button>Remove</button>
            </div>
            <div class="time-slot">
                <p>Friday 10:00 AM - 12:00 PM (Personal)</p>
                <button>Remove</button>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <!-- Same footer as previous pages -->
        </div>     
    </footer>
</body>
</html>