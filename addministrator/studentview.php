<?php
// Including the connection to the database
require('connection.php');

// Check if the connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin.php");
    exit();
}

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Your protected content here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <!-- Including external stylesheet for table styling -->
    <link rel="stylesheet" href="tableStyle.css">
    <style>
        h1 {
            text-align: center;
        }
        .search-form {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-input {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .search-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #45a049;
        }
        .update-button, .delete-button {
            padding: 5px 10px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-button {
            background-color: #f44336;
        }
        .update-button:hover {
            background-color: #005f73;
        }
        .delete-button:hover {
            background-color: #d32f2f;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color:rgb(179, 126, 29);
        }
    </style>
    <script language="javascript">
        // JavaScript function to prevent right-clicking
        function noClick(event) {
            if (event.button == 2) {
                alert("Right-clicking is disabled!!");
                return false;
            }
        }
        document.onmousedown = noClick;
    </script>
</head>
<body>
<button class="update-button" onclick="location.href='logout.php'">Home</button>
<button class="update-button" onclick="location.href='buttonpage.php'">Back</button>
<h1>Student Details</h1>

<!-- Search form -->
<div class="search-form">
    <form method="POST" action="">
        <input type="text" name="search_username" class="search-input" placeholder="Enter Username">
        <input type="submit" name="search" value="Search" class="search-button">
    </form>
</div>

<!-- Creating a table to display data -->
<table>
    <tr>
        <!-- Table headers -->
        <th>Name</th>
        <th>College ID</th>
        <th>Aadhaar No</th>
        <th>Email</th>
        <th>Email verified or not</th>
        <th>Voted or not</th>
        <th>Update Data</th>
        <th>Delete Data</th>
    </tr>
    <?php
    // Initialize the SQL query
    $sql = "SELECT full_name, username, aadher, email, is_verified, voting FROM registered_users";
    
    // Check if the search form was submitted
    if (isset($_POST['search']) && !empty($_POST['search_username'])) {
        $search_username = $_POST['search_username'];
        // Modify the SQL query to include the search condition
        $sql .= " WHERE username = '$search_username'";
    }

    // Executing the query
    $result = $con->query($sql);

    // Checking if there are rows returned from the query
    if ($result && $result->num_rows > 0) {
        // Looping through each row of the result set
        while ($row = $result->fetch_assoc()) {
            // Outputting each row as a table row in HTML
            echo "<tr>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['aadher'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['is_verified'] . "</td>";
            echo "<td>" . $row['voting'] . "</td>";
            echo "<td>";
            echo "<button class='update-button' onclick=\"window.location.href='update.php?id=" . $row['username'] . "'\">Update</button></td>";
            echo "<td>";
            echo "<button class='delete-button' onclick=\"window.location.href='delete.php?id=" . $row['username'] . "'\">Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        // Outputting a message if no results are found
        echo "<tr><td colspan='8'>No results found</td></tr>";
    }
    ?>
</table>

</body>
</html>
