<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php")



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
</head>
<body>
<div class="container mt-5">
        <h2 class="mb-4">Hiring Team Complaints</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="w-20">Victim</th>
                    <th class="w-20">Complaint Title</th>
                    <th class="w-20">Complaint Content</th>
                    <th class="w-20">Accused</th>
                    <th class="w-20">Complaint Reply</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    $selQry = "select * from tbl_complaint c inner join tbl_hiringteam ht on c.hiring_id = ht.hiring_id where complaint_from='Hiring-team'";
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
                    <td class="w-20"><?php echo $row["hiring_name"] ?></td>
                    <td class="w-20"><?php echo $row["complaint_title"] ?></td>
                    <td class="w-20"><?php echo $row["complaint_content"] ?></td>
                    <td class="w-20"><?php echo $victim ?></td>
                    <td class="w-20">
                        <?php
                            if($row["complaint_status"] == 0)
                            {
                        ?>
                        <a href="ComplaintReply.php?compId=<?php echo $row["complaint_id"] ?>" class="btn btn-danger">Respond</a>
                        
                        <?php }
                        else
                        {
                         ?>
                         <span>Responded</span>   
                        <?php } ?>
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <h2 class="mb-4">Lender Complaints</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Victim</th>
                    <th>Complaint Title</th>
                    <th>Complaint Content</th>
                    <th>Accused</th>
                    <th>Complaint Reply</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    $selQry = "select * from tbl_complaint c inner join tbl_locationlender lr on c.lender_id = lr.lender_id inner join tbl_hiringteam ht on c.hiring_id = ht.hiring_id where complaint_from='Lender' ";
                    $data = $con->query($selQry);
                    while($row = $data->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["lender_name"] ?></td>
                    <td><?php echo $row["complaint_title"] ?></td>
                    <td><?php echo $row["complaint_content"] ?></td>
                    <td><?php echo $row["hiring_name"] ?></td>
                    <td>
                        <?php
                            if($row["complaint_status"] == 0)
                            {
                        ?>
                        <a href="ComplaintReply.php?compId=<?php echo $row["complaint_id"] ?>" class="btn btn-danger">Respond</a>
                        
                        <?php }
                        else
                        {
                         ?>
                         <span>Responded</span>   
                        <?php } ?>
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <h2 class="mb-4">User Complaints</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Victim</th>
                    <th>Complaint Title</th>
                    <th>Complaint Content</th>
                    <th>Accused</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    $selQry = "select * from tbl_complaint c inner join tbl_userregistration ur on c.user_id = ur.user_id inner join tbl_hiringteam ht on c.hiring_id = ht.hiring_id where complaint_from ='User'";
                    $data = $con->query($selQry);
                    while($row = $data->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["userreg_name"] ?></td>
                    <td><?php echo $row["complaint_title"] ?></td>
                    <td><?php echo $row["complaint_content"] ?></td>
                    <td><?php echo $row["hiring_name"] ?></td>
                    <td>
                        <?php
                            if($row["complaint_status"] == 0)
                            {
                        ?>
                        <a href="ComplaintReply.php?compId=<?php echo $row["complaint_id"] ?>" class="btn btn-danger">Respond</a>
                        
                        <?php }
                        else
                        {
                         ?>
                         <span>Responded</span>   
                        <?php } ?>
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>