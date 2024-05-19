<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Location</title>
</head>

<body>
    
<div class="container-fluid mt-5">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>SI No</th>
                    <th>Location Name</th>
                    <th>Location Address</th>
                    <th>Location State</th>
                    <th>Location District</th>
                    <th>Location Place</th>
                    <th>Location Image</th>
                    <th>Owner Name</th>
                    <th>Owner Contact</th>
                    <th>Location Rent</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selQry = "select * from tbl_locationdetails l inner join tbl_place p on l.place_id = p.place_id inner join tbl_district d on p.district_id =d.district_id inner join tbl_state s on d.state_id = s.state_id inner join tbl_locationlender len on l.lender_id = len.lender_id ";
                //    echo $selQry = "SELECT *
                //     FROM tbl_locationdetails l
                //     INNER JOIN tbl_place p ON l.place_id = p.place_id
                //     INNER JOIN tbl_district d ON p.district_id = d.district_id
                //     INNER JOIN tbl_state s ON d.state_id = s.state_id
                //     INNER JOIN tbl_locationlender len ON l.lender_id = len.lender_id
                //     LEFT JOIN tbl_locationbooking lb ON l.location_id = lb.location_id
                //     WHERE lb.location_id IS NULL
                //     ";
                $selData = $con->query($selQry);
                while($row = $selData->fetch_assoc())
                {
                    $i++
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row["location_name"] ?></td>
                    <td><?php echo $row["location_address"] ?></td>
                    <td><?php echo $row["state_name"] ?></td>
                    <td><?php echo $row["district_name"] ?></td>
                    <td><?php echo $row["place_name"] ?></td>
                    <td><img src="../assets/files/loclender/Photo/<?php echo $row["location_image"]?>" width="100px" /></td>
                    <td><?php echo $row["lender_name"] ?></td>
                    <td><?php echo $row["lender_contact"] ?></td>
                    <td><?php echo $row["location_rent"] ?>/Day</td>
                    <td>
                        <a href="BookLocation.php?applyId=<?php echo $row["location_id"]?>" class="btn btn-primary">Apply</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
ob_flush();
include("Foot.php");

?>