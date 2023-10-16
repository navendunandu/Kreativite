<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/connection.php");
session_start();

$selUserQuery = "select*from tbl_userregistration u inner join tbl_place p on p.place_id = u.place_id inner join tbl_district d on d.district_id = p.district_id inner join tbl_state s on s.state_id = d.state_id  inner join tbl_usertype ut on u.usertype_id=ut.usertype_id where user_id='".$_SESSION["uid"]."'";
$userData = $con->query($selUserQuery);
$userRow = $userData->fetch_assoc();    



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
                <td>Image:</td>
                <td>
                    <img src="../Assets/Files/User/Photo/<?php echo $userRow["userreg_photo"] ?>"  width="350px" alt="" name="user-photo" id="user-photo" />
                </td>
            </tr>
            <tr>
                <td>Name:</td>
                <td>
                    <?php echo $userRow["userreg_name"] ?>
                </td>
            </tr>
            <tr>
                <td>Contact:</td>
                <td>
                    <?php echo $userRow["userreg_contact"] ?>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <?php echo $userRow["userreg_email"]?>
                </td>
            </tr>
            <tr>
                <td>State</td>
                <td>
                    <?php echo $userRow["state_name"]?>
                </td>
            </tr>
            <tr>
                <td>District</td>
                <td>
                    <?php echo $userRow["district_name"] ?>
                </td>
            </tr>
            <tr>
                <td>Place</td>
                <td>
                    <?php echo $userRow["place_name"] ?>
                </td>
            </tr>
            <tr>
                <td>User Type:</td>
                <td>
                    <?php echo $userRow["usertype_name"] ?>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>



<?php
ob_flush();
include("Foot.php");

?>