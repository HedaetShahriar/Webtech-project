<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - InnerEcho</title>
    <link rel="stylesheet" href="Styles/AdminDashboard.css">
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
            <div class="admin-section">
                <h2 class="section-header">User Management</h2>
                <div class="admin-options">
                    <!-- View User Card -->
                    <div class="admin-card">
                        <h2>View Users</h2>
                        <p>View the list of the Users of the platform. View their details and expertise</p>
                        <a href="adminUserInfo.php"><button>View User</button></a>
                    </div>
                    <!-- Add User Card -->
                    <div class="admin-card">
                        <h2>Add User</h2>
                        <p>Add a new user to the system. Provide necessary details to create an account</p>
                        <a href="addUser.php"><button>Add User</button></a>
                    </div>
                </div>
            </div>

            <!-- Consultant Management Section -->
            <div class="admin-section">
                <h2 class="section-header">Consultant Management</h2>
                <div class="admin-options">
                    <!-- Add Consultant Card -->
                    <div class="admin-card">
                        <h2>Consultants</h2>
                        <p>View the list of the consultants of the platform. View their details and expertise.</p>
                        <a href="adminConsultantInfo.php"><button>View Consultants</button></a>
                        
                    </div>
                    <!-- Remove Consultant Card -->
                    <div class="admin-card">
                        <h2>Add Consultants</h2>
                        <p>Add a new consultant to the platform. Provide their details <br> and expertise.</p>
                        <a href="addConsultant.php"><button>Add Consultants</button></a>
                    </div>
                </div>
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
                <p class="footer-description">Providing compassionate and expert mental health support to transform lives.</p>
            </div>
            <div class="contact-info">
                <h2>Contact</h2>
                <p>Address: 1234 Street Name, City Name, United States</p>
                <p>Phone: +123 456 7890</p>
                <p>Email: info@innerecho.com</p>
            </div>
        </div>
    </footer>
</body>
</html>