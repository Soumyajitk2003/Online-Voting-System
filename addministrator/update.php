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

    // Fetch the existing data based on the ID
    $sql = "SELECT * FROM registered_users WHERE username='$username'";
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
        $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
        $aadher = mysqli_real_escape_string($con, $_POST['aadher']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $is_verified = mysqli_real_escape_string($con, $_POST['is_verified']);
        $voting = mysqli_real_escape_string($con, $_POST['voting']);
        $new_username = mysqli_real_escape_string($con, $_POST['username']);

        // Check if the new username already exists in the database
        $check_sql = "SELECT * FROM registered_users WHERE username='$new_username' AND username != '$username'";
        $check_result = mysqli_query($con, $check_sql);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            echo "<script>
                    alert('Username already exists. Please choose a different username.');
                    window.history.back();
                  </script>";
            exit();
        } else {
            // SQL query to update the record
            $sql = "UPDATE registered_users SET 
                    full_name='$full_name', 
                    aadher='$aadher', 
                    email='$email', 
                    is_verified='$is_verified', 
                    voting='$voting',
                    username='$new_username'
                    WHERE username='$username'";

            // Execute the query
            if (mysqli_query($con, $sql)) {
                // Redirect to the studentview.php page after updating
                echo "<script>
                        alert('Record updated successfully');
                        window.location.href='studentview.php';
                      </script>";
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($con);
            }
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
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>" required><br><br>
        
        <label for="username">College ID (Username):</label>
        <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required><br><br>
        
        <label for="aadher">Aadhaar No:</label>
        <input type="text" id="aadher" name="aadher" value="<?php echo $row['aadher']; ?>" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>
        
        <label for="is_verified">Email Verified or Not:</label>
        <input type="text" id="is_verified" name="is_verified" value="<?php echo $row['is_verified']; ?>" required><br><br>

        <label for="voting">Voted or Not:</label>
        <input type="text" id="voting" name="voting" value="<?php echo $row['voting']; ?>" required><br><br>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>

