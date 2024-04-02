<?php
session_start();

// Initialize $error_message variable
$error_message = "";

// Include the SQL handler function
include_once 'SqlHandler.php';

// Retrieve form data
$username = $_POST["username"];
$password = $_POST["password"];

// Prepare SQL query
$sql = "SELECT username, password, Remarks FROM users A 
        LEFT JOIN ATEC_Category B ON A.Remarks = B.TYPE 
        WHERE username = ? AND password = ?";

// Execute the SQL query
$params = array($username, $password);
$results = executeSQLQuery($sql, $params);

// Check if any rows were returned
if (!empty($results)) {
    // Retrieve the first row
    $row = $results[0];

    // Set session variables (assuming login is successful)
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;

    // Redirect based on user's Remarks
    switch ($row['Remarks']) {
        case 'admin':
            // header("Location: ../admin.php");
            echo "<script>window.location='../admin.php';</script>";
            exit;
        case 'Planning':
            header("Location: ../php_page/planning.php");
            exit;
        case 'Eng':
            header("Location: ../php_page/engineering.php");
            exit;
        case 'Tech':
            header("Location: ../php_page/Tech.php");
            exit;
        default:
            header("Location: ../default.php");
            exit;
    }
} else {
    // No rows returned, handle accordingly
    header("Location: ../index.php?error=no_rows");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- your head content -->
</head>
<body>
    <!-- your HTML content -->
    <div>
        <p><?php echo $error_message; 123 ?></p>
    </div>
</body>
</html>