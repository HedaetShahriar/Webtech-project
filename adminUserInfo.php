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
    <title>UserInfo - InnerEcho</title>
    <link rel="stylesheet" href="Styles/adminUserInfo.css">
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
            <div class="nav-buttons display-flex">
                <div class="icon-circle">
                    <a href="adminConsultantInfo.php"><i class="fa-solid fa-user"></i></a>
                </div>
                <div class="icon-circle">
                    <a href="login.php"><i class="fa-solid fa-right-from-bracket"></i></a>
                </div>
                
            </div>
        </nav>
    </header>
    <main>
        <section class="admin-container">
                    <div class="admin-card text-center">
                        <h2>User List</h2>
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>johndoe@example.com</td>
                                    <td>+123 456 7890</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td>janesmith@example.com</td>
                                    <td>+098 765 4321</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="buttons display-flex">
                        <a href=""><button class="btn">Save User</button></a>
                        <a href=""><button class="btn">Remove User</button></a>
                    </div>
        </section>
    </main>
    <footer>
        <div class="footer-container">
            <div>
                <div class="footer-logo">
                    <img src="images/logo_white.png" alt="InnerEcho Logo" class="logo-footer">
                    <h2>InnerEcho</h2>
                </div>
                <p class="footer-description"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, quae!</p>
            </div>
            <div class="about-us">
                <h2>Contact</h2>
                <p>Address: 1234 Street Name, City Name, United States</p>
                <p>Phone: +123 456 7890</p>
                <p>Email:@example.com</p>
            </div>
        </div>     
    </footer>
</body>
</html>
