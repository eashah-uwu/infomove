<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');
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
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q = "SELECT uq.query_id, uq.user_id AS q_uid,
                            uq.subject,
                            uq.message,
                            uq.status,
                            uq.created_at,
                            u.user_id,
                            u.username,
                            u.email,
                            u.name
                     FROM user_queries uq
                     JOIN users u ON uq.user_id = u.user_id; 
                     ORDER BY 'q_uid' DESC" ?>
                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                            </tr>
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