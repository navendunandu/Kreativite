<?php 
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
$selQry = "select * from tbl_locationlender l inner join tbl_place p on p.place_id=l.place_id inner join tbl_district d on p.district_id=d.district_id inner join tbl_state s on s.state_id=d.state_id where lender_id='".$_SESSION["lid"]."'";
$data = $con->query($selQry);
$row = $data->fetch_assoc();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<div class="container mt-5">
        <table class="table table-bordered">
            <tr>
                <td>Photo:</td>
                <td><img src="../Assets/Files/Loclender/Photo/<?php echo $row["lender_photo"]?>" width="100px" /> </td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><?php echo $row["lender_name"]?></td>
            </tr>
            <tr>
                <td>Contact:</td>
                <td><?php echo $row["lender_contact"]?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $row["lender_email"]?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><?php echo $row["lender_address"]?></td>
            </tr>
            <tr>
                <td>Place:</td>
                <td><?php echo $row["place_name"]?></td>
            </tr>
            <tr>
                <td>District:</td>
                <td><?php echo $row["district_name"]?></td>
            </tr>
            <tr>
                <td>State:</td>
                <td><?php echo $row["state_name"]?></td>
            </tr>
        </table>
        <a href="Editprofile.php" class="btn btn-primary">Edit Profile</a>
    </div>
</body>
</html>


<?php
	 ob_flush();
	 include("Foot.php");
	 
	 ?>