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

  <?php require ('links.php') ?>
    

</head>
<body>

  <!--navbar background-color: #d2b48c;-->
  <header>
  <?php require ('usernavbar.php') ?>
</header>



 <main>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-inner">
  
    <div class="carousel-item">
      <img src="Images/pexels-mihis-alex-21014.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>InfoMove</h5>
        <p>The one stop for all your travelling needs</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Images/pexels-nubia-navarro-(nubikini)-385998.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item active">
      <img src="Images\pexels-photo-3064079.jpeg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class='py-4' style="font: size 20px; text-align: center; color: black;">
           
           <h1  >InfoMove</h1>
           <p>The one stop for all your travelling needs</p>
           
           <?php if(isset($_SESSION['username'])==true) { ?>
           <a class="btn btn-success" style="text-align: center" href="user/Booking.php">Book a Vehicle</a>
           
           <?php } else{  ?>
           <a class="btn btn-success" style="text-align: center" href="Login.php">Login To Book A Vehicle</a> 
           <?php } ?>
           
         </div>


<section class="my-4">
  <div class="py-3">
    <h5 class="text-center" style="font-size: 2rem;">About Us</h5>
  </div>
  <div class="container text-center border border-dark bg-light p-4" >
    <h6 style="font-size: 1.5rem;">Welcome to InfoMove - Your Ultimate Route Solution!</h6>

    <p style="font-size: 1rem;">At InfoMove, we understand that getting from point A to point B should be seamless and stress-free. That's why we are here to revolutionize your travel experience. As a leading route-providing company, InfoMove is committed to offering you efficient and reliable transportation solutions tailored to your needs.</p>
  </div>
</section>
</main>

  <!--bootstrap js link-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
 crossorigin="anonymous"></script>

 <footer>
  <p class="text-center">&copy; 2023 InfoMove. All rights reserved.</p>
  <address class="text-center">
    Contact us at: info@infomove.com
  </address>
</footer>

</body>
</html>