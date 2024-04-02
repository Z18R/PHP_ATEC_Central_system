<?php
session_start();

$_SESSION["loggedin"] = true;

// Check if the user is not logged in or is not an admin
if (!isset($_SESSION["loggedin"])) {
    // Redirect the user to the login page or another appropriate page
    header("Location: index.php");
    exit;
}
// Include the SQL handler function
include_once 'phpCon/SqlHandler.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        // Set session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;

        // Redirect based on user's Remarks
        switch ($row['Remarks']) {
            case 'admin':
                header("Location: ../admin.php");
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
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>