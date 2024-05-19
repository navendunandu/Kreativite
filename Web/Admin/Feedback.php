<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feebacks</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center">User Feedback</h2>
        <table class="table table-bordered">
            <th>User Name:</th>
            <th>User Feedback</th>

            <?php
            $i=0;
            $selQry1 = "select * from tbl_feedback f inner join tbl_userregistration ur on f.user_id = ur.user_id where f.user_id > 0";
            $data = $con->query($selQry1);
            while($row1 = $data->fetch_assoc())
            {
                $i++;
            
            ?>

            <tr>
                <td><?php echo $row1["userreg_name"] ?></td>
                <td><?php echo $row1["feedback_content"] ?></td>
            </tr>

           <?php } ?> 
        </table>
        
    </div>
    <div class="container">
        <h2 class="text-center">Hiring Team Feedback</h2>
        <table class="table table-bordered">
            <th>Hirer Name:</th>
            <th>Hirer Feedback</th>

            <?php
            $i=0;
            $selQry1 = "select * from tbl_feedback f inner join tbl_hiringteam ht on f.hiring_id = ht.hiring_id where f.hiring_id > 0";
            $data = $con->query($selQry1);
            while($row1 = $data->fetch_assoc())
            {
                $i++;
            
            ?>

            <tr>
                <td><?php echo $row1["hiring_name"] ?></td>
                <td><?php echo $row1["feedback_content"] ?></td>
            </tr>

           <?php } ?> 
        </table>
        
    </div>
    <div class="container">
        <h2 class="text-center">Location Lender Feedback</h2>
        <table class="table table-bordered">
            <th>Lender Name:</th>
            <th>Lender Feedback</th>

            <?php
            $i=0;
            $selQry1 = "select * from tbl_feedback f inner join tbl_locationlender ll on f.lender_id = ll.lender_id where f.lender_id > 0";
            $data = $con->query($selQry1);
            while($row1 = $data->fetch_assoc())
            {
                $i++;
            
            ?>

            <tr>
                <td><?php echo $row1["lender_name"] ?></td>
                <td><?php echo $row1["feedback_content"] ?></td>
            </tr>

           <?php } ?> 
        </table>
        
    </div>
</body>
</html>