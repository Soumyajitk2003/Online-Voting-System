<!DOCTYPE html>
<html>
  <head>
    <title>Online Voting System</title>
    <!-- Linking external stylesheet -->
    <link rel="stylesheet" href="style2.css" />
    <!-- Including Font Awesome kit -->
    <script defer src="https://kit.fontawesome.com/5780e10c9c.js" crossorigin="anonymous"></script>
    <!-- JavaScript for disabling right-click -->
    <script language="javascript">
        function noClick() {
            if(event.button == 2) {
                alert("You cannot click on this page.");
            }
        }
        document.onmousedown = noClick;
    </script>
    <style>
      .captcha-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 10px;
      }
      .captcha {
        font-size: 20px;
        letter-spacing: 3px;
        background-color: #f1f1f1;
        padding: 10px;
        margin-bottom: 10px;
      }
      .input-field {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
      }
      .input-field i {
        margin-right: 10px;
      }
    </style>
  </head>
  <body>
    <div class="container1">
      <div class="header1">
        <div class="left">
          <img src="eci.png" />
        </div>
        <div class="right">
          <button type="button" id="memberSignup"><a href="Membersign.php">Member SignUp</a></button>
        </div>
      </div>
      <marquee behavior="scroll" direction="right">Online voting portal</marquee>
      <div class="form-box" id="fromFild">
        <h1 id="title">Login</h1>
        <form action="memberlogin1.php" method="post" onsubmit="return validateLogin()">
          <div class="input-group">
            <div class="select-field">
              <select id="party" required name="party">
                <option value="" selected>Select a party</option>
                <option value="Party 1">Party 1</option>
                <option value="Party 2">Party 2</option>
                <option value="Party 3">Party 3</option>
                <option value="Party 4">Party 4</option>
              </select>
            </div>
            <div class="input-field" id="numberField">
              <i class="fa-solid fa-phone"></i>
              <input type="number" placeholder="Number" name="phoneNumber" required />
            </div>
            <div class="input-field">
              <i class="fa-solid fa-lock"></i>
              <input type="password" placeholder="Password" name="user_pass" required />
            </div>
            <div class="captcha-container">
              <div id="captcha" class="captcha"></div>
              <div class="input-field">
                <input type="text" id="captchaInput" placeholder="Enter CAPTCHA" required />
              </div>
            </div>
          </div>
          <div>
            <input type="submit" value="Login" id="submitBtn">
          </div>
        </form>
      </div>
    </div>
    <script>
      // CAPTCHA generation and validation
      function generateCaptcha() {
        const digitsArray = "0123456789";
        const lengthOtp = 6;
        let captcha = [];
        for (let i = 0; i < lengthOtp; i++) {
          const index = Math.floor(Math.random() * digitsArray.length);
          captcha.push(digitsArray[index]);
        }
        document.getElementById('captcha').innerHTML = captcha.join('');
      }

      function validateCaptcha(input) {
        const generatedCaptcha = document.getElementById('captcha').innerHTML;
        return input === generatedCaptcha;
      }

      // Form validation with CAPTCHA
      function validateLogin() {
        const numberField = document.querySelector('input[type="number"][placeholder="Number"]');
        const passwordField = document.querySelector('input[type="password"][placeholder="Password"]');
        const captchaInput = document.getElementById('captchaInput').value;

        if (numberField.value === '' || passwordField.value === '' || captchaInput === '') {
          alert('Please fill in all required fields.');
          return false;
        }

        if (!validateCaptcha(captchaInput)) {
          alert('Invalid CAPTCHA. Please try again.');
          generateCaptcha(); // Regenerate CAPTCHA
          return false;
        }

        return true; // Allow form submission
      }

      // Initialize CAPTCHA on page load
      window.onload = generateCaptcha;
    </script>
  </body>
</html>
