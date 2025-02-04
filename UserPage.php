<?php
    //if username is already set, redirect to index.php
    session_start();
    if (!isset($_SESSION["uname"])) {
        header("Location: login.php");
        exit(); 
    }
    //session_start();
    $conn = new mysqli('localhost', 'root', '', 'project');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Fetch consultant details
    $username = $_SESSION["uname"];//"Himon";
    $sqlID = "SELECT `Id`, `Name`, `Email`, `Contact`, `Password`, `image` FROM `users` WHERE `Name` = '$username'";
    $resultID = $conn->query($sqlID);
    $usersID = $resultID->fetch_assoc();

    

    // Handle AJAX request for booking appointment
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'bookAppointment') {
        // if (!isset($_SESSION["uname"])) {
        //     echo json_encode(["status" => "error", "message" => "User not logged in."]);
        //     exit();
        // }
        if ($usersID) {
            $userId = $usersID['Id'];
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
            exit();
        }

        $preferredDay = $_POST['preferredDay'];
        $preferredTime = $_POST['preferredTime'];
        $consultantId = $_POST['consultant'];
    
        $sql = "INSERT INTO appointments (user_id, consultant_id, preferred_day, preferred_time, status) 
                VALUES ('$userId', '$consultantId', '$preferredDay', '$preferredTime', 'pending')";
    
        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home - InnerEcho</title>
    <link rel="stylesheet" href="Styles/userpage.css">
    <script src="https://kit.fontawesome.com/6a2c66ea03.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="nav-bar display-flex">
            <div class="nav-logo display-flex">
                <img src="images/logo.png" alt="InnerEcho Logo" class="logo">
                <h1 class="nav-title"> InnerEcho </h1>
            </div>
            <ul class="nav-links display-flex ">
                <li><a href="">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Pages</a></li>
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
                        session_destroy(); // Destroy the session
                        header("Location: index.php"); // Redirect to homepage
                        exit();
                    }
                }
            ?>
            
        </nav>
    </header>

    <main>
        <section class="user-dashboard">
            <div class="dashboard-content">
                <h1>Welcome Back, <span class="username"><?php echo $usersID['Name']; ?></span>!</h1>
                <p>Your mental wellness journey starts here. Keep track of your thoughts and emotions.</p>
                <button class="btn-primary" onclick="openJournalModal()">Create Journal</button>
            </div>
            <div class="dashboard-image">
                <img src="images/journel.png" alt="Mental Health" class="dashboard-img">
            </div>
        </section>

        <section class="user-dashboard">
            <div class="dashboard-content">
                <h1>Mood Tracker</h1>
                <p>Monitor your emotional patterns over time.</p>
                <button class="btn-primary" onclick="openMoodModal()">Track Mood</button>
            </div>
            <div class="dashboard-image">
                <img src="images/moodttracker.png" alt="Mood Tracker" class="dashboard-img">
            </div>
        </section>

        <section class="user-dashboard">
            <div class="dashboard-content">
                <h1>Self-Assessment</h1>
                <p>Evaluate your mental health with self-assessments.</p>
                <button class="btn-primary" onclick="openAssessmentModal()">Start Assessment</button>
            </div>
            <div class="dashboard-image">
                <img src="images/self assesment.png" alt="Self Assessment" class="dashboard-img">
            </div>
        </section>

        <section class="user-dashboard">
            <div class="dashboard-content">
                <h1>Book an Appointment</h1>
                <p>Schedule a session with a professional counselor.</p>
                <button class="btn-primary" onclick="openAppointmentModal()">Book Now</button>
            </div>
            <div class="dashboard-image">
                <img src="images/consultent.png" alt="Book Appointment" class="dashboard-img">
            </div>
        </section>
    </main>

    <div id="journalModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeJournalModal()">X</span>
            <h2>Create a New Journal Entry</h2>
            <form class="form">
                <input type="text" placeholder="Journal Title" required>
                <textarea placeholder="Write your thoughts..." required></textarea>
                <button type="submit" class="btn-primary">Save Journal</button>
            </form>
        </div>
    </div>

    <div id="moodModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeMoodModal()">X</span>
            <h2>Track Your Mood</h2>
            <form class="form">
                <input type="text" placeholder="Mood Description" required>
                <button type="submit" class="btn-primary">Save Mood</button>
            </form>
        </div>
    </div>

    <div id="assessmentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAssessmentModal()">X</span>
            <h2>Self-Assessment</h2>
            <form class="form">
                <!-- Question 1 -->
                <div class="question">
                    <label>1. How stressed are you today? (1= Calm, 5 Overwhelmed)</label>
                    <div class="scale">
                        <input type="radio" name="stress" id="stress1" value="1"><label for="stress1">1</label>
                        <input type="radio" name="stress" id="stress2" value="2"><label for="stress2">2</label>
                        <input type="radio" name="stress" id="stress3" value="3"><label for="stress3">3</label>
                        <input type="radio" name="stress" id="stress4" value="4"><label for="stress4">4</label>
                        <input type="radio" name="stress" id="stress5" value="5"><label for="stress5">5</label>
                    </div>
                </div>
    
                <!-- Question 2 -->
                <div class="question">
                    <label>2. How happy do you feel today? (1= Sad, 5= Ecstatic)</label>
                    <div class="scale">
                        <input type="radio" name="happiness" id="happy1" value="1"><label for="happy1">1</label>
                        <input type="radio" name="happiness" id="happy2" value="2"><label for="happy2">2</label>
                        <input type="radio" name="happiness" id="happy3" value="3"><label for="happy3">3</label>
                        <input type="radio" name="happiness" id="happy4" value="4"><label for="happy4">4</label>
                        <input type="radio" name="happiness" id="happy5" value="5"><label for="happy5">5</label>
                    </div>
                </div>
    
                <!-- Question 3 -->
                <div class="question">
                    <label>3. How anxious are you feeling? (1= Relaxed, 5= Panicked)</label>
                    <div class="scale">
                        <input type="radio" name="anxiety" id="anxiety1" value="1"><label for="anxiety1">1</label>
                        <input type="radio" name="anxiety" id="anxiety2" value="2"><label for="anxiety2">2</label>
                        <input type="radio" name="anxiety" id="anxiety3" value="3"><label for="anxiety3">3</label>
                        <input type="radio" name="anxiety" id="anxiety4" value="4"><label for="anxiety4">4</label>
                        <input type="radio" name="anxiety" id="anxiety5" value="5"><label for="anxiety5">5</label>
                    </div>
                </div>
    
                <!-- Question 4 -->
                <div class="question">
                    <label>4. How energetic do you feel? (1= Exhausted, 5= Energized)</label>
                    <div class="scale">
                        <input type="radio" name="energy" id="energy1" value="1"><label for="energy1">1</label>
                        <input type="radio" name="energy" id="energy2" value="2"><label for="energy2">2</label>
                        <input type="radio" name="energy" id="energy3" value="3"><label for="energy3">3</label>
                        <input type="radio" name="energy" id="energy4" value="4"><label for="energy4">4</label>
                        <input type="radio" name="energy" id="energy5" value="5"><label for="energy5">5</label>
                    </div>
                </div>
    
                <!-- Question 5 -->
                <div class="question">
                    <label>5. Sleep quality last night? (1= Restless, 5= Restful)</label>
                    <div class="scale">
                        <input type="radio" name="sleep" id="sleep1" value="1"><label for="sleep1">1</label>
                        <input type="radio" name="sleep" id="sleep2" value="2"><label for="sleep2">2</label>
                        <input type="radio" name="sleep" id="sleep3" value="3"><label for="sleep3">3</label>
                        <input type="radio" name="sleep" id="sleep4" value="4"><label for="sleep4">4</label>
                        <input type="radio" name="sleep" id="sleep5" value="5"><label for="sleep5">5</label>
                    </div>
                </div>
                <button type="submit" class="btn-primary">Save Mood Entry</button>
            </form>
        </div>
    </div>
    <!-- Book Appointment Modal -->
    <div id="appointmentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAppointmentModal()">X</span>
            <h2>Book an Appointment</h2>
            <form id="appointmentForm" class="form">
                <label for="preferredDay">Preferred Day</label>
                <select name="preferredDay" id="preferredDay" required>
                    <option value="">Select a day</option>
                    <option value="Sunday-Tuesday">Sunday-Tuesday</option>
                    <option value="Monday-Wednesday">Monday-Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                </select>

                <label for="preferredTime">Preferred Time</label>
                <select name="preferredTime" id="preferredTime" required>
                    <option value="">Select a time</option>
                    <option value="9 AM - 11:00 AM">9:00 AM - 11:00 AM</option>
                    <option value="11:00 AM - 1:00 PM">11:00 AM - 1:00 PM</option>
                    <option value="2:00 PM - 4:00 PM">2:00 PM - 4:00 PM</option>
                    <option value="6:00 PM - 8:00 PM">6:00 PM - 8:00 PM</option>
                </select>

                <label for="consultant">Select Therapist</label>
                <select id="consultant" name="consultant" required>
                    <option value="">Select a consultant</option>
                    <?php
                    $consultantQuery = "SELECT Id, Name FROM users WHERE Role = 'consultant'";
                    $result = $conn->query($consultantQuery);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['Id']}'>{$row['Name']}</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="btn-primary" >Confirm Appointment</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div>
                <div class="footer-logo">
                    <img src="images/logo_white.png" alt="InnerEcho Logo" class="logo-footer">
                    <h2>InnerEcho</h2>
                </div>
                <p class="footer-description"> "Your journey to mental well-being starts here – compassionate care, expert guidance, and 24/7 support at InnerEcho."</p>
            </div>
            <div class="about-us">
                <h2>Contact</h2>
                <p>Address: Bashundhara R/A, Block E, Dhaka</p>
                <p>Phone: +123 456 7890</p>
                <p>Email:innerecho@gmail.com</p>
            </div>
        </div>     
    </footer>

    <script>
        function openJournalModal() {
            document.getElementById("journalModal").style.display = "block";
        }
        function closeJournalModal() {
            document.getElementById("journalModal").style.display = "none";
        }
        function openMoodModal() {
            document.getElementById("moodModal").style.display = "block";
        }
        function closeMoodModal() {
            document.getElementById("moodModal").style.display = "none";
        }
        function openAssessmentModal() {
            document.getElementById("assessmentModal").style.display = "block";
        }
        function closeAssessmentModal() {
            document.getElementById("assessmentModal").style.display = "none";
        }
        function openAppointmentModal() {
            document.getElementById("appointmentModal").style.display = "block";
        }
        function closeAppointmentModal() {
            document.getElementById("appointmentModal").style.display = "none";
        }
        document.getElementById("appointmentForm").addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(this);
            formData.append("action", "bookAppointment");

            fetch("UserPage.php", { 
                method: "POST",
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Appointment booked successfully!");
                    closeAppointmentModal();
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => console.error("Error:", error));
        });
    </script>
</body>
</html>
