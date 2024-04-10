<?php
session_start();
?>
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
        /* additional css for new LOGIN */
    body {
        
        background-color: #f8f9fa;
        
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
            border: 1px solid #ccc;
            padding: 30px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-form button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #0a244d;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        .login-form button[type="submit"]:hover {
            background-color: #fe5800;
        }
        .login-form .signup-link {
            text-align: center;
        }
        .login-form .signup-link a {
            color: #007bff;
        }
        /* additional css for new LOGIN */
        
    span {
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
    footer p {
   margin: 0 auto;
    color: #1E90FF;
    width: 100%;
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
    <!-- Navbar -->
    <section>
        <nav class="navbar navbar-expand-xl bg-dark navbar-dark p-4 fixed-top ">
            <span href="#" class="navbar-brand"><span>ATEC </span>CENTRAL SYSTEMS</span>
    </section> 
    
    <!-- add the whole code -->
        <div class="container login-container">
        <div class="card mt-3">
            <div class="card-body">
                <form action="phpCon/formHandler.php" method="post" class="login-form">
                    <h2 class="card-title"><strong>Login</strong></h2>
                    <div class="form-group">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn button">Login</button>
                    <div class="signup-link">
                        <a href="default.php" class="defaultCss">Default</a>
                    </div>
                </form>
    <!-- add the whole code -->

            <div class="p-2">
                <?php
                // Check if the error parameter is set in the URL
                if(isset($_GET['error'])) {
                    $error = $_GET['error'];

                    switch($error) {
                        case 'no_rows':
                            $error_message = "Please check your credentials.";
                            break;
                        
                        default:
                            $error_message = "An unknown error occurred.";
                            break;
                    }
                } else {
                    $error_message = "";
                }
                ?>
                <div>
                    <p><?php echo $error_message; ?></p>
                </div>
            </div>
        </div>
    </div>
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
