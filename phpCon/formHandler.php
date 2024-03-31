<?php
session_start();

// Include the SQL handler function
include_once 'SqlHandler.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare SQL query to retrieve user data based on username and password
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $params = array($username, $password);

    // Execute the SQL query using the SQL handler function
    $results = executeSQLQuery($sql, $params);

    // Check if any rows were returned
    if (!empty($results)) {
        // Password is correct, set session variables and redirect
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;

        // Redirect to another page
        header("Location: ../login.php");
        exit; // Ensure script execution stops after redirect
    } else {
        // No rows returned, handle accordingly
        echo "Invalid username or password.";
    }
}
?>
