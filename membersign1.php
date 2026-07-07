<?php
require('connection.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input to prevent SQL injection
    $party = mysqli_real_escape_string($con, $_POST['party']);
    $collegeId = mysqli_real_escape_string($con, $_POST['college_id']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phone_no']); 
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $aadharNumber = mysqli_real_escape_string($con, $_POST['aadharNum']);
    $voterNumber = mysqli_real_escape_string($con, $_POST['voterNum']);
    $email = mysqli_real_escape_string($con, $_POST['Email_id']);
    $password = mysqli_real_escape_string($con, $_POST['Password']);

    // Check if the user already exists
    $check_query = "SELECT * FROM member_details WHERE aadharNum = '$aadharNumber'  OR phone_no = '$phoneNumber' OR college_id = '$collegeId' OR party ='$party'";
    $result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($result) > 0) {
        // If user already exists, show an alert message
        echo "<script>alert('User already present..'); window.location = 'http://localhost/voting/Membersign.php';</script>";
    } else {
        // Insert the new user into the database
        $insert_query = "INSERT INTO member_details (party, college_id, phone_no, fullName, aadharNum, voterNum, Email, User_Pass) VALUES ('$party', '$collegeId', '$phoneNumber', '$fullName', '$aadharNumber', '$voterNumber', '$email', '$password')";

        if (mysqli_query($con, $insert_query)) {
            // If user inserted successfully, show success message and redirect to login page
            echo "<script>alert('New user created successfully!'); window.location = 'http://localhost/voting/memberlogin.php';</script>";
        } else {
            // If there was an error, show an alert message with the error details
            echo "<script>alert('Something went wrong!'); window.location = 'http://localhost/voting/home_member.php';</script>";
            echo "Error: " . $insert_query . "<br>" . mysqli_error($con);
        }
    }
} else {
    // If the request method is not POST, echo "Invalid request"
    echo "Invalid request";
}

// Close the database connection
mysqli_close($con);
?>
