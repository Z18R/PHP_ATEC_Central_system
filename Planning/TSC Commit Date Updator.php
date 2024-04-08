<?php
session_start();

// Check if the user is not logged in or is not an admin
if (!isset($_SESSION["loggedin"])) {
    // Redirect the user to the login page or another appropriate page
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="../images/LOGO.png" type="image/png">
<link rel="stylesheet" href="styles/defaultCss.css">
    <section>
        <nav class="navbar navbar-expand-xl bg-dark navbar-dark p-2 fixed-top ">
            <span href="#" class="navbar-brand"><span>ATEC </span>CENTRAL SYSTEMS</span>
            <li class="nav-item ml-auto">
                <a class="nav-link go-back text-white" href="../">Go Back</a>
            </li>
    </section>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSC Commit Date Updator</title>
    <link rel="stylesheet" href="../styles.css">
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include jQuery UI Datepicker CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Include jQuery UI Datepicker JS -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        .update-form {
            display: flex;
            align-items: flex-end;
        }
        .update-form .form-group {
            margin-bottom: 0;
            margin-right: 10px;
        }
        .update-form .btn-update {
            margin-top: 5px;
        }
        .container {
            margin-top: 2%;
        }
        .footer {
            font-size: smaller;
            padding-top: 5px; /* Adjust the top padding as needed */
            padding-bottom: 5px; /* Adjust the bottom padding as needed */
        }
        .table-responsive{
            padding-bottom: 20px;
        }
        span{
        color: #fe5800;
        font-weight: bold;
        font-size: 30px;
        text-transform: uppercase;
        font-style: italic;
        }
    .div-container{
    font-size: 15px;
    }
 
    .button {
        display: inline-block;
        padding: 3px 15px;
        background-color: #f0f0f0;
        color: #000000;
        text-decoration: none;
        border: 0.15em solid #000000;
        cursor: pointer;
        border-radius: 5px; /* Optional: Add rounded corners */
        margin: 0 auto;
    }
    button:hover {
        background-color: #fe5800;
    }
    a.button{
        display: inline-block;
        padding: 3px 15px;
        background-color: #f0f0f0;
        color: #000000;
        text-decoration: none;
        border: 0.15em solid #000000;
        cursor: pointer;
        border-radius: 5px; /* Optional: Add rounded corners */
    }
    a.button:hover{
        background-color: #fe5800;
    }
   
.Cfooter{
    margin-left: 80%;
}

@media only screen and (max-width: 1920px) {

    body{
        margin-top: 45px ;
        padding-bottom: 3.74rem;
    }

    .AtecWebsite {
        margin: auto 50px;
    }
    .Cfooter{
        margin-left: 81%;
    }
    
}
@media only screen and (max-width: 1224px) {

    body{
        margin-top: 45px ;
        padding-bottom: 3.74rem;
    }

    .AtecWebsite {
        margin: auto 50px;
    }
  

    .Cfooter{
        margin-left: 73%;
    }
    
}

/* Responsive styles */
@media only screen and (max-width: 768px) {

    body{
        margin-top: 45px ;
        padding-bottom: 4.74rem;
    }

    .AtecWebsite {
        margin: auto 50px;
    }
  
    .navbar-brand {
        font-size: 25px;
    }
  
    span {
        font-size: 25px;
    }

    .Cfooter{
        margin-left: 63%;
    }
       
}
    </style>
</head>
<body>


<?php

require_once 'SQLhandler.php';

// Display the lot number filter form with Bootstrap styling
echo "<div class='container mt-0'>";
echo "<form action='' method='post'>";
echo "<div class='form-group'>";
echo "<label for='lotnumber'>Lot Number:</label>";
echo "<input type='text' class='form-control' id='lotnumber' name='lotnumber'>";
echo "</div>";
echo "<div class='form-group'>";
echo "<label for='dateformat'>Date Format (e.g., Y-m-d):</label>";
echo "<input type='text' class='form-control' id='dateformat' name='dateformat' value='Y-m-d'>";
echo "</div>";
echo "<button type='submit' class='btn button' name='submitFilter'>Filter</button>";
echo "<span class='ml-5'></span>";
echo "<button type='help' class='btn button' id='loadContent' name='submithelp'>Help</button>";
echo "</form>";
echo "</div>";

// Handle lot number filter submission
if (isset($_POST['submitFilter'])) {
    $lotNumberFilter = $_POST['lotnumber'];
    $dateFormat = $_POST['dateformat'];
    
    $sqlSelect = "SELECT TOP 20 lotnumber, Commitdate 
    FROM PL_ProductionOrder 
    WHERE customercode = 55 
    AND processtypecode = 1 AND lotnumber LIKE '%$lotNumberFilter%' 
    order by pocode desc;";
    
    // Execute select query
    $data = executeSQLSelect($sqlSelect);
    
    // Display results with Bootstrap table styling
    if (!empty($data)) {
        echo "<div class='container'>";
        echo "<h2>Filtered Results</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Lot Number</th>";
        echo "<th>Commit Date</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($data as $row) {
            // Convert the Commitdate to the specified format
            $formattedDate = $row['Commitdate']->format($dateFormat);

            echo "<tr>";
            echo "<td>" . $row['lotnumber'] . "</td>";
            echo "<td>" . $formattedDate . "</td>";
            echo "<td>";
            echo "<form class='update-form' action='' method='post'>";
            echo "<input type='hidden' name='lotnumber' value='" . $row['lotnumber'] . "'>";
            echo "<input type='hidden' name='dateformat' value='" . $dateFormat . "'>";
            echo "<div class='form-group'>";
            echo "<input type='text' class='form-control' id='newdate' name='newdate' placeholder='New Date'>";
            echo "</div>";
            echo "<button type='submit' class='btn button btn-update' name='submitUpdate'>Update</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<div class='container'>";
        echo "<div class='alert alert-warning'>No records found.</div>";
        echo "</div>";
    }
}

// Handle update action
if (isset($_POST['submitUpdate'])) {
    $lotNumberToUpdate = $_POST['lotnumber'];
    $newDate = $_POST['newdate'];

    // Here you need to construct the SQL update query to update the Commitdate with the new date
    // For example:
    $sqlUpdate = "UPDATE PL_ProductionOrder 
    SET Commitdate = '$newDate' 
    WHERE lotnumber = '$lotNumberToUpdate'";
    
    // Execute the update query
    executeSQLUpdate($sqlUpdate);
}
?>

<div id="ajaxContent"></div>

<!-- Include jQuery UI Datepicker -->
<script>
    
    $(document).ready(function() {
        $("#loadContent").click(function(event) {
            event.preventDefault(); // Prevent default button behavior (form submission)
            $("#ajaxContent").load("tscHelp.txt"); // Load the content from sample.txt into the element with the ID "ajaxContent"
        });
    });

    // Initialize Datepicker
    $(document).ready(function() {
        $("#dateformat").datepicker({
            dateFormat: 'yy-mm-dd' // Default date format
        });
    });

    // Confirm update before submission
    $(document).on('submit', '.update-form', function() {
        var newDate = $(this).find('#newdate').val();
        return confirm('Please Send Screen Shot first before Updating. Are you sure about updating the date to ' + newDate + '? if done please Send the SS to the IT' );
    });
</script>
<footer class="footer bg-dark text-white fixed-bottom">
    <div class="container-sm">
        <p>Copyright © Automated Technology (Phil.), Inc</p>
        <p>IT Development Team 2024</p>
    </div>
</footer>
</body>
</html>
