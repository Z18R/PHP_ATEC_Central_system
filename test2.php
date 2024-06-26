<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    </style>
</head>
<body>

<?php

function executeSQLSelect($sql) {
    // Database connection information
    $serverName = "DESKTOP-6E9LU1F\\SQLEXPRESS"; // Server name
    $connectionOptions = array(
        "Database" => "MES_ATEC", // Database name
        "Uid" => "sa",                 // Username
        "PWD" => "18Bz23efBd0J"        // Password
    );

    // Establish the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    // Check connection
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the select query
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        // Fetch and return results
        $data = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    // Clean up statement and close connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

function executeSQLUpdate($sql) {
    // Database connection information
    $serverName = "DESKTOP-6E9LU1F\\SQLEXPRESS"; // Server name
    $connectionOptions = array(
        "Database" => "MES_ATEC", // Database name
        "Uid" => "sa",                 // Username
        "PWD" => "18Bz23efBd0J"        // Password
    );

    // Establish the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    // Check connection
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the update query
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "<div class='container'><div class='alert alert-success'>Update executed successfully</div></div>";
    }

    // Clean up statement and close connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

// Display the lot number filter form with Bootstrap styling
echo "<div class='container'>";
echo "<h2>Filter by Lot Number</h2>";
echo "<form action='' method='post'>";
echo "<div class='form-group'>";
echo "<label for='lotnumber'>Lot Number:</label>";
echo "<input type='text' class='form-control' id='lotnumber' name='lotnumber'>";
echo "</div>";
echo "<div class='form-group'>";
echo "<label for='dateformat'>Date Format (e.g., Y-m-d):</label>";
echo "<input type='text' class='form-control' id='dateformat' name='dateformat' value='Y-m-d'>";
echo "</div>";
echo "<button type='submit' class='btn btn-primary' name='submitFilter'>Filter</button>";
echo "</form>";
echo "</div>";

// Handle lot number filter submission
if (isset($_POST['submitFilter'])) {
    $lotNumberFilter = $_POST['lotnumber'];
    $dateFormat = $_POST['dateformat'];
    
    $sqlSelect = "SELECT TOP 20 lotnumber, Commitdate FROM PL_ProductionOrder WHERE customercode = 12 
    AND processtypecode = 1 AND lotnumber LIKE '%$lotNumberFilter%' order by pocode desc;";
    
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
            echo "<button type='submit' class='btn btn-primary btn-update' name='submitUpdate'>Update</button>";
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

<!-- Include jQuery UI Datepicker -->
<script>
    // Initialize Datepicker
    $(document).ready(function() {
        $("#dateformat").datepicker({
            dateFormat: 'yy-mm-dd' // Default date format
        });
    });
</script>
</body>
</html>
