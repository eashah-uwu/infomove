<?php 
   session_start();
   include('C:/xampp/htdocs/infomove/includes/connect.php');
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
        
        <?php
        
        if( $_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_POST["submit"]))
            {
                /*
                    ADDING ROUTES
                 Check if the $_POST key 'submit' exists
                */
               
                $viaCities = strtoupper($_POST["viaCities"]);
                $cost = $_POST["stepCost"];
                $deptime = $_POST["dep_time"];
                $depdate = $_POST["dep_date"];
                $busno = $_POST["busno"];
                $route_exists = exist_routes($con,$viaCities,$depdate, $deptime);
                $route_added = false;
        
                if(!$route_exists)
                {
                    // Route is unique, proceed
                    $sql = "INSERT INTO `routes` (`route_cities`,
                     `bus_no`, 
                     `route_dep_date`,
                     `route_dep_time`, `route_step_cost`, `route_created`) VALUES ('$viaCities','$busno', '$depdate','$deptime', '$cost', current_timestamp());";
                    $result = mysqli_query($conn, $sql);
                    
                    // Gives back the Auto Increment id
                    $autoInc_id = mysqli_insert_id($conn);
                    // If the id exists then, 
                    if($autoInc_id)
                    {
                        $code = rand(1,99999);
                        // Generates the unique userid
                        $route_id = "RT-".$code.$autoInc_id;
                        
                        $query = "UPDATE `routes` SET `route_id` = '$route_id' WHERE `routes`.`id` = $autoInc_id;";
                        $queryResult = mysqli_query($conn, $query);
                        if(!$queryResult)
                            echo "Not Working";
                    }
                    
                    if($result)
                    {
                        $route_added = true;
                        // The bus is now assigned, updating uses table
                        bus_assign($conn, $busno);
                    }
                }
    
                if($route_added)
                {
                    // Show success alert
                    echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successful!</strong> Route Added
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                else{
                    
                    // Show error alert
                    echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Route already exists
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
            if(isset($_POST["edit"]))
            {
                // EDIT ROUTES
                $viaCities = strtoupper($_POST["viaCities"]);
                $cost = $_POST["stepCost"];
                $id = $_POST["id"];
                $deptime = $_POST["dep_time"];
                $depdate = $_POST["dep_date"];
                $busno = $_POST["busno"];
                $oldBusNo = $_POST["old-busno"];

                $id_if_route_exists = exist_routes($conn,$viaCities,$depdate,$deptime);
           
                if(!$id_if_route_exists || $id == $id_if_route_exists)
                {
                    $updateSql = "UPDATE `routes` SET
                    `route_cities` = '$viaCities',
                    `bus_no`='$busno',
                    `route_dep_date` = '$depdate',
                    `route_dep_time` = '$deptime',
                    `route_step_cost` = '$cost' WHERE `routes`.`id` = '$id';";
            
                    $updateResult = mysqli_query($conn, $updateSql);
                    $rowsAffected = mysqli_affected_rows($conn);
                    
                    $messageStatus = "danger";
                    $messageInfo = "";
                    $messageHeading = "Error!";
    
                    if(!$rowsAffected)
                    {
                        $messageInfo = "No Edits Administered!";
                    }
    
                    elseif($updateResult)
                    {
                        // To assign the new bus, and free the old one - this should only reun when the bus no is edited.
                        if($oldBusNo != $busno)
                        {
                            bus_assign($conn,$busno);
                            bus_free($conn, $oldBusNo);
                        }
                        // Show success alert
                        $messageStatus = "success";
                        $messageHeading = "Successfull!";
                        $messageInfo = "Route details Edited";
                    }
                    else{
                        // Show error alert
                        $messageInfo = "Your request could not be processed due to technical Issues from our part. We regret the inconvenience caused";
                    }
                    
                    // MESSAGE
                    echo '<div class="my-0 alert alert-'.$messageStatus.' alert-dismissible fade show" role="alert">
                    <strong>'.$messageHeading.'</strong> '.$messageInfo.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                else 
                {
                    // If route details already exists
                    echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Route details already exists
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }

            }
            if(isset($_POST["delete"]))
            {
                // DELETE ROUTES
                $id = $_POST["id"];
                // Get the bus_no from route_id
                $busno_toFree = busno_from_routeid($conn, $id);
                // Delete the route with id => id
                $deleteSql = "DELETE FROM `routes` WHERE `routes`.`id` = $id";
                $deleteResult = mysqli_query($conn, $deleteSql);
                $rowsAffected = mysqli_affected_rows($conn);
                $messageStatus = "danger";
                $messageInfo = "";
                $messageHeading = "Error!";

                if(!$rowsAffected)
                {
                    $messageInfo = "Record Doesnt Exist";
                }

                elseif($deleteResult)
                {   
                    // echo $num;
                    // Show success alert
                    $messageStatus = "success";
                    $messageInfo = "Route Details deleted";
                    $messageHeading = "Successfull!";
                    // Free the bus assigned
                    bus_free($conn, $busno_toFree);
                }
                else{
                    // Show error alert
                    $messageInfo = "Your request could not be processed due to technical Issues from our part. We regret the inconvenience caused";
                }
                // Message
                echo '<div class="my-0 alert alert-'.$messageStatus.' alert-dismissible fade show" role="alert">
                <strong>'.$messageHeading.'</strong> '.$messageInfo.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
        ?>    





















        <!-- bootstrap js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    </body>
    </html>




