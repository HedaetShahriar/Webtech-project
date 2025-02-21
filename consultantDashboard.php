<?php
    //if username is already set, redirect to index.php
    session_start();
    if (!isset($_SESSION["uname"])) {
        header("Location: login.php");
    }
    //session_start();
    $conn = new mysqli('localhost', 'root', '', 'project');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Fetch consultant details
    $username = $_SESSION["uname"];
    $sqlID = "SELECT `Id`, `Name`, `Email`, `Contact`, `Password`, `image` FROM `users` WHERE `Name` = '$username' AND `Role` = 'consultant'";
    $resultID = $conn->query($sqlID);
    $usersID = $resultID->fetch_assoc();

    $consultantId = $usersID['Id'];
    // Handle accept/reject actions
    if (isset($_POST['action']) && isset($_POST['appointment_id'])) {
        $appointmentId = $_POST['appointment_id'];
        $action = $_POST['action'];
        $allocatedDate = isset($_POST['allocated_date']) ? $_POST['allocated_date'] : ''; 

        if ($action === 'accept') {
            // If a date is selected, update the appointment with the allocated date
            if ($allocatedDate != '') {
                $updateQuery = "UPDATE appointments SET status = 'accepted', final_appointment_date = '$allocatedDate' WHERE id = $appointmentId";
                $message = "Your appointment has been accepted! The allocated date is $allocatedDate. Please be available at the specified time.";
            } else {
                // If no date is provided, just accept the request without setting a date
                $updateQuery = "UPDATE appointments SET status = 'accepted' WHERE id = $appointmentId";
                $message = "Your appointment has been accepted, but no date has been allocated yet. Please wait for the consultant to allocate a date.";
            }
        } elseif ($action === 'reject') {
            $updateQuery = "UPDATE appointments SET status = 'denied' WHERE id = $appointmentId";
            $message = "Your appointment request has been rejected.";
        }
        // Get user ID from the appointment
        $queryNotification = "SELECT user_id FROM appointments WHERE id = $appointmentId";
        $resultNotification = mysqli_query($conn, $queryNotification);
        $appointment = mysqli_fetch_assoc($resultNotification);
        $RequestedUserId = $appointment['user_id'];
        

        // Insert notification for the user
        $insertNotificationQuery = "INSERT INTO notifications (user_id, message) VALUES ($RequestedUserId, '$message')";
        mysqli_query($conn, $insertNotificationQuery);

        // Execute the update query
        mysqli_query($conn, $updateQuery);
        header("Location: consultantDashboard.php");
        exit();
    }

    // Fetch all pending booking requests
    $query = "SELECT * FROM appointments WHERE consultant_id = $consultantId AND status = 'pending' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $query);
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
                <li><a href="consultantDashboard.php">Home</a></li>
                <li><a href="">User</a></li>
                <li><a href="">Consultant</a></li>
            </ul>
            <?php
                echo '
                <div class="nav-buttons display-flex">
                    <a href=""><button class="button"><i class="fa-solid fa-bell"></i></button></a>
                    <a href="consultantProfile.php"><button class="button"><i class="fa-solid fa-user"></i></button></a>
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
                        session_destroy(); // Destroy the session
                        header("Location: index.php"); // Redirect to homepage
                        exit();
                    }
                }
            ?>
        </nav>

    <main class="consultant-container">
        <!-- Booking Requests Section -->
        <section class="request-section">
            <h2 class="section-title">Booking Requests</h2>

            <?php
            if (mysqli_num_rows($result) > 0) {
                // Output each request
                while ($row = mysqli_fetch_assoc($result)) {
                    // Fetch user details based on user_id
                    $userId = $row['user_id'];
                    $userQuery = "SELECT Name FROM users WHERE Id = $userId"; // No SQL protection here
                    $userResult = mysqli_query($conn, $userQuery);
                    $user = mysqli_fetch_assoc($userResult);

                    echo '
                    <div class="request-card">
                        <div class="request-info">
                            <h3>' . $user['Name'] . '</h3>
                            <p>Preferred Time: ' . $row['preferred_day'] . ' ' . $row['preferred_time'] . '
                        </div>
                        <div class="request-actions">
                            <form method="post" action="">
                                <input type="hidden" name="appointment_id" value="' . $row['id'] . '">
                                <label for="allocated_date">Allocate Date:</label>
                                <input type="date" name="allocated_date" id="allocated_date" required>
                                <button class="accept-btn" name="action" value="accept">Accept</button>
                                <button class="reject-btn" name="action" value="reject">Reject</button>
                            </form>
                        </div>
                    </div>';
                }
            } else {
                echo '<div class="no-request"><h1>No request for now</h1></div>';
            }
            ?>
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