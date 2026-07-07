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
    $sql = "SELECT * FROM member_details WHERE college_id='$college_id'";
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
        $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
        $aadharNum = mysqli_real_escape_string($con, $_POST['aadharNum']);
        $Email = mysqli_real_escape_string($con, $_POST['Email']);
        $phone_no = mysqli_real_escape_string($con, $_POST['phone_no']);
        $voterNum = mysqli_real_escape_string($con, $_POST['voterNum']);
        $new_college_id = mysqli_real_escape_string($con, $_POST['college_id']);

        // Check if the new username already exists in the database
        $check_sql = "SELECT * FROM member_details WHERE college_id='$college_id' AND college_id != '$college_id'";
        $check_result = mysqli_query($con, $check_sql);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            echo "<script>
                    alert('Username already exists. Please choose a different username.');
                    window.history.back();
                  </script>";
            exit();
        } else {
            // SQL query to update the record
            $sql = "UPDATE member_details SET 
                    college_id='$new_college_id', 
                    phone_no ='$phone_no',
                    fullName='$fullName',
                    aadharNum='$aadharNum', 
                    voterNum='$voterNum',
                    Email='$Email' 
                    WHERE college_id='$college_id'";

            // Execute the query
            if (mysqli_query($con, $sql)) {
                // Redirect to the memberview.php page after updating
                echo "<script>
                        alert('Record updated successfully');
                        window.location.href='memberview.php';
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
    <title>Update Record</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmUpdate();">
    <h2><u>Update Record</u></h2>
        <label for="college_id">College ID:</label>
        <input type="number" id="college_id" name="college_id" value="<?php echo $row['college_id']; ?>" required><br>
        
        <label for="phone_no">Phone Number:</label>
        <input type="number" id="phone_no" name="phone_no" value="<?php echo $row['phone_no']; ?>" required><br>
        
        <label for="fullName">Name:</label>
        <input type="text" id="fullName" name="fullName" value="<?php echo $row['fullName']; ?>" required><br>
        
        <label for="aadharNum">Aadhar Number:</label>
        <input type="text" id="aadharNum" name="aadharNum" value="<?php echo $row['aadharNum']; ?>" required><br>
        
        <label for="voterNum">Voter Number:</label>
        <input type="text" id="voterNum" name="voterNum" value="<?php echo $row['voterNum']; ?>" required><br>

        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" value="<?php echo $row['Email']; ?>" required><br>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>

