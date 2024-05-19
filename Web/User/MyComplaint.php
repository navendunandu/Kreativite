<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Complaints</title>
</head>
<body>
    <div class="container">
    <table class="table table-bordered">
        <thead class="bg-light">
        <tr>
            <th>SI No</th>
            <th>Complaint Title</th>
            <th>Complaint Content</th>
            <th>Accused Name</th>
            <th>Complaint Response</th>
        </tr>
        </thead>
        <?php
            $i = 0;
            $selQry = "select * from tbl_complaint c inner join tbl_userregistration ur on c.user_id = ur.user_id inner join tbl_hiringteam ht on c.hiring_id = ht.hiring_id where c.user_id='".$_SESSION["uid"]."' and complaint_from='User'";
            $data = $con->query($selQry);
            while($row=$data->fetch_assoc())
            {
                $i++;
        ?>

        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row["complaint_title"] ?></td>
            <td><?php echo $row["complaint_content"] ?></td>
            <td><?php echo $row["hiring_name"] ?></td>
            <td>
                        <?php
                            if($row["complaint_status"] == 0)
                            {
                        ?>
                        <span class="badge badge-warning">Waiting for Response</span>
                        <?php }
                            else
                            {
                                echo $row["complaint_reply"];
                            }
                        ?>
                    </td>
        </tr>


<?php } ?>
    </table>
    </div>
</body>
</html>

<?php
ob_flush();
include("Foot.php");


?>