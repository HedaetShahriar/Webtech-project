<?php
    session_start();
    if (!isset($_SESSION["uname"])) {
        header("Location: login.php");
        exit();
    }

    $conn = new mysqli('localhost', 'root', '', 'project');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch consultant details
    $username = $_SESSION["uname"];//"Himon";
    $sql = "SELECT `Id`, `Name`, `Email`, `Contact`, `Password`, `image` FROM `users` WHERE `Name` = '$username'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    // Check if the form has been submitted for updating the user
    if (isset($_POST['updateUser'])) {
        $userId = $_POST['userId'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $password = $_POST['password'];

        // Handle profile picture upload
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
            $image = $_FILES['profilePicture'];
            $imagePath = "images/" . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $imagePath);
        } else {
            $imagePath = $user['image'];
        }

        // Update user details in the database
        $sql = "UPDATE users SET Name='$name', Email='$email',  Contact='$contact', Password='$password', image='$imagePath' WHERE Id=$userId";
        if ($conn->query($sql)) {
            echo "User updated successfully";
        } else {
            echo "Error updating user: " . $conn->error;
        }
        exit();
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="Styles/userProfile.css">
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
                <li><a href="UserPage.php">Home</a></li>
                <li><a href="">User</a></li>
                <li><a href="">Consultant</a></li>
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
        <section class="profile-container">
            <!-- <div class="admin-card text-center">
                <h2>Consultant Profile</h2> -->
                <form id="profileForm" enctype="multipart/form-data">
                    <div class="profile-picture-section">
                        <a href="#" class="edit-icon" onclick="document.getElementById('profile-picture-input').click();">
                            <img src="<?php echo $user['image'];?>" alt="Profile Picture" class="profile-picture" id="profile-picture-preview-img">
                        </a>
                        <input type="file" id="profile-picture-input" class="editable-input" accept="image/*" onchange="previewProfilePicture(event)" style="display: none;">
                    </div>
                    <div class="profile-name"><?php echo $user['Name']; ?></div>
                    <div class="profile-info">
                        <div>
                            <span>Username</span>
                            <span id="username-display">
                                <input type="text" id="username-input" class="editable-input" value="<?php echo $user['Name']; ?>" disabled>
                                <a href="#" class="edit-icon" onclick="enableEditing('username-input', event)">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </span>
                        </div>
                        <div>
                            <span>Email</span>
                            <span id="email-display">
                                <input type="text" id="email-input" class="editable-input" value="<?php echo $user['Email']; ?>" disabled>
                                <a href="#" class="edit-icon" onclick="enableEditing('email-input', event)">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </span>
                        </div>
                        <div>
                            <span>Phone Number</span>
                            <span id="phone-display">
                                <input type="text" id="phone-input" class="editable-input" value="<?php echo $user['Contact']; ?>" disabled>
                                <a href="#" class="edit-icon" onclick="enableEditing('phone-input', event)">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </span>
                        </div>
                        <div>
                            <span>Password</span>
                            <span id="password-display">
                                <input type="password" id="password-input" class="editable-input" value="<?php echo $user['Password']; ?>" disabled>
                                <a href="#" class="edit-icon" onclick="enableEditing('password-input', event)">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </span>
                        </div>
                        <div>
                            <div class="show-password">
                                <input type="checkbox" id="showPassword" onclick="togglePassword()">
                                <label for="showPassword">Show Password</label>
                            </div>
                        </div>
                    </div>
                    <button class="submit-button" onclick="submitProfile()">Submit</button>
                </form>
            <!-- </div> -->
        </section>
    </main>

    <!-- <footer>
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
                <p>Email: innerecho@gmail.com</p>
            </div>
        </div>
    </footer> -->

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password-input");
            const showPasswordCheckbox = document.getElementById("showPassword");
            passwordField.type = showPasswordCheckbox.checked ? "text" : "password";
        }
        function previewProfilePicture(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById("profile-picture-preview-img");
                previewImg.src = e.target.result;  // Update profile picture preview
            };
            if (file) {
                reader.readAsDataURL(file);  // Read the selected file
            }
        }

        function enableEditing(inputId, event) {
            event.preventDefault();
            const inputField = document.getElementById(inputId);
            inputField.removeAttribute("disabled");
            inputField.focus();
        }

        function toggleDropdown(event) {
            event.preventDefault();
            const displaySpan = document.getElementById("consultant-type-display");
            const dropdown = document.getElementById("consultant-type-dropdown");

            // Toggle visibility
            if (dropdown.style.display === "none" || dropdown.style.display === "") {
                displaySpan.style.display = "none";
                dropdown.style.display = "block";
            } else {
                displaySpan.style.display = "inline";
                dropdown.style.display = "none";
            }
        }

        function updateConsultantType(event) {
            const displaySpan = document.getElementById("consultant-type-display");
            const dropdown = document.getElementById("consultant-type-dropdown");

            // Update text
            displaySpan.innerHTML = `${dropdown.options[dropdown.selectedIndex].text} 
                <a href="#" class="edit-icon" onclick="toggleDropdown(event)">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>`;

            // Hide dropdown and show updated text
            displaySpan.style.display = "inline";
            dropdown.style.display = "none";
        }

        function submitProfile() {
            const username = document.getElementById("username-input").value;
            const email = document.getElementById("email-input").value;
            const phone = document.getElementById("phone-input").value;
            const password = document.getElementById("password-input").value;

            // Prepare FormData for AJAX
            const formData = new FormData();
            formData.append('updateUser', true);
            formData.append('userId', <?php echo $user['Id']; ?>); // Send the user ID to identify the user
            formData.append('name', username);
            formData.append('email', email);
            formData.append('contact', phone);
            formData.append('password', password);

            const profilePictureInput = document.getElementById("profile-picture-input");
            if (profilePictureInput.files.length > 0) {
                formData.append('profilePicture', profilePictureInput.files[0]);
            }

            // Send AJAX request
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert('Profile updated successfully!');
                } else {
                    alert('Error updating profile');
                }
            };
            xhr.send(formData);
        }
    </script>
</body>
</html>
