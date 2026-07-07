<?php
// Including the connection to the database
require("connection.php");

// Importing PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Function to send password reset email
function sendMail($email, $reset_token)
{
    // Including PHPMailer classes
    require('PHPMailer/PHPMailer.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/Exception.php');

    // Creating a new PHPMailer object
    $mail = new PHPMailer(true);

    try {
        // Configuring SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'projectworks196@gmail.com';
        $mail->Password = 'pvwkgqrtjxxkinpv';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Setting email content
        $mail->setFrom('projectworks196@gmail.com', 'Online voting system');
        $mail->addAddress($_POST["email"]);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Link for Online Voting System';
        $mail->Body = "<h2>We got a request from you to reset your password!<br>
        Click the link below:<br></h2>
        <a href='http://localhost/voting/updatepassword.php?email=$email&reset_token=$reset_token'>
        <h1>Reset Password</h1>
        </a>";

        // Sending the email
        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}

// Handling form submission for sending password reset link
if (isset($_POST['send-reset-link'])) {
    // Query to check if user exists with the given email
    $query = "SELECT * FROM `registered_users` WHERE `email`= '$_POST[email]'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            // Generating reset token
            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/Hong_Kong');
            $date = date("Y-m-d");
            // Updating reset token and expiration date in the database
            $query = "UPDATE `registered_users` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE `email`='$_POST[email]'";
            // Sending password reset email
            if (mysqli_query($con, $query) && sendmail($_POST['email'], $reset_token)) {
                echo "
              <script>
                 alert('Password Reset Link sent to E-mail');
                window.location.href='index.php';
              </script>
              ";
            } else {
                echo "
              <script>
                 alert('Server down try again later!!');
                window.location.href='index.php';
              </script>
              ";
            }
        } else {
            // If no user found with the given email
            echo "
              <script>
                 alert('No user found with this email. Please enter a valid email address.');
                window.location.href='index.php';
              </script>
              ";
        }
    } else {
        // If query execution fails
        echo "
            <script>
            alert('Cannot run query');
            window.location.href='index.php';
            </script>
            ";
    }
}
?>
