<?php
// Including the connection file
require ('connection.php');

// Checking if the form for completing the vote is submitted
if (isset($_POST['complete_vote'])) {
    // Getting data from the form
    $username = $_POST['username'];
    $person = $_POST['person'];

    // Check if the user has already voted
    $check_voted = $con->prepare("SELECT voting FROM registered_users WHERE username = ?");
    $check_voted->bind_param("s", $username);
    $check_voted->execute();
    $check_voted->bind_result($voted);
    $check_voted->fetch();
    $check_voted->close();

    // If the user has already voted, show an alert and redirect
    if ($voted == 1) {
        echo '<script>
        alert("You have already voted!");
        window.location.href = "index.php";
        </script>';
    } else {
        // If the user has not voted yet, update the database
        $query_update = $con->prepare("UPDATE registered_users SET voting = ?, party=? WHERE username = ?");
        $votingValue = 1;
        $query_update->bind_param("iss", $votingValue, $person, $username);
        $query_update->execute();
        $query_update->close();

        // Increment the vote count for the selected person
        $increment_query = $con->prepare("UPDATE member_details SET votes = votes + 1 WHERE fullname = ?");
        $increment_query->bind_param("s", $person); // Assuming person matches fullName in other_table

        // If the increment query executes successfully, show success message, otherwise show error message
        if ($increment_query->execute()) {
            echo '<script>
            alert("Voted successfully!");
            window.location.href = "index.php";
            </script>';
        } else {
            echo '<script>alert("Voting failed!");</script>';
        }
        $increment_query->close();
    }
}
?>
