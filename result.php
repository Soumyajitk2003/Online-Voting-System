<?php
// Including the connection to the database
require('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <!-- Including external stylesheet for table styling -->
    <link rel="stylesheet" href="tableStyle.css">
    <script language="javascript">
        // JavaScript function to prevent right-clicking
        function noClick()
        {
            if(event.button==2)
            {
                alert("This function is not work!!")
            }
        }
        document.onmousedown=noClick
    </script>
</head>
<body>
    <!-- Creating a table to display data -->
    <table>
        <tr>
            <!-- Table headers -->
            <th>Party</th>
            <th>Fullname</th>
            <th>Votes</th>
        </tr>
        <?php
        // Query to select data from the database table
        $sql = "SELECT party, fullname, votes FROM member_details";
        // Executing the query
        $result = $con->query($sql);

        // Checking if there are rows returned from the query
        if ($result->num_rows > 0) {
            // Looping through each row of the result set
            while ($row = $result->fetch_assoc()) {
                // Outputting each row as a table row in HTML
                echo "<tr>";
                echo "<td>" . $row['party'] . "</td>";
                echo "<td>" . $row['fullname'] . "</td>";
                echo "<td>" . $row['votes'] . "</td>";
                echo "</tr>";
            }
        } else {
            // Outputting a message if no results are found
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
