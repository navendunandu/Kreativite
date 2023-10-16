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
<title>Applicant Profile</title>
</head>

<body>
<div class="container mt-5">
        <?php
        $selQry = "select * from tbl_previouswork pw inner join tbl_userregistration ur on pw.user_id = ur.user_id where pw.user_id ='".$_GET["userId"]."'";
        $data = $con->query($selQry);
        if($row = $data->fetch_assoc())
        {
        ?>
        <table class="table table-bordered" align="center">
            <tr>
                <td>Applicant Photo</td>
                <td>
                    <img src="../assets/files/user/Photo/<?php echo $row["userreg_photo"]?>" width="200px" />
                </td>
            </tr>
            <tr>
                <td>Applicant Name</td>
                <td><?php echo $row["userreg_name"] ?></td>
            </tr>
            <tr>
                <td>Applicant Contact</td>
                <td><?php echo $row["userreg_contact"] ?></td>
            </tr>
            <tr>
                <td>Applicant Email</td>
                <td><?php echo $row["userreg_email"] ?></td>
            </tr>
        </table>
        <?php } ?>
        <h2 align="center">Works</h2>
        <table class="table table-bordered" align="center">
            <?php
            $i = 0;
            $selQry2 = "select * from tbl_previouswork where user_id = '".$_GET["userId"]."'";
            $data2 = $con->query($selQry2);
            while($row2 = $data2->fetch_assoc())
            {
                $i++;
            ?>
            <tr>
                <td align="center">
                    <img src="../assets/files/user/Photo/<?php echo $row2["work_image"]?>" height="200px" />
                    <p><?php echo $row2["work_details"] ?></p><br />
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>