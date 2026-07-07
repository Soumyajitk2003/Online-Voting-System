<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset</title>
  <style>
  /* CSS styles for the password reset form */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    font-family: Poppins, sans-serif;
  }
  form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: hsla(66, 92%, 49%, 0.998);
    width: 350px;
    border-radius: 5px;
    padding: 20px 25px 30px 25px;
  }
  form h3 {
    margin-bottom: 15px;
    color: #30475e;
  }
  form input {
    width: 100%;
    margin-bottom: 20px;
    background-color: transparent;
    border: none;
    border-bottom: 2px solid #30475e;
    border-radius: 0;
    padding: 5px 0;
    font-weight: 550;
    font-size: 14px;
    outline: none;
  }
  form button {
    font-weight: 550;
    font-style: 15px;
    color: white;
    background-color: #30475e;
    padding: 4px 10px;
    border: none;
    outline: none;
  }
  </style>
</head>
<body>
  <?php 
  // PHP code for handling password reset
  require("connection.php");

  if(isset($_GET['email']) && isset($_GET['reset_token']))
  {
    // Check if the reset token is valid and not expired
    date_default_timezone_set('Asia/Hong_Kong');
    $date=date('Y-m-d');
    $query="SELECT * from `registered_users` WHERE `email` = '$_GET[email]' AND `resettoken`='$_GET[reset_token]' AND `resettokenexpire`='$date'";
    $result=mysqli_query($con,$query);
    if($result)
    {
      if(mysqli_num_rows($result)==1)
      {
        // Display the form to create a new password
        echo"
        <form method='POST'>
        <h3> Create New Password </h3>
        <input type='password' name='Password' placeholder='New Password' required><br>
        <button type='submit' name='updatepassword'>UPDATE</button>
        <input type='hidden' name='email' value='$_GET[email]'>
        </form>
        ";
      }
      else
      {
        // Alert if the link is invalid or expired
        echo" 
        <script>
         alert('Invalid or Expire Link?');
         window.location.href='index.php';
       </script>
       ";
      }
    } 
    else
    {
     // Alert if there is an issue with the server
     echo" 
     <script>
      alert('Server Down, try again later!');
      window.location.href='index.php';
    </script>
    ";
    }
  }
?>

<?php
  // PHP code for updating the password
  if(isset($_POST['updatepassword']))
  {
    // Hash the new password
    $pass=password_hash($_POST['Password'],PASSWORD_BCRYPT);
    // Update the password in the database
    $update="UPDATE `registered_users` SET `password`='$pass',`resettoken`=NULL,`resettokenexpire`= NULL WHERE `email`='$_POST[email]'";
    if(mysqli_query($con,$update))
    {
      // Alert if the password is updated successfully
      echo" 
      <script>
       alert('Password update successfully');
       window.location.href='index.php';
     </script>
     ";
    }
    else
    {
      // Alert if there is an issue with the server
      echo" 
      <script>
       alert('Server down try again later!');
       window.location.href='index.php';
     </script>
     ";
    }
  }
?>
</body>
</html>
