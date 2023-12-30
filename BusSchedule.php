<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');
   $sql = "SELECT rd.route_name,bs.departure_time,bs.arrival_time,bs.bus_regno
           FROM
           routedetails as rd
           JOIN
        busschedule as bs ON rd.route_id = bs.route_id;";

    $res=mysqli_query($con,$sql);


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


        <div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 foo">
            <div class="page-header">
                <h1  style="text-align: center;"> Bus Schedule</h1>
            </div>

           
            <table class="table">
                <thead>
                    <th>Route Name</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Bus Registration No</th>
                </thead>
                <tbody>
                    <?php
                    if ($res->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['route_name']}</td>
                                    <td>{$row['departure_time']}</td>
                                    <td>{$row['arrival_time']}</td>
                                    <td>{$row['bus_regno']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No routes found</td></tr>";
                    }
                    $con->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>












        <!--bootstrap js link-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
 crossorigin="anonymous"></script>


</body>
</html>
