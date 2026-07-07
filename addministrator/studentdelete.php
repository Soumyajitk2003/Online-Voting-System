<?php
// Including the connection to the database
require('connection.php');

// Check if the connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the ID from the URL
    $username = $_GET['id'];

    // Perform any necessary input validation and sanitization
    $username = mysqli_real_escape_string($con, $username);

    // Check if the record exists
    $sql = "SELECT * FROM student_info WHERE college_id='$username'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Perform deletion
        $delete_sql = "DELETE FROM student_info WHERE college_id='$username'";
        if (mysqli_query($con, $delete_sql)) {
            echo "<script>
                    alert('Record for username: " . $username . " deleted successfully');
                    window.location.href = 'studentdetails.php'; // Redirect to studentview.php after deletion
                  </script>";
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }
    } else {
        echo "Record not found.";
    }
} else {
    echo "No ID provided.";
}

// Close the database connection
mysqli_close($con);
?>
