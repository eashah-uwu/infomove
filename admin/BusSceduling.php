<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');

/*insert*/
if (isset($_POST['save_data'])) {
    
    $route_name = $_POST['route_name'];
    $departure_time = $_POST['departure_time'];
    $destination = $_POST['destination'];

    $query = "INSERT INTO busschedule (route_name, departure_time, destination) VALUES ('$route_name', '$departure_time', '$destination')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success'] = "Route Added";
        header('Location: Route.php');
    } else {
        $_SESSION['status'] = "Route Not Added";
        header('Location: Route.php');
    }
}   



/*View*/
if (isset($_POST['click_view_btn'])) {
    $route_id = $_POST['route_id'];
    $query = "SELECT * FROM busschedule WHERE route_id = '$route_id'";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            ?>
                <h6>Route Id: <?php echo $row['route_id']; ?></h6>
             <h6>Route Name: <?php echo $row['route_name']; ?></h6>
             <h6>departure_time: <?php echo $row['departure_time']; ?></h6>
                <h6>destination: <?php echo $row['destination']; ?></h6>

            <?php
        }
    } else {
        echo "No Record Found";
    }
    exit();
}

/*Edit*/
if (isset($_POST['click_edit_btn'])) {
    $route_id = $_POST['route_id'];
    $arrayresult=[];
    $query = "SELECT * FROM busschedule WHERE route_id = '$route_id'";
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
    $route_id = $_POST['route_id'];
    $route_name = $_POST['route_name'];
    $departure_time = $_POST['departure_time'];
    $destination = $_POST['destination'];

    $query = "UPDATE busschedule SET route_name='$route_name', departure_time='$departure_time', destination='$destination' WHERE route_id='$route_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success'] = "Route Updated";
        header('Location: Route.php');
    } else {
        $_SESSION['status'] = "Route Not Updated";
        header('Location: Route.php');
    }
}

/*Delete*/
if (isset($_POST['click_delete_btn'])) {
    $route_id = $_POST['route_id'];

    $query = "DELETE FROM busschedule WHERE route_id='$route_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success'] = "Route Deleted";
        header('Location: Route.php');
    } else {
        $_SESSION['status'] = "Route Not Deleted";
        header('Location: Route.php');
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Route</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="POST">
      <div class="modal-body ">
        <div class="form-group mb-3">
            <label for="">Route Name</label>
            <input type="text" class="form-control" name="route_name" placeholder="Enter Route Name">
        </div>
        <div class="form-group mb-3">
        <label for="">departure_time</label>
            <input type="text" class="form-control" name="departure_time" placeholder="Enter Starting Point">
        </div>
        <div class="form-group mb-3">
        <label for="">destination</label>
            <input type="text" class="form-control" name="destination"  placeholder="Enter destination">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">View Roure Data</h1>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Route</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="POST">
      <div class="modal-body ">
        <div class="form-group mb-3">
                
        <input type="hidden" class="form-control" id='route_id' name="route_id">
</div>
        <div class="form-group mb-3">
            <label for="">Route Name</label>
            <input type="text" class="form-control" id='route_name' name="route_name" placeholder="Enter Route Name">
        </div>
        <div class="form-group mb-3">
        <label for="">Bus Number</label>
            <input type="text" class="form-control" id='departure_time' name="departure_time" placeholder="Enter departure_time">
        </div>
        <div class="form-group mb-3">
        <label for=""> Bus destination</label>
            <input type="text" class="form-control" id='destination' name="destination"  placeholder="Enter destination">
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
                        <h4 class="text-center">Route</h4>
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Set Schedule
                            </button>
                    </div>
                    <div class="card-body">
                    <table class="table table-scripted table-bordered">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Route Name</th>
                                        <th scope="col">Departure Time</th>
                                        <th scope="col">Arrival Time</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT
                                            r.route_name,
                                            r.route_id,
                                            s.departure_time,
                                            s.arrival_time
                                        FROM
                                            routedetails r
                                        JOIN
                                            busschedule s ON r.route_id = s.route_id";
                                            $query_run = mysqli_query($con, $query);
                                            $i = 1;
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $row) {
                                                    ?>
                                                    <tr>
                                                        <td class="route_id"><?php echo $row['route_id']; ?></td>
                                                        <td ><?php echo $row['route_name']; ?></td>
                                                        <td> <?php echo $row['departure_time']; ?></td>
                                                        <td><?php echo $row['arrival_time']; ?></td>
                                                       
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
             var route_id = $(this).closest('tr').find('.route_id').text();
             console.log(route_id);
            $.ajax({
                url: 'Route.php',
                method: 'post',
                data: {
                    ' click_view_btn': true,
                    'route_id': route_id,
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
             var route_id = $(this).closest('tr').find('.route_id').text();
             console.log(route_id);
            $.ajax({
                url: 'Route.php',
                method: 'post',
                data: {
                    ' click_edit_btn': true,
                    'route_id': route_id,
                },
                success: function(response){
              
                    $.each(response, function(key, value){
                          $('#route_id').val(value['route_id']);
                       $('#route_name').val(value['route_name']);
                       $('#departure_time').val(value['departure_time']);
                       $('#destination').val(value['destination']);
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
            var route_id = $(this).closest('tr').find('.route_id').text();
            console.log(route_id);
            var deletebus = confirm('Are you sure you want to delete this bus?');
            if(deletebus){
                $.ajax({
                    url: 'Route.php',
                    method: 'post',
                    data: {
                        'click_delete_btn': true,
                        'route_id': route_id,
                    },
                    success: function(response){
                        // alert(response);
                        location.reload();
                    }
                });
            }else{
                alert('Bus Not Deleted');
            }
        });
    });
    </script>




