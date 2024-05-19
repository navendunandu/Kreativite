<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");

if(isset($_POST["btn_submit"]))
{
    $updateQry = "update tbl_complaint set complaint_status = 1 , complaint_reply='".$_POST["comp-reply"]."' where complaint_id='".$_GET["compId"]."' ";
    if($con->query($updateQry))
    {
        echo "Success";
    }
    else
    {
        echo "Failed";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Reply</title>
</head>
<body>
<div class="container mt-5">
        <form method="POST">
            <div class="form-group">
                <label for="comp-reply">Complaint Reply</label>
                <textarea required class="form-control" name="comp-reply" id="comp-reply" rows="5"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
                <button type="reset" class="btn btn-secondary" name="btn_reset">Reset</button>
            </div>
        </form>
    </div>

</body>
</html>