<?php
// $serverName = "DESKTOP-6E9LU1F\SQLEXPRESS"; //serverName\instanceName
// $connectionInfo = array( "Database"=>"Book", "UID"=>"sa", "PWD"=>"18Bz23efBd0J");
// $conn = sqlsrv_connect( $serverName, $connectionInfo);

// try {
//     if ($conn) {
//         echo "Connection established.<br />";
//     } else {
//         throw new Exception("Connection could not be established.<br />");
//     }
// } catch (Exception $e) {
//     echo $e->getMessage();
//     die(print_r(sqlsrv_errors(), true));
// }
// 

function executeSQLQuery($sql, $params = array()) {
    // Database connection options
    $serverName = "DESKTOP-6E9LU1F\\SQLEXPRESS"; // Server name
    $connectionOptions = array(
        "Database" => "CentralAccess", // Database name
        "Uid" => "sa",                 // Username
        "PWD" => "18Bz23efBd0J"        // Password
    );

    // Connect to the database
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if ($conn === false) {
        die("Connection failed: " . print_r(sqlsrv_errors(), true));
    }

    // Execute the SQL query
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die("Query failed: " . print_r(sqlsrv_errors(), true));
    }

    // Fetch and return results (if any)
    $results = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $results[] = $row;
    }

    // Free statement and close connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $results;
}
?>

