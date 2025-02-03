<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="Styles/consultantProfile.css">
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
                <span>Consultant Type</span>
                <span id="consultant-type-display">
                    Therapy Expert
                    <a href="#" class="edit-icon" onclick="toggleDropdown(event)">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </span>
                <select id="consultant-type-dropdown" class="consultant-dropdown" onchange="updateConsultantType(event)">
                    <option value="therapy-expert">Therapy Expert</option>
                    <option value="family-counselor">Family Counselor</option>
                    <option value="personal-counselor">Personal Counselor</option>
                    <option value="career-counselor">Career Counselor</option>
                </select>
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
 
    <script>
        function toggleDropdown(event) {
            event.preventDefault();
            const displaySpan = document.getElementById("consultant-type-display");
            const dropdown = document.getElementById("consultant-type-dropdown");
 
            // Toggle visibility
            displaySpan.style.display = displaySpan.style.display === "none" ? "inline" : "none";
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }
 
        function updateConsultantType(event) {
            const selectedValue = event.target.options[event.target.selectedIndex].text;
            const displaySpan = document.getElementById("consultant-type-display");
            const dropdown = document.getElementById("consultant-type-dropdown");
 
            // Update the span text
            displaySpan.innerHTML = `${selectedValue}
                <a href="#" class="edit-icon" onclick="toggleDropdown(event)">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>`;
 
            // Hide the dropdown and show the span
            dropdown.style.display = "none";
            displaySpan.style.display = "inline";
        }
    </script>
</body>
</html>