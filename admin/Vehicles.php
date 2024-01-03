<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');

/*insert*/
if (isset($_POST['save_data'])) {
    
    $bus_name = $_POST['bus_name'];
    $bus_number = $_POST['bus_number'];
    $bus_capacity = $_POST['bus_capacity'];

    $query = "INSERT INTO businfo (bus_name, bus_number, capacity) VALUES ('$bus_name', '$bus_number', '$bus_capacity')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success'] = "Vehicles Added";
        header('Location: Vehicles.php');
    } else {
        $_SESSION['status'] = "Vehicles Not Added";
        header('Location: Vehicles.php');
    }
}   



/*View*/
if (isset($_POST['click_view_btn'])) {
    $bus_regno = $_POST['bus_regno'];
    $query = "SELECT * FROM businfo WHERE bus_regno = '$bus_regno'";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            ?>
                <h6>Bus Regno: <?php echo $row['bus_regno']; ?></h6>
             <h6>Bus Name: <?php echo $row['bus_name']; ?></h6>
             <h6>Bus Number: <?php echo $row['bus_number']; ?></h6>
                <h6>Bus Capacity: <?php echo $row['capacity']; ?></h6>

            <?php
        }
    } else {
        echo "No Record Found";
    }
    exit();
}

/*Edit*/
if (isset($_POST['click_edit_btn'])) {
    $bus_regno = $_POST['bus_regno'];
    $arrayresult=[];
    $query = "SELECT * FROM businfo WHERE bus_regno = '$bus_regno'";
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
    $bus_regno = $_POST['bus_regno'];
    $bus_name = $_POST['bus_name'];
    $bus_number = $_POST['bus_number'];
    $bus_capacity = $_POST['bus_capacity'];

    $query = "UPDATE businfo SET bus_name='$bus_name', bus_number='$bus_number', capacity='$bus_capacity' WHERE bus_regno='$bus_regno'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success'] = "Vehicles Updated";
        header('Location: Vehicles.php');
    } else {
        $_SESSION['status'] = "Vehicles Not Updated";
        header('Location: Vehicles.php');
    }
}

/*Delete*/
if (isset($_POST['click_delete_btn'])) {
    $bus_regno = $_POST['bus_regno'];

    $query = "DELETE FROM businfo WHERE bus_regno='$bus_regno'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success'] = "Vehicles Deleted";
        header('Location: Vehicles.php');
    } else {
        $_SESSION['status'] = "Vehicles Not Deleted";
        header('Location: Vehicles.php');
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Vehicles</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="POST">
      <div class="modal-body ">
        <div class="form-group mb-3">
            <label for="">Bus Name</label>
            <input type="text" class="form-control" name="bus_name" placeholder="Enter Bus Name">
        </div>
        <div class="form-group mb-3">
        <label for="">Bus Number</label>
            <input type="text" class="form-control" name="bus_number" placeholder="Enter Bus Number">
        </div>
        <div class="form-group mb-3">
        <label for=""> Bus capacity</label>
            <input type="text" class="form-control" name="bus_capacity"  placeholder="Enter Bus Capacity">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">View Bus Data</h1>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Vehicle</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="POST">
      <div class="modal-body ">
        <div class="form-group mb-3">
                
        <input type="hidden" class="form-control" id='bus_regno' name="bus_regno">
</div>
        <div class="form-group mb-3">
            <label for="">Bus Name</label>
            <input type="text" class="form-control" id='bus_name' name="bus_name" placeholder="Enter Bus Name">
        </div>
        <div class="form-group mb-3">
        <label for="">Bus Number</label>
            <input type="text" class="form-control" id='bus_number' name="bus_number" placeholder="Enter Bus Number">
        </div>
        <div class="form-group mb-3">
        <label for=""> Bus capacity</label>
            <input type="text" class="form-control" id='bus_capacity' name="bus_capacity"  placeholder="Enter Bus Capacity">
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
                        <h4 class="text-center">Vehicles</h4>
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Insert Vehicles
                            </button>
                    </div>
                    <div class="card-body">
                    <table class="table table-scripted table-bordered">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Bus Number</th>
                                        <th scope="col">Bus Name</th>
                                        <th scope="col">Capacity</th>
                                        <th scope="col">View</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM businfo";
                                            $query_run = mysqli_query($con, $query);
                                            $i = 1;
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $row) {
                                                    ?>
                                                    <tr>
                                                        <td class="bus_regno"><?php echo $row['bus_regno']; ?></td>
                                                        <td> <?php echo $row['bus_number']; ?></td>
                                                        <td ><?php echo $row['bus_name']; ?></td>
                                                        <td><?php echo $row['capacity']; ?></td>
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
             var bus_regno = $(this).closest('tr').find('.bus_regno').text();
             console.log(bus_regno);
            $.ajax({
                url: 'Vehicles.php',
                method: 'post',
                data: {
                    ' click_view_btn': true,
                    'bus_regno': bus_regno,
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
             var bus_regno = $(this).closest('tr').find('.bus_regno').text();
             console.log(bus_regno);
            $.ajax({
                url: 'Vehicles.php',
                method: 'post',
                data: {
                    ' click_edit_btn': true,
                    'bus_regno': bus_regno,
                },
                success: function(response){
              
                    $.each(response, function(key, value){
                          $('#bus_regno').val(value['bus_regno']);
                       $('#bus_name').val(value['bus_name']);
                       $('#bus_number').val(value['bus_number']);
                       $('#bus_capacity').val(value['capacity']);
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
            var bus_regno = $(this).closest('tr').find('.bus_regno').text();
            console.log(bus_regno);
            var deletebus = confirm('Are you sure you want to delete this bus?');
            if(deletebus){
                $.ajax({
                    url: 'Vehicles.php',
                    method: 'post',
                    data: {
                        'click_delete_btn': true,
                        'bus_regno': bus_regno,
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

