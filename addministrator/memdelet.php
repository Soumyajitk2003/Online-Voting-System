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
    $college_id = $_GET['id'];

    // Perform any necessary input validation and sanitization
    $college_id = mysqli_real_escape_string($con, $college_id);

    // Check if the record exists
    $sql = "SELECT * FROM member_details WHERE college_id='$college_id'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Perform deletion
        $delete_sql = "DELETE FROM member_details WHERE college_id='$college_id'";
        if (mysqli_query($con, $delete_sql)) {
            echo "<script>
                    alert('Record for username: " . $college_id . " deleted successfully');
                    window.location.href = 'memberview.php'; // Redirect to studentview.php after deletion
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
