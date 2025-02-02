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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $password = $_POST['password'];

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'project');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO `users`(`Name`, `Email`, `Contact`, `Password`) VALUES ('$fullname', '$email', '$contact', '$password')";

        if ($conn->query($sql) === TRUE) {
            header("Location: Login.php",);
        }

        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp_Page</title>
    <link rel="stylesheet" href="Styles/signupStyles.css">
</head>
<body class="manrope-font">
    <div class="container">
        <div class="illustration">
            <img class="form-pic" src="images/sign-up.png" alt="No image found">
            <!-- <img src="Styles/Login-styles.css" alt="Mental health illustration"> -->
            <!-- <h1>InnerEcho</h1> -->
            <!-- <p>Bashundhara R/A, Block E, Dhaka</p> -->
        </div>
        <div class="form-container">
            <h2>Create a New Account</h2>
            <p>Welcome to Inn</p>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter your full name">

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">

                <label for="contact">Phone Number</label>
                <input type="text" id="contact" name="contact" placeholder="Enter your phone number">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
                
                <div class="show-password">
                    <input type="checkbox" id="showPassword" onclick="togglePassword()">
                    <label for="showPassword">Show Password</label>
                </div>

                <button type="submit">Sign Up</button>
                <p>Already have an account? <a href="Login.php">Log in</a></p>
            </form>
            <script>
                // Password toggle function
                function togglePassword() {
                    const passwordField = document.getElementById("password");
                    const showPasswordCheckbox = document.getElementById("showPassword");
                    passwordField.type = showPasswordCheckbox.checked ? "text" : "password";
                }
            </script>
        </div>
    </div>
</body>
</html>