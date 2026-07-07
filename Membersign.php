<?php 
// Including the connection to the database
require('connection.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>SignUp | Online voting system</title>
    <!-- Including CSS file for styling -->
    <link rel="stylesheet" href="style2.css" />
    <!-- JavaScript function to disable right-click -->
    <script language="javascript">
        function noClick()
        {
            if(event.button==2)
            {
                alert("This function is not work!!")
            }
        }
        document.onmousedown=noClick
    </script>
</head>
<body>
    <div class="container1">
        <div class="header1">
            <!-- Logo for the header -->
            <img src="eci.png" />
        </div>
        <!-- Marquee for scrolling text -->
        <marquee behavior="scroll" direction="right">Online voting portal</marquee>
        <!-- Form for sign up -->
        <div class="form-box" id="fromFild2">
            <h1>Member Sign Up</h1>
            <form action="membersign1.php" method="post">
                <div class="input-group">
                    <!-- Selecting party -->
                    <div class="select-field">
                        <select id="party" name="party" required>
                            <option value="" selected>Select a party</option>
                            <option value="Party 1">Party 1</option>
                            <option value="Party 2">Party 2</option>
                            <option value="Party 3">Party 3</option>
                            <option value="Party 4">Party 4</option>
                        </select>
                    </div>
                    <!-- Input fields for user details -->
                    <div class="input-field">
                        <i class="fa-solid fa-id-card"></i>
                        <input type="number" placeholder="College id" name="college_id" required />
                    </div>
                    <div class="input-field" id="numberField2">
                        <i class="fa-solid fa-phone"></i>
                        <input type="number" placeholder="Number" name="phone_no" required />
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-person"></i>
                        <input type="text" placeholder="Full Name" name="fullName" required />
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-id-card"></i>
                        <input type="number" placeholder="Aadher number" name="aadharNum" required />
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-id-card"></i>
                        <input type="text" placeholder="Voter Number" name="voterNum" required />
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email" name="Email_id" required />
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" name="Password" required />
                    </div>
                    <div class="input-field" id="passField2">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Confirm password" name="Conf_Password" required />
                    </div>
                    <!-- Terms and conditions checkbox -->
                    <div class="terms">
                        <input type="checkbox" id="checkbox2" required><label for="checkbox">I agree to these all the given data are correct</label>
                    </div>
                    <!-- Submit button -->
                    <div class="btn-field">
                        <input type="submit" class="submitBtn " value="submit" id="submitBtn" onclick="validate()">
                    </div>
                    <!-- Link to login page -->
                    <div class="terms">
                        <h3>Are you already register?<a href="index.php"> Click here</a><br></h3>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- JavaScript function to validate the form -->
    <script>
        function validate() {
            // Getting input field values
            var collegeId = document.querySelector('input[type="number"][placeholder="College id"]');
            var phoneNumber = document.querySelector('input[type="number"][placeholder="Number"]');
            var fullName = document.querySelector('input[type="text"][placeholder="Full Name"]');
            var aadharNumber = document.querySelector('input[type="number"][placeholder="Aadher number"]');
            var voterNumber = document.querySelector('input[type="text"][placeholder="Voter Number"]');
            var email = document.querySelector('input[type="email"][placeholder="Email"]');
            var password = document.querySelector('input[type="password"][placeholder="Password"]');
            var confirmPassword = document.querySelector('input[type="password"][placeholder="Confirm password"]');
            var checkbox = document.getElementById('checkbox2');

            // Checking if any field is empty
            if (collegeId.value === '' || phoneNumber.value === '' || fullName.value === '' || aadharNumber.value === '' || voterNumber.value === '' || email.value === '' || password.value === '' || confirmPassword.value === '') {
                alert('Please fill in all required fields.');
                return false;
            }

            // Checking if passwords match
            if (password.value !== confirmPassword.value) {
                alert('Passwords do not match.');
                return false;
            }

            // Checking if terms and conditions checkbox is checked
            if (!checkbox.checked) {
                alert('Please agree to the terms & conditions.');
                return false;
            }
            // Form validation successful
            // alert('Form submitted successfully!');
            // return true;
        }
    </script>
</body>
</html>
