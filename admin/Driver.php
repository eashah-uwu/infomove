<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');

  
    $msg= "" ;     


    if(isset($_POST['submit'])){
        $drname=$_POST['drname'];
        $drjoin=$_POST['drjoin'];
        $drmobile=$_POST['drmobile'];
        $drlicense=$_POST['drlicense'];
        $drlicensevalid=$_POST['drlicensevalid'];
        $draddress=$_POST['draddress'];
      
        INSERT INTO `driverdetails`(`driver_id`, `driver_name`, `license_number`, `driver_phone`, `date_of_joining`, `bus_regno`) 
        
    
        $res=false;
        $insert_query="INSERT INTO `driverdetails`(`driver_name`, `license_number,`driver_phone`, `date_of_joining`, `bus_regno`)  VALUES ('$drname','$drmobile','$drlicense','$drlicensevalid','$draddress')";
        
        $res= mysqli_query($con, $insert_query);
            
        if($res==true){
            $msg= "<script language='javascript'>
                                       swal(
                                            'Success!',
                                            'Registration Completed!',
                                            'success'
                                            );
				          </script>";
        }
        else{
            die('unsuccessful' .mysqli_error($connection));
        }
        
        
    }

    
        
       
    
?>





<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>InfoMove</title>
        <?php require ('../links.php') ?>

  
    </head>

    <body style="padding-top: 150px;">
        <header>
            <?php require ('adminnavbar.php') ?>
        </header>
        

        <div class="container"> 
     <div class="row">
       
        <div class="page-header">
            <h1 style="text-align: center;">New Driver Form</h1>
            <?php echo $msg; ?>
                              
                  
      
      </div> 
       <div class="col-md-3">
         
       </div>
        <div class="col-md-6 animated bounceIn"> 
          
           
            
                <br>
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" >
                
                <div class="input-group">
                  <span class="input-group-addon"><b>Driver Name</b></span>
                  <input id="drname" type="text" class="form-control" name="drname" placeholder="Name">
                </div>
                <br> 
                
                 <div class="input-group">
                  <span class="input-group-addon"><b>Mobile</b></span>
                  <input id="drmobile" type="text" class="form-control" name="drmobile" placeholder="Mobile No">
                </div>
                <br> 
                
                <div class="input-group">
                  <span class="input-group-addon"><b>Driver Joining Date</b></span>
                  <input id="drjoin" type="text" class="form-control" name="drjoin" placeholder="Joining date">
                </div>
                <br>
                
              
                
                 <script>
                      $( function() {
                        $( "#drjoin" ).datepicker();
                      } );
                </script> 
                
                 <div class="input-group">
                  <span class="input-group-addon"><b>National ID</b></span>
                  <input id="drnid" type="text" class="form-control" name="drnid" placeholder="Nid No">
                </div>
                <br> 
                
                <div class="input-group">
                  <span class="input-group-addon"><b>License No</b></span>
                  <input id="drlicense" type="text" class="form-control" name="drlicense" placeholder="License No">
                </div>
                <br>
                
                 <div class="input-group">
                  <span class="input-group-addon"><b>License End Date</b></span>
                  <input id="drlicensevalid" type="text" class="form-control" name="drlicensevalid" placeholder="Validity date">
                </div>
                <br>
                
              
                
                 <script>
                      $( function() {
                        $( "#drlicensevalid" ).datepicker();
                      } );
                </script> 
                
                
                <br>
                
                 <div class="input-group">
                  <span class="input-group-addon"><b>Driver Address</b></span>
                     <textarea rows="5" id="draddress" type="text" class="form-control" name="draddress" placeholder="Address"> </textarea>
                  
                </div>
                <br>
                
                
                
                 
                
                <div class="input-group">
                  <input type="submit" name="submit" class="btn btn-success">
                  
                </div>
              </form>   
        </div>  
        <div class="col-md-3"></div>
         
     </div>
         
   
    </div> 
    









        <!-- bootstrap js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    </body>
    </html>