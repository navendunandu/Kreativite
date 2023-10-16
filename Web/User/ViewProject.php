


<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include('Head.php');
 ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Project</title>
</head>

<body>

<div class="container mt-5">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>SI No</th>
                    <th>Project Name</th>
                    <th>Project Details</th>
                    <th>Project Image</th>
                    <th>Hirer Name</th>
                    <th>Hirer Contact</th>
                    <th>Hirer Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selQry = "select * from tbl_projectdetails p inner join tbl_hiringteam h on p.hiring_id = h.hiring_id";
                $selData = $con->query($selQry);
                while($row = $selData->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row["project_title"] ?></td>
                    <td><?php echo $row["project_details"] ?></td>
                    <td><img src="../assets/files/Hiringteam/ProjectImg/<?php echo $row["project_image"]?>" width="100" /></td>
                    <td><?php echo $row["hiring_name"] ?></td>
                    <td><?php echo $row["hiring_contact"] ?></td>
                    <td><?php echo $row["hiring_email"] ?></td>
                    <td>
                        <a href="AddApplication.php?applyId=<?php echo $row["project_id"] ?>" class="btn btn-primary">Apply</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<?php
ob_flush();
include('Foot.php');
?>
</html>


