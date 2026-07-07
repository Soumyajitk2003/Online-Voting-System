<?php
session_start();
require('connection.php');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$Email_id = $_POST["email"];
$password = $_POST["user_pass"];
$party = $_POST["party"];

$sql = "SELECT * FROM `administrator` WHERE addmail='$Email_id' AND User_Pass='$password'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $Email_id;

    switch ($party) {
        case "Party 1":
            header("Location: buttonpage.php");
            break;
        default:
            echo "<script>alert('User & party name are not found');window.location = 'admin.php'</script>";
            break;
    }
    exit();
} else {
    echo "<script>alert('User & party name are not found');window.location = 'admin.php'</script>";
}

mysqli_close($con);
?>
