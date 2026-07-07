<!DOCTYPE html>
<html>
<head>
    <title>Online Voting System</title>
    <link rel="stylesheet" href="style1.css">
    <script defer src="https://kit.fontawesome.com/5780e10c9c.js" crossorigin="anonymous"></script>
    <style>
        .captcha {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 3px;
            background: #f2f2f2;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
        }
        .captcha-container {
            display: flex;
            align-items: center;
        }
        .refresh-captcha {
            margin-left: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container1">
        <div class="header1">
            <div class="left">
                <img src="eci.png" alt="ECI Logo">
            </div>
            <div class="right">
                <button type="button" id="memberSignup"><a href="/voting/index.php">Home</a></button>
            </div>
        </div>
        <marquee behavior="scroll" direction="right">Online voting portal</marquee>
        <div class="form-box" id="fromFild">
            <h1 id="title">Administrator Login</h1>
            <form action="admin1.php" method="post" onsubmit="return validateLogin()">
                <div class="input-group">
                    <div class="select-field">
                        <select id="party" required name="party">
                            <option value="" selected>Select Admin</option>
                            <option value="Party 1">Admin 1</option>
                        </select>
                    </div>
                    <div class="input-field" id="numberField">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email_id" name="email" required>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" name="user_pass" required>
                    </div>
                    <!-- Captcha Section -->
                    <div class="input-field captcha-container">
                        <div class="captcha" id="captcha"></div>
                        <i class="fa-solid fa-refresh refresh-captcha" id="refreshCaptcha"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Enter Captcha" name="captcha" id="captchaInput" required>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Login" id="submitBtn">
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const captchaElement = document.getElementById('captcha');
            const refreshCaptcha = document.getElementById('refreshCaptcha');
            const captchaInput = document.getElementById('captchaInput');

            function generateCaptcha() {
                let chars = '0123456789';
                let captcha = '';
                for (let i = 0; i < 6; i++) {
                    captcha += chars[Math.floor(Math.random() * chars.length)];
                }
                return captcha;
            }

            function setCaptcha() {
                let captcha = generateCaptcha();
                captchaElement.textContent = captcha;
                captchaInput.value = '';
            }

            refreshCaptcha.addEventListener('click', setCaptcha);

            // Initial captcha load
            setCaptcha();

            window.validateLogin = function() {
                if (captchaInput.value !== captchaElement.textContent) {
                    alert('Captcha is incorrect. Please try again.');
                    return false;
                }

                var emailField = document.querySelector('input[type="email"][placeholder="Email_id"]');
                var passwordField = document.querySelector('input[type="password"][placeholder="Password"]');

                if (emailField.value === '' || passwordField.value === '') {
                    alert('Please fill in all required fields.');
                    return false;
                }

                return true;
            }
        });
    </script>
</body>
</html>
