<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Admin Panel</title>
    <link rel="stylesheet" href="Styles/addUser.css">
</head>
<body class="manrope-font">
    <main>
        <div class="container">
            <h2>Add a New User</h2>
            <p>Enter the details to add a new user</p>
            <form>
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter full name" required>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter email" required>

                <label for="phoneNumber">Phone Number</label>
                <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Enter phone number" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>

                <button type="submit">Add User</button>
                <p><a href="admin-dashboard.html">Back to Admin Panel</a></p>
            </form>
    </div>
    </main>
    
</body>
</html>
