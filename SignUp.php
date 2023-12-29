    <?php
    session_start();
    include('C:/xampp/htdocs/infomove/includes/connect.php');
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>InfoMove</title>

        <!-- bootsrap CSS link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
        crossorigin="anonymous">
       
        <!-- CSS link -->
        <link rel="stylesheet" href="css/styles.css">
        
        <!-- google fonts link -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

        
    <style>
        body {
            
            background-color: #f8f9fa;
            background-image: url('Images/bg.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            
            
        }

       
    </style>
    </head>

    <body style="padding-top: 150px;">
        <header>
            <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #F6D6D6; padding: 0.01em; ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="Images/logo.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
                    </a>
                    <a class="navbar-brand" href="#">InfoMove</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="BusRoute.php">Bus Route</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="BusSchedule.php">Bus schedule</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="SignUp.php">Sign Up</a>
                            </li>
                            <li class="nav-item">   
                                <a class="nav-link" href="LogIn.php">Log In</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        

        <main>
        <br>
        <div class="container rounded border border-black py-5 px-2 bg-light" style="max-width: 500px; border-radius: 15px;"> 
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6"> 
                    <div class="alert">
                        <?php
                        if(isset($_SESSION['status']))
                        {
                            echo"<h4>".$_SESSION['status']."</h4>";
                            unset($_SESSION['status']);
                        }
                        ?>
                    </div>
                   <form action = "code.php" method = "POST">
                    <div class="page-header">
                        <h1 style="text-align: center;">Sign Up</h1>      
                    </div> 
                    <form class="form-horizontal animated bounce" action="" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <br>
                            <div class="input-group d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn" style="background-color: #38419D; color: #ffffff;">Sign Up</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </form>
    </main>


        <!-- bootstrap js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    </body>
    </html>
 
    

  
