<?php
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
$sql = "SELECT `Id`, `Name`, `Email`, `Contact` FROM `users` WHERE `Role` = 'user'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid black; text-align: left; }
        .search-bar { margin-bottom: 10px; padding: 5px; width: 200px; }
        .delete-btn { background-color: red; color: white; border: none; padding: 5px; cursor: pointer; }
        .save-btn { background-color: green; color: white; border: none; padding: 5px; cursor: pointer; }
        td[contenteditable="true"] { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>User List</h2>

    <!-- Search Bar -->
    <input type="text" id="searchInput" class="search-bar" placeholder="Search users..." onkeyup="searchTable()">

    <table id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr data-id="<?php echo $row['Id']; ?>">
                    <td><?php echo $row['Id']; ?></td>
                    <td contenteditable="true"><?php echo $row['Name']; ?></td>
                    <td contenteditable="true"><?php echo $row['Email']; ?></td>
                    <td contenteditable="true"><?php echo $row['Contact']; ?></td>
                    <td>
                        <button class="save-btn" onclick="updateUser(this)">Save</button>
                        <form method="POST" style="display:inline;">
                            <button type="submit" name="deleteUser" value="<?php echo $row['Id']; ?>" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

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
</body>
</html>
