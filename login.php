<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.user-info {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 20px;
}

.user-info p {
    margin: 5px 0;
}

.user-info strong {
    color: #333;
}
</style>
</head>
<body>

<?php
// Include the SQL handler function
include_once 'phpCon/SqlHandler.php';

// Example SQL query
$sql = "SELECT TOP(50)* FROM Users order by usercode desc";

// Execute the SQL query
$results = executeSQLQuery($sql);

foreach ($results as $row) {
    echo "<div class='user-info'>";
    echo "<p><strong>User Code:</strong> " . $row['UserCode'] . "</p>";
    echo "<p><strong>Username:</strong> " . $row['Username'] . "</p>";
    echo "<p><strong>Password:</strong> " . $row['Password'] . "</p>";
    echo "<p><strong>Full Name:</strong> " . $row['FullName'] . "</p>";
    echo "<p><strong>Email Address:</strong> " . $row['EmailAddress'] . "</p>";
    echo "<p><strong>Active:</strong> " . $row['Active'] . "</p>";
    if ($row['DateRegistered'] !== null) {
        echo "<p><strong>Date Registered:</strong> " . $row['DateRegistered']->format('Y-m-d H:i:s') . "</p>";
    } else {
        echo "<p><strong>Date Registered:</strong> N/A</p>";
    }
    echo "</div>"; // Close user-info div
    echo "<hr>"; // Add a horizontal line between each user's info
}
?>
    
</body>
</html>