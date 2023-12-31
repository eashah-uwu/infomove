
     
<?php
  
  if(isset($_SESSION['username'])==false) {
      
?>  

<div class="container">
    
<nav class="navbar navbar-expand-lg  bg-custom-brown  fixed-top" style="background-color: #F6D6D6; padding: 0.01em;">
  <div class="container-fluid">
  <a class="navbar-brand" href="index.php">
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
      
           
    
     
</div>
 
     
  <?php } else { ?> 
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
                            <li class="nav-item">
                                <a class="nav-link" href="Enquiry.php">Enquiry</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Booking.php">Booking</a>
                            </li>
                           
                            
                            </ul>
                            <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                                </li>
                                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Welcome <?php echo $_SESSION['username']; ?></a></li>
                           
                            </ul>
                            
                     
                    </div>
                </div>
            </nav>
  </div>
  
  
  <?php } ?> 
  
  
  
  