<?php
    //if username is already set, redirect to index.php
    session_start();
    if (!isset($_SESSION["uname"])) {
        header("Location: login.php");
        exit(); 
    }
    $conn = new mysqli('localhost', 'root', '', 'project');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // If delete button is clicked
    if (isset($_POST['deleteUser'])) {
        $userId = $_POST['deleteUser'];
        $sql = "DELETE FROM `users` WHERE `Id` = $userId";
        $conn->query($sql);
    }

    // If update request is received (from AJAX)
    if (isset($_POST['updateUser'])) {
        $userId = $_POST['userId'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];

        $sql = "UPDATE users SET Name='$name', Email='$email', Contact='$contact' WHERE Id=$userId";
        if ($conn->query($sql)) {
            echo "User updated successfully";
        } else {
            echo "Error updating user: " . $conn->error;
        }
        exit();
    }
    // Fetch users from the database
    $sql = "SELECT `Id`, `Name`, `Email`, `Contact`, `Password` FROM `users` WHERE `Role` = 'user'";
    $result = $conn->query($sql);
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserInfo - InnerEcho</title>
    <link rel="stylesheet" href="Styles/viewUser.css">
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
                <li><a href="viewUser.php">User</a></li>
                <li><a href="viewConsultant">Consultant</a></li>
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
        <section class="admin-container">
            <div class="admin-card text-center">
                <h2>User List</h2>
                <!-- Search Bar -->
                <input type="text" id="searchInput" class="search-bar" placeholder="Search users..." onkeyup="searchTable()">
                <table id="userTable" class="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <tr data-id="' . $row['Id'] . '">
                                <td>' . $row['Id'] . '</td>
                                <td contenteditable="true">' . $row['Name'] . '</td>
                                <td contenteditable="true">' . $row['Email'] . '</td>
                                <td contenteditable="true">' . $row['Contact'] . '</td>
                                <td contenteditable="true">' . $row['Password'] . '</td>
                                <td>
                                    <button class="save-btn" onclick="updateUser(this)">Save</button>
                                    <form method="POST" style="display:inline;">
                                        <button type="submit" name="deleteUser" value="' . $row['Id'] . '" class="delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>';
                        } 
                    ?>
                    </tbody>
                </table>
            </div>
            <script>
                function searchTable() {
                    let input = document.getElementById("searchInput").value.toLowerCase();
                    let table = document.getElementById("userTable");
                    let rows = table.getElementsByTagName("tr");

                    for (let i = 1; i < rows.length; i++) {
                        let cells = rows[i].getElementsByTagName("td");
                        let found = false;

                        for (let j = 0; j < cells.length; j++) {
                            if (cells[j].innerText.toLowerCase().includes(input)) {
                                found = true;
                                break;
                            }
                        }
                        rows[i].style.display = found ? "" : "none";
                    }
                }

                function updateUser(button) {
                    let row = button.closest("tr");
                    let userId = row.getAttribute("data-id");
                    let name = row.cells[1].innerText;
                    let email = row.cells[2].innerText;
                    let contact = row.cells[3].innerText;

                    let formData = new FormData();
                    formData.append("updateUser", "true");
                    formData.append("userId", userId);
                    formData.append("name", name);
                    formData.append("email", email);
                    formData.append("contact", contact);

                    fetch("", { // Sends data to the same PHP file
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => alert(data));
                }
            </script>
        </section>
    </main>
    <footer>
        <div class="footer-container">
            <div>
                <div class="footer-logo">
                    <img src="images/logo_white.png" alt="InnerEcho Logo" class="logo-footer">
                    <h2>InnerEcho</h2>
                </div>
                <p class="footer-description">"Your journey to mental well-being starts here - compassionate care, expert guidance, and 24/7 support at InnerEcho."</p>
            </div>
            <div class="about-us">
                <h2>Contact</h2>
                <p>Address: Bashundhara R/A, Block E, Dhaka</p>
                <p>Phone: +123 456 7890</p>
                <p>Email:innerecho@gmail.com</p>
            </div>
        </div>     
    </footer>
</body>
</html>
