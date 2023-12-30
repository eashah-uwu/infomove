
<?php
session_start();

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <?php require ('links.php') ?>

</head>
<body style="padding-top: 150px;">

  <!--navbar background-color: #d2b48c;-->
  
  <nav class="navbar navbar-expand-lg  bg-custom-brown  fixed-top" style="background-color: #F6D6D6; padding: 0.01em;">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
      <img src="Images/logo.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">

    </a>
    <a class="navbar-brand" href="index.php">InfoMove</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="BusRoute.php"> Bus Route</a>
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

 
<br>
    <div class="container rounded border border-black py-5 px-2 bg-light" style="max-width: 500px; border-radius: 15px; "> 
     <div class="row">
       <div class="col-md-3"></div>
        <div class="col-md-6"> 


            <?php
              if(isset($_SESSION['status']))
              {
                ?>
                <div class = "alert alert-success">
                  <h5><?= $_SESSION['status'];?></h5>
              </div>
              <?php
              unset($_SESSION['status']);
              }
            ?>
       
       <div class="page-header">
                <h1 style="text-align: center;">Login</h1>      
            </div> 
            <form action="logincode.php" method="post"> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <!-- Update input field name from 'username' to 'email' -->
                  <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                </div>
                <br>
                
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <!-- Ensure the password input field name remains 'password' -->
                  <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <br> 
                
                <div class="input-group d-flex justify-content-center">
                  <button type="submit" name="submit" class="btn" style="background-color: #38419D; color: #ffffff;">Log in</button>
                  
                </div>
              </form>  
              <br> 
              <div class="input-group d-flex justify-content-center">
                  <a href="AdminLogin.php">Admin Login</a>
                  <p class="p-2"> not a user? sign up <p>
                 
              </div>
        </div> 
        <div class="col-md-3"></div>
         
     </div>
    </div> 
    



  <!--bootstrap js link-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
 crossorigin="anonymous"></script>


</body>
</html>