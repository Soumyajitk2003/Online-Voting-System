<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Buttons</title>
    <link rel="stylesheet" href="style4.css"> <!-- Linking to an external CSS file -->

    <!-- JavaScript function to disable right-click -->
    <script language="javascript">
        function noClick()
        {
            if(event.button==2)
            {
                alert("This function is not work!!") // Alerting when right-click is detected
            }
        }
        document.onmousedown=noClick; // Assigning the function to the mousedown event
    </script>
</head>
<body>
    <div class="button-container">
        <!-- Buttons with images linked to party photos -->
        <br><button onclick="location.href='party1.jpg';"><img src="skpic.png" alt="Photo 1"></button>
        <button onclick="location.href='party2.jpg';"><img src="rmpic.png" alt="Photo 2"></button>
        <button onclick="location.href='party3.jpg';"><img src="tdmpic.png" alt="Photo 3"></button>
        <button onclick="location.href='party4.jpg';"><img src="abpic.png" alt="Photo 4"></button><br>
        <!-- Button to navigate to the home page -->
        <button onclick="location.href='index.php';">Home page</button>
    </div>
</body>
</html>
