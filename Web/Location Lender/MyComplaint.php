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
   <table class="table table-bordered">
    <tr>
        <th>SI No</th>
        <th>Complaint Title</th>
        <th>Complaint Contet</th>
        <th>Accused Name</th>
        <th>Complaint Reply</th>
    </tr>
    <?php
    $i = 0;
    $selQry = "select * from tbl_complaint c inner join tbl_locationlender l on c.lender_id = l.lender_id inner join tbl_hiringteam h on c.hiring_id = h.hiring_id where c.lender_id='".$_SESSION["lid"]."' and complaint_from ='Lender' ";
    $data = $con->query($selQry);
    while($row = $data->fetch_assoc())
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
</body>
</html>


<?php
ob_flush();
include("Foot.php");

?>