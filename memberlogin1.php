<?php
// Include the file with database connection details
require('connection.php');

// Check if the connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get phone number and password from the form
$phoneNumber = $_POST["phoneNumber"];
$password = $_POST["user_pass"];

// Check if party information is provided, if not set it to empty string
$party = isset($_POST["party"]) ? $_POST["party"] : "";

// SQL query to select member details based on phone number, password, and party
$sql = "SELECT * FROM member_details WHERE phone_no = '$phoneNumber' AND User_Pass = '$password' AND party ='$party'";

// Execute the query
$result = mysqli_query($con, $sql);

// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {
    // If user exists, redirect based on party
    switch ($party) {
        case "Party 1":
            header("Location: member1.php");
            break;
        case "Party 2":
            header("Location: member2.php");
            break;
        case "Party 3":
            header("Location: member3.php");
            break;
        case "Party 4":
            header("Location: member4.php");
            break;
        default:
            // If party is not recognized, display error message and redirect
            echo "<script>alert('User & party name are not found');window.location = 'http://localhost/voting/memberlogin.php'</script>";
            break;
    }
    // Stop execution after redirection
    exit();
} else {
    // If user does not exist, display error message and redirect
    echo "<script>alert('User & party name are not found');window.location = 'http://localhost/voting/memberlogin.php'</script>";
}

// Close the database connection
mysqli_close($con);
?>
