<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');

/*insert*/
if (isset($_POST['save_data'])) {
    
    $driver_name= $_POST['driver_name'];
    $license_number = $_POST['license_number'];
    $driver_phone = $_POST['driver_phone'];
    $date_of_joining = $_POST['date_of_joining'];
    $driver_email = $_POST['driver_email'];
    $driver_availablity = $_POST['driver_availablity'];

    $query = "INSERT INTO `driverdetails` (`driver_name`, `license_number`, `driver_phone`, `driver_email`, `driver_availablity`) 
          VALUES ('$driver_name', '$license_number', '$driver_phone', '$driver_email', '$driver_availablity')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success'] = "Driver Added";
        header('Location: Driver.php');
    } else {
        $_SESSION['status'] = "Driver Not Added";
        header('Location: Driver.php');
    }
}   



/*View*/
if (isset($_POST['click_view_btn'])) {
    $driver_id = $_POST['driver_id'];
    $query = "SELECT * FROM driverdetails WHERE driver_id = '$driver_id'";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            ?>
                <h6>Driver ID: <?php echo $row['driver_id']; ?></h6>
             <h6>Driver Name: <?php echo $row['driver_name']; ?></h6>
             <h6>License Number: <?php echo $row['license_number']; ?></h6>
                <h6>Phone Number: <?php echo $row['driver_phone']; ?></h6>
                <h6>Date of Joining: <?php echo $row['date_of_joining']; ?></h6>
                <h6>Driver Email: <?php echo $row['driver_email']; ?></h6>
                <h6>Driver Availablity: <?php echo $row['driver_availablity']; ?></h6>

            <?php
        }
    } else {
        echo "No Record Found";
    }
    exit();
}

/*Edit*/
if (isset($_POST['click_edit_btn'])) {
    $driver_id = $_POST['driver_id'];
    $arrayresult=[];
    $query = "SELECT * FROM driverdetails WHERE driver_id = '$driver_id'";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
       while($row = mysqli_fetch_array($query_run)){
           array_push($arrayresult,$row);
           header('Content-type: application/json');
              echo json_encode($arrayresult);
        }
    } else {
        echo "No Record Found";
    }
    exit();
}

/*Update*/
if (isset($_POST['update_data'])) {
    $driver_id = $_POST['driver_id'];
    $driver_name= $_POST['driver_name'];
    $license_number = $_POST['license_number'];
    $driver_phone = $_POST['driver_phone'];
    $driver_email = $_POST['driver_email'];
    $driver_availablity = $_POST['driver_availablity'];



    $query = "UPDATE driverdetails SET 
            driver_name='$driver_name', 
            license_number='$license_number', 
            driver_phone='$driver_phone', 
            driver_email='$driver_email', 
            driver_availablity='$driver_availablity' 
          WHERE driver_id='$driver_id'";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success'] = "Driver Updated";
        header('Location: Driver.php');
    } else {
        $_SESSION['status'] = "Driver Not Updated";
        header('Location: Driver.php');
    }
}

