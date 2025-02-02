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
    <title>User Home - InnerEcho</title>
    <link rel="stylesheet" href="Styles/userpage.css">
    <script src="https://kit.fontawesome.com/6a2c66ea03.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="nav-bar">
            <div class="nav-logo">
                <img src="images/logo.png" alt="InnerEcho Logo" class="logo">
                <h1 class="nav-title">InnerEcho</h1>
            </div>
            <ul class="nav-links">
                <li><a href="user_home.php">Home</a></li>
                <li><a href="journal.php">My Journal</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        

        <section class="journal-entries">
            <h2>Your Recent Journals</h2>
            <div class="journal-list">
                <div class="journal-card">
                    <h3>My First Journal</h3>
                    <p><i class="fa-solid fa-calendar"></i> January 30, 2025</p>
                    <button class="btn-secondary">View</button>
                </div>
                <div class="journal-card">
                    <h3>Reflection on Today</h3>
                    <p><i class="fa-solid fa-calendar"></i> January 29, 2025</p>
                    <button class="btn-secondary">View</button>
                </div>
            </div>
        </section>
        
    </main>

    

    <footer>
        <p>© 2025 InnerEcho. All Rights Reserved.</p>
    </footer>

    <script>
        function openJournalModal() {
            document.getElementById("journalModal").style.display = "block";
        }
        function closeJournalModal() {
            document.getElementById("journalModal").style.display = "none";
        }
    </script>
</body>
</html>
