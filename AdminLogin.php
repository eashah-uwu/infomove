
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

 
  <?php require ('usernavbar.php') ?>
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
            <form action="adminlogincode.php" method="post"> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <!-- Update input field name from 'username' to 'email' -->
                  <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <br>
                
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <!-- Ensure the password input field name remains 'password' -->
                  <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <br> 
                
                <div class="input-group d-flex justify-content-center">
                  <button type="submit" name="submit" class="btn btn-success">Log in</button>
                </div>
              </form>  
              <br> 
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