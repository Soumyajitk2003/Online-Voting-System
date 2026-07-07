<?php
// Including the connection to the database
require('connection.php');

// Check if the connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .profile-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .update-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .update-button:hover {
            background-color: #0056b3;
        }
        h1 {
            text-align: center;
            margin-top: 0;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f8f8;
            color: #555;
            width: 30%;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        @media (max-width: 600px) {
            .header {
                flex-direction: column;
                align-items: center;
            }
            .update-button {
                width: 80%;
                padding: 10px;
                font-size: 14px;
                margin-top: 10px;
            }
            th, td {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
    <script>
        // JavaScript function to prevent right-clicking and context menu
        function disableRightClick(event) {
            if (event.button == 2) {
                alert("Right-click is disabled!");
                return false;
            }
        }
        document.onmousedown = disableRightClick;
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="rmpic.png" alt="Profile Photo" class="profile-photo">
            <button class="update-button" onclick="location.href='/voting/index.php'"><i class="fas fa-home"></i>Logout</button>
        </div>
        <h1>Member Details</h1>
        <!-- Creating a table to display data -->
        <table>
            <?php
            // Sanitizing input to prevent SQL injection
            $college_id = mysqli_real_escape_string($con, '2132042');

            // Query to select data from the database table
            $sql = "SELECT party, college_id, phone_no, fullName, aadharNum, voterNum, Email, User_Pass FROM member_details WHERE college_id='$college_id'";
            // Executing the query
            $result = $con->query($sql);

            // Checking if there are rows returned from the query
            if ($result && $result->num_rows > 0) {
                // Fetching the first row
                $row = $result->fetch_assoc();

                // Outputting each field as a row
                echo "<tr><th>College ID</th><td>" . htmlspecialchars($row['college_id']) . "</td></tr>";
                echo "<tr><th>Name</th><td>" . htmlspecialchars($row['fullName']) . "</td></tr>";
                echo "<tr><th>Party</th><td>" . htmlspecialchars($row['party']) . "</td></tr>";
                echo "<tr><th>Phone No</th><td>" . htmlspecialchars($row['phone_no']) . "</td></tr>";
                echo "<tr><th>Aadhaar No</th><td>" . htmlspecialchars($row['aadharNum']) . "</td></tr>";
                echo "<tr><th>Voter No</th><td>" . htmlspecialchars($row['voterNum']) . "</td></tr>";
                echo "<tr><th>Email</th><td>" . htmlspecialchars($row['Email']) . "</td></tr>";
                echo "<tr><th>Password</th><td>" . htmlspecialchars($row['User_Pass']) . "</td></tr>";
            } else {
                // Outputting a message if no results are found
                echo "<tr><td colspan='2'>No results found</td></tr>";
            }

            // Closing the database connection
            $con->close();
            ?>
        </table>
    </div>
</body>
</html>
