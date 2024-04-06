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
        echo "Update executed successfully";
    }

    // Clean up statement and close connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

// Display the lot number filter form
echo "<form action='' method='post'>";
echo "Filter by Lot Number: <input type='text' name='lotnumber'><br>";
echo "<input type='submit' name='submitFilter' value='Filter'>";
echo "</form>";

// Handle lot number filter submission
if (isset($_POST['submitFilter'])) {
    $lotNumberFilter = $_POST['lotnumber'];
    $sqlSelect = "SELECT lotnumber, Commitdate FROM PL_ProductionOrder WHERE customercode = 18 AND processtypecode = 1 AND lotnumber LIKE '%$lotNumberFilter%'";
    
    // Execute select query
    $data = executeSQLSelect($sqlSelect);
    
    // Display results
    if (!empty($data)) {
        echo "<table border='1'>
            <tr>
                <th>Lot Number</th>
                <th>Commit Date</th>
            </tr>";
        foreach ($data as $row) {
            // Convert the Commitdate to a formatted string
            $formattedDate = $row['Commitdate']->format('Y-m-d'); // Format for the date picker

            echo "<tr>
                    <td>" . $row['lotnumber'] . "</td>
                    <td>" . $formattedDate . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No records found.";
    }
}

?>
