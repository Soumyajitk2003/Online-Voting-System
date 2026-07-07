<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // If not logged in, redirect to login page
    header("Location: index.php");
    exit();
}

// Now you can access the user's data using $_SESSION['username']
$username = $_SESSION['username'];
?>

<!-- <?php
require ('connection.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selectedPerson'])) {
        $selectedPerson = $_POST['selectedPerson'];

        // Update the vote count for the selected person in the database
        $query = "UPDATE candidates SET votes = votes + 1 WHERE name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $selectedPerson);
        $stmt->execute();

        // Redirect to the login page after voting
        header("Location: index.php");
        exit();
    }
}
?> -->
<?php

session_unset();
session_destroy();
header("index.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>online voting system</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
         <script language="javascript">
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
    <div class="container">

        <div class="navbar">
            <div class="left" onclick="toggle()">
                <img src="eci.png" alt="voting" />
                <h3>College_id:-<?php echo $username; ?></h3>
            </div>
            <div class="right">
                <button>
                    <a href="index.php">Logout</a>
                </button>
                <button>
                    <i class="fa-regular fa-user"></i>
                </button>
            </div>
        </div>

        <div class="main">
            <form method="POST" action="votingpage.php">

                <div class="person">
                    <img src="skpic.png">
                    <h1>
                        Soumyajit
                    </h1>
                    <p><i class='bx bx-briefcase'></i> Party 1</p>
                    <input type="radio" name="person" value="Soumyajit" onclick="selectperson('Soumyajit')">

                </div>
                <div class="person">
                    <img src="rmpic.png">
                    <h1>
                        Rajib
                    </h1>
                    <p><i class='bx bx-briefcase'></i> Party 2</p>
                    <input type="radio" name="person" value="Rajib" onclick="selectperson('Rajib')">

                </div>
                <div class="person">
                    <img src="tdmpic.png">
                    <h1>
                        Thakurdas
                    </h1>
                    <p><i class='bx bx-briefcase'></i> Party 3</p>
                    <input type="radio" name="person" value="Thakurdas" onclick="selectperson('Thakurdas')">

                </div>
                <div class="person">
                    <img src="abpic.png">
                    <h1>
                        Anwesha
                    </h1>
                    <p><i class='bx bx-briefcase'></i> Party 4</p>
                    <input type="radio" name="person" value="Anwesha" onclick="selectperson('Anwesha')">
                </div>

                <input type="hidden" name="selectedPerson" id="selectedPersonInput" value="">
                <input type="hidden" name="username" value="<?php echo $username; ?>">               
                <div id="selectedPerson">Select Your Vote</div>
                <input type="submit" name="complete_vote" value="Vote Here">
            </form>

            <!-- <div class="details" id="profile">
            <img src="placeholder.jpg">
            <div>
                <h1>
                    <%=vote %>
                </h1>
                <h1 style="font-size:13px; font-style:italic; font-weight:500;">Experience: <%=exp %> yrs</h1>
            </div>
            <a href="deleteVote.jsp?id=<%=username%>"><i class='bx bx-trash'></i></a>


        </div> -->
            <h1 class="voted" id="voted">Click Vote Here Button </h1>
        </div>
    </div>

    <script>
        var person = "";
        const person_container = document.getElementById("selectedPerson");
        const hiddenInput = document.getElementById("selectedPersonInput");

        function selectperson(name) {
            const response = confirm("Are you sure to vote " + name + " ?");
            if (response === true) {
                var allRadioButtons = document.querySelectorAll('input[type="radio"]');
                allRadioButtons.forEach(function (radioButton) {
                    radioButton.checked = false;
                });

                // Check the currently clicked radio button
                var currRadio = document.querySelector('input[type="radio"][name="person"][value="' + name + '"]');
                if (currRadio) {
                    currRadio.checked = true;
                }


                if (person === name) {
                    alert(name + ' is already selected !!');
                } else {
                    person = name;
                    console.log(name);
                    person_container.innerHTML = "Selected Person: " + person;

                    // Set the value of the hidden input field
                    hiddenInput.value = person;
                }
            } else {
                var allRadioButtons = document.querySelectorAll('input[type="radio"]');
                allRadioButtons.forEach(function (radioButton) {
                    radioButton.checked = false;
                });
            }
            return person;
        }
    </script>
</body>

</html>