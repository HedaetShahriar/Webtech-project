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
            <form>
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter your full name">

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">

                <label for="phoneNumber">Phone Number</label>
                <input type="text" id="location" name="location" placeholder="Enter your phone number">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">

                <button type="submit">Sign Up</button>
                <p>Already have an account? <a href="Login.php">Log in</a></p>
            </form>
        </div>
    </div>
</body>
</html>