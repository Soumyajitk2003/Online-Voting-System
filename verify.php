<?php
// Including the connection to the database
require("connection.php");

// Checking if email and verification code are set in the URL parameters
if (isset($_GET['email']) && isset($_GET['v_code'])) {
  // Query to select user with provided email and verification code
  $query = "SELECT * FROM `registered_users` WHERE `email`='$_GET[email]' AND `verification_code`='$_GET[v_code]'";
  // Executing the query
  $result = mysqli_query($con, $query);
  // Checking if the query was successful
  if ($result) {
    // Checking if a row with matching email and verification code exists
    if (mysqli_num_rows($result) == 1) {
      // Fetching the row as an associative array
      $result_fetch = mysqli_fetch_assoc($result);
      // Checking if the user is not already verified
      if ($result_fetch['is_verified'] == 0) {
        // Updating the user's verification status to verified
        $update = "UPDATE `registered_users` SET `is_verified`='1' WHERE `email`='$result_fetch[email]'";
        // Executing the update query
        if (mysqli_query($con, $update)) {
          // Alerting the user about successful email verification and redirecting to index.php
          echo "
            <script>
              alert('Email verification successful');
              window.location.href='index.php';
            </script>
          ";
        } else {
          // Alerting the user about query execution failure and redirecting to index.php
          echo "
            <script>
              alert('Cannot Run Query');
              window.location.href='index.php';
            </script>
          ";
        }
      } else {
        // Alerting the user that the email is already registered and redirecting to index.php
        echo "
          <script>
            alert('Email already registered');
            window.location.href='index.php';
          </script>
        ";
      }
    }
  } else {
    // Alerting the user about query execution failure and redirecting to index.php
    echo "
      <script>
        alert('Cannot Run Query');
        window.location.href='index.php';
      </script>
    ";
  }
}
?>
