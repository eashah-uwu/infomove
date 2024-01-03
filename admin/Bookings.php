<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');






/*Edit*/
if (isset($_POST['click_edit_btn'])) {
    $route_id = $_POST['route_id'];
    $arrayresult = [];
    $query = "SELECT * FROM reservations WHERE route_id = '$route_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_array($query_run)) {
            array_push($arrayresult, $row);
        }

        // Send acceptance email logic
        $user_email = $arrayresult[0]['user_email']; // Replace with the actual column name
        $subject = "Your reservation has been accepted";
        $message = "Dear user, your reservation for route " . $arrayresult[0]['route_name'] . " has been accepted.";

        $headers = "From: your-email@example.com"; // Replace with your email

        // Use the mail() function to send the email
        if (mail($user_email, $subject, $message, $headers)) {
            echo json_encode(['success' => true, 'message' => 'Acceptance email sent successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error sending acceptance email']);
        }

        header('Content-type: application/json');
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'No Record Found']);
    }
    exit();
}




/*Delete*/
if (isset($_POST['click_delete_btn'])) {
    $route_id = $_POST['route_id'];

    $query = "DELETE FROM reservations WHERE route_id='$route_id'";
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
        <h6> Confirmation Email Sent!</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                        <th scope="col">#</th>
                                        <th scope="col">Route id</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Accept</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT
                                            r.route_id,
                                            r.name,
                                            r.email,
                                            s.date
                                        FROM
                                            reservations r
                                        JOIN
                                            busschedule s ON r.route_id = s.route_id";
                                            $query_run = mysqli_query($con, $query);
                                            $i = 1;
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $row) {
                                                    ?>
                                                    <tr>
                                                        <td class="route_id"><?php echo $i++; ?></td>
                                                        <td ><?php echo $row['route_id']; ?></td>
                                                        <td ><?php echo $row['name']; ?></td>
                                                        <td> <?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['date']; ?></td>
                                                       
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
    

        /* Edit Data */ 
    $(document).ready(function(){
        $('.edit_data').click(function(e){
            e.preventDefault();
             var route_id = $(this).closest('tr').find('.route_id').text();
             console.log(route_id);
            $.ajax({
                url: 'Bookings.php',
                method: 'post',
                data: {
                    'click_edit_btn': true,
                    'route_id': route_id,
                },
                success: function(response){
              
                   
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
                alert('Bus Not Deleted');
            }
        });
    });
    </script>
