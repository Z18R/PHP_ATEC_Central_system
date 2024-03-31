<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign IN Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <section>
        <nav class="navbar navbar-expand-xl bg-dark navbar-dark p-4 fixed-top ">
            <span href="#" class="navbar-brand"><span>ATEC </span>CENTRAL SYSTEMS</span>
    </section>  
<!-- Details -->
<div class="container mt-5">
<form action="phpCon/formHandler.php" method="post" class="mt_form">
    <h2>Login</h2>
    <label for="username">Username or Email:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Login</button>
    <a href="default.php" class="button">Default</a>
</form>
<!-- Footer -->
<footer class="footer bg-dark text-white p-1 fixed-bottom">
    <div class="container Cfooter">
        <p>Copyright © Automated Technology (Phil.), Inc</p>
        <p>IT Development Team 2024</p>
    </div>
</footer>

</div>

</body>
</html>
