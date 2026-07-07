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
            background-color: rgb(179, 126, 29);;
        }
    </style>
    <script language="javascript">
        // JavaScript function to prevent right-clicking
        function noClick(event) {
            if (event.button == 2) {
                alert("This function is not work!!");
                return false;
            }
        }
        document.onmousedown = noClick;
    </script>
</head>
<body>
<button class="update-button" onclick="location.href='logout.php'">Home</button>
<button class="update-button" onclick="location.href='buttonpage.php'">Back</button>
    <h1>Member Details</h1>

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
            <th>Party</th>
            <th>College ID</th>
            <th>Phone No</th>
            <th>Name</th>
            <th>Aadhaar No</th>
            <th>Voter No</th>
            <th>Email</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        // Initialize the SQL query
        $sql = "SELECT party, college_id, phone_no, fullName, aadharNum, voterNum, Email FROM member_details";

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
                echo "<td>" . $row['party'] . "</td>";
                echo "<td>" . $row['college_id'] . "</td>";
                echo "<td>" . $row['phone_no'] . "</td>";
                echo "<td>" . $row['fullName'] . "</td>";
                echo "<td>" . $row['aadharNum'] . "</td>";
                echo "<td>" . $row['voterNum'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>";
                echo "<button class='update-button' onclick=\"window.location.href='memupdate.php?id=" . $row['college_id'] . "'\">Update</button></td>";
                echo "<td>";
                echo "<button class='delete-button' onclick=\"window.location.href='memdelet.php?id=" . $row['college_id'] . "'\">Delete</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            // Outputting a message if no results are found
            echo "<tr><td colspan='9'>No results found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
