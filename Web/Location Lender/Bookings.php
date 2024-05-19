<?php

include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

//Updating
if(isset($_GET["acceptId"]))
{
	$update = "update tbl_locationbooking set booking_status= 1 where booking_id='".$_GET["acceptId"]."'";
	if($con->query($update))
	{
		echo "Success";
		header("location:Bookings.php");
	}
	else
	{
		echo "Failed";
	}
}

if(isset($_GET["rejId"]))
{
	$update = "update tbl_locationbooking set booking_status= 2 where booking_id='".$_GET["rejId"]."'";
	if($con->query($update))
	{
		echo "Success";
		header("location:Bookings.php");
	}
	else
	{
		echo "Failed";
	}
}

 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bookings</title>
</head>
<body>
<div class="container-fluid mt-5">
<table class="table table-bordered">
            <tr>
                <th>SI No</th>
                <th>Hirer Name</th>
                <th>Hirer Contact</th>
                <th>Location Name</th>
                <th>Address</th>
                <th>Days</th>
                <th>Rent</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            $i=0;
            $selQry = "SELECT
            lb.*,
            ld.location_name,
            ht.hiring_name,
            ht.hiring_contact,
            ht.hiring_id,
            ld.location_address,
            p.place_name,
            d.district_name,
            s.state_name,
            ld.location_rent,
            DATEDIFF(CURDATE(), STR_TO_DATE(lb.booking_startdate, '%Y-%m-%d')) + 1 AS num_days,
            (ld.location_rent * (DATEDIFF(CURDATE(), STR_TO_DATE(lb.booking_startdate, '%Y-%m-%d')) + 1)) AS total_rent
        FROM tbl_locationbooking lb
        INNER JOIN tbl_locationdetails ld ON lb.location_id = ld.location_id
        INNER JOIN tbl_locationlender lr ON ld.lender_id = lr.lender_id
        INNER JOIN tbl_place p ON ld.place_id = p.place_id
        INNER JOIN tbl_district d ON p.district_id = d.district_id
        INNER JOIN tbl_state s ON d.state_id = s.state_id
        INNER JOIN tbl_hiringteam ht ON lb.hiring_id = ht.hiring_id
         where ld.lender_id ='".$_SESSION["lid"]."'";
            $data = $con->query($selQry);
            while($row = $data->fetch_assoc())
            {
                $today = date('Y-m-d');
                $i++;
            ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row["hiring_name"] ?></td>
                <td><?php echo $row["hiring_contact"] ?></td>
                <td><?php echo $row["location_name"] ?></td>
                <td><?php echo $row["location_address"]?>, <?php echo $row["place_name"]?>, <?php echo $row["district_name"]?>, <?php echo $row["state_name"]?></td>
                <td><?php 
                if($row["num_days"]<0){
                    echo "------";
                }
                else{
                echo $row["num_days"] ;
                }
                ?>
                </td>    <!-- Day Count -->
                <td><?php if($row["total_rent"]<0){
                    echo "------";
                }
                else{
                echo $row["total_rent"] ;
                } ?></td>    <!-- Rent -->
                <td><?php
                    if($row['booking_status']==0)
                    {
                        ?>
                        <a href="Bookings.php?acceptId=<?php echo $row["booking_id"] ?>" class="btn btn-primary">Accept</a>
                        <a href="Bookings.php?rejId=<?php echo $row["booking_id"] ?>" class="btn btn-primary">Reject</a>
                    <?php
                    }
                    else if($row["booking_status"] == 1)
                    {
                        echo "Waiting for advance payment";
                    }
                    else if($row["booking_status"] == 2)
                    {
                        echo "Rejected";
                    }
                    else if($row["booking_status"] == 3 && $row["payment_status"] == 1)
                    {
                        echo "Advance Payment Completed";
                    }
                    else if($row["booking_status"] == 4)
                    {
                        echo "Project Finished";
                    }
                    else if($row["booking_status"] == 6)
                    {
                        echo "Project Finished";
                    }
                ?>
                </td>
                <td>
                    <?php 
                    if($row["booking_status"] == 1)
                    {
                        echo "Waiting for payment";
                        ?>
                     
                        <?php
                    }
                    else if($row["booking_status"] == 3 && $row["payment_status"] == 1 && $today >= $row["booking_startdate"])
                    {
                        echo "Waiting for final payment";
                        ?>
                
                        <?php
                    }
                    else if($row["booking_status"] == 4 && $row["payment_status"] == 1){
                        // Add your action for completed projects
                    }
                    else if($row["booking_status"] == 4 && $row["payment_status"] == 2){
                        // Add your action for projects with payment issues
                    }
                    else if($row["booking_status"] == 5 && $row["payment_status"] == 2){
                        // Add your action for projects with payment issues
                        echo "Work Finished";
                    }
                    else if($row["booking_status"] == 6 && $row["payment_status"] == 2){
                        // Add your action for projects with payment issues
                       ?>
                        
                       <?php
                    }
                    if($row["payment_status"] == 1 || $row["payment_status"] == 2){
                        ?>
                        <a href="Complaint.php?complaintId=<?php echo $row["hiring_id"] ?>" class="btn btn-primary">Complaint</a>
                       <?php
                    }
                    ?>
                </td>

            </tr>



<?php } ?>
        </table>
        <a href="./Feedback.php" class="btn btn-primary">Feedback</a>
    </div>
</body>
</html>


<?php
	 ob_flush();
	 include("Foot.php");
	 
	 ?>