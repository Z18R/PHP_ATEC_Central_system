<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/LOGO.png" type="image/png">
    <title>SIGNIN FORM</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <style>
    .button {
        display: inline-block;
        padding: 3px 15px;
        background-color: #f0f0f0;
        color: #000000;
        text-decoration: none;
        border: 0.15em solid #000000;
        cursor: pointer;
        border-radius: 5px; /* Optional: Add rounded corners */
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

    </style>

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
        <div class="container ml-auto">
        <button type="submit" class="button">Login</button>
        <span style="margin: 0 10px;"></span> <!-- Add spacing between the buttons and link -->
        <a href="default.php" class="button">Default</a>
    </div>
        
    </form>
    </div>
    <!-- Footer -->
    <footer class="footer bg-dark text-white p-1 fixed-bottom">
        <div class="container Cfooter">
            <p>Copyright © Automated Technology (Phil.), Inc</p>
            <p>IT Development Team 2024</p>
        </div>
    </footer>



</body>
</html>
