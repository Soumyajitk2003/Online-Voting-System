<?php require('connection.php'); ?> <!-- Including the connection to the database -->

<!DOCTYPE html>
<html>
  <head>
    <title>Online voting system</title>
    <link rel="stylesheet" href="style1.css" /> <!-- Linking to the CSS file -->
    <script defer src="https://kit.fontawesome.com/5780e10c9c.js"
      crossorigin="anonymous"></script> <!-- Including Font Awesome for icons -->
          
    <!-- JavaScript for disabling right-click -->
    <script language="javascript">
        function noClick()
        {
            if(event.button==2)
            {
                alert("you can not click on this page")
            }
        }
        document.onmousedown=noClick
    </script>
  </head>

  <body>
    <div class="container">
      <div class="header">
        <div class="left">
          <img src="eci.png" /> <!-- Displaying the logo -->
        </div>
        <div class="right">
          <!-- Buttons for member signup and login -->
          <button type="button" id="memberSignup"><a
              href="Membersign.php">Member SignUp</a></button>
          <button type="button" id="memberLogin"><a
              href="memberlogin.php">Member Login</a></button>
        </div>
      </div>
      <marquee behavior="scroll" direction="right">Online voting
        portal</marquee> <!-- Marquee for displaying scrolling text -->
    </div>

    <script>
      // JavaScript code for handling button clicks and form validation
      let fromFild = document.getElementById("fromFild");
      let fromFild2 = document.getElementById("fromFild2");
      let LoginBtn = document.getElementById("LoginBtn");
      let signupBtn = document.getElementById("signupBtn");

      signupBtn.onclick = function () {
        // Redirecting to the signup page
        window.location = './signup.html';
      };

      function validateLogin() {
        var numberField = document.querySelector('input[type="number"][placeholder="Number"]');
        var passwordField = document.querySelector('input[type="password"][placeholder="Password"]');

        if (numberField.value === '' || passwordField.value === '') {
          // Validating if all required fields are filled
          alert('Please fill in all required fields.');
          return false;
        }  
      }
    </script>
  </body>
</html>
