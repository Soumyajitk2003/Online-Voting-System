
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
  <title>Online Voting System</title>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
    }

    .container1 {
      text-align: center;
      background: white;
      width: 100%;
      background-image: linear-gradient(rgb(245, 177, 121),rgba(13, 237, 54, 0.585)),url(flag.jpg);
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .button-container {
      margin: 20px 0;
    }

    .button-container button,
    .update-button {
      background-color: #007BFF;
      color: white;
      border: none;
      padding: 15px 30px;
      margin: 10px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s;
    }

    .button-container button:hover,
    .update-button:hover {
      background-color: #0056b3;
    }

    .update-button {
      display: block;
      margin: 20px auto;
    }
  </style>
  <script defer src="https://kit.fontawesome.com/5780e10c9c.js" crossorigin="anonymous"></script>
  <script language="javascript">
    // JavaScript function to prevent right-clicking
    function noClick(event) {
      if (event.button == 2) {
        alert("This function does not work!!");
        return false;
      }
    }
    document.onmousedown = noClick;
  </script>
</head>

<body>
  <div class="container1">
    <div class="header1">
      <div class="button-container">
        <button onclick="location.href='result1.php'">View Result</button><br>
        <button onclick="location.href='studentdetails.php'">Student details</button><br>
        <button onclick="location.href='memberview.php'">Member view</button><br>
        <button onclick="location.href='studentview.php'">Student view</button>
      </div>
    </div>
    <button class="update-button" onclick="location.href='logout.php'">Logout</button>
  </div>
  
</body>

</html>
