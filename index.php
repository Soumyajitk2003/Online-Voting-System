<?php
// Including the connection file
require ('connection.php');

// Start a session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if login credentials are correct (you need to implement this logic)
    // Assuming login is successful
    $username = $_POST['username']; // Assuming username is used for login
    $_SESSION['username'] = $username; // Store username in session
    $_SESSION['logged_in'] = true; // Set logged_in to true

    // Redirect to the voting page
    header("Location: voting_page.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System</title>
    <!-- CSS file -->
    <link rel="stylesheet" href="style.css">
    <!-- Inline CSS style for timer -->
    <style>
        #timer {
            color: whitesmoke;
            font-size: xx-large;
            font-weight: bold;
        }

        .button-73.hidden {
            display: none;
        }
    </style>

    <!-- JavaScript for disabling right-click -->
    <script language="javascript">
        function noClick() {
            if (event.button == 2) {
                alert("you can not click on this page")
            }
        }
        document.onmousedown = noClick
    </script>
</head>

<body>
    <div class="container">
        <!-- Header section -->
        <header>
            <!-- Logo -->
            <div class="left">
                <img src="eci.png" alt="Logo">
            </div>

            <!-- Hamburger menu -->
            <div class="hamburger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <!-- Navigation links -->
            <nav id="navLinks">
                <?php if (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) { ?>
                    <!-- If user is not logged in -->
                    <a href="index.php">HOME</a>
                    <a href="memberlogin.php">Member Login</a>
                    <a href="memberdetailes.php">View Member</a>
                    <a href="#">ABOUT</a>
                <?php } ?>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
                    <!-- If user is logged in -->
                    <h2 class="tages">Online Voting Procedure</h2>
                    <?php echo "<script>document.location.href='voting_page.php'</script>"; ?>
                <?php } else { ?>
                    <!-- If user is not logged in, show login and registration buttons -->
                    <div class="button">
                        <div class="sign-in-up">
                            <button class="button-78" id="login-btn" type="button"
                                onclick="popup('login-popup')">LOGIN</button>
                            <div id="login-timer"></div>
                        </div>
                        <div class="sign-in-up">
                            <button class="button-78" id="register-btn" type="button"
                                onclick="popup('register-popup')">REGISTER</button>
                            <div id="register-timer"></div>
                        </div>
                    </div>
                <?php } ?>
            </nav>
        </header>

        <!-- Main content -->
        <div class="box">
            <!-- Box 1: Information about voting results and timer -->
            <div class="box1">
                <p><br>
                <h2>Admin Login</h2> <br>
                </p>
                <div class="button">
                    <div class="sign-in-up">
                        <button class="button-78" id="view" type="button"
                            onclick="location.href='/voting/addministrator/admin.php'">Admin Page</button><br>
                    </div>
                </div>
                <p><br>
                <h1>The voting Results will be declared on</h1> <br>
                </p>
                <!-- Button to check results (hidden until the time) -->
                <button id="check-result-btn" class="button-73 hidden" style="vertical-align:middle"
                    onclick="gotoResult()"><span>Check Result</span></button>
                <!-- Timer for voting results declaration -->
                <div id="timer"></div>
            </div>

            <!-- Box 2: Steps for voting procedure -->
            <div class="box2">
                <p>
                <h2><u>Step 1: </u><a href="registration.png">Registration</a></h2><br>
                <h4>
                    i. As per your college I'd card first you have to put your full name.<br>
                    ii. Then you have to put your College I'd or you have to put your 7 digit Roll no. <br>
                    iii. Put Your Govt. UDAI no. (Aadhar no.)<br>
                    iv. Provide a valid Email I'd which you are using for any official work.<br>
                    v. Lastly put a strong password within 4 to 12 digits & register yourself for the voting pole.<br>
                </h4>
                <h2><u><br>Step 2: </u><a href="loging.png"> Login</a></h2><br>
                <h4>
                    i. Put your Email I'd or College I'd which you gave at the time of registration.<br>
                    ii. Now put your secret password which you have created at the time of registration.<br>
                    iii. In case, If you forgot your password then click on forget password & put your Email I'd, so we
                    can send you the recover email to help you out to recover your secret password.<br>
                </h4>
                <h2><u><br>Step 3:</u><a href="votes.jpg"> Voting Pole<a></h2><br>
                <h4>
                    i. Choose your desired member & vote for the party.<br>
                    ii. Press ok to confirm your party then press the vote here option. Congratulations you vote for a
                    change.<br>
                    iii. In case, if you don't want to vote for anyone then directly press the vote here button.<br>
                </h4>
                </p>
            </div>
        </div>

        <!-- Displaying welcome message if user is logged in -->
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            echo "<h1 style='text-align: center;margin-top:200px'>welcome to the voting page - $_SESSION[username]</h1>";
        }
        ?>
    </div>

    <!-- Popups for login, registration, and password reset -->
    <div class="popup-container" id="login-popup">
        <div class="popup">
            <form method="POST" action="login_register.php">
                <h2>
                    <span>USER LOGIN</span>
                    <button type="reset" onclick="popup('login-popup')">X</button>
                </h2>
                <input type="text" placeholder="E-mail or college_id" name="email_username">
                <input type="password" placeholder="Password" name="password">
                <button type="submit" class="login-btn" name="login">LOGIN</button>
            </form>
            <div class="forgot-btn">
                <button type="button" onclick="forgotPopup()">Forgot Password?</button>
            </div>
        </div>
    </div>

    <div class="popup-container" id="register-popup">
        <div class="register popup">
            <form method="POST" action="login_register.php">
                <h2>
                    <span>USER REGISTER</span>
                    <button type="reset" onclick="popup('register-popup')">X</button>
                </h2>
                <input type="text" placeholder="Full Name" name="fullname" require>
                <input type="number" placeholder="College id" name="username" require>
                <input type="number" placeholder="Aadhar Number" name="aadherno" require>
                <input type="email" placeholder="E-mail" name="email" require>
                <input type="password" placeholder="Password" name="password" require>
                <input type="password" placeholder="Confirm Password" name="cnfpassword" require>
                <button type="submit" class="register-btn" name="register">REGISTER</button>
            </form>
        </div>
    </div>

    <div class="popup-container" id="forgot-popup">
        <div class="forgot popup">
            <form method="POST" action="forgotpassword.php">
                <h2>
                    <span>Reset Password</span>
                    <button type="reset" onclick="popup('forgot-popup')">X</button>
                </h2>
                <input type="email" placeholder="E-mail" name="email">
                <button type="submit" class="reset-btn" name="send-reset-link">Send Link</button>
            </form>
        </div>
    </div>

    <!-- JavaScript for hamburger menu, timer, and popups -->
    <script>
        // JavaScript for hamburger menu
        function toggleMenu() {
            var navLinks = document.getElementById("navLinks");
            var hamburger = document.querySelector('.hamburger');
            if (navLinks.style.display === "flex") {
                navLinks.style.display = "none";
                hamburger.classList.remove('active');
            } else {
                navLinks.style.display = "flex";
                hamburger.classList.add('active');
            }
        }

        // Call toggleMenu on initial page load
        window.onload = function () {
            window.onload = startRegisterTimer;
            var screenWidth = window.innerWidth;
            if (screenWidth <= 768) {
                document.getElementById("navLinks").style.display = "none";
            }
        }

        // Call toggleMenu on window resize
        window.onresize = function () {
            var screenWidth = window.innerWidth;
            if (screenWidth > 768) {
                document.getElementById("navLinks").style.display = "flex";
            } else {
                document.getElementById("navLinks").style.display = "none";
            }
        }
    </script>

    <!-- External script for collecting data -->
    <script>(function (w, d) { w.CollectId = "6638e5a13e99425e992d292d"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async = true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>

    <!-- JavaScript for registration timer & loging-->
    <script>
        function startTimers() {
            const loginButton = document.getElementById('login-btn');
            const loginTimer = document.getElementById('login-timer');
            const registerButton = document.getElementById('register-btn');
            const registerTimer = document.getElementById('register-timer');

            const now = new Date().getTime();
            const registerEndDate = new Date('june 25, 2024 14:18:00').getTime(); // Set your registration end date
            const loginEndDate = new Date('July 02, 2024 00:00:00').getTime(); // Set login end date

            function updateTimers() {
                const now = new Date().getTime();

                // Update registration timer
                const registerTimeLeft = registerEndDate - now;
                if (registerTimeLeft <= 0) {
                    registerButton.disabled = true;
                    registerTimer.innerHTML = "Registration End!";
                    loginButton.disabled = false; // Enable the login button
                } else {
                    const registerDays = Math.floor(registerTimeLeft / (1000 * 60 * 60 * 24));
                    const registerHours = Math.floor((registerTimeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const registerMinutes = Math.floor((registerTimeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const registerSeconds = Math.floor((registerTimeLeft % (1000 * 60)) / 1000);
                    registerTimer.innerHTML = `${registerDays}d ${registerHours}h ${registerMinutes}m ${registerSeconds}s`;
                }

                // Update login timer
                if (!registerButton.disabled) {
                    loginButton.disabled = true; // Ensure login button is disabled while registration is open
                } else {
                    const loginTimeLeft = loginEndDate - now;
                    if (loginTimeLeft <= 0) {
                        loginButton.disabled = true;
                        loginTimer.innerHTML = "Vote End!";
                    } else {
                        const loginDays = Math.floor(loginTimeLeft / (1000 * 60 * 60 * 24));
                        const loginHours = Math.floor((loginTimeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const loginMinutes = Math.floor((loginTimeLeft % (1000 * 60 * 60)) / (1000 * 60));
                        const loginSeconds = Math.floor((loginTimeLeft % (1000 * 60)) / 1000);
                        loginTimer.innerHTML = `${loginDays}d ${loginHours}h ${loginMinutes}m ${loginSeconds}s`;
                    }
                }
            }

            // Initially disable the login button
            loginButton.disabled = true;

            // Start the timer updates
            setInterval(updateTimers, 1000);
        }

        window.onload = startTimers;

    </script>
    <!-- JavaScript for voting timer and check result -->
    <script>
        function gotoResult() {
            window.location.href = "result_page.html"; // Replace with the actual result page URL
        }

        function updateTimer(remainingTime) {
            const timerElement = document.getElementById('timer');
            const buttonElement = document.getElementById('check-result-btn');
            if (remainingTime <= 0) {
                timerElement.textContent = 'Result Published';
                buttonElement.classList.remove('hidden'); // Show the button
            } else {
                const days = Math.floor(remainingTime / (3600 * 24));
                const hours = Math.floor((remainingTime % (3600 * 24)) / 3600);
                const minutes = Math.floor((remainingTime % 3600) / 60);
                const seconds = remainingTime % 60;
                timerElement.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                buttonElement.classList.add('hidden'); // Hide the button
            }
        }

        function checkButtonStatus() {
            fetch('check_timer.php')
                .then(response => response.json())
                .then(data => {
                    updateTimer(data.remainingTime);
                })
                .catch(error => console.error('Error:', error));
        }

        // Check button status and update timer every second
        setInterval(checkButtonStatus, 1000);

        // Initial check when the page loads
        checkButtonStatus();
    </script>
    <!-- JavaScript for handling popups -->
    <script>
        function popup(popup_name) {
            get_popup = document.getElementById(popup_name);
            if (get_popup.style.display == "flex") {
                get_popup.style.display = "none";
            } else {
                get_popup.style.display = "flex";
            }
        }

        function forgotPopup() {
            document.getElementById('login-popup').style.display = "none";
            document.getElementById('forgot-popup').style.display = "flex";
        }

        function gotoResult() {
            window.location.href = "result.php";
        }
    </script>
</body>

</html>