<?php
    //if username is already set, redirect to index.php
    session_start();
    if (!isset($_SESSION["uname"])) {
        header("Location: login.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Directly get POST values without sanitization
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $password = $_POST['password'];

        $conn = new mysqli('localhost', 'root', '', 'project');

        if ($conn->connect_error) {
            die(json_encode(['success' => false, 'message' => "Connection failed"]));
        }

        $sql = "INSERT INTO `users`(`Name`, `Email`, `Contact`, `Password`, `Role`) VALUES ('$fullname', '$email', '$contact', '$password', 'consultant')";

        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
        
        $conn->close();
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Consultant - Admin Panel</title>
    <link rel="stylesheet" href="Styles/addUser.css">
</head>
<body class="manrope-font">
    <main>
        <div class="container">
            <h2>Add a New Consultant</h2>
            <div id="message"></div>
            <form id="userForm">
                <label for="fullname">Full Name <span id="ename"></span></label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter full name" required>

                <label for="email">Email Address <span id="mail"></span></label>
                <input type="email" id="email" name="email" placeholder="Enter email" required>

                <label for="contact">Phone Number <span id="phone"></span></label>
                <input type="text" id="contact" name="contact" placeholder="Enter phone number" required>

                <label for="password">Password <span id="pass"></span></label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
                <div class="show-password">
                    <input type="checkbox" id="showPassword" onclick="togglePassword()">
                    <label for="showPassword">Show Password</label>
                </div>
                <button type="submit">Add User</button>
                <p><a href="admin-dashboard.php">Back to Admin Panel</a></p>
            </form>
            <script>
                // Password toggle function
                function togglePassword() {
                    const passwordField = document.getElementById("password");
                    const showPasswordCheckbox = document.getElementById("showPassword");
                    passwordField.type = showPasswordCheckbox.checked ? "text" : "password";
                }
                // AJAX Form Submission
                document.getElementById('userForm').onsubmit = function(e) {

                    e.preventDefault();
                    const message = document.getElementById('message');
                    
                    // Get input values
                    const fullname = document.getElementById('fullname').value.trim();
                    const email = document.getElementById('email').value.trim();
                    const contact = document.getElementById('contact').value.trim();
                    const password = document.getElementById('password').value.trim();

                    const namePattern = /^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/;
                    if (!namePattern.test(fullname)) {
                        ename.innerHTML = 'Invalid name';
                        ename.className = 'error';
                        ename.style.display = 'inline';
                        return;
                    }

                    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                    if (!emailPattern.test(email)) {
                        mail.innerHTML = 'Invalid email';
                        mail.className = 'error';
                        mail.style.display = 'inline';
                        return;
                    }

                    const phonePattern = /^[0-9]{8,12}$/; // Allows 10-15 digit numbers
                    if (!phonePattern.test(contact)) {
                        phone.innerHTML = 'Invalid phone number';
                        phone.className = 'error';
                        phone.style.display = 'inline';
                        return;
                    }

                    if (password.length < 4) {
                        pass.innerHTML = 'Invalid password';
                        pass.className = 'error';
                        pass.style.display = 'inline';
                        return;
                    }
                    
                    // Create AJAX request
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"];?>');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    
                    // Handle response
                    xhr.onload = function() {
                        try {
                            const response = JSON.parse(this.responseText);
                            if (response.success) {
                                message.innerHTML = 'User added successfully! Redirecting...';
                                message.className = 'success';
                                message.style.display = 'block';
                                setTimeout(() => {
                                    window.location.href = 'adminDashboard.php';
                                }, 1500);
                            } else {
                                message.innerHTML = 'Error: ' + (response.message || 'Failed to add user');
                                message.className = 'error';
                                message.style.display = 'block';
                            }
                        } catch (error) {
                            message.innerHTML = 'Error parsing response';
                            message.className = 'error';
                            message.style.display = 'block';
                        }
                    };
                    
                    // Handle errors
                    xhr.onerror = function() {
                        message.innerHTML = 'Request failed';
                        message.className = 'error';
                        message.style.display = 'block';
                    };
                    
                    // Prepare form data
                    const formData = new URLSearchParams(new FormData(this)).toString();
                    xhr.send(formData);
                };
            </script>
        </div>
    </main>
    
</body>
</html>
