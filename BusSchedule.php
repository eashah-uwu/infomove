<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');
   $sql = "SELECT rd.route_name,bs.departure_time,bs.arrival_time,rd.route_id,bs.date
           FROM
           routedetails as rd
           JOIN
        busschedule as bs ON rd.route_id = bs.route_id;";

    $res=mysqli_query($con,$sql);

    function getRoutePath($id)
{
    global $con;  

    $sql = "SELECT * FROM routedetails WHERE route_id = '$id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['source'] . " to " . $row['destination'];
    } else {
       
        return "Error retrieving route information";
    }
}



if (isset($_GET['seen'])) {
   
    $route_id = $_GET['seen'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];


    $sql = "INSERT INTO reservations ( route_id, email, name) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);

  
    mysqli_stmt_bind_param($stmt, "iss", $route_id, $email, $username);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Your seat reservation request has been sent. The admin will review it shortly.";
        header("Location: BusSchedule.php");
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
} else {
   
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


        <div class="container" >
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 foo">
            <div class="page-header" >
                <h1  style="text-align: center;"> Bus Schedule</h1>
            </div>

           
            <table class="table" >
                <thead>
                    <th>Route Name</th>
                    <th>Route</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Date</th>
                    <th>Reserve</th>
                </thead>
                <tbody>
                    <?php
                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                            $seen = "<a href='?seen={$row['route_id']}' class='btn btn-sm rounded-pill btn-primary'>Reserve a seat</a>";
                            echo "<tr>
                                    <td>{$row['route_name']}</td>
                                    <td>" . getRoutePath($row['route_id']) . "</td>
                                    <td>{$row['departure_time']}</td>
                                    <td>{$row['arrival_time']}</td>
                                    <td>{$row['date']}</td>
                                    <td>$seen</td>
                                  </tr>";
                            
                        }
                    } else {
                        echo "<tr><td colspan='6'>No routes found</td></tr>";
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
