<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/connection.php");
session_start();


 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Applications</title>
</head>
<body>
<div class="container mt-5">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Hirer Name</th>
                    <th>Project Name</th>
                    <th>Project Description</th>
                    <th>Application Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $sel = "select * from tbl_projectapplication pa inner join tbl_userregistration ug on pa.user_id = ug.user_id inner join tbl_projectdetails dt on dt.project_id = pa.project_id inner join tbl_hiringteam ht on dt.hiring_id = ht.hiring_id where ug.user_id = '".$_SESSION["uid"]."'";
                $data = $con->query($sel);
                while($row = $data->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $row["hiring_name"] ?></td>
                    <td><?php echo $row["project_title"] ?></td>
                    <td><?php echo $row["project_details"] ?></td>
                    <td>
                        <?php
                        if($row["application_status"] == 0) {
                            echo '<span class="badge badge-warning">Pending</span>';
                        } elseif($row["application_status"] == 1) {
                            echo '<span class="badge badge-success">Congrats..You are selected</span>';
                        } else {
                            echo '<span class="badge badge-danger">We wish you well, better luck next time</span>';
                        }
                        ?>
            
                    </td>
                    <td>
                        <a href="Chat.php?chatId=<?php echo $row["hiring_id"]?>" class="btn btn-primary">Chat</a>
                        <a href="Complaint.php?complaintId=<?php echo $row["hiring_id"]?>" class="btn btn-primary">Complaints</a>
                       
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <a class="btn btn-primary" href="./Feedback.php">Review</a>
    </div>
</body>
</html>


<?php
ob_flush();
include("Foot.php");

?>