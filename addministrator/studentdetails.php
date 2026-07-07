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
            padding: 5px;
            margin-right: 10px;
        }
        .search-button {
            padding: 5px 10px;
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
<button class="update-button" onclick="location.href='logout1.php'">Home</button>
<button class="update-button" onclick="location.href='buttonpage.php'">Back</button>
<h1>Student Details</h1>

<!-- Search form -->
<div class="search-form">
    <form method="POST" action="">
        <input type="text" name="search_college_id" class="search-input" placeholder="Enter College ID">
        <input type="submit" name="search" value="Search" class="search-button">
    </form>
</div>

<!-- Creating a table to display data -->
<table>
    <tr>
        <!-- Table headers -->
        <th>College ID</th>
        <th>Aadhaar No</th>
        <th>Update Data</th>
        <th>Delete Data</th>
    </tr>
    <?php
    // Initialize the SQL query
    $sql = "SELECT college_id, aadher_no FROM student_info";
    
    // Check if the search form was submitted
    if (isset($_POST['search']) && !empty($_POST['search_college_id'])) {
        $search_college_id = $_POST['search_college_id'];
        // Modify the SQL query to include the search condition
        $sql .= " WHERE college_id = '$search_college_id'";
    }

    // Executing the query
    $result = $con->query($sql);

    // Checking if there are rows returned from the query
    if ($result && $result->num_rows > 0) {
        // Looping through each row of the result set
        while ($row = $result->fetch_assoc()) {
            // Outputting each row as a table row in HTML
            echo "<tr>";
            echo "<td>" . $row['college_id'] . "</td>";
            echo "<td>" . $row['aadher_no'] . "</td>";
            echo "<td>";
            echo "<button class='update-button' onclick=\"window.location.href='studentupdate.php?id=" . $row['college_id'] . "'\">Update</button><td>";
            echo "<button class='delete-button' onclick=\"window.location.href='studentdelete.php?id=" . $row['college_id'] . "'\">Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        // Outputting a message if no results are found
        echo "<tr><td colspan='4'>No results found</td></tr>";
    }
    ?>
</table>

</body>
</html>
