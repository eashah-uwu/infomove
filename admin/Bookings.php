<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');





/*View*/
if (isset($_POST['click_view_btn'])) {
    $route_id = $_POST['route_id'];
    $query = "SELECT * FROM reservations WHERE route_id = '$route_id'";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            ?>
                <h6>Route Id: <?php echo $row['route_id']; ?></h6>
             <h6>Email: <?php echo $row['email']; ?></h6>
             <h6>Name: <?php echo $row['name']; ?></h6>
         

            <?php
        }
    } else {
        echo "No Record Found";
    }
    exit();
}



/*Delete*/
if (isset($_POST['click_delete_btn'])) {
    $route_id = $_POST['route_id'];

    $query = "DELETE FROM reservations WHERE route_id='$route_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success'] = "Bookings Deleted";
        header('Location: Bookings.php');
    } else {
        $_SESSION['status'] = "Bookings Not Deleted";
        header('Location: Bookings.php');
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
        

      

<!-- View Modal -->
<div class="modal fade" id="viewusermodel" tabindex="-1" aria-labelledby="viewusermodel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="view_user_data">
        <h6>Confirmation Email sent to the user</h6>
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
                
        <input type="hidden" class="form-control" id='route_id' name="route_id">
</div>
        <div class="form-group mb-3">
            <label for="">Bus Name</label>
            <input type="text" class="form-control" id='email' name="email" placeholder="Enter Bus Name">
        </div>
        <div class="form-group mb-3">
        <label for="">Bus Number</label>
            <input type="text" class="form-control" id='name' name="name" placeholder="Enter Bus Number">
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
                        <h4 class="text-center">Reservations</h4>
                        
                    </div>
                    <div class="card-body">
                    <table class="table table-scripted table-bordered">
                                    <thead>
                                        <tr>
                                        <th scope="col">Route Id</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Confirm</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $query = "SELECT * FROM reservations";
                                          $query_run = mysqli_query($con, $query);
                                          
                                          if ($query_run) {
                                              if (mysqli_num_rows($query_run) > 0) {
                                                  while ($row = mysqli_fetch_assoc($query_run)) {
                                                      ?>
                                                      <tr>
                                                          <td class="route_id"><?php echo $row['route_id']; ?></td>
                                                          <td><?php echo $row['name']; ?></td>
                                                          <td><?php echo $row['email']; ?></td>
                                                          <td>
                                                              <a href="#" class="btn btn-info btn-sm view_data">Confirm</a>
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
                                          } else {
                                              echo "Query failed: " . mysqli_error($con);
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
                url: 'Bookings.php',
                method: 'post',
                data: {
                    ' click_view_btn': true,
                    'route_id': route_id,
                },
                success: function(response){
                //    console.log(response)
                //    $('.view_user_data').html(response)
                   $('#viewusermodel').modal('show');
                }
            });
            });
    });

        /* Edit Data */ 
    // $(document).ready(function(){
    //     $('.edit_data').click(function(e){
    //         e.preventDefault();
    //          var route_id = $(this).closest('tr').find('.route_id').text();
    //          console.log(route_id);
    //         $.ajax({
    //             url: 'Bookings.php',
    //             method: 'post',
    //             data: {
    //                 ' click_edit_btn': true,
    //                 'route_id': route_id,
    //             },
    //             success: function(response){
              
    //                 $.each(response, function(key, value){
    //                       $('#route_id').val(value['route_id']);
    //                    $('#email').val(value['email']);
    //                    $('#name').val(value['name']);
    //                 });
                   
    //                $('#editusermodal').modal('show');
    //             }
    //         });
    //         });
    // });

    /* Delete Data */
    $(document).ready(function(){
        $('.delete_btn').click(function(e){
            e.preventDefault();
            var route_id = $(this).closest('tr').find('.route_id').text();
            console.log(route_id);
            var deletebus = confirm('Are you sure you want to delete this bus?');
            if(deletebus){
                $.ajax({
                    url: 'Bookings.php',
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
                alert('Booking Not Deleted');
            }
        });
    });
    </script>

