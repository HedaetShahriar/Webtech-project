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
    <title>SignUp_Page</title>
    <link rel="stylesheet" href="Styles/userProfile.css">
</head>
<body class="manrope-font">
    <div class="container">
        <div class="illustration">
            <button class="back-btn" onclick="window.history.back()">Back</button>
            <img class="form-pic" src="images/sign-up.png" alt="No image found">
        </div>
        <div class="form-container">
            <h2>User Profile</h2>
            <p>Welcome to Inn</p>
            <form>
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname">

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email">

                <label for="phoneNumber">Phone Number</label>
                <input type="text" id="location" name="location">

                <label for="password">Password</label>
                <input type="password" id="password" name="password">

                <button type="submit">Edit Information</button><br>
                <button type="submit">Save Information</button>
            </form>
        </div>
    </div>
</body>
</html>
