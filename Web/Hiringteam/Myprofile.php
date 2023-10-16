<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

$selQuery = "select * from tbl_hiringteam h inner join tbl_place p on p.place_id = h.place_id inner join tbl_district d on d.district_id=p.district_id inner join tbl_state s on s.state_id=d.state_id where hiring_id='".$_SESSION["hid"]."'";
$hiringData = $con->query($selQuery);
$row = $hiringData->fetch_assoc();


 ?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
    
<div class="container mt-5">
        <table class="table">
            <tr>
                <td>Photo</td>
                <td>
                    <img src="../Assets/Files/Hiringteam/Photo/<?php echo $row["hiring_photo"] ?>" width="100px" name="hirer-photo" id="hirer-photo" class="img-fluid">
                </td>
            </tr>

            <tr>
                <td>Name:</td>
                <td><?php echo $row["hiring_name"] ?></td>
            </tr>

            <tr>
                <td>Contact:</td>
                <td><?php echo $row["hiring_contact"] ?></td>
            </tr>

            <tr>
                <td>Email:</td>
                <td><?php echo $row["hiring_email"] ?></td>
            </tr>
            <tr>
                <td>State:</td>
                <td><?php echo $row["state_name"] ?></td>
            </tr>

            <tr>
                <td>District:</td>
                <td><?php echo $row["district_name"] ?></td>
            </tr>

            <tr>
                <td>Place:</td>
                <td><?php echo $row["place_name"] ?></td>
            </tr>

            <tr>
                <td>Hirer Type:</td>
                <td><?php echo $row["hiring_type"] ?></td>
            </tr>
        </table>

        <a href="editprofile.php" class="btn btn-primary">Edit Profile</a>
    </div>
</body>
</html>

<?php
ob_flush();
include("Foot.php");

?>