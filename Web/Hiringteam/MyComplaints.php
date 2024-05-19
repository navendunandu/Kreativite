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
    <h2>My Complaints</h2>
    <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Complaint Title</th>
                    <th>Complaint Content</th>
                    <th>Accused</th>
                    <th>Complaint Reply</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    $selQry = "select * from tbl_complaint c inner join tbl_hiringteam ht on c.hiring_id = ht.hiring_id where complaint_from='Hiring-team' and ht.hiring_id='".$_SESSION["hid"]."'";
                    // echo $selQry;
                    $data = $con->query($selQry);
                    while($row = $data->fetch_assoc()) {
                        if($row['user_id']!=0){
                            $selVictim="select user_id,userreg_name as victim_name from tbl_userregistration where user_id=".$row['user_id'];
                            $resVictim=$con->query($selVictim);
                            $dataVictim=$resVictim->fetch_assoc();
                            $victim="User: ".$dataVictim['victim_name'];
                        }
                        else {
                            $selVictim="select lender_id, lender_name as victim_name from tbl_locationlender where lender_id=".$row['lender_id'];
                            // echo $selVictim;
                            $resVictim=$con->query($selVictim);
                            $dataVictim=$resVictim->fetch_assoc();
                            $victim="Lender: ".$dataVictim['victim_name'];
                        }
                ?>
                <tr>
                    <td><?php echo $row["complaint_title"] ?></td>
                    <td><?php echo $row["complaint_content"] ?></td>
                    <td><?php echo $victim ?></td>
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
            </tbody>
        </table>
</body>
</html>

<?php
ob_flush();
include("Foot.php")

?>