/*Delete*/
if (isset($_POST['click_delete_btn'])) {
  $driver_id = $_POST['driver_id'];

    $query = "DELETE FROM driverdetails WHERE driver_id='$driver_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success'] = "Driver Deleted";
        header('Location: Driver.php');
    } else {
        $_SESSION['status'] = "driver Not Deleted";
        header('Location: Driver.php');
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
        

        <!--Insert Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Driver</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="POST">
      <div class="modal-body ">
        <div class="form-group mb-3">
            <label for="">Driver Name</label>
            <input type="text" class="form-control" name="driver_name" placeholder="Enter Driver Name">
        </div>
        <div class="form-group mb-3">
        <label for="">License Number</label>
            <input type="text" class="form-control" name="license_number" placeholder="Enter License Number">
        </div>
        <div class="form-group mb-3">
        <label for=""> Phone Number</label>
            <input type="text" class="form-control" name="driver_phone"  placeholder="Enter Phone Number">
        </div>
        <div class="form-group mb-3">
        <label for=""> Email</label>
            <input type="text" class="form-control" name="driver_email"  placeholder="Enter Email">
        </div>
        <div class="form-group mb-3">
                <label for="driver_availability">Availability</label>
                <select class="form-control" id="driver_availability" name="driver_availability">
                    <option value="available">Available</option>
                    <option value="not_available">Not Available</option>
                </select>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="save_data" class="btn btn-primary">Save</button>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewusermodel" tabindex="-1" aria-labelledby="viewusermodel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">View Driver Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="view_user_data">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editusermodal" tabindex="-1" aria-labelledby="editusermodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Driver Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <input type="hidden" class="form-control" id='driver_id' name="driver_id">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Driver Name</label>
                        <input type="text" class="form-control" id='driver_name' name="driver_name" placeholder="Enter Driver Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Bus Number</label>
                        <input type="text" class="form-control" id='license_number' name="license_number" placeholder="Enter License Number">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Bus capacity</label>
                        <input type="text" class="form-control" id='driver_phone' name="driver_phone"  placeholder="Enter Phone number">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="text" class="form-control" id='driver_email' name="driver_email"  placeholder="Enter Email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="driver_availability">Availability</label>
                        <select class="form-control" id="driver_availability" name="driver_availability">
                            <option value="available">Available</option>
                            <option value="not_available">Not Available</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_data" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>




      
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Drivers</h4>
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Drivers
                            </button>
                    </div>
                    <div class="card-body">
                    <table class="table table-scripted table-bordered">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Driver Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Email</th>
                      
                                        <th scope="col">View</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM driverdetails";
                                            $query_run = mysqli_query($con, $query);
                                            $i = 1;
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $row) {
                                                    ?>
                                                    <tr>
                                                        <td class="driver_id"><?php echo $row['driver_id']; ?></td>
                                                        <td> <?php echo $row['driver_name']; ?></td>
                                                        <td ><?php echo $row['driver_phone']; ?></td>
                                                        <td><?php echo $row['driver_email']; ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-info btn-sm view_data">View</a>
                                                        </td>
                                                        <td>
                                                            <a href="#" class="btn btn-success btn-sm edit_data">Edit</a>
                                                        </td>
                                                        <td>
                                                            <a href="#" class="btn btn-danger btn-sm delete_btn">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo "No Record Found";
                                            }
                                      ?>
                                    </tbody>
                                    </table>
                    </div>
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


    <script>
        /* View Data */
    $(document).ready(function(){
        $('.view_data').click(function(e){
            e.preventDefault();
             var driver_id = $(this).closest('tr').find('.driver_id').text();
             console.log(driver_id);
            $.ajax({
                url: 'Driver.php',
                method: 'post',
                data: {
                    ' click_view_btn': true,
                    'driver_id': driver_id,
                },
                success: function(response){
                //    console.log(response)
                   $('.view_user_data').html(response)
                   $('#viewusermodel').modal('show');
                }
            });
            });
    });

        /* Edit Data */ 
    $(document).ready(function(){
        $('.edit_data').click(function(e){
            e.preventDefault();
             var driver_id = $(this).closest('tr').find('.driver_id').text();
             console.log(driver_id);
            $.ajax({
                url: 'Driver.php',
                method: 'post',
                data: {
                    'click_edit_btn': true,
                    'driver_id': driver_id,
                },
                success: function(response){
              
                    $.each(response, function(key, value){
                          $('#driver_id').val(value['driver_id']);
                       $('#driver_name').val(value['driver_name']);
                       $('#license_number').val(value['license_number']);
                       $('#driver_email').val(value['driver_email']);
                        $('#driver_phone').val(value['driver_phone']);
                        $('#driver_availablity').val(value['driver_availablity']);

                    });
                   
                   $('#editusermodal').modal('show');
                }
            });
            });
    });

    /* Delete Data */
    $(document).ready(function(){
        $('.delete_btn').click(function(e){
            e.preventDefault();
            var driver_id = $(this).closest('tr').find('.driver_id').text();
            console.log(driver_id);
            var deletebus = confirm('Are you sure you want to delete this Driver?');
            if(deletebus){
                $.ajax({
                    url: 'Driver.php',
                    method: 'post',
                    data: {
                        'click_delete_btn': true,
                        'driver_id': driver_id,
                    },
                    success: function(response){
                        // alert(response);
                        location.reload();
                    }
                });
            }else{
                alert('Driver Not Deleted');
            }
        });
    });
    </script>


