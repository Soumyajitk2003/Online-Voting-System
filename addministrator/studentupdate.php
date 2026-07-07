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

    // Fetch the existing data based on the ID
    $sql = "SELECT * FROM student_info WHERE college_id='$college_id'";
    $result = mysqli_query($con, $sql);

    // Check if the query was successful and if the record exists
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Record not found.";
        exit();
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $aadhar_no = mysqli_real_escape_string($con, $_POST['aadhar_no']);

        // SQL query to update the record
        $update_sql = "UPDATE student_info SET aadher_no='$aadhar_no' WHERE college_id='$college_id'";

        // Execute the query
        if (mysqli_query($con, $update_sql)) {
            // Redirect to the studentview.php page after updating
            echo "<script>
                    alert('Record updated successfully');
                    window.location.href='studentdetails.php';
                  </script>";
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }
} else {
    echo "No ID provided.";
    exit();
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    
    <form method="post" onsubmit="return confirmUpdate();">
        <h2><u>Update Record</u></h2>
        <label for="username">College ID (Username):</label>
        <input type="text" id="username" name="username" value="<?php echo $row['college_id']; ?>" required><br><br>
        
        <label for="aadhar">Aadhaar No:</label>
        <input type="text" id="aadhar" name="aadhar_no" value="<?php echo $row['aadher_no']; ?>" required><br><br>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>
