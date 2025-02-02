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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'project');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM `users` WHERE `Name` = '$username' and `Password` = '$password'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            // Set session variable for the logged-in user
        $_SESSION["uname"] = $row['Name'];
        $_SESSION["role"] = $row['Role']; // Assuming you have a 'role' column in your table

        // Redirect based on role
        switch ($row['Role']) {
            case 'admin':
                header("Location: adminDashboard.php");
                break;
            case 'consultant':
                header("Location: consultantDashboard.php");
                break;
            case 'user':
                header("Location: userPage.php");
                break;
            default:
                // header("Location: index.php");
                break;
        }
        exit();
        } else {
            echo "User not found";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Styles/loginStyles.css">
</head>
<body class="manrope-font">
    <div class="container">
        <div class="form-section">
            <h1>Welcome Back!</h1>
            <p>Don't have an account yet? <a href="signup.php">Sign Up</a></p>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <div class="checkbox-container">
                    <label>
                        <input type="checkbox"> Keep me logged in
                    </label>
                    <div>
                        <input type="checkbox" id="showPassword" onclick="togglePassword()">
                        <label for="showPassword">Show Password</label>
                    </div>
                </div>
                <button type="submit">Login</button>
                <!-- <button type="submit">Login</button> -->
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
        <div class="image-section">
            <img src="images/login.png" alt="Illustration">
        </div>
    </div>
</body>
</html>

