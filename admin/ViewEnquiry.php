<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');

   $q = "SELECT uq.query_id,
   u.name,
   u.email,
   uq.subject,
   uq.message,
   uq.created_at,
   uq.status
    FROM user_queries uq
    JOIN users u ON uq.user_id = u.user_id
    ORDER BY uq.query_id DESC" ;
    $data = mysqli_query($con, $q);

    if(isset($_GET['seen'])){
        $frm_data = filter_input_array(INPUT_GET);
    
        if($frm_data['seen'] == 'all'){
            // Handle 'seen' equals 'all'
        }
        else{
            $q = "UPDATE `user_queries` SET `status`='resolved' WHERE ";
            $result = mysqli_query($con, $q);
        }
    }

    if (isset($_GET['del'])) {
        $frm_data = filter_input_array(INPUT_GET);
    
        if ($frm_data['del'] == 'all') {
           
        } else {
           
            $query_id = mysqli_real_escape_string($con, $frm_data['del']);
            $q = "DELETE FROM `user_queries` WHERE `query_id` = '$query_id'";
            $result = mysqli_query($con, $q);
    
        }
    }
    
    

?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Queries</title>
        <?php require ('../links.php') ?>
    </head>



    <body class="bg-light" style="padding-top: 150px;">
        <header>
            <?php require ('adminnavbar.php') ?>
        </header>
        
        <div class='container-fluid' id='main-content'>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-10 px-4 overflow-hidden">
                    <h3 class="mb-4">User Queries</h3>
                    
                    <div class="card border-0 shadow-sm mb-4">
                    <div class = "card-body">
                      <div class="text-end mb-4">
                      <a href="?seen=all" class=></a>
                      </div>
                     <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                     <table class="table table-hover border" >
                        <thead class="sticky-top">
                            <tr class="bg-dark text-light">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $i=1;

                        while ($row = mysqli_fetch_assoc($data)) {
                            $seen='';
                            if($row['status']!='resolved'){
                                $seen = "<a href='?seen=$row[query_id]' class='btn btn-sm rounded-pill btn-primary'> Mark as read</a>";
                            }
                            $seen.="<a href='?del=$row[query_id]' class='btn btn-sm rounded-pill btn-danger mt-2'> Delete </a>";
                            echo <<< query
                            <tr>
                                <td>$i</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['subject']}</td>
                                <td>{$row['message']}</td>
                                <td>{$row['created_at']}</td>
                                <td>{$row['status']}</td>
                                <td>$seen</td>
                            </tr>
                        query;
                            $i++;
                        }
                        
                         ?>
                           
                        </tbody>
                        </table>
                     </div>
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