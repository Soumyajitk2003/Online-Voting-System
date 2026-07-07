<?php
// Including the connection to the database
require ('connection.php');
// Starting a session
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Function to send email verification
function sendMail($email, $v_code)
{
    // Including PHPMailer classes
    require ('PHPMailer/PHPMailer.php');
    require ('PHPMailer/SMTP.php');
    require ('PHPMailer/Exception.php');

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
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Email verification from online voting system';
        $mail->Body = "<h2>Thanks for registration!<br>
                        Please verify your mail...<br></h2>
                        <a href='http://localhost/voting/verify.php?email=$email&v_code=$v_code'>
                        <h1>Verify your mail</h1>
                        </a>";

        // Sending the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        // If an error occurs during email sending, return false
        return false;
    }
}

// Handling login form submission
if (isset($_POST['login'])) {
    // Escaping special characters to prevent SQL injection
    $email_username = mysqli_real_escape_string($con, $_POST['email_username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Query to select user based on email or username
    $query = "SELECT * FROM `registered_users` WHERE `email`='$email_username' OR `username`='$email_username'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['is_verified'] == 1) {
                if (password_verify($password, $result_fetch['password'])) {
                    // If password matches, set session variables and redirect to index.php
                    $_SESSION['logged_in'] = true;
                    $_SESSION['username'] = $result_fetch['username'];
                    header("location: index.php");
                    exit;
                } else {
                    // If password is incorrect, show alert and redirect to index.php
                    echo "
                        <script>
                            alert('Incorrect password');
                            window.location.href='index.php';
                        </script>
                    ";
                }
            } else {
                // If email is not verified, show alert and redirect to index.php
                echo "
                    <script>
                        alert('Email not verified');
                        window.location.href='index.php';
                    </script>
                ";
            }
        } else {
            // If no matching user found, show alert and redirect to index.php
            echo "
                <script>
                    alert('College ID Not Registered! & Fill in the blank box');
                    window.location.href='index.php';
                </script>
            ";
        }
    } else {
        // If query execution fails, show alert and redirect to index.php
        echo "
            <script>
                alert('Cannot run Query');
                window.location.href='index.php';
            </script>
        ";
    }
}

// Handling registration form submission
if (isset($_POST['register'])) {
    // Check if all fields are filled
    if (empty($_POST['fullname']) || empty($_POST['username']) || empty($_POST['aadherno']) || empty($_POST['email']) || empty($_POST['password'])) {
        // If any field is empty, show alert and redirect to index.php
        echo "
            <script>
                alert('Please fill in all fields.');
                window.location.href='index.php';
            </script>
        ";
        exit;
    }

    // Check if password and confirm password match
    if ($_POST['password'] !== $_POST['cnfpassword']) {
        // If passwords do not match, show alert and redirect to index.php
        echo "
            <script>
                alert('Both passwords do not match.');
                window.location.href='index.php';
            </script>
        ";
        exit;
    }
    $user_exists = "SELECT * FROM `student_info` WHERE `college_id`='$_POST[username]' AND `aadher_no` = '$_POST[aadherno]'";
    $results = mysqli_query($con, $user_exists);

    // Check if username or email is already taken
    $user_exist_query = "SELECT * FROM `registered_users` WHERE `username`='$_POST[username]' OR `email` = '$_POST[email]'";
    $result = mysqli_query($con, $user_exist_query);
    if ($results) {
        if (mysqli_num_rows($results) == 1) {
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $result_fetch = mysqli_fetch_assoc($result);
                    if ($result_fetch['username'] == $_POST['username']) {
                        // If username is already taken, show alert and redirect to index.php
                        echo "
                    <script>
                        alert('$result_fetch[username] - College ID already registered!');
                        window.location.href='index.php';
                    </script>
                ";
                    } else {
                        // If email is already taken, show alert and redirect to index.php
                        echo "
                    <script>
                        alert('$result_fetch[email] - Email ID already registered!');
                        window.location.href='index.php';
                    </script>
                ";
                    }
                } else {
                    // Inserting new user data into the database
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $v_code = bin2hex(random_bytes(16));
                    $query = "INSERT INTO `registered_users`(`full_name`, `username`, `aadher`, `email`, `password`, `verification_code`, `is_verified`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[aadherno]','$_POST[email]','$password','$v_code','0')";

                    if (mysqli_query($con, $query) && sendMail($_POST['email'], $v_code)) {
                        // If registration is successful, show alert and redirect to index.php
                        echo "
                    <script>
                        alert('Registration successful');
                        window.location.href='index.php';
                    </script>
                ";
                    } else {
                        // If data insertion fails, show alert and redirect to index.php
                        echo "
                    <script>
                        alert('Server Down!');
                        window.location.href='index.php';
                    </script>
                ";
                    }
                }
            } else {
                // If query execution fails, show alert and redirect to index.php
                echo "
            <script>
                alert('Cannot Run Query');
                window.location.href='index.php';
            </script>
            ";
            }
        } else 
        {
            echo "
            <script>
                alert('Student is not study in the college');
                window.location.href='index.php';
            </script>
        ";
        }

    }
}
?>