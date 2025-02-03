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
    <title>InnerEcho</title>
    <link rel="stylesheet" href="Styles/style.css">
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
                <li><a href="">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="therapist.php">Services</a></li>
            </ul>
            <a href="login.php"><button class="btn-primary">Login</button></a>
        </nav>
        <section class="banner display-flex">
            <div class="banner-content">
                <h1 class="banner-title">Healthy Minds, Happy <br>Lives <span style="color:#EC744A ;">Mental Heath</span><br> Consultancy</h1>
                <p class="banner-description">InnerEcho offers personalized mental health support through online, family, and personal counseling, alongside tools like mood tracking and self-assessment to help you thrive. Begin your journey to emotional well-being with our secure, compassionate care today!</p>
                <div>
                    <a href="signup.php"><button class="btn-primary">Get Started</button></a>
                </div>
            </div>
            <div class="banner-image">
                <img src="images/banner.png" alt="Banner Image" class="banner-img">
            </div>
        </section>
        <div class="banner-overlay">
            <div class="counseling-type display-flex">
                <div class="type1">
                    <div class="head display-flex">
                        <img src="images/massage_c.png" alt="Type Image" class="type-img1">
                    <h2> Online Counseling</h2>
                    </div>
                    <p>Many therapists offer counselling online or by telephone, check their profile to learn more or use our online and telephone search.</p>
                    <a href="therapist.php" class="therapist">Find therapist  <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="type2">
                    <div class="head display-flex">
                        <img src="images/P_c.png" alt="Type Image" class="type-img2">
                        <h2> Family Counseling</h2>
                    </div>
                    <p>If you are in trouble and want our immediate help, simply pick up the phone and call us anytime you need help.</p>
                    <a href="therapist.php" class="therapist">Find therapist  <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="type3">
                    <div class="head display-flex">
                        <img src="images/D_Counseling .png" alt="Type Image" class="type-img3">
                        <h2> Personal Counseling</h2>
                    </div>
                    <p>Psychological counseling, direct psychotherapy with leading psychologists at Medcaline.</p>
                    <a href="therapist.php" class="therapist3">Find therapist  <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="Consultant">
            <h1 class="consultants-title text-center">Easing your mind with the best <br> therapeutic care?</h1>
            <div class="Consultant-content display-flex">
                <div class="Consultant1">
                    <img src="images/team-1.jpg" alt="Consultant Image" class="Consultant-img">
                    <h2 class="Consultant-title text-center">Dr. Sophia Reynolds</h2>
                    <h3 class="text-center"> Therapy Expert </h3>
                </div>
                <div class="Consultant2">
                    <img src="images/team-2.jpg" alt="Consultant Image" class="Consultant-img">
                    <h2 class="Consultant-title text-center">Dr. Jane Doe</h2>
                    <h3 class="text-center"> Therapy Expert </h3>
                </div>
                <div class="Consultant3">
                    <img src="images/team-3.png" alt="Consultant Image" class="Consultant-img">
                    <h2 class="Consultant-title text-center" >Dr. Olivia Bennett</h2>
                    <h3 class="text-center"> Therapy Expert </h3>
                </div>
                <div class="Consultant4">
                    <img src="images/team-4.jpg" alt="Consultant Image" class="Consultant-img">
                    <h2 class="Consultant-title text-center">Dr. Daniel Foster</h2>
                    <h3 class="text-center"> Therapy Expert </h3>
                </div>
            </div>
            <div class="text-center consultant_btn">
                <a href="therapist.php"><button class="btn-primary">View More Consultant </button></a>
                
            </div>
        </section>

        <section class="about-us">
            <h1 class="about-us-title text-center">Why Our Mental Health Consultants are <br> the Best Choice</h1>
            <div class="about-us-content display-flex"> 
                <div class="card-1 text-center">
                    <img src="images/card1.png" alt="Card Image" class="card-img ">
                    <h2 class="card-title">Holistic approach</h2>
                    <p class="card-description">Our holistic approach focuses on addressing mental, emotional, and physical well-being to create lasting, positive change in your life.</p>

                </div>
                <div class="card-2 text-center">
                    <img src="images/card2.png" alt="Card Image" class="card-img">
                    <h2 class="card-title">Expertise Team</h2>
                    <p class="card-description">Our expert team of compassionate professionals is dedicated to providing personalized care and guidance for your mental well-being.</p>

                </div>
                <div class="card-3 text-center">
                    <img src="images/card3.png" alt="Card Image" class="card-img">
                    <h2 class="card-title">24/7 Support</h2>

                    <p class="card-description">We provide 24/7 support to ensure that help is always available whenever you need it, offering constant care and guidance to prioritize your mental well-being.</p>

                </div> 
            </div>
    </main>
    <footer>
        <div class="footer-container">
            <div>
                <div class="footer-logo">
                    <img src="images/logo_white.png" alt="InnerEcho Logo" class="logo-footer">
                    <h2>InnerEcho</h2>
                </div>
                <p class="footer-description"> "Your journey to mental well-being starts here – compassionate care, expert guidance, and 24/7 support at InnerEcho."</p>
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