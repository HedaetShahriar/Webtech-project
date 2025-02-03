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
    <title>User Profile</title>
    <link rel="stylesheet" href="Styles/userProfile.css">
    <script src="https://kit.fontawesome.com/6a2c66ea03.js" crossorigin="anonymous"></script>
</head>
<body class="manrope-font">
    <div class="profile-container">
        <img src="images/team-1.jpg" alt="Profile Picture" class="profile-picture">
        <div class="profile-name">Jessica Alba</div>
        <div class="profile-info">
            <div>
                <span>Username</span>
                <span>Jenny Wilson <a href="#" class="edit-icon"><i class="fa-solid fa-pen-to-square"></i></a></span>
            </div>
            <div>
                <span>Email</span>
                <span>jenny@gmail.com <a href="#" class="edit-icon"><i class="fa-solid fa-pen-to-square"></i></a></span>
            </div>
            <div>
                <span>Phone Number</span>
                <span>Sky Angel <a href="#" class="edit-icon"><i class="fa-solid fa-pen-to-square"></i></a></span>
            </div>
            <div>
                <span>Password</span>
                <span>April 28, 1981 <a href="#" class="edit-icon"><i class="fa-solid fa-pen-to-square"></i></a></span>
            </div>
        </div>
 
        <button class="submit-button">Submit</button>
    </div>
</body>
</html>