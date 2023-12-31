<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');


   if (isset($_POST['send'])) {
    $user_id = $_SESSION['user_id']; 
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $q = "INSERT INTO `user_queries` (`user_id`, `subject`, `message` ) VALUES ('$user_id' ,' $subject' ,' $message')";
    $query_run = mysqli_query($con, $q);


}


?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>InfoMove</title>
        <?php require ('links.php') ?>

        
  
    </head>

    <body style="padding-top: 150px;">
        <header>
        <?php require ('usernavbar.php') ?>
        </header>

        <div class = "px-4">
            <h2 class="fw-bold h-font text-center"> Share Your Enquiries</h2>
            <div class = "h-line bg-dark" style="width: 45px;  margin:0 auto;  height: 1.7px;"></div>
            <p class="text-center mt-3">We are here to help you. Please share your queries with us.</p>
        </div>

        <div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4">
                <iframe class="w-100 rounded mb-4" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14464.013739181737!2d-71.01029974965992!3d24.999999245411473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89451ab5034cb7ab%3A0xb600ecf3df7aca4d!2sBermuda%20Triangle!5e0!3m2!1sen!2s!4v1703964127181!5m2!1sen!2s" height="320px"></iframe>
                <h5>Address</h5>
                <a href="https://maps.app.goo.gl/WCMFdVQBxbqXygfN6" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                    <i class="bi bi-geo-alt-fill"></i> InfoMove, Bermuda Triangle
                </a>
                <h5>Call Us</h5>
                <a href="tel: +91 1234567890" class="d-inline-block text-decoration-none text-dark mb-2">
                    <i class="bi bi-telephone-fill"></i> +91 1234567890
                </a>
                <h5 class="mt-2">Email</h5>
                <a href="mailto: eashaheb11@gmail.com" class="d-inline-block text-decoration-none text-dark mb-2">
                    <i class="bi bi-envelope-fill"></i> eashaheb11@gmail.com
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 px-4">
            <div class="bg-white rounded shadow p-4">
           <form  method="post" action="">
            <h5> Send a message</h5>
            
                <div class=mt-3>
                <label class="form-label">Subject</label>
            <input type="text" name="subject" required class="form-control shadow-none" placeholder="Subject" >
                </div>
                <div class=mt-3>
                <label class="form-label">message</label>
            <textarea  name="message" required class="form-control shadow-none" rows="5" style= "resize:none;" ></textarea>
                </div>
                <div class="input-group d-flex justify-content mt-4">
                  <button type="submit" name="send" class="btn" style="background-color: #38419D; color: #ffffff;">Submit</button>
                  
                </div>
        </form>
       
            </div>
        </div>
    </div>
</div>

        

        <!-- bootstrap js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    </body>
    </html